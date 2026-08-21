<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdminRole;
use App\Enums\AdminStatus;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\SubAdminApprovedNotification;
use App\Notifications\SubAdminRejectedNotification;
use App\Notifications\SubAdminAutoPublishToggledNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubAdminManagementController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status', 'all');
        $search = $request->query('q');

        $subAdmins = Admin::query()
            ->where('role', AdminRole::SubAdmin)
            ->when($status !== 'all', fn ($query) => $query->where('status', $status))
            ->when($search, fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->withCount('offers', 'blogs')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.sub-admins.index', [
            'subAdmins' => $subAdmins,
            'activeStatus' => $status,
            'search' => $search,
            'statusCounts' => [
                'all' => Admin::where('role', AdminRole::SubAdmin)->count(),
                'pending' => Admin::where('role', AdminRole::SubAdmin)->where('status', AdminStatus::Pending)->count(),
                'approved' => Admin::where('role', AdminRole::SubAdmin)->where('status', AdminStatus::Approved)->count(),
                'rejected' => Admin::where('role', AdminRole::SubAdmin)->where('status', AdminStatus::Rejected)->count(),
            ],
        ]);
    }

    public function show(Admin $subAdmin): View
    {
        abort_if($subAdmin->role === AdminRole::SuperAdmin, 404);

        $offers = $subAdmin->offers()->latest()->paginate(10);

        return view('admin.sub-admins.show', [
            'subAdmin' => $subAdmin,
            'offers' => $offers,
        ]);
    }

    public function approve(Admin $subAdmin): RedirectResponse
    {
        $subAdmin->forceFill([
            'status' => AdminStatus::Approved,
            'rejection_reason' => null,
        ])->save();

        $subAdmin->notify(new SubAdminApprovedNotification());

        return back()->with('status', 'Sub-Admin approved successfully.');
    }

    public function reject(Request $request, Admin $subAdmin): RedirectResponse
    {
        $validated = $request->validate(['rejection_reason' => ['required', 'string', 'max:500']]);

        $subAdmin->forceFill([
            'status' => AdminStatus::Rejected,
            'rejection_reason' => $validated['rejection_reason'],
        ])->save();

        $subAdmin->notify(new SubAdminRejectedNotification($validated['rejection_reason']));

        return back()->with('status', 'Sub-Admin access rejected.');
    }

    public function toggleAutoPublish(Admin $subAdmin): RedirectResponse
    {
        abort_if($subAdmin->role === AdminRole::SuperAdmin, 404);

        $enabling = !$subAdmin->auto_publish_offers;

        $subAdmin->forceFill(['auto_publish_offers' => !$subAdmin->auto_publish_offers])->save();

        $subAdmin->forceFill(['auto_publish_offers' => $enabling])->save();

        if ($enabling) {
            $subAdmin->notify(new \App\Notifications\SubAdminAutoPublishToggledNotification(true));
        }

        return back()->with('status', $enabling ? 'Auto-publish enabled for this Sub-Admin.' : 'Auto-publish disabled for this Sub-Admin.');
    }

    public function destroy(Admin $subAdmin): RedirectResponse
    {
        abort_if($subAdmin->role === AdminRole::SuperAdmin, 404);

        $subAdmin->delete();

        return redirect()->route('admin.sub-admins.index')->with('status', 'Sub-Admin removed.');
    }
}