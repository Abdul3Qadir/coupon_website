<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function index(Request $request): View
    {
        $admin = $request->user('admin');
        $filter = $request->query('filter', 'all');

        $query = $admin->notifications()->latest();

        if ($filter === 'unread') {
            $query->whereNull('read_at');
        }

        return view('admin.notifications.index', [
            'notifications' => $query->paginate(20)->withQueryString(),
            'activeFilter' => $filter,
            'unreadCount' => $admin->unreadNotifications()->count(),
        ]);
    }

    public function markRead(Request $request, string $id): RedirectResponse
    {
        $notification = $request->user('admin')->notifications()->findOrFail($id);
        $notification->markAsRead();

        $url = $notification->data['action_url'] ?? null;
        return $url ? redirect($url) : back();
    }

    public function markAllRead(Request $request): RedirectResponse
    {
        $request->user('admin')->unreadNotifications->markAsRead();
        return back()->with('status', 'All notifications marked as read.');
    }
}