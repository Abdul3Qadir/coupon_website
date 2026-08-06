<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function index(Request $request): View
    {
        $brand = $request->user('brand');
        $filter = $request->query('filter', 'all');

        $query = $brand->notifications()->latest();

        if ($filter === 'unread') {
            $query->whereNull('read_at');
        }

        return view('brand.notifications.index', [
            'notifications' => $query->paginate(20)->withQueryString(),
            'activeFilter' => $filter,
            'unreadCount' => $brand->unreadNotifications()->count(),
        ]);
    }

    public function markRead(Request $request, string $id): RedirectResponse
    {
        $notification = $request->user('brand')->notifications()->findOrFail($id);
        $notification->markAsRead();

        $url = $notification->data['action_url'] ?? null;
        return $url ? redirect($url) : back();
    }

    public function markAllRead(Request $request): RedirectResponse
    {
        $request->user('brand')->unreadNotifications->markAsRead();
        return back()->with('status', 'All notifications marked as read.');
    }
}