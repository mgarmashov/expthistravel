<?php

namespace App\Services;

use App\Models\User;

class AdminNotifications
{
    public static function AdminNotify($notification)
    {
        $admin = User::where('login', config('app.USER_NOTIFY'))->first();

        if (!count($admin)) {
            $admin = User::where('email', config('app.DEFAULT_EMAIL_NOTIFY'))->first();
        }
        if (!count($admin)) {

            $admin = new User;
            $admin->email = config('app.DEFAULT_EMAIL_NOTIFY');
            $admin->login = 'notificationUser';
            $admin->save();
        }

        $admin->notify($notification);
    }
}
