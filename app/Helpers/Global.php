<?php

use App\Traits\HasPermissionsTrait;

if (!function_exists('is_can')) {
    function is_can($roles = [])
    {
        return true;
        if (!auth()->user()) {
            return false;
        }
        if (empty($roles) || auth()->user()->is_admin  == 1) {
            return true;
        }
        $role_group = auth()->user()->groupRole;

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
if (!function_exists('addVersionTo')) {
    function addVersionTo($pathFile, $timestamp = '')
    {
        $path            = public_path($pathFile);
        $timestamp       = !empty($timestamp) ? $timestamp : \File::lastModified($path);
        $url             = asset($pathFile);
        $param_separator = (strpos($url, '?') !== false) ? '&' : '?';
        return $url . $param_separator . 'v=' . $timestamp;
    }
}

if (!function_exists('templateAsset')) {
    function templateAsset($fileName, $timestamp = '')
    {
        $pathFile        = config('template.config.base_dir') . $fileName;
        $path            = public_path($pathFile);
        $timestamp       = !empty($timestamp) ? $timestamp : \File::lastModified($path);
        $url             = asset($pathFile);
        $param_separator = (strpos($url, '?') !== false) ? '&' : '?';
        return $url . $param_separator . 'v=' . $timestamp;
    }
}

if (!function_exists('bladeAsset')) {
    function bladeAsset($fileName)
    {
        $pathFile        = config('template.config.blade_dir') . $fileName;
        return $pathFile;
    }
}

if(!function_exists('formatPrice')) {
    function formatPrice($price) {
        return number_format($price, 0, '', ','); // 1,000,000
    }
}
