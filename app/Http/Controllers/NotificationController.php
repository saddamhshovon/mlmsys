<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{

    public function allNotification()
    {
        $id = session('ADMIN_ID');
        $admin = Admin::first();
        $notifications = $admin->notifications()->paginate(5);
        return view('admin.notification.all', compact('notifications'));
    }

    public function markAsRead()
    {
        $id = session('ADMIN_ID');
        $admin = Admin::first();
        $admin->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function newMemberNotification()
    {
        $admin = Admin::first();
        $notifications = $admin->notifications()->where('data->is_active', '1')->paginate(5);
        return view('admin.notification.new-member', compact('notifications'));
    }

    public function withdrawFundNotification()
    {
        $admin = Admin::first();
        $notifications = $admin->notifications()->where('data->f_type', '0')->paginate(5);
        // dd($notifications);
        return view('admin.notification.withdraw-fund', compact('notifications'));
    }

    public function addFundNotification()
    {
        $admin = Admin::first();
        $notifications = $admin->notifications()->where('data->f_type', '1')->paginate(5);
        // dd($notifications);
        return view('admin.notification.add-fund', compact('notifications'));
    }

    public function readNotification()
    {
        $admin = Admin::first();
        $notifications = $admin->readNotifications()->paginate(5);
        return view('admin.notification.read', compact('notifications'));
    }

    public function unreadNotification()
    {
        $admin = Admin::first();
        $notifications = $admin->unreadNotifications()->paginate(5);
        return view('admin.notification.unread', compact('notifications'));
    }
}
