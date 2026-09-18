<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSiteSettingRequest;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

class SiteSettingController extends Controller
{
    /**
     * Display the settings manager.
     */
    public function index(): View
    {
        $settingsByGroup = SiteSetting::all()->groupBy('group');

        return view('admin.settings.index', [
            'settingsByGroup' => $settingsByGroup,
        ]);
    }

    /**
     * Update settings in storage.
     */
    public function update(UpdateSiteSettingRequest $request): RedirectResponse
    {
        $settings = $request->validated('settings');

        foreach ($settings as $key => $value) {
            SiteSetting::where('key', $key)->update([
                'value' => $value ?? '',
            ]);
        }

        Cache::forget('site_settings_all');

        return back()->with('success', 'Site settings updated successfully.');
    }
}
