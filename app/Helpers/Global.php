<?php

use App\Traits\HasPermissionsTrait;

if (!function_exists('is_can')) {
    function is_can($roles = [])
    {
        if (!auth()->user()) {
            return false;
        }
        if (empty($roles) || auth()->user()->is_admin  == 1) {
            return true;
        }
        $role_group =
            collect(auth()->user()->groups->pluck('group_role_json'))->map(function ($value) {
                if (is_json($value)) {
                    return json_decode($value);
                }
            });
        if ($role_group->isEmpty()) {
            return false;
        }
        $role_group = $role_group->flatten(2)->unique();
        foreach ($roles as $role) {
            if ($role_group->contains($role)) {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('is_json')) {
    function is_json($string)
    {
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE);
    }
}

if (!function_exists('is_admin')) {
    function is_admin()
    {
        return auth()->user()->is_admin;
    }
}

if (!function_exists('auth_user')) {
    function auth_user()
    {
        return auth()->user();
    }
}
