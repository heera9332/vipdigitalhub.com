<x-layouts.admin :title="'Edit: ' . $project->title">
    <x-slot:header>
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-2 text-xs text-slate-500">
                <a href="{{ route('admin.projects.index') }}" class="hover:text-brand-600 transition-colors">Case Studies</a>
                <span>/</span>
                <span class="text-slate-900 font-semibold truncate max-w-xs">{{ $project->title }}</span>
            </div>
            <a 
                href="{{ route('projects.show', $project) }}" 
                target="_blank" 
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors"
            >
                <svg class="w-3.5 h-3.5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                <span>Preview Case Study</span>
            </a>
        </div>
    </x-slot:header>

    <form action="{{ route('admin.projects.update', $project) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Main Content Area -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Title & Slug Card -->
                <div class="bg-white p-4 rounded-md border border-slate-200/90 shadow-xs space-y-4">
                    <div>
                        <label for="title" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Project Title <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            value="{{ old('title', $project->title) }}" 
                            required 
                            placeholder="e.g. Multi-Tenant Real Estate & Property Engine" 
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
                                /projects/
                            </span>
                            <input 
                                type="text" 
                                name="slug" 
                                id="slug" 
                                value="{{ old('slug', $project->slug) }}" 
                                class="w-full px-3.5 py-2.5 text-xs text-slate-900 focus:outline-none bg-white font-mono"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="short_description" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Short Summary <span class="text-slate-400 font-normal">(Visible on portfolio cards)</span>
                        </label>
                        <textarea 
                            name="short_description" 
                            id="short_description" 
                            rows="2" 
                            class="w-full px-4 py-3 rounded-md border border-slate-300 bg-white text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >{{ old('short_description', $project->short_description) }}</textarea>
                    </div>

                    <div>
                        <label for="description" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Full Case Study Description
                        </label>
                        <textarea 
                            name="description" 
                            id="description" 
                            rows="8" 
                            class="w-full px-4 py-3 rounded-md border border-slate-300 bg-white text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >{{ old('description', $project->description) }}</textarea>
                    </div>
                </div>

                <!-- Technologies & External Links -->
                <div class="bg-white p-6 sm:p-8 rounded-md border border-slate-200/90 shadow-xs space-y-4">
                    <h3 class="text-sm font-bold text-slate-950">Tech Stack & External Links</h3>

                    <div>
                        <label for="technologies" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Technologies Used <span class="text-slate-400 font-normal">(Comma-separated)</span>
                        </label>
                        <input 
                            type="text" 
                            name="technologies" 
                            id="technologies" 
                            value="{{ old('technologies', is_array($project->technologies) ? implode(', ', $project->technologies) : '') }}" 
                            class="w-full px-3.5 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                    </div>

                    <div>
                        <label for="project_url" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Live URL / Demo Link
                        </label>
                        <input 
                            type="url" 
                            name="project_url" 
                            id="project_url" 
                            value="{{ old('project_url', $project->project_url) }}" 
                            placeholder="https://example.com" 
                            class="w-full px-3.5 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Action Card -->
                <div class="bg-white p-4 rounded-md border border-slate-200/90 shadow-xs space-y-4">
                    <h3 class="text-sm font-bold text-slate-950">Publication Details</h3>

                    <div>
                        <label for="status" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Status <span class="text-rose-500">*</span>
                        </label>
                        <select 
                            name="status" 
                            id="status" 
                            class="w-full px-3.5 py-2.5 rounded-md border border-slate-300 bg-white text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                            <option value="published" {{ old('status', $project->status) === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ old('status', $project->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>

                    <div class="pt-2">
                        <label class="flex items-center gap-2.5 cursor-pointer">
                            <input 
                                type="checkbox" 
                                name="featured" 
                                value="1" 
                                {{ old('featured', $project->featured) ? 'checked' : '' }} 
                                class="rounded border-slate-300 text-brand-500 focus:ring-brand-500"
                            >
                            <span class="text-xs font-semibold text-slate-800">Pin as Featured Work on Homepage</span>
                        </label>
                    </div>

                    <div>
                        <label for="sort_order" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Sort Priority
                        </label>
                        <input 
                            type="number" 
                            name="sort_order" 
                            id="sort_order" 
                            value="{{ old('sort_order', $project->sort_order) }}" 
                            min="0" 
                            class="w-full px-3.5 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                    </div>

                    <div class="pt-2 border-t border-slate-100 flex items-center gap-3">
                        <button 
                            type="submit" 
                            class="cta-shimmer flex-1 inline-flex items-center justify-center px-4 py-3 rounded-md bg-brand-500 hover:bg-brand-600 text-white font-semibold text-xs shadow-md shadow-brand-500/25 active:scale-95 transition-all"
                        >
                            <span>Save Changes</span>
                            <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </button>

                        <a 
                            href="{{ route('admin.projects.index') }}" 
                            class="px-4 py-3 rounded-md border border-slate-200 text-slate-600 font-semibold text-xs hover:bg-slate-50 transition-colors"
                        >
                            Back
                        </a>
                    </div>
                </div>

                <!-- Client & Taxonomy -->
                <div class="bg-white p-4 rounded-md border border-slate-200/90 shadow-xs space-y-4">
                    <h3 class="text-sm font-bold text-slate-950">Client & Category</h3>

                    <div>
                        <label for="category" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Category <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="category" 
                            id="category" 
                            list="project-categories" 
                            value="{{ old('category', $project->category) }}" 
                            required 
                            class="w-full px-3.5 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                        <datalist id="project-categories">
                            @foreach ($categories as $cat)
                                <option value="{{ $cat }}"></option>
                            @endforeach
                            <option value="SaaS Platforms"></option>
                            <option value="Custom Software"></option>
                            <option value="Mobile Applications"></option>
                            <option value="DevOps & Cloud"></option>
                        </datalist>
                    </div>

                    <div>
                        <label for="client" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Client Name
                        </label>
                        <input 
                            type="text" 
                            name="client" 
                            id="client" 
                            value="{{ old('client', $project->client) }}" 
                            class="w-full px-3.5 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                    </div>

                    <div>
                        <label for="year" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Year Delivered
                        </label>
                        <input 
                            type="text" 
                            name="year" 
                            id="year" 
                            value="{{ old('year', $project->year) }}" 
                            class="w-full px-3.5 py-2.5 rounded-md border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>
