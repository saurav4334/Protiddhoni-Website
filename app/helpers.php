<?php

use App\Models\PageBlock;
use App\Models\Setting;

if (! function_exists('block')) {
    /** Dynamic page-block content with a static fallback. */
    function block(string $key, mixed $default = null): mixed
    {
        return PageBlock::value($key, $default);
    }
}

if (! function_exists('setting')) {
    /** Site setting with a static fallback. */
    function setting(string $key, mixed $default = null): mixed
    {
        return Setting::get($key, $default);
    }
}
