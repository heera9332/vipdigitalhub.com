<x-layouts.app 
    :title="$post->title"
    :description="$post->excerpt ?? $post->meta_description"
>
    <!-- Article Header -->
    <x-ui.section spacing="default" class="bg-gradient-to-b from-brand-50/40 via-white to-slate-50 border-b border-slate-200/80">
        <x-ui.container>
            <div class="max-w-3xl mx-auto space-y-6">
                <!-- Breadcrumbs -->
                <nav class="animate-fade-in-up flex items-center gap-2 text-xs font-medium text-slate-500">
                    <a href="{{ route('home') }}" class="hover:text-brand-600 transition-colors">Home</a>
                    <span>/</span>
                    <a href="{{ route('posts.index') }}" class="hover:text-brand-600 transition-colors">Articles</a>
                    <span>/</span>
                    <span class="text-slate-800 line-clamp-1">{{ $post->title }}</span>
                </nav>

                <div class="animate-fade-in-up delay-100 flex items-center gap-3">
                    <x-ui.badge variant="brand">{{ $post->category ?? 'Technology' }}</x-ui.badge>
                    <span class="text-xs text-slate-400 font-mono">{{ $post->reading_time }} min read</span>
                </div>

                <h1 class="animate-fade-in-up delay-150 text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-950 tracking-tight leading-tight">
                    {{ $post->title }}
                </h1>

                <!-- Author & Meta bar -->
                <div class="animate-fade-in-up delay-250 pt-4 flex items-center gap-4 text-xs text-slate-500 border-t border-slate-200/80">
                    <div class="w-9 h-9 rounded-full bg-brand-500 text-white flex items-center justify-center font-bold text-sm shadow-xs">
                        {{ substr($post->author, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-semibold text-slate-900 text-sm">{{ $post->author }}</div>
                        <div>Published on {{ $post->published_at?->format('F d, Y') ?? 'Recently' }}</div>
                    </div>
                </div>
            </div>
        </x-ui.container>
    </x-ui.section>

    <!-- Article Body -->
    <x-ui.section spacing="default" class="bg-white">
        <x-ui.container>
            <div class="max-w-3xl mx-auto space-y-8">
                <!-- Article Lead / Excerpt -->
                @if ($post->excerpt)
                    <div class="reveal-on-scroll p-6 rounded-md bg-brand-50/60 border border-brand-100 text-base text-slate-800 font-medium leading-relaxed shadow-xs">
                        {{ $post->excerpt }}
                    </div>
                @endif

                <!-- Article Content -->
                <div class="reveal-on-scroll article-content prose prose-slate prose-lg max-w-none prose-headings:font-extrabold prose-headings:text-slate-950 prose-a:text-brand-600 prose-a:font-semibold hover:prose-a:text-brand-700 prose-img:rounded-md prose-img:shadow-md text-slate-700 leading-relaxed">
                    {!! $post->content !!}
                </div>

                <!-- Author Bio Box -->
                <div class="reveal-on-scroll p-8 rounded-md border border-slate-200/90 bg-slate-50 flex flex-col sm:flex-row items-center sm:items-start gap-5 mt-12 shadow-xs hover:border-brand-200 transition-colors">
                    <div class="w-14 h-14 rounded-md bg-gradient-to-br from-brand-500 to-brand-600 text-white flex items-center justify-center font-bold text-xl shrink-0 shadow-sm">
                        {{ substr($post->author, 0, 1) }}
                    </div>
                    <div class="space-y-1.5 text-center sm:text-left">
                        <div class="text-base font-bold text-slate-900">Written by {{ $post->author }}</div>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Published by VIP Digital Hub's core engineering and marketing practice. We build web applications, multi-tenant SaaS products, and custom digital software for growing businesses.
                        </p>
                    </div>
                </div>
            </div>
        </x-ui.container>
    </x-ui.section>

    <!-- Related Articles -->
    @if ($relatedPosts->isNotEmpty())
        <x-ui.section spacing="default" class="bg-slate-50 border-t border-slate-200/80">
            <x-ui.container>
                <div class="reveal-on-scroll mb-10 flex items-center justify-between">
                    <div>
                        <x-ui.badge variant="brand">More Insights</x-ui.badge>
                        <h2 class="text-2xl font-bold text-slate-950 mt-2">Related Articles</h2>
                    </div>
                    <x-ui.button variant="outline" size="sm" :href="route('posts.index')">
                        All Articles
                    </x-ui.button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($relatedPosts as $relPost)
                        <div class="reveal-on-scroll" data-reveal-delay="{{ $loop->index * 100 }}">
                            <x-cards.post :post="$relPost" />
                        </div>
                    @endforeach
                </div>
            </x-ui.container>
        </x-ui.section>
    @endif

    <!-- Bottom Call to Action -->
    <x-ui.section spacing="default" class="bg-white border-t border-slate-200/80">
        <x-ui.container>
            <div class="reveal-on-scroll">
                <x-sections.cta 
                    title="Looking for Engineering Excellence for Your Business?"
                    subtitle="Let's build reliable web apps, scalable backend systems, or data-driven digital growth strategies together."
                    buttonText="Discuss Your Project"
                />
            </div>
        </x-ui.container>
    </x-ui.section>
</x-layouts.app>
