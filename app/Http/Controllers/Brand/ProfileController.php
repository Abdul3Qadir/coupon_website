<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\UpdatePasswordRequest;
use App\Http\Requests\Brand\UpdateProfileRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Enums\AdminRole;
use App\Models\Admin;
use App\Notifications\BrandAllowAdminNotification;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('brand.profile.edit', [
            'brand' => $request->user('brand'),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $brand = $request->user('brand');
        $data = $request->validated();

        if ($request->hasFile('small_logo')) {
            if ($brand->small_logo) {
                Storage::disk('public')->delete($brand->small_logo);
            }
            $data['small_logo'] = $request->file('small_logo')->store('brand-logos', 'public');
        }

        if ($request->hasFile('large_logo')) {
            if ($brand->large_logo) {
                Storage::disk('public')->delete($brand->large_logo);
            }
            $data['large_logo'] = $request->file('large_logo')->store('brand-logos', 'public');
        }

        $data['social_links'] = array_filter([
            'facebook' => $request->input('facebook_url'),
            'instagram' => $request->input('instagram_url'),
            'twitter' => $request->input('twitter_url'),
        ]);

        $wasAllowing = $brand->allow_admin_to_add_offers;
        $willAllow = $request->boolean('allow_admin_to_add_offers');

        $brand->update($data);

        if (!$wasAllowing && $willAllow) {
            $admins = \App\Models\Admin::whereIn('role', [\App\Enums\AdminRole::SuperAdmin, \App\Enums\AdminRole::SubAdmin])->get();
            foreach ($admins as $admin) {
                $admin->notify(new \App\Notifications\BrandAllowAdminNotification($brand));
            }
        }

        return back()->with('status', 'Your profile has been updated.');
    }

    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        $brand = $request->user('brand');
        $brand->forceFill(['password' => $request->validated()['password']])->save();

        return back()->with('status', 'Your password has been changed.');
    }
}