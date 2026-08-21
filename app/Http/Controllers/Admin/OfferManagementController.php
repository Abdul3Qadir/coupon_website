<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OfferStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Offer;
use App\Notifications\BrandOfferAddedNotification;
use App\Notifications\OfferApprovedNotification;
use App\Notifications\OfferRejectedNotification;
use App\Notifications\OfferPendingReviewNotification;
use App\Services\OfferStatusResolver;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OfferManagementController extends Controller
{
    public function index(Request $request): View
    {
        $admin = $request->user('admin');
        $isSuperAdmin = $admin->isSuperAdmin();
        $status = $request->query('status', $isSuperAdmin ? 'pending' : 'all');
        $brandId = $request->query('brand_id');

        $query = Offer::with(['brand', 'createdByAdmin'])->latest();

        if (!$isSuperAdmin) {
            $query->where('created_by_admin_id', $admin->id);
        }

        $query->when($status !== 'all', fn ($q) => $q->where('status', $status))
            ->when($brandId, fn ($q) => $q->where('brand_id', $brandId));

        $countQuery = Offer::query();
        if (!$isSuperAdmin) {
            $countQuery->where('created_by_admin_id', $admin->id);
        }

        return view('admin.offers.index', [
            'offers' => $query->paginate(15)->withQueryString(),
            'activeStatus' => $status,
            'isSuperAdmin' => $isSuperAdmin,
            'brands' => $isSuperAdmin ? Brand::orderBy('name')->get(['id', 'name']) : collect(),
            'selectedBrandId' => $brandId,
            'statusCounts' => [
                'all' => (clone $countQuery)->count(),
                'pending' => (clone $countQuery)->where('status', OfferStatus::Pending)->count(),
                'approved' => (clone $countQuery)->where('status', OfferStatus::Approved)->count(),
                'rejected' => (clone $countQuery)->where('status', OfferStatus::Rejected)->count(),
            ],
        ]);
    }

    public function show(Offer $offer): View
    {
        $offer->load(['brand', 'category', 'createdByAdmin', 'verifier']);
        return view('admin.offers.show', compact('offer'));
    }

    public function create(): View
    {
        return view('admin.offers.create', [
            'brands' => Brand::where('status', \App\Enums\BrandStatus::Verified)
                ->where('allow_admin_to_add_offers', true)
                ->orderBy('name')
                ->get(['id', 'name']),
            'categories' => Category::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(OfferRequest $request, OfferStatusResolver $resolver): RedirectResponse
    {
        $request->validate(['brand_id' => ['required', 'exists:brands,id']]);

        $brand = Brand::findOrFail($request->input('brand_id'));
        $admin = $request->user('admin');

        if (!$brand->allow_admin_to_add_offers) {
            return back()->with('error', $brand->name . ' does not allow admins to create offers on their behalf.');
        }

        $data = array_merge(
            $request->validated(),
            ['brand_id' => $brand->id],
            $resolver->resolveForAdminSubmission($admin)
        );

        $offer = Offer::create($data);

        $brand->notify(new BrandOfferAddedNotification($offer));

        if (!$admin->isSuperAdmin()) {
            $superAdmins = Admin::where('is_super_admin', true)->get();
            foreach ($superAdmins as $superAdmin) {
                $superAdmin->notify(new OfferPendingReviewNotification($offer, $admin));
            }
        }

        $isApproved = $offer->status && $offer->status->value === 'approved';
        $message = $isApproved
            ? 'Offer published automatically.'
            : 'Offer submitted for review.';

        return redirect()->route('admin.offers.index')->with('status', $message);
    }

    public function edit(Request $request, Offer $offer): View
    {
        $admin = $request->user('admin');

        if (!$admin->isSuperAdmin()) {
            abort_unless($offer->created_by_admin_id === $admin->id, 403);
        }

        return view('admin.offers.edit', [
            'offer' => $offer,
            'categories' => Category::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function update(OfferRequest $request, Offer $offer, OfferStatusResolver $resolver): RedirectResponse
    {
        $admin = $request->user('admin');

        if (!$admin->isSuperAdmin()) {
            abort_unless($offer->created_by_admin_id === $admin->id, 403);
        }

        $data = array_merge($request->validated(), $resolver->resolveForAdminSubmission($admin));

        $offer->update($data);

        $freshOffer = $offer->fresh();
        $isApproved = $freshOffer->status && $freshOffer->status->value === 'approved';
        $message = $isApproved
            ? 'Offer updated and published.'
            : 'Offer updated and submitted for review.';

        return redirect()->route('admin.offers.index')->with('status', $message);
    }

    public function destroy(Request $request, Offer $offer): RedirectResponse
    {
        $admin = $request->user('admin');

        if (!$admin->isSuperAdmin()) {
            abort_unless($offer->created_by_admin_id === $admin->id, 403);
        }

        $offer->delete();

        return back()->with('status', 'Offer removed.');
    }

    public function approve(Request $request, Offer $offer): RedirectResponse
    {
        $offer->forceFill([
            'status' => OfferStatus::Approved,
            'verified_by' => $request->user('admin')->id,
            'verified_at' => now(),
            'rejection_reason' => null,
        ])->save();

        $offer->brand->notify(new OfferApprovedNotification($offer));

        if ($offer->created_by_admin_id && $offer->created_by_admin_id !== $request->user('admin')->id) {
            $creator = Admin::find($offer->created_by_admin_id);
            if ($creator) {
                $creator->notify(new OfferApprovedNotification($offer));
            }
        }

        return back()->with('status', 'Offer approved.');
    }

    public function reject(Request $request, Offer $offer): RedirectResponse
    {
        $validated = $request->validate(['rejection_reason' => ['required', 'string', 'max:500']]);

        $offer->forceFill([
            'status' => OfferStatus::Rejected,
            'rejection_reason' => $validated['rejection_reason'],
            'verified_by' => $request->user('admin')->id,
            'verified_at' => now(),
        ])->save();

        $offer->brand->notify(new OfferRejectedNotification($offer, $validated['rejection_reason']));

        if ($offer->created_by_admin_id && $offer->created_by_admin_id !== $request->user('admin')->id) {
            $creator = Admin::find($offer->created_by_admin_id);
            if ($creator) {
                $creator->notify(new OfferRejectedNotification($offer, $validated['rejection_reason']));
            }
        }

        return back()->with('status', 'Offer rejected.');
    }
}