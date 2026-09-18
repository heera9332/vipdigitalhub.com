<?php

use App\Services\SiteSettingsService;

if (! function_exists('setting')) {
    /**
     * Get a site setting value with optional default fallback.
     */
    function setting(?string $key = null, mixed $default = null): mixed
    {
        $service = app(SiteSettingsService::class);

        if (is_null($key)) {
            return $service;
        }

        return $service->get($key, $default);
    }
}
