<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\RedirectResponse;

class OfferRedirectController extends Controller
{
    public function __invoke(Offer $offer): RedirectResponse
    {
        $offer->increment('clicks_count');

        return redirect()->away($offer->redirect_url);
    }
}