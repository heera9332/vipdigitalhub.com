@props([
    'post',
])

<article class="group relative rounded-2xl border border-slate-200/90 bg-white p-6 sm:p-7 shadow-sm transition-all duration-300 hover:shadow-xl hover:border-brand-300 hover:-translate-y-1.5 flex flex-col justify-between h-full">
    <div>
        <div class="flex items-center justify-between text-xs text-slate-500 mb-3.5">
            <x-ui.badge variant="brand" size="sm">
                {{ $post->category ?? 'Insights' }}
            </x-ui.badge>
            <div class="flex items-center gap-1.5 text-[11px] text-slate-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ $post->reading_time ?? 5 }} min read</span>
            </div>
        </div>

        <h3 class="text-lg font-bold text-slate-900 group-hover:text-brand-600 transition-colors line-clamp-2 mb-2.5">
            <a href="{{ route('posts.show', $post) }}">
                {{ $post->title }}
            </a>
        </h3>

        <p class="text-slate-600 text-sm leading-relaxed mb-6 line-clamp-3">
            {{ $post->excerpt }}
        </p>
    </div>

    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
        <div class="text-xs text-slate-500">
            <span class="font-medium text-slate-700">{{ $post->author }}</span>
            <span class="mx-1.5">·</span>
            <span>{{ $post->published_at?->format('M d, Y') ?? 'Recently' }}</span>
        </div>

        <a 
            href="{{ route('posts.show', $post) }}" 
            class="text-xs font-semibold text-brand-600 group-hover:text-brand-700 inline-flex items-center gap-1 group-hover:gap-1.5 transition-all duration-200"
        >
            <span>Read</span>
            <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
</article>
