<?php

use App\Models\Setting;
use App\Models\Page;

if (!function_exists('setting')) {
    function setting($key, $default = null) {
        $settings = Setting::first();

        return $settings?->{$key} ?? $default;
    }
}

if (!function_exists('navigationPages')) {
    function navigationPages() {
        return Page::where('status', 'published')            
            ->get();
    }
}

?>