<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BrandStatus;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Notifications\BrandAutoPublishEnabledNotification;
use App\Notifications\BrandRejectedNotification;
use App\Notifications\BrandVerifiedNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Notifications\BrandFeaturedNotification;

class BrandManagementController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status', 'all');
        $search = $request->query('q');

        $brands = Brand::query()
            ->when($status !== 'all', fn ($query) => $query->where('status', $status))
            ->when($search, fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->withCount('offers')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.brands.index', [
            'brands' => $brands,
            'activeStatus' => $status,
            'search' => $search,
            'statusCounts' => [
                'all' => Brand::count(),
                'pending' => Brand::where('status', BrandStatus::Pending)->count(),
                'verified' => Brand::where('status', BrandStatus::Verified)->count(),
                'rejected' => Brand::where('status', BrandStatus::Rejected)->count(),
                'suspended' => Brand::where('status', BrandStatus::Suspended)->count(),
            ],
        ]);
    }

    public function show(Brand $brand): View
    {
        $brand->load(['category', 'verifier']);
        $offers = $brand->offers()->latest()->paginate(10);

        return view('admin.brands.show', [
            'brand' => $brand,
            'offers' => $offers,
        ]);
    }

    public function verify(Brand $brand): RedirectResponse
    {
        $brand->forceFill([
            'status' => BrandStatus::Verified,
            'verified_by' => auth('admin')->id(),
            'verified_at' => now(),
            'rejection_reason' => null,
        ])->save();

        $brand->notify(new BrandVerifiedNotification());

        return back()->with('status', 'Brand verified successfully.');
    }

    public function reject(Request $request, Brand $brand): RedirectResponse
    {
        $validated = $request->validate([
            'rejection_reason' => ['required', 'string', 'max:500'],
        ]);

        $brand->forceFill([
            'status' => BrandStatus::Rejected,
            'rejection_reason' => $validated['rejection_reason'],
            'verified_by' => auth('admin')->id(),
            'verified_at' => now(),
        ])->save();

        $brand->notify(new BrandRejectedNotification($validated['rejection_reason']));

        return back()->with('status', 'Brand registration rejected.');
    }

    public function suspend(Brand $brand): RedirectResponse
    {
        $brand->forceFill(['status' => BrandStatus::Suspended])->save();

        return back()->with('status', 'Brand suspended.');
    }

    public function reinstate(Brand $brand): RedirectResponse
    {
        $brand->forceFill(['status' => BrandStatus::Verified])->save();

        return back()->with('status', 'Brand reinstated.');
    }

    public function toggleAutoPublish(Brand $brand): RedirectResponse
    {
        $enabling = !$brand->auto_publish_offers;

        $brand->forceFill(['auto_publish_offers' => $enabling])->save();

        if ($enabling) {
            $brand->notify(new BrandAutoPublishEnabledNotification());
        }

        return back()->with('status', $enabling ? 'Auto-publish enabled for this brand.' : 'Auto-publish disabled for this brand.');
    }

    public function toggleFeatured(Brand $brand): RedirectResponse
    {
        $enabling = !$brand->is_featured;
        
        $brand->forceFill(['is_featured' => $enabling])->save();
        
        $brand->notify(new \App\Notifications\BrandFeaturedNotification($brand, $enabling));
        
        $message = $enabling 
            ? 'Brand marked as featured.' 
            : 'Brand removed from featured.';
        
        return back()->with('status', $message);
    }
}