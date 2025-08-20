<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('currentUser')) {
    function currentUser()
    {
        return Auth::user();
    }
}

if (!function_exists('currentUserNotifications')) {
    function currentUserNotifications()
    {
        if (Auth::check()) {
            return Auth::user()->unreadNotifications;
        }
        return collect();
    }
}
