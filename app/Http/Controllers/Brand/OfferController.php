<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Models\Category;
use App\Models\Offer;
use App\Services\OfferStatusResolver;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OfferController extends Controller
{
    public function index(Request $request): View
    {
        $brand = $request->user('brand');
        $status = $request->query('status', 'all');

        $offers = $brand->offers()
            ->when($status !== 'all', fn ($q) => $q->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('brand.offers.index', [
            'offers' => $offers,
            'activeStatus' => $status,
            'statusCounts' => [
                'all' => $brand->offers()->count(),
                'approved' => $brand->offers()->where('status', 'approved')->count(),
                'pending' => $brand->offers()->where('status', 'pending')->count(),
                'rejected' => $brand->offers()->where('status', 'rejected')->count(),
            ],
        ]);
    }

    public function create(): View
    {
        return view('brand.offers.create', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(OfferRequest $request, OfferStatusResolver $resolver): RedirectResponse
    {
        $brand = $request->user('brand');
        $data = array_merge($request->validated(), $resolver->resolveForBrandSubmission($brand));

        $brand->offers()->create($data);

        return redirect()->route('brand.offers.index')->with('status', 'Your coupon or deal has been submitted.');
    }

    public function edit(Request $request, Offer $offer): View
    {
        abort_unless($offer->brand_id === $request->user('brand')->id, 403);

        return view('brand.offers.edit', [
            'offer' => $offer,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(OfferRequest $request, Offer $offer, OfferStatusResolver $resolver): RedirectResponse
    {
        abort_unless($offer->brand_id === $request->user('brand')->id, 403);

        $data = array_merge($request->validated(), $resolver->resolveForBrandSubmission($offer->brand));

        $offer->update($data);

        return redirect()->route('brand.offers.index')->with('status', 'Your changes have been saved.');
    }

    public function destroy(Request $request, Offer $offer): RedirectResponse
    {
        abort_unless($offer->brand_id === $request->user('brand')->id, 403);

        $offer->delete();

        return back()->with('status', 'Removed successfully.');
    }
}