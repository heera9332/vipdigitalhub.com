<div 
    x-data="mediaPickerModal()"
    x-show="isOpen"
    x-cloak
    @keydown.escape.window="closeModal()"
    class="relative z-50"
    role="dialog"
    aria-modal="true"
>
    <!-- Modal Backdrop with blur -->
    <div 
        x-show="isOpen"
        x-transition:enter="ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="closeModal()"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity"
    ></div>

    <!-- Modal Container -->
    <div class="fixed inset-0 z-10 overflow-y-auto p-4 sm:p-6 lg:p-8 flex min-h-full items-center justify-center">
        <div 
            x-show="isOpen"
            x-transition:enter="ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            @click.stop
            class="relative w-full max-w-4xl h-[85vh] flex flex-col rounded-xl bg-white shadow-2xl border border-slate-200/90 overflow-hidden"
        >
            <!-- Modal Header -->
            <div class="px-5 py-4 border-b border-slate-200/90 flex items-center justify-between bg-slate-50/70 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-brand-50 border border-brand-200 flex items-center justify-center text-brand-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 leading-tight">Select Media</h3>
                        <p class="text-xs text-slate-500">Pick an image from the library or upload a new file</p>
                    </div>
                </div>

                <!-- Tabs & Close Button -->
                <div class="flex items-center gap-3">
                    <div class="flex items-center p-0.5 rounded-lg bg-slate-200/80 text-xs font-semibold text-slate-600">
                        <button 
                            type="button" 
                            @click="activeTab = 'browse'" 
                            :class="{ 'bg-white text-slate-900 shadow-xs': activeTab === 'browse', 'text-slate-600 hover:text-slate-900': activeTab !== 'browse' }"
                            class="px-3 py-1 rounded-md transition-all flex items-center gap-1.5"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                            <span>Browse Library</span>
                        </button>
                        <button 
                            type="button" 
                            @click="activeTab = 'upload'" 
                            :class="{ 'bg-white text-slate-900 shadow-xs': activeTab === 'upload', 'text-slate-600 hover:text-slate-900': activeTab !== 'upload' }"
                            class="px-3 py-1 rounded-md transition-all flex items-center gap-1.5"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            <span>Upload New</span>
                        </button>
                    </div>

                    <button 
                        type="button" 
                        @click="closeModal()" 
                        class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-200/60 transition-colors"
                        title="Close modal (Esc)"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Tab 1: Browse Media -->
            <div x-show="activeTab === 'browse'" class="flex-1 flex flex-col min-h-0">
                <!-- Search & Filters Toolbar -->
                <div class="px-5 py-3 border-b border-slate-200 bg-white flex flex-wrap items-center justify-between gap-3 shrink-0">
                    <!-- Search Input -->
                    <div class="relative flex-1 min-w-[200px] max-w-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            x-model="searchQuery"
                            @input="handleSearchInput()"
                            placeholder="Search by file name or alt text..." 
                            class="w-full pl-9 pr-8 py-1.5 rounded-lg border border-slate-300 bg-slate-50/50 text-xs text-slate-900 placeholder:text-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
                        >
                        <button 
                            type="button" 
                            x-show="searchQuery" 
                            @click="searchQuery = ''; fetchMedia(1)" 
                            class="absolute inset-y-0 right-0 pr-2.5 flex items-center text-slate-400 hover:text-slate-600"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <!-- Type Filter Pills -->
                    <div class="flex items-center gap-1.5 text-xs">
                        <button 
                            type="button" 
                            @click="setFilter('')" 
                            :class="{ 'bg-slate-900 text-white font-medium': filterType === '', 'bg-slate-100 text-slate-600 hover:bg-slate-200': filterType !== '' }"
                            class="px-2.5 py-1 rounded-md transition-colors"
                        >
                            All Files
                        </button>
                        <button 
                            type="button" 
                            @click="setFilter('images')" 
                            :class="{ 'bg-slate-900 text-white font-medium': filterType === 'images', 'bg-slate-100 text-slate-600 hover:bg-slate-200': filterType !== 'images' }"
                            class="px-2.5 py-1 rounded-md transition-colors"
                        >
                            Images
                        </button>
                        <button 
                            type="button" 
                            @click="setFilter('documents')" 
                            :class="{ 'bg-slate-900 text-white font-medium': filterType === 'documents', 'bg-slate-100 text-slate-600 hover:bg-slate-200': filterType !== 'documents' }"
                            class="px-2.5 py-1 rounded-md transition-colors"
                        >
                            Docs
                        </button>
                    </div>
                </div>

                <!-- Media Items Grid Area -->
                <div class="flex-1 overflow-y-auto p-5 bg-slate-50/50">
                    <!-- Loading State -->
                    <div x-show="loading" class="h-full min-h-[260px] flex flex-col items-center justify-center text-slate-400">
                        <svg class="animate-spin w-7 h-7 text-brand-500 mb-2" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="text-xs font-medium">Loading media files...</span>
                    </div>

                    <!-- Empty State -->
                    <div x-show="!loading && items.length === 0" class="h-full min-h-[260px] flex flex-col items-center justify-center text-center p-6">
                        <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h4 class="text-sm font-bold text-slate-800 mb-1">No media files found</h4>
                        <p class="text-xs text-slate-500 max-w-sm mb-4">No assets match your query. Upload new files to attach them to your content.</p>
                        <button 
                            type="button" 
                            @click="activeTab = 'upload'" 
                            class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-md bg-brand-600 text-white font-medium text-xs hover:bg-brand-700 transition-colors shadow-xs"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            <span>Upload Files</span>
                        </button>
                    </div>

                    <!-- Items Grid -->
                    <div x-show="!loading && items.length > 0" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
                        <template x-for="item in items" :key="item.id">
                            <div 
                                @click="selectItem(item)"
                                @dblclick="selectItem(item); confirmSelection()"
                                :class="{ 
                                    'ring-2 ring-brand-500 ring-offset-2 border-brand-500 bg-brand-50/40': selectedItem && selectedItem.id === item.id,
                                    'border-slate-200 bg-white hover:border-slate-300 hover:shadow-xs': !selectedItem || selectedItem.id !== item.id
                                }"
                                class="group relative rounded-lg border cursor-pointer flex flex-col overflow-hidden transition-all text-left"
                            >
                                <!-- Thumbnail -->
                                <div class="aspect-square w-full bg-slate-100 flex items-center justify-center overflow-hidden relative">
                                    <template x-if="item.is_image">
                                        <img 
                                            :src="item.url" 
                                            :alt="item.alt_text || item.name" 
                                            loading="lazy" 
                                            class="w-full h-full object-cover transition-transform group-hover:scale-105 duration-200"
                                        >
                                    </template>
                                    <template x-if="!item.is_image">
                                        <div class="flex flex-col items-center justify-center text-slate-400 p-2 text-center">
                                            <svg class="w-8 h-8 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <span class="text-[10px] font-bold text-slate-600 mt-1 uppercase" x-text="item.file_name.split('.').pop()"></span>
                                        </div>
                                    </template>

                                    <!-- Selected Checkmark Overlay -->
                                    <div 
                                        x-show="selectedItem && selectedItem.id === item.id" 
                                        class="absolute top-1.5 right-1.5 w-5 h-5 rounded-full bg-brand-600 text-white flex items-center justify-center shadow-md"
                                    >
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                </div>

                                <!-- Metadata -->
                                <div class="p-2 flex-1 flex flex-col justify-between">
                                    <p class="text-[11px] font-semibold text-slate-800 truncate" :title="item.name" x-text="item.name"></p>
                                    <div class="flex items-center justify-between text-[10px] text-slate-400 mt-1">
                                        <span x-text="item.dimensions || item.human_size"></span>
                                        <span class="uppercase" x-text="item.file_name.split('.').pop()"></span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Selection Status Bar (If item is selected) -->
                <div x-show="selectedItem" class="px-5 py-2.5 bg-brand-50/70 border-t border-brand-100 flex items-center justify-between text-xs shrink-0">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-9 h-9 rounded-md bg-white border border-slate-200 overflow-hidden shrink-0 flex items-center justify-center">
                            <template x-if="selectedItem && selectedItem.is_image">
                                <img :src="selectedItem.url" alt="" class="w-full h-full object-cover">
                            </template>
                            <template x-if="selectedItem && !selectedItem.is_image">
                                <span class="text-[10px] font-bold text-slate-600 uppercase" x-text="selectedItem.file_name.split('.').pop()"></span>
                            </template>
                        </div>
                        <div class="min-w-0">
                            <p class="font-semibold text-slate-900 truncate" x-text="selectedItem ? selectedItem.name : ''"></p>
                            <p class="text-[11px] text-slate-500 truncate" x-text="selectedItem ? (selectedItem.dimensions ? `${selectedItem.dimensions} • ${selectedItem.human_size}` : selectedItem.human_size) : ''"></p>
                        </div>
                    </div>
                    <span class="text-[11px] font-medium text-brand-700 bg-brand-100 px-2 py-0.5 rounded shrink-0">
                        Ready to attach
                    </span>
                </div>
            </div>

            <!-- Tab 2: Upload New Media -->
            <div x-show="activeTab === 'upload'" class="flex-1 flex flex-col justify-center items-center p-6 bg-slate-50/50">
                <div 
                    @dragover.prevent="isDragging = true"
                    @dragleave.prevent="isDragging = false"
                    @drop.prevent="handleDrop($event)"
                    :class="{ 'border-brand-500 bg-brand-50/50 scale-[0.99]': isDragging, 'border-slate-300 bg-white hover:border-slate-400': !isDragging }"
                    class="w-full max-w-lg p-8 rounded-xl border-2 border-dashed flex flex-col items-center justify-center text-center transition-all relative"
                >
                    <!-- Drag & Drop Visuals -->
                    <div class="w-14 h-14 rounded-full bg-brand-50 border border-brand-100 text-brand-600 flex items-center justify-center mb-4">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                    </div>

                    <h4 class="text-sm font-bold text-slate-800 mb-1">
                        Drag and drop files here, or <label for="modal-media-upload" class="text-brand-600 hover:text-brand-700 underline cursor-pointer font-semibold">browse</label>
                    </h4>
                    <p class="text-xs text-slate-500 max-w-xs mb-3">
                        Upload JPG, PNG, WEBP, GIF, SVG, or PDF files up to 10MB each.
                    </p>

                    <!-- Hidden File Input -->
                    <input 
                        type="file" 
                        id="modal-media-upload" 
                        class="hidden" 
                        accept="image/*,.pdf" 
                        @change="handleFileInput($event)"
                        :disabled="uploading"
                    >

                    <!-- Uploading Progress Indicator -->
                    <div x-show="uploading" class="mt-4 flex flex-col items-center gap-2">
                        <svg class="animate-spin w-6 h-6 text-brand-600" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="text-xs font-semibold text-brand-700">Uploading and processing media...</span>
                    </div>

                    <!-- Upload Error Banner -->
                    <div x-show="uploadError" class="mt-4 p-3 rounded-md bg-rose-50 border border-rose-200 text-rose-700 text-xs font-medium text-left w-full">
                        <span x-text="uploadError"></span>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-5 py-3 border-t border-slate-200 bg-white flex items-center justify-between gap-3 shrink-0">
                <!-- Pagination Buttons (Browse tab only) -->
                <div class="flex items-center gap-2 text-xs text-slate-500">
                    <template x-if="activeTab === 'browse' && pagination.total > 0">
                        <div class="flex items-center gap-2">
                            <span>
                                Page <strong class="text-slate-800" x-text="pagination.current_page"></strong> of <strong class="text-slate-800" x-text="pagination.last_page"></strong> (<span x-text="pagination.total"></span> total)
                            </span>
                            <div class="flex items-center gap-1 ml-2">
                                <button 
                                    type="button" 
                                    @click="fetchMedia(pagination.current_page - 1)" 
                                    :disabled="pagination.current_page <= 1"
                                    class="p-1 rounded border border-slate-200 text-slate-600 hover:bg-slate-100 disabled:opacity-40 disabled:pointer-events-none"
                                    title="Previous Page"
                                >
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                </button>
                                <button 
                                    type="button" 
                                    @click="fetchMedia(pagination.current_page + 1)" 
                                    :disabled="pagination.current_page >= pagination.last_page"
                                    class="p-1 rounded border border-slate-200 text-slate-600 hover:bg-slate-100 disabled:opacity-40 disabled:pointer-events-none"
                                    title="Next Page"
                                >
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Action Confirmation Buttons -->
                <div class="flex items-center gap-2">
                    <button 
                        type="button" 
                        @click="closeModal()" 
                        class="px-3.5 py-1.5 rounded-md border border-slate-300 bg-white text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors shadow-xs"
                    >
                        Cancel
                    </button>
                    <button 
                        type="button" 
                        @click="confirmSelection()" 
                        :disabled="!selectedItem" 
                        class="px-4 py-1.5 rounded-md bg-brand-600 text-white text-xs font-semibold hover:bg-brand-700 disabled:opacity-50 disabled:pointer-events-none transition-all shadow-xs flex items-center gap-1.5"
                    >
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Attach Selected Media</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
