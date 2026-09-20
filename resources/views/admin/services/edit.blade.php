<x-layouts.admin :title="'Edit: ' . $service->title">
    <x-slot:header>
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-2 text-xs text-slate-500">
                <a href="{{ route('admin.services.index') }}" class="hover:text-brand-600 transition-colors">Services</a>
                <span>/</span>
                <span class="text-slate-900 font-semibold truncate max-w-xs">{{ $service->title }}</span>
            </div>
            <a 
                href="{{ route('services') }}" 
                target="_blank" 
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors"
            >
                <svg class="w-3.5 h-3.5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                <span>View on Public Catalog</span>
            </a>
        </div>
    </x-slot:header>

    <form action="{{ route('admin.services.update', $service) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Main Form Column -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Title & Slug Card -->
                <div class="bg-white p-5 rounded-md border border-slate-200/90 shadow-xs space-y-4">
                    <div>
                        <label for="title" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Service Title <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            value="{{ old('title', $service->title) }}" 
                            required 
                            class="w-full px-4 py-3 rounded-md border {{ $errors->has('title') ? 'border-rose-400 bg-rose-50/20' : 'border-slate-300 bg-white' }} text-base font-bold text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                        @error('title')
                            <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            URL Slug
                        </label>
                        <div class="flex rounded-md border border-slate-300 overflow-hidden focus-within:ring-2 focus-within:ring-brand-500/40 focus-within:border-brand-500">
                            <span class="px-3.5 py-2.5 bg-slate-50 border-r border-slate-300 text-xs text-slate-500 font-mono flex items-center">
                                /services/
                            </span>
                            <input 
                                type="text" 
                                name="slug" 
                                id="slug" 
                                value="{{ old('slug', $service->slug) }}" 
                                class="w-full px-3.5 py-2.5 text-xs text-slate-900 focus:outline-none bg-white font-mono"
                            >
                        </div>
                        @error('slug')
                            <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="short_description" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Short Summary <span class="text-rose-500">*</span> <span class="text-slate-400 font-normal">(Displayed on service cards)</span>
                        </label>
                        <textarea 
                            name="short_description" 
                            id="short_description" 
                            rows="2" 
                            required 
                            class="w-full px-3.5 py-2.5 rounded-md border {{ $errors->has('short_description') ? 'border-rose-400 bg-rose-50/20' : 'border-slate-300 bg-white' }} text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 leading-relaxed"
                        >{{ old('short_description', $service->short_description) }}</textarea>
                        @error('short_description')
                            <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Full Service Description
                        </label>
                        <textarea 
                            name="description" 
                            id="description" 
                            rows="4" 
                            class="w-full px-3.5 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 leading-relaxed"
                        >{{ old('description', $service->description) }}</textarea>
                    </div>
                </div>

                <!-- Features & Call to Action -->
                <div class="bg-white p-5 rounded-md border border-slate-200/90 shadow-xs space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-900">Service Highlights & Action</h3>

                    <div>
                        <label for="features" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Key Features & Capabilities <span class="text-slate-400 font-normal">(Comma or newline separated)</span>
                        </label>
                        @php
                            $featuresValue = is_array($service->features) ? implode(', ', $service->features) : ($service->features ?? '');
                        @endphp
                        <textarea 
                            name="features" 
                            id="features" 
                            rows="3" 
                            class="w-full px-3.5 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >{{ old('features', $featuresValue) }}</textarea>
                        <p class="text-[11px] text-slate-400 mt-1">These will appear as bulleted checkmarks on the service card.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="cta" class="block text-xs font-semibold text-slate-800 mb-1.5">
                                Button Call-to-Action Text
                            </label>
                            <input 
                                type="text" 
                                name="cta" 
                                id="cta" 
                                value="{{ old('cta', $service->cta ?? 'Inquire Now') }}" 
                                class="w-full px-3.5 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                            >
                        </div>

                        <div>
                            <label for="icon" class="block text-xs font-semibold text-slate-800 mb-1.5">
                                Icon Identifier
                            </label>
                            <select 
                                name="icon" 
                                id="icon" 
                                class="w-full px-3.5 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                            >
                                @foreach (['globe' => 'Globe (Web)', 'code' => 'Code (Custom Software)', 'cloud' => 'Cloud (SaaS/Cloud)', 'layers' => 'Layers (Full Stack / Architecture)', 'device-mobile' => 'Device Mobile (Apps)', 'chart-bar' => 'Chart Bar (SEO/Growth)', 'palette' => 'Palette (UI/UX)', 'shield-check' => 'Shield Check (Security/Maintenance)', 'cpu' => 'CPU (High Performance / Node)', 'zap' => 'Zap (Speed / Next.js)', 'layout' => 'Layout (WordPress/CMS)', 'shopping-cart' => 'Shopping Cart (E-Commerce)', 'megaphone' => 'Megaphone (Marketing)', 'target' => 'Target (Paid Ads)', 'component' => 'Component (React)'] as $val => $label)
                                    <option value="{{ $val }}" {{ old('icon', $service->icon) === $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Controls Column -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Publishing Controls Card -->
                <div class="bg-white p-5 rounded-md border border-slate-200/90 shadow-xs space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-900">Publishing Settings</h3>

                    <div>
                        <label for="status" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Status <span class="text-rose-500">*</span>
                        </label>
                        <select 
                            name="status" 
                            id="status" 
                            class="w-full px-3.5 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                            <option value="published" {{ old('status', $service->status) === 'published' ? 'selected' : '' }}>Published (Live on site)</option>
                            <option value="draft" {{ old('status', $service->status) === 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                            <option value="archived" {{ old('status', $service->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>

                    <div>
                        <label for="category" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Category
                        </label>
                        <input 
                            type="text" 
                            name="category" 
                            id="category" 
                            value="{{ old('category', $service->category ?? 'Technology Services') }}" 
                            class="w-full px-3.5 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                    </div>

                    <div>
                        <label for="sort_order" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Display Sort Order
                        </label>
                        <input 
                            type="number" 
                            name="sort_order" 
                            id="sort_order" 
                            value="{{ old('sort_order', $service->sort_order ?? 0) }}" 
                            min="0" 
                            class="w-full px-3.5 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                        <p class="text-[11px] text-slate-400 mt-1">Lower numbers appear first on the catalog.</p>
                    </div>

                    <div class="pt-2 border-t border-slate-100 flex items-center gap-3">
                        <button 
                            type="submit" 
                            class="w-full cta-shimmer py-2.5 px-4 rounded-md bg-brand-500 text-white font-semibold text-xs hover:bg-brand-600 shadow-sm shadow-brand-500/25 active:scale-95 transition-all text-center"
                        >
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>
