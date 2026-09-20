<x-layouts.admin title="Media Library">
    <x-slot:header>
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-2 text-xs text-slate-500">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-brand-600 transition-colors">Admin</a>
                <span>/</span>
                <span class="text-slate-900 font-semibold">Media Library</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs text-slate-500 font-mono">
                    {{ number_format($totalCount) }} {{ Str::plural('file', $totalCount) }}
                </span>
            </div>
        </div>
    </x-slot:header>

    <div class="space-y-6" x-data="adminMediaLibrary()">
        <!-- Top Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded-md border border-slate-200/90 shadow-xs flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <div class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Total Uploads</div>
                    <div class="text-lg font-bold text-slate-900">{{ number_format($totalCount) }}</div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-md border border-slate-200/90 shadow-xs flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div>
                    <div class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Images</div>
                    <div class="text-lg font-bold text-slate-900">{{ number_format($imageCount) }}</div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-md border border-slate-200/90 shadow-xs flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 00-9.78 2.096A4.001 4.001 0 003 15z"/></svg>
                </div>
                <div>
                    <div class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Storage Space</div>
                    <div class="text-lg font-bold text-slate-900">
                        @if ($totalSize >= 1048576)
                            {{ number_format($totalSize / 1048576, 1) }} MB
                        @else
                            {{ number_format($totalSize / 1024, 0) }} KB
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Upload Dropzone Card -->
        <div class="bg-white rounded-md border border-slate-200/90 shadow-xs p-5">
            <div 
                class="border-2 border-dashed border-slate-300 rounded-md p-6 text-center hover:border-brand-500 hover:bg-brand-50/20 transition-all cursor-pointer"
                :class="{ 'border-brand-500 bg-brand-50/30': isDragging }"
                @dragover.prevent="isDragging = true"
                @dragleave.prevent="isDragging = false"
                @drop.prevent="handleDrop($event)"
                @click="$refs.fileInput.click()"
            >
                <input 
                    type="file" 
                    x-ref="fileInput" 
                    @change="handleFileSelect($event)" 
                    accept="image/jpeg,image/png,image/webp,image/gif,image/svg+xml,application/pdf" 
                    class="hidden"
                >
                <div class="flex flex-col items-center justify-center space-y-2">
                    <div class="w-12 h-12 rounded-full bg-brand-50 text-brand-500 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-brand-600 hover:underline">Click to upload media</span>
                        <span class="text-xs text-slate-500"> or drag and drop files here</span>
                    </div>
                    <p class="text-[11px] text-slate-400">
                        Supports WebP, PNG, JPG, GIF, SVG, and PDF (Max 10MB)
                    </p>
                </div>

                <!-- Upload Progress -->
                <div x-show="uploading" x-cloak class="mt-4 max-w-xs mx-auto">
                    <div class="flex justify-between text-xs text-slate-600 mb-1">
                        <span>Uploading...</span>
                        <span x-text="progress + '%'"></span>
                    </div>
                    <div class="w-full bg-slate-200 rounded-full h-2 overflow-hidden">
                        <div class="bg-brand-500 h-2 rounded-full transition-all duration-200" :style="'width: ' + progress + '%'"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="bg-white p-4 rounded-md border border-slate-200/90 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-3">
            <form action="{{ route('admin.media.index') }}" method="GET" class="flex items-center gap-2 w-full sm:w-auto">
                <div class="relative flex-1 sm:w-72">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search media by name or alt..." 
                        class="w-full pl-8 pr-3 py-2 text-xs rounded-md border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                    >
                    <svg class="w-4 h-4 text-slate-400 absolute left-2.5 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                @if (request('type'))
                    <input type="hidden" name="type" value="{{ request('type') }}">
                @endif
                <button type="submit" class="px-3 py-2 rounded-md bg-slate-100 hover:bg-slate-200 text-xs font-semibold text-slate-700 transition-colors">
                    Search
                </button>
                @if (request()->hasAny(['search', 'type']))
                    <a href="{{ route('admin.media.index') }}" class="text-xs text-slate-500 hover:text-rose-600 underline">Clear</a>
                @endif
            </form>

            <!-- Type Filter Tabs -->
            <div class="flex items-center gap-1 self-start sm:self-auto bg-slate-100 p-1 rounded-md text-xs font-semibold">
                <a 
                    href="{{ route('admin.media.index', array_merge(request()->query(), ['type' => null])) }}" 
                    class="px-2.5 py-1 rounded {{ !request('type') ? 'bg-white text-slate-900 shadow-xs' : 'text-slate-600 hover:text-slate-900' }}"
                >
                    All
                </a>
                <a 
                    href="{{ route('admin.media.index', array_merge(request()->query(), ['type' => 'images'])) }}" 
                    class="px-2.5 py-1 rounded {{ request('type') === 'images' ? 'bg-white text-slate-900 shadow-xs' : 'text-slate-600 hover:text-slate-900' }}"
                >
                    Images
                </a>
                <a 
                    href="{{ route('admin.media.index', array_merge(request()->query(), ['type' => 'documents'])) }}" 
                    class="px-2.5 py-1 rounded {{ request('type') === 'documents' ? 'bg-white text-slate-900 shadow-xs' : 'text-slate-600 hover:text-slate-900' }}"
                >
                    Documents
                </a>
            </div>
        </div>

        <!-- Media Grid -->
        @if ($media->isNotEmpty())
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach ($media as $item)
                    <div 
                        class="group relative bg-white rounded-md border border-slate-200/90 overflow-hidden shadow-xs hover:shadow-md hover:border-brand-400 transition-all flex flex-col cursor-pointer"
                        @click="openDetails({{ json_encode($item) }})"
                    >
                        <!-- Thumbnail Box -->
                        <div class="aspect-square bg-slate-100 overflow-hidden flex items-center justify-center relative">
                            @if ($item->is_image)
                                <img 
                                    src="{{ $item->url }}" 
                                    alt="{{ $item->alt_text ?? $item->name }}" 
                                    loading="lazy"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                >
                            @else
                                <div class="flex flex-col items-center justify-center p-3 text-slate-400">
                                    <svg class="w-10 h-10 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    <span class="text-[10px] uppercase font-mono">{{ pathinfo($item->file_name, PATHINFO_EXTENSION) }}</span>
                                </div>
                            @endif

                            <!-- Quick Hover Overlay -->
                            <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-1.5">
                                <button type="button" class="p-1.5 rounded-full bg-white text-slate-800 shadow-sm hover:bg-brand-50 hover:text-brand-600 transition-colors" title="View Details">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Card Info -->
                        <div class="p-2.5 flex-1 flex flex-col justify-between">
                            <div class="text-xs font-semibold text-slate-800 truncate" title="{{ $item->name }}">
                                {{ $item->name }}
                            </div>
                            <div class="flex items-center justify-between text-[10px] text-slate-400 mt-1 font-mono">
                                <span>{{ $item->human_size }}</span>
                                @if ($item->dimensions)
                                    <span>{{ $item->dimensions }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $media->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-md border border-slate-200/90 p-12 text-center shadow-xs">
                <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-slate-900 mb-1">No media files found</h3>
                <p class="text-xs text-slate-500 max-w-sm mx-auto mb-4">
                    Upload your first image, brand graphic, or case study screenshot using the dropzone above.
                </p>
            </div>
        @endif

        <!-- Media Details Modal -->
        <div 
            x-show="detailModalOpen" 
            x-cloak 
            class="fixed inset-0 z-50 overflow-y-auto"
            aria-labelledby="modal-title" 
            role="dialog" 
            aria-modal="true"
        >
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                <div 
                    x-show="detailModalOpen"
                    x-transition:enter="ease-out duration-200"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs transition-opacity" 
                    @click="detailModalOpen = false"
                ></div>

                <div 
                    x-show="detailModalOpen"
                    x-transition:enter="ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative bg-white rounded-lg border border-slate-200 text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-3xl sm:w-full"
                >
                    <div class="h-12 px-4 border-b border-slate-200 flex items-center justify-between bg-slate-50">
                        <h3 class="text-xs font-bold text-slate-900 truncate" x-text="activeItem?.name || 'File Details'"></h3>
                        <button type="button" @click="detailModalOpen = false" class="p-1 rounded-md text-slate-400 hover:text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <div class="p-6 grid grid-cols-1 md:grid-cols-12 gap-6" x-show="activeItem">
                        <!-- Preview Column -->
                        <div class="md:col-span-6 flex flex-col items-center justify-center bg-slate-100 rounded-md p-4 min-h-[220px]">
                            <template x-if="activeItem?.is_image">
                                <img :src="activeItem?.url" :alt="activeItem?.alt_text || activeItem?.name" class="max-h-72 max-w-full rounded-md shadow-xs object-contain">
                            </template>
                            <template x-if="!activeItem?.is_image">
                                <div class="text-center text-slate-400 py-8">
                                    <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    <span class="text-xs font-mono" x-text="activeItem?.mime_type"></span>
                                </div>
                            </template>
                        </div>

                        <!-- Meta & Edit Column -->
                        <div class="md:col-span-6 space-y-4 text-xs">
                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">File Name</label>
                                <input 
                                    type="text" 
                                    x-model="activeItem.name" 
                                    class="w-full px-3 py-2 rounded-md border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 font-medium"
                                >
                            </div>

                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Alt Text (Accessibility & SEO)</label>
                                <input 
                                    type="text" 
                                    x-model="activeItem.alt_text" 
                                    placeholder="e.g. Dashboard metrics overview screen" 
                                    class="w-full px-3 py-2 rounded-md border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                                >
                            </div>

                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">File URL</label>
                                <div class="flex rounded-md border border-slate-300 overflow-hidden">
                                    <input 
                                        type="text" 
                                        readonly 
                                        :value="activeItem?.url" 
                                        class="w-full px-3 py-2 bg-slate-50 text-slate-600 font-mono text-[11px] select-all focus:outline-none"
                                    >
                                    <button 
                                        type="button" 
                                        @click="copyUrl(activeItem?.url)" 
                                        class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold shrink-0 transition-colors"
                                    >
                                        <span x-text="copied ? 'Copied!' : 'Copy'"></span>
                                    </button>
                                </div>
                            </div>

                            <div class="p-3 bg-slate-50 rounded-md border border-slate-200 text-[11px] font-mono text-slate-500 space-y-1">
                                <div class="flex justify-between">
                                    <span>File Size:</span>
                                    <span class="font-bold text-slate-800" x-text="activeItem?.human_size"></span>
                                </div>
                                <div class="flex justify-between" x-show="activeItem?.dimensions">
                                    <span>Dimensions:</span>
                                    <span class="font-bold text-slate-800" x-text="activeItem?.dimensions"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Format:</span>
                                    <span class="font-bold text-slate-800" x-text="activeItem?.mime_type"></span>
                                </div>
                            </div>

                            <div class="pt-2 flex items-center justify-between gap-2 border-t border-slate-200">
                                <button 
                                    type="button" 
                                    @click="saveChanges()" 
                                    :disabled="saving"
                                    class="px-4 py-2 rounded-md bg-brand-500 hover:bg-brand-600 text-white font-semibold transition-colors disabled:opacity-50"
                                >
                                    <span x-text="saving ? 'Saving...' : 'Save Meta'"></span>
                                </button>

                                <button 
                                    type="button" 
                                    @click="deleteMedia(activeItem?.id)" 
                                    class="px-3 py-2 rounded-md border border-rose-200 text-rose-600 hover:bg-rose-50 transition-colors font-semibold"
                                >
                                    Delete File
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
