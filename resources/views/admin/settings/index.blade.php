<x-layouts.admin title="Site Settings">
    <x-slot:header>
        <div class="flex items-center justify-between gap-4">
            <div>
                <h1 class="text-xl font-bold text-slate-900 tracking-tight">Global Site Configuration</h1>
                <p class="text-xs text-slate-500 mt-0.5">Edit database-backed agency settings, contact info, social links, and SEO defaults.</p>
            </div>
        </div>
    </x-slot:header>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8 max-w-4xl">
        @csrf

        <!-- General Info Card -->
        <div class="bg-white p-4 rounded-md border border-slate-200/90 shadow-xs space-y-4">
            <div class="border-b border-slate-100 pb-3">
                <h2 class="text-base font-bold text-slate-950">Agency Information</h2>
                <p class="text-xs text-slate-500">Core brand identity and website URL.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold text-slate-800 mb-1.5">Agency Brand Name</label>
                    <input 
                        type="text" 
                        name="settings[site_name]" 
                        value="{{ old('settings.site_name', setting('site_name', 'VIP Digital Hub')) }}" 
                        class="w-full px-4 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                    >
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-800 mb-1.5">Brand Tagline</label>
                    <input 
                        type="text" 
                        name="settings[site_tagline]" 
                        value="{{ old('settings.site_tagline', setting('site_tagline', 'Software Development & Digital Marketing Agency')) }}" 
                        class="w-full px-4 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                    >
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-slate-800 mb-1.5">Website URL</label>
                    <input 
                        type="url" 
                        name="settings[site_website]" 
                        value="{{ old('settings.site_website', setting('site_website', 'https://vipdigitalhub.com/')) }}" 
                        class="w-full px-4 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                    >
                </div>
            </div>
        </div>

        <!-- Contact Info Card -->
        <div class="bg-white p-4 rounded-md border border-slate-200/90 shadow-xs space-y-4">
            <div class="border-b border-slate-100 pb-3">
                <h2 class="text-base font-bold text-slate-950">Direct Contact & Location</h2>
                <p class="text-xs text-slate-500">Contact details shown in headers, footers, and contact sections.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold text-slate-800 mb-1.5">Official Email</label>
                    <input 
                        type="email" 
                        name="settings[site_email]" 
                        value="{{ old('settings.site_email', setting('site_email', 'vipdigitalhub@gmail.com')) }}" 
                        class="w-full px-4 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                    >
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-800 mb-1.5">Official Phone / Hotline</label>
                    <input 
                        type="text" 
                        name="settings[site_phone]" 
                        value="{{ old('settings.site_phone', setting('site_phone', '+91 7000153244')) }}" 
                        class="w-full px-4 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                    >
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-800 mb-1.5">Business Operating Hours</label>
                    <input 
                        type="text" 
                        name="settings[business_hours]" 
                        value="{{ old('settings.business_hours', setting('business_hours', 'Mon - Sat: 9:00 AM - 7:00 PM')) }}" 
                        class="w-full px-4 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                    >
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-800 mb-1.5">Google Maps Link</label>
                    <input 
                        type="url" 
                        name="settings[google_maps_url]" 
                        value="{{ old('settings.google_maps_url', setting('google_maps_url', 'https://maps.google.com/?q=Bhopal,Madhya+Pradesh')) }}" 
                        class="w-full px-4 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                    >
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-slate-800 mb-1.5">Office Physical Address</label>
                    <textarea 
                        name="settings[site_address]" 
                        rows="2" 
                        class="w-full px-4 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                    >{{ old('settings.site_address', setting('site_address', 'Front of Petrol Pump, House No. 2, Shravan Kanta, NZM Bypass Road, Estate, Bhopal, Madhya Pradesh 462021')) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Social Media Links Card -->
        <div class="bg-white p-4 rounded-md border border-slate-200/90 shadow-xs space-y-4">
            <div class="border-b border-slate-100 pb-3">
                <h2 class="text-base font-bold text-slate-950">Social & Messaging Channels</h2>
                <p class="text-xs text-slate-500">Links rendered across header, footer, and contact buttons.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold text-slate-800 mb-1.5">WhatsApp Direct URL</label>
                    <input 
                        type="url" 
                        name="settings[whatsapp_url]" 
                        value="{{ old('settings.whatsapp_url', setting('whatsapp_url', 'https://wa.me/917000153244')) }}" 
                        class="w-full px-4 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                    >
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-800 mb-1.5">LinkedIn Profile</label>
                    <input 
                        type="url" 
                        name="settings[linkedin_url]" 
                        value="{{ old('settings.linkedin_url', setting('linkedin_url', 'https://linkedin.com/company/vipdigitalhub')) }}" 
                        class="w-full px-4 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                    >
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-800 mb-1.5">X (Twitter)</label>
                    <input 
                        type="url" 
                        name="settings[twitter_url]" 
                        value="{{ old('settings.twitter_url', setting('twitter_url', 'https://x.com/vipdigitalhub')) }}" 
                        class="w-full px-4 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                    >
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-800 mb-1.5">Instagram</label>
                    <input 
                        type="url" 
                        name="settings[instagram_url]" 
                        value="{{ old('settings.instagram_url', setting('instagram_url', 'https://instagram.com/vipdigitalhub')) }}" 
                        class="w-full px-4 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                    >
                </div>
            </div>
        </div>

        <!-- SEO Defaults Card -->
        <div class="bg-white p-4 rounded-md border border-slate-200/90 shadow-xs space-y-4">
            <div class="border-b border-slate-100 pb-3">
                <h2 class="text-base font-bold text-slate-950">Global SEO Defaults</h2>
                <p class="text-xs text-slate-500">Fallback meta titles and descriptions for search crawlers.</p>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-800 mb-1.5">Default Meta Title</label>
                    <input 
                        type="text" 
                        name="settings[default_meta_title]" 
                        value="{{ old('settings.default_meta_title', setting('default_meta_title', 'VIP Digital Hub — Software Development & Digital Marketing Agency')) }}" 
                        class="w-full px-4 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                    >
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-800 mb-1.5">Default Meta Description</label>
                    <textarea 
                        name="settings[default_meta_description]" 
                        rows="3" 
                        class="w-full px-4 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                    >{{ old('settings.default_meta_description', setting('default_meta_description', 'VIP Digital Hub is a premium technology and digital marketing agency offering custom software development, web & mobile applications, SEO, and business growth solutions.')) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center gap-4">
            <button 
                type="submit" 
                class="cta-shimmer inline-flex items-center gap-2 px-6 py-3 rounded-md bg-brand-500 hover:bg-brand-600 text-white font-semibold text-xs shadow-md shadow-brand-500/25 active:scale-95 transition-all"
            >
                <span>Save Site Settings</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </button>
        </div>
    </form>
</x-layouts.admin>
