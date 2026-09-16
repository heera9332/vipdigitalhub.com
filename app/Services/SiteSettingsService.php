<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class SiteSettingsService
{
    protected const CACHE_KEY = 'site_settings_all';
    protected const CACHE_TTL = 86400; // 24 hours

    /**
     * Get a setting by key.
     */
    public function get(string $key, mixed $default = null): mixed
    {
        $settings = $this->all();

        if (array_key_exists($key, $settings)) {
            return $settings[$key];
        }

        // Fallback to agency config if exists
        $agencyConfigKey = match ($key) {
            'site_name' => 'agency.name',
            'site_tagline' => 'agency.tagline',
            'site_email' => 'agency.email',
            'site_phone' => 'agency.phone',
            'site_address' => 'agency.address',
            'site_website' => 'agency.website',
            'default_meta_title' => 'agency.default_seo.title',
            'default_meta_description' => 'agency.default_seo.description',
            default => 'agency.' . $key,
        };

        if (config()->has($agencyConfigKey)) {
            return config($agencyConfigKey);
        }

        return $default;
    }

    /**
     * Get all cached settings.
     */
    public function all(): array
    {
        try {
            if (! Schema::hasTable('site_settings')) {
                return [];
            }

            return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
                return SiteSetting::all()
                    ->mapWithKeys(fn (SiteSetting $setting) => [$setting->key => $setting->casted_value])
                    ->toArray();
            });
        } catch (\Throwable) {
            return [];
        }
    }

    /**
     * Set a setting value and clear cache.
     */
    public function set(string $key, mixed $value, string $type = 'text', string $group = 'general'): SiteSetting
    {
        $stringValue = is_array($value) ? json_encode($value) : (string) $value;

        $setting = SiteSetting::updateOrCreate(
            ['key' => $key],
            [
                'value' => $stringValue,
                'type' => $type,
                'group' => $group,
            ]
        );

        $this->clearCache();

        return $setting;
    }

    /**
     * Clear the cached settings.
     */
    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
