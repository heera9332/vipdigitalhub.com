@props([
    'name' => 'content',
    'value' => '',
    'label' => 'Article Content',
    'required' => false,
])

<div 
    x-data="tiptapEditor({ initialContent: {{ json_encode(old($name, $value)) }} })" 
    class="space-y-1.5"
>
    @if ($label)
        <label class="block text-xs font-semibold text-slate-800">
            {{ $label }} @if ($required) <span class="text-rose-500">*</span> @endif
        </label>
    @endif

    <div class="rounded-md border border-slate-300 bg-white overflow-hidden shadow-xs focus-within:ring-2 focus-within:ring-brand-500/40 focus-within:border-brand-500 transition-all">
        <!-- TipTap Action Toolbar -->
        <div class="flex flex-wrap items-center gap-1 p-2 bg-slate-50 border-b border-slate-200/90 text-slate-700">
            <!-- Text Styling -->
            <button 
                type="button" 
                @mousedown.prevent
                @click="toggleBold()" 
                :class="{ 'bg-brand-100 text-brand-700 font-bold shadow-xs': isActive('bold'), 'hover:bg-slate-200/70': !isActive('bold') }"
                class="p-1.5 rounded-lg text-xs transition-colors" 
                title="Bold (Ctrl+B)"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z"/></svg>
            </button>

            <button 
                type="button" 
                @mousedown.prevent
                @click="toggleItalic()" 
                :class="{ 'bg-brand-100 text-brand-700 font-bold shadow-xs': isActive('italic'), 'hover:bg-slate-200/70': !isActive('italic') }"
                class="p-1.5 rounded-lg text-xs transition-colors" 
                title="Italic (Ctrl+I)"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 0h-6m2 16h-6"/></svg>
            </button>

            <button 
                type="button" 
                @mousedown.prevent
                @click="toggleStrike()" 
                :class="{ 'bg-brand-100 text-brand-700 shadow-xs': isActive('strike'), 'hover:bg-slate-200/70': !isActive('strike') }"
                class="p-1.5 rounded-lg text-xs transition-colors" 
                title="Strikethrough"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M16 6a4 4 0 00-8 0c0 4 8 2 8 6a4 4 0 01-8 0"/></svg>
            </button>

            <button 
                type="button" 
                @mousedown.prevent
                @click="toggleCode()" 
                :class="{ 'bg-brand-100 text-brand-700 shadow-xs': isActive('code'), 'hover:bg-slate-200/70': !isActive('code') }"
                class="p-1.5 rounded-lg text-xs font-mono transition-colors" 
                title="Inline Code"
            >
                &lt;/&gt;
            </button>

            <div class="h-4 w-px bg-slate-300 mx-1"></div>

            <!-- Headings -->
            <button 
                type="button" 
                @mousedown.prevent
                @click="toggleHeading(1)" 
                :class="{ 'bg-brand-100 text-brand-700 font-bold shadow-xs': isActive('heading', { level: 1 }), 'hover:bg-slate-200/70': !isActive('heading', { level: 1 }) }"
                class="px-2 py-1 rounded-lg text-xs font-bold transition-colors" 
                title="Heading 1"
            >
                H1
            </button>

            <button 
                type="button" 
                @mousedown.prevent
                @click="toggleHeading(2)" 
                :class="{ 'bg-brand-100 text-brand-700 font-bold shadow-xs': isActive('heading', { level: 2 }), 'hover:bg-slate-200/70': !isActive('heading', { level: 2 }) }"
                class="px-2 py-1 rounded-lg text-xs font-bold transition-colors" 
                title="Heading 2"
            >
                H2
            </button>

            <button 
                type="button" 
                @mousedown.prevent
                @click="toggleHeading(3)" 
                :class="{ 'bg-brand-100 text-brand-700 font-bold shadow-xs': isActive('heading', { level: 3 }), 'hover:bg-slate-200/70': !isActive('heading', { level: 3 }) }"
                class="px-2 py-1 rounded-lg text-xs font-bold transition-colors" 
                title="Heading 3"
            >
                H3
            </button>

            <div class="h-4 w-px bg-slate-300 mx-1"></div>

            <!-- Lists -->
            <button 
                type="button" 
                @mousedown.prevent
                @click="toggleBulletList()" 
                :class="{ 'bg-brand-100 text-brand-700 shadow-xs': isActive('bulletList'), 'hover:bg-slate-200/70': !isActive('bulletList') }"
                class="p-1.5 rounded-lg text-xs transition-colors" 
                title="Bullet List"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16M2 6h.01M2 12h.01M2 18h.01"/></svg>
            </button>

            <button 
                type="button" 
                @mousedown.prevent
                @click="toggleOrderedList()" 
                :class="{ 'bg-brand-100 text-brand-700 shadow-xs': isActive('orderedList'), 'hover:bg-slate-200/70': !isActive('orderedList') }"
                class="p-1.5 rounded-lg text-xs transition-colors" 
                title="Numbered List"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 6h13M7 12h13M7 18h13M3 5v2m0-2L2 6m1 6a1 1 0 011-1 1 1 0 011 1v1a1 1 0 01-1 1H3m0 5h2a1 1 0 001-1v-1a1 1 0 00-1-1H3"/></svg>
            </button>

            <button 
                type="button" 
                @mousedown.prevent
                @click="toggleBlockquote()" 
                :class="{ 'bg-brand-100 text-brand-700 shadow-xs': isActive('blockquote'), 'hover:bg-slate-200/70': !isActive('blockquote') }"
                class="p-1.5 rounded-lg text-xs transition-colors" 
                title="Blockquote"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
            </button>

            <button 
                type="button" 
                @mousedown.prevent
                @click="toggleCodeBlock()" 
                :class="{ 'bg-brand-100 text-brand-700 shadow-xs': isActive('codeBlock'), 'hover:bg-slate-200/70': !isActive('codeBlock') }"
                class="p-1.5 rounded-lg text-xs transition-colors" 
                title="Code Block"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
            </button>

            <div class="h-4 w-px bg-slate-300 mx-1"></div>

            <!-- Media & Utilities -->
            <button 
                type="button" 
                @mousedown.prevent
                @click="setLink()" 
                :class="{ 'bg-brand-100 text-brand-700 shadow-xs': isActive('link'), 'hover:bg-slate-200/70': !isActive('link') }"
                class="p-1.5 rounded-lg text-xs transition-colors" 
                title="Add Link"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
            </button>

            <button 
                type="button" 
                @mousedown.prevent
                @click="addImage()" 
                class="p-1.5 rounded-lg text-xs hover:bg-slate-200/70 transition-colors" 
                title="Insert Image by URL"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </button>

            <button 
                type="button" 
                @mousedown.prevent
                @click="setHorizontalRule()" 
                class="p-1.5 rounded-lg text-xs hover:bg-slate-200/70 transition-colors" 
                title="Horizontal Divider"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 12h16"/></svg>
            </button>

            <div class="h-4 w-px bg-slate-300 mx-1"></div>

            <!-- History -->
            <button 
                type="button" 
                @mousedown.prevent
                @click="undo()" 
                class="p-1.5 rounded-lg text-xs hover:bg-slate-200/70 transition-colors" 
                title="Undo (Ctrl+Z)"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h10a5 5 0 015 5v2m-15-7l4-4m-4 4l4 4"/></svg>
            </button>

            <button 
                type="button" 
                @mousedown.prevent
                @click="redo()" 
                class="p-1.5 rounded-lg text-xs hover:bg-slate-200/70 transition-colors" 
                title="Redo (Ctrl+Y)"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 10H11a5 5 0 00-5 5v2m15-7l-4-4m4 4l-4 4"/></svg>
            </button>
        </div>

        <!-- TipTap Editor Canvas -->
        <div x-ref="editorElement" class="bg-white min-h-[350px]"></div>

        <!-- Hidden input for standard Form submission -->
        <textarea name="{{ $name }}" x-ref="hiddenInput" class="hidden">{{ old($name, $value) }}</textarea>
    </div>

    @error($name)
        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
    @enderror
</div>
