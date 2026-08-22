<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AdminMessage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function index(Request $request): View
    {
        $admin = auth('admin')->user();
        
        if ($admin->isSuperAdmin()) {
            return $this->superAdminChat($request);
        } else {
            return $this->subAdminChat($request);
        }
    }

    private function superAdminChat(Request $request): View
    {
        $admin = auth('admin')->user();
        $selectedSubAdminId = $request->query('subadmin');

        // Get all sub-admins created by this super admin
        $subAdmins = $admin->subAdmins()
            ->where('status', 'approved')
            ->orderBy('name')
            ->get();

        $messages = [];
        $selectedSubAdmin = null;

        if ($selectedSubAdminId) {
            $selectedSubAdmin = $subAdmins->find($selectedSubAdminId);

            if ($selectedSubAdmin) {
                // Get all messages between super admin and this sub-admin
                $messages = AdminMessage::where(function ($query) use ($admin, $selectedSubAdmin) {
                    $query->where('sender_admin_id', $admin->id)
                        ->where('receiver_admin_id', $selectedSubAdmin->id);
                })->orWhere(function ($query) use ($admin, $selectedSubAdmin) {
                    $query->where('sender_admin_id', $selectedSubAdmin->id)
                        ->where('receiver_admin_id', $admin->id);
                })
                ->orderBy('created_at', 'asc')
                ->get();

                // Mark as read
                AdminMessage::where('receiver_admin_id', $admin->id)
                    ->where('sender_admin_id', $selectedSubAdmin->id)
                    ->whereNull('read_at')
                    ->update(['read_at' => now()]);
            }
        }

        return view('admin.chat.index', [
            'subAdmins' => $subAdmins,
            'selectedSubAdmin' => $selectedSubAdmin,
            'messages' => $messages,
        ]);
    }

    private function subAdminChat(Request $request): View
    {
        $admin = auth('admin')->user();
        $superAdmin = $admin->creator;

        // Get all messages with super admin
        $messages = AdminMessage::where(function ($query) use ($admin, $superAdmin) {
            $query->where('sender_admin_id', $admin->id)
                ->where('receiver_admin_id', $superAdmin->id);
        })->orWhere(function ($query) use ($admin, $superAdmin) {
            $query->where('sender_admin_id', $superAdmin->id)
                ->where('receiver_admin_id', $admin->id);
        })
        ->orderBy('created_at', 'asc')
        ->get();

        // Mark as read
        AdminMessage::where('receiver_admin_id', $admin->id)
            ->where('sender_admin_id', $superAdmin->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('admin.chat.subadmin', [
            'superAdmin' => $superAdmin,
            'messages' => $messages,
        ]);
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
            'receiver_admin_id' => ['required', 'exists:admins,id'],
        ]);

        $admin = auth('admin')->user();

        AdminMessage::create([
            'sender_admin_id' => $admin->id,
            'receiver_admin_id' => $validated['receiver_admin_id'],
            'message' => $validated['message'],
        ]);

        return back()->with('status', 'Message sent successfully.');
    }
}