<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'VIP Digital Hub', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Software Development & Digital Marketing Agency', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_email', 'value' => 'vipdigitalhub@gmail.com', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'site_phone', 'value' => '+91 7000153244', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'site_address', 'value' => 'Front of Petrol Pump, House No. 2, Shravan Kanta, NZM Bypass Road, Estate, Bhopal, Madhya Pradesh 462021', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'site_website', 'value' => 'https://vipdigitalhub.com/', 'type' => 'text', 'group' => 'general'],
            ['key' => 'business_hours', 'value' => 'Mon - Sat: 9:00 AM - 7:00 PM', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'default_meta_title', 'value' => 'VIP Digital Hub — Software Development & Digital Marketing Agency', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'default_meta_description', 'value' => 'VIP Digital Hub is a premium technology and digital marketing agency offering custom software development, web & mobile applications, SEO, and business growth solutions.', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/vipdigitalhub', 'type' => 'text', 'group' => 'social'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/vipdigitalhub', 'type' => 'text', 'group' => 'social'],
            ['key' => 'linkedin_url', 'value' => 'https://linkedin.com/company/vipdigitalhub', 'type' => 'text', 'group' => 'social'],
            ['key' => 'twitter_url', 'value' => 'https://x.com/vipdigitalhub', 'type' => 'text', 'group' => 'social'],
            ['key' => 'youtube_url', 'value' => 'https://youtube.com/@vipdigitalhub', 'type' => 'text', 'group' => 'social'],
            ['key' => 'whatsapp_url', 'value' => 'https://wa.me/917000153244', 'type' => 'text', 'group' => 'social'],
            ['key' => 'google_maps_url', 'value' => 'https://maps.google.com/?q=Bhopal,Madhya+Pradesh', 'type' => 'text', 'group' => 'contact'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        Cache::forget('site_settings_all');
    }
}
