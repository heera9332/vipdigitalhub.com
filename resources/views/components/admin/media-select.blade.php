@props([
    'name',
    'value' => null,
    'label' => 'Featured Image',
    'help' => null,
    'required' => false,
    'placeholder' => 'No media selected',
])

@php
    $currentValue = old($name, $value);
@endphp

<div 
    x-data="mediaSelect(@js($currentValue ?? ''))" 
    class="space-y-1.5"
>
    @if ($label)
        <div class="flex items-center justify-between">
            <label for="{{ $name }}" class="block text-xs font-semibold text-slate-800">
                {{ $label }} @if ($required) <span class="text-rose-500">*</span> @endif
            </label>
            <button 
                type="button" 
                @click="showUrlInput = !showUrlInput" 
                class="text-[11px] text-slate-400 hover:text-slate-600 transition-colors"
                x-text="showUrlInput ? 'Hide URL input' : 'Enter URL manually'"
            ></button>
        </div>
    @endif

    <div class="space-y-2">
        <!-- Main Select Box with Preview -->
        <div class="rounded-lg border border-slate-200 bg-slate-50/70 p-3 flex items-center gap-3.5 transition-all">
            <!-- Thumbnail Box -->
            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-md border border-slate-200 bg-white overflow-hidden shrink-0 flex items-center justify-center relative shadow-xs">
                <template x-if="imageUrl">
                    <img 
                        :src="imageUrl" 
                        alt="Media Preview" 
                        class="w-full h-full object-cover"
                    >
                </template>
                <div x-show="!imageUrl" class="flex flex-col items-center justify-center text-slate-300 p-2 text-center">
                    <svg class="w-6 h-6 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>

            <!-- Details & Actions -->
            <div class="flex-1 min-w-0">
                <!-- If Image is selected -->
                <div x-show="imageUrl" class="space-y-1">
                    <p class="text-xs font-semibold text-slate-800 truncate" x-text="imageUrl.split('/').pop() || 'Selected Media'"></p>
                    <p class="text-[11px] font-mono text-slate-400 truncate max-w-xs sm:max-w-md" x-text="imageUrl"></p>
                    
                    <div class="flex items-center gap-2 pt-1">
                        <button 
                            type="button" 
                            @click="openPicker()" 
                            class="inline-flex items-center gap-1 text-[11px] font-semibold text-brand-600 hover:text-brand-700 hover:underline"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Choose Different
                        </button>
                        <span class="text-slate-300">|</span>
                        <button 
                            type="button" 
                            @click="clearImage()" 
                            class="inline-flex items-center gap-1 text-[11px] font-semibold text-rose-600 hover:text-rose-700 hover:underline"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Remove
                        </button>
                    </div>
                </div>

                <!-- If No Image is selected -->
                <div x-show="!imageUrl" class="space-y-1.5">
                    <p class="text-xs text-slate-500">{{ $placeholder }}</p>
                    <button 
                        type="button" 
                        @click="openPicker()" 
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md bg-white border border-slate-300 shadow-xs text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:border-slate-400 transition-all"
                    >
                        <svg class="w-4 h-4 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Choose from Library</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Optional Manual URL text field -->
        <div x-show="showUrlInput" class="transition-all">
            <input 
                type="text" 
                x-model="imageUrl" 
                placeholder="https://... or /storage/media/..."
                class="w-full px-3 py-1.5 rounded-md border border-slate-300 bg-white text-xs font-mono text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500"
            >
        </div>

        <!-- Form submission input -->
        <input 
            type="hidden" 
            name="{{ $name }}" 
            id="{{ $name }}" 
            :value="imageUrl"
        >

        @if ($help)
            <p class="text-[11px] text-slate-400">{{ $help }}</p>
        @endif

        @error($name)
            <p class="text-xs text-rose-600 font-medium">{{ $message }}</p>
        @enderror
    </div>
</div>
