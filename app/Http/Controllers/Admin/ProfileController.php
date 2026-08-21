<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePasswordRequest;
use App\Http\Requests\Admin\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('admin.profile.edit', [
            'admin' => $request->user('admin'),
        ]);
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $admin = $request->user('admin');
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            if ($admin->avatar) {
                Storage::disk('public')->delete($admin->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('admin-avatars', 'public');
        }

        $admin->update($data);

        return back()->with('status', 'Your profile has been updated.');
    }

    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        $admin = $request->user('admin');
        $admin->forceFill(['password' => $request->validated()['password']])->save();

        return back()->with('status', 'Your password has been changed.');
    }
}