<x-layouts.admin :title="'Edit: ' . $post->title">
    <x-slot:header>
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-2 text-xs text-slate-500">
                <a href="{{ route('admin.posts.index') }}" class="hover:text-brand-600 transition-colors">Articles</a>
                <span>/</span>
                <span class="text-slate-900 font-semibold truncate max-w-xs">{{ $post->title }}</span>
            </div>
            <a 
                href="{{ route('posts.show', $post) }}" 
                target="_blank" 
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors"
            >
                <svg class="w-3.5 h-3.5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                <span>Preview on Website</span>
            </a>
        </div>
    </x-slot:header>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Main Content: Title, Excerpt, TipTap Editor -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Title & Slug Card -->
                <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/90 shadow-xs space-y-5">
                    <div>
                        <label for="title" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Article Title <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            value="{{ old('title', $post->title) }}" 
                            required 
                            placeholder="e.g. Scaling Laravel Multi-Tenant Applications to 10M Requests" 
                            class="w-full px-4 py-3 rounded-xl border {{ $errors->has('title') ? 'border-rose-400 bg-rose-50/20' : 'border-slate-300 bg-white' }} text-base font-bold text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                        @error('title')
                            <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            URL Slug
                        </label>
                        <div class="flex rounded-xl border border-slate-300 overflow-hidden focus-within:ring-2 focus-within:ring-brand-500/40 focus-within:border-brand-500">
                            <span class="px-3.5 py-2.5 bg-slate-50 border-r border-slate-300 text-xs text-slate-500 font-mono flex items-center">
                                /posts/
                            </span>
                            <input 
                                type="text" 
                                name="slug" 
                                id="slug" 
                                value="{{ old('slug', $post->slug) }}" 
                                class="w-full px-3.5 py-2.5 text-xs text-slate-900 focus:outline-none bg-white font-mono"
                            >
                        </div>
                        @error('slug')
                            <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="excerpt" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Article Summary / Excerpt <span class="text-slate-400 font-normal">(Shown on article cards & lead intro)</span>
                        </label>
                        <textarea 
                            name="excerpt" 
                            id="excerpt" 
                            rows="3" 
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >{{ old('excerpt', $post->excerpt) }}</textarea>
                    </div>
                </div>

                <!-- TipTap Rich Text Editor Card -->
                <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/90 shadow-xs">
                    <x-admin.tiptap-editor 
                        name="content" 
                        :value="old('content', $post->content)" 
                        label="Article Content (TipTap Rich-Text)" 
                        :required="true" 
                    />
                </div>
            </div>

            <!-- Sidebar: Status, Category, Author, SEO -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Publishing Action Card -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200/90 shadow-xs space-y-4">
                    <h3 class="text-sm font-bold text-slate-950">Publishing Details</h3>

                    <div>
                        <label for="status" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Status <span class="text-rose-500">*</span>
                        </label>
                        <select 
                            name="status" 
                            id="status" 
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white text-xs font-semibold text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                            <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draft (Private)</option>
                            <option value="archived" {{ old('status', $post->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>

                    <div>
                        <label for="published_at" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Publish Date
                        </label>
                        <input 
                            type="datetime-local" 
                            name="published_at" 
                            id="published_at" 
                            value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}" 
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                    </div>

                    <div class="pt-2 border-t border-slate-100 flex items-center gap-3">
                        <button 
                            type="submit" 
                            class="cta-shimmer flex-1 inline-flex items-center justify-center px-4 py-3 rounded-xl bg-brand-500 hover:bg-brand-600 text-white font-semibold text-xs shadow-md shadow-brand-500/25 active:scale-95 transition-all"
                        >
                            <span>Save Changes</span>
                            <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </button>

                        <a 
                            href="{{ route('admin.posts.index') }}" 
                            class="px-4 py-3 rounded-xl border border-slate-200 text-slate-600 font-semibold text-xs hover:bg-slate-50 transition-colors"
                        >
                            Back
                        </a>
                    </div>
                </div>

                <!-- Category & Author Card -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200/90 shadow-xs space-y-4">
                    <h3 class="text-sm font-bold text-slate-950">Taxonomy & Meta</h3>

                    <div>
                        <label for="category" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Category <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="category" 
                            id="category" 
                            list="category-suggestions" 
                            value="{{ old('category', $post->category) }}" 
                            required 
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                        <datalist id="category-suggestions">
                            @foreach ($categories as $cat)
                                <option value="{{ $cat }}"></option>
                            @endforeach
                            <option value="Architecture"></option>
                            <option value="Backend Engineering"></option>
                            <option value="SaaS Strategy"></option>
                            <option value="Growth Marketing"></option>
                        </datalist>
                    </div>

                    <div>
                        <label for="author" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Author <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="author" 
                            id="author" 
                            value="{{ old('author', $post->author) }}" 
                            required 
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                    </div>

                    <div>
                        <label for="reading_time" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Reading Time (Minutes)
                        </label>
                        <input 
                            type="number" 
                            name="reading_time" 
                            id="reading_time" 
                            value="{{ old('reading_time', $post->reading_time) }}" 
                            min="1" 
                            max="60" 
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                    </div>

                    <div>
                        <label for="featured_image" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Featured Image URL
                        </label>
                        <input 
                            type="text" 
                            name="featured_image" 
                            id="featured_image" 
                            value="{{ old('featured_image', $post->featured_image) }}" 
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                    </div>
                </div>

                <!-- SEO Metadata Card -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200/90 shadow-xs space-y-4">
                    <h3 class="text-sm font-bold text-slate-950">Search Engine Optimization</h3>

                    <div>
                        <label for="meta_title" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Meta Title
                        </label>
                        <input 
                            type="text" 
                            name="meta_title" 
                            id="meta_title" 
                            value="{{ old('meta_title', $post->meta_title) }}" 
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                    </div>

                    <div>
                        <label for="meta_description" class="block text-xs font-semibold text-slate-800 mb-1.5">
                            Meta Description
                        </label>
                        <textarea 
                            name="meta_description" 
                            id="meta_description" 
                            rows="3" 
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >{{ old('meta_description', $post->meta_description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>
