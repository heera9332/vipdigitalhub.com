import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Image from '@tiptap/extension-image';

Alpine.plugin(collapse);
window.Alpine = Alpine;

// TipTap Rich-Text Editor Component for Admin Post Content Editing
// Note: Keep editorInstance in lexical closure scope so it is NEVER wrapped by Alpine's
// reactive proxy (preventing ProseMirror transaction errors) and does NOT depend on this.$el.
Alpine.data('tiptapEditor', (config = {}) => {
    let editorInstance = null;

    return {
        content: config.initialContent || '',
        selectionTick: 0,

        getEditor() {
            return editorInstance;
        },

        get editor() {
            return editorInstance;
        },

        isActive(name, opts = {}) {
            this.selectionTick;
            return editorInstance ? editorInstance.isActive(name, opts) : false;
        },

        init() {
            editorInstance = new Editor({
                element: this.$refs.editorElement,
                extensions: [
                    StarterKit.configure({
                        heading: {
                            levels: [1, 2, 3, 4, 5, 6],
                        },
                        link: {
                            openOnClick: false,
                            HTMLAttributes: {
                                class: 'text-brand-600 underline font-medium hover:text-brand-700',
                            },
                        },
                    }),
                    Image.configure({
                        HTMLAttributes: {
                            class: 'rounded-md max-w-full my-4 shadow-sm border border-slate-200',
                        },
                    }),
                ],
                content: this.content,
                editorProps: {
                    attributes: {
                        class: 'tiptap prose prose-slate max-w-none min-h-[350px] p-5 sm:p-6 focus:outline-none text-slate-800 leading-relaxed font-normal',
                    },
                },
                onUpdate: ({ editor: ed }) => {
                    this.content = ed.getHTML();
                    if (this.$refs.hiddenInput) {
                        this.$refs.hiddenInput.value = this.content;
                    }
                    this.selectionTick++;
                },
                onSelectionUpdate: () => {
                    this.selectionTick++;
                },
                onTransaction: () => {
                    this.selectionTick++;
                },
                onFocus: () => {
                    this.selectionTick++;
                },
                onBlur: () => {
                    this.selectionTick++;
                },
            });

            if (this.$refs.editorElement) {
                this.$refs.editorElement._editor = editorInstance;
            }

            this.$nextTick(() => {
                this.selectionTick++;
            });
        },

        destroy() {
            if (editorInstance) {
                editorInstance.destroy();
                editorInstance = null;
            }
        },

        toggleBold() { editorInstance?.chain().focus().toggleBold().run(); },
        toggleItalic() { editorInstance?.chain().focus().toggleItalic().run(); },
        toggleStrike() { editorInstance?.chain().focus().toggleStrike().run(); },
        toggleCode() { editorInstance?.chain().focus().toggleCode().run(); },
        toggleHeading(level) { editorInstance?.chain().focus().toggleHeading({ level: parseInt(level, 10) }).run(); },
        toggleBulletList() { editorInstance?.chain().focus().toggleBulletList().run(); },
        toggleOrderedList() { editorInstance?.chain().focus().toggleOrderedList().run(); },
        toggleBlockquote() { editorInstance?.chain().focus().toggleBlockquote().run(); },
        toggleCodeBlock() { editorInstance?.chain().focus().toggleCodeBlock().run(); },
        setHorizontalRule() { editorInstance?.chain().focus().setHorizontalRule().run(); },
        undo() { editorInstance?.chain().focus().undo().run(); },
        redo() { editorInstance?.chain().focus().redo().run(); },
        setLink() {
            if (!editorInstance) return;
            const previousUrl = editorInstance.getAttributes('link').href || '';
            const url = window.prompt('Enter Link URL:', previousUrl);
            if (url === null) return;
            if (url === '') {
                editorInstance.chain().focus().extendMarkRange('link').unsetLink().run();
                return;
            }
            editorInstance.chain().focus().extendMarkRange('link').setLink({ href: url }).run();
        },
        addImage() {
            if (!editorInstance) return;
            window.dispatchEvent(new CustomEvent('open-media-modal', {
                detail: {
                    onSelect: (media) => {
                        if (media && media.url) {
                            editorInstance.chain().focus().setImage({
                                src: media.url,
                                alt: media.alt_text || media.name || '',
                            }).run();
                        }
                    }
                }
            }));
        },
    };
});

// Admin Media Library Component
Alpine.data('adminMediaLibrary', () => ({
    isDragging: false,
    uploading: false,
    progress: 0,
    detailModalOpen: false,
    activeItem: null,
    saving: false,
    copied: false,

    handleDrop(e) {
        this.isDragging = false;
        const files = e.dataTransfer?.files;
        if (files && files.length > 0) {
            this.uploadFile(files[0]);
        }
    },

    handleFileSelect(e) {
        const files = e.target?.files;
        if (files && files.length > 0) {
            this.uploadFile(files[0]);
        }
    },

    async uploadFile(file) {
        if (!file) return;
        this.uploading = true;
        this.progress = 20;

        const formData = new FormData();
        formData.append('file', file);
        formData.append('name', file.name.replace(/\.[^/.]+$/, ''));

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        try {
            this.progress = 50;
            const response = await fetch('/admin/media', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: formData,
            });

            this.progress = 90;
            if (!response.ok) {
                const err = await response.json();
                alert(err.message || 'Upload failed.');
                return;
            }

            this.progress = 100;
            window.location.reload();
        } catch (error) {
            console.error('Upload error:', error);
            alert('An unexpected error occurred during upload.');
        } finally {
            this.uploading = false;
            this.progress = 0;
        }
    },

    openDetails(item) {
        this.activeItem = { ...item };
        this.detailModalOpen = true;
        this.copied = false;
    },

    async saveChanges() {
        if (!this.activeItem) return;
        this.saving = true;

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        try {
            const response = await fetch(`/admin/media/${this.activeItem.id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({
                    name: this.activeItem.name,
                    alt_text: this.activeItem.alt_text,
                }),
            });

            if (response.ok) {
                this.detailModalOpen = false;
                window.location.reload();
            } else {
                const err = await response.json();
                alert(err.message || 'Failed to update media details.');
            }
        } catch (e) {
            console.error(e);
            alert('Error updating media.');
        } finally {
            this.saving = false;
        }
    },

    async deleteMedia(id) {
        if (!confirm('Are you sure you want to permanently delete this media file?')) return;

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        try {
            const response = await fetch(`/admin/media/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            if (response.ok) {
                this.detailModalOpen = false;
                window.location.reload();
            } else {
                alert('Failed to delete media file.');
            }
        } catch (e) {
            console.error(e);
            alert('Error deleting media.');
        }
    },

    copyUrl(url) {
        if (!url) return;

        const handleSuccess = () => {
            this.copied = true;
            setTimeout(() => { this.copied = false; }, 2000);
        };

        if (navigator && navigator.clipboard && typeof navigator.clipboard.writeText === 'function' && window.isSecureContext) {
            navigator.clipboard.writeText(url)
                .then(handleSuccess)
                .catch(() => this.fallbackCopy(url, handleSuccess));
        } else {
            this.fallbackCopy(url, handleSuccess);
        }
    },

    fallbackCopy(text, onSuccess) {
        try {
            const textArea = document.createElement('textarea');
            textArea.value = text;
            textArea.style.position = 'fixed';
            textArea.style.left = '-999999px';
            textArea.style.top = '-999999px';
            textArea.style.opacity = '0';
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            const successful = document.execCommand('copy');
            document.body.removeChild(textArea);
            if (successful && typeof onSuccess === 'function') {
                onSuccess();
            }
        } catch (err) {
            console.error('Fallback clipboard copy failed:', err);
        }
    },
}));

// Universal Media Picker Modal Component
Alpine.data('mediaPickerModal', () => ({
    isOpen: false,
    activeTab: 'browse',
    searchQuery: '',
    filterType: '',
    loading: false,
    items: [],
    pagination: {
        current_page: 1,
        last_page: 1,
        total: 0,
        prev_page_url: null,
        next_page_url: null,
    },
    selectedItem: null,
    onSelectCallback: null,
    uploading: false,
    uploadError: '',
    isDragging: false,
    searchTimeout: null,

    init() {
        window.addEventListener('open-media-modal', (e) => {
            this.openModal(e.detail || {});
        });
    },

    openModal(detail = {}) {
        this.isOpen = true;
        this.onSelectCallback = detail.onSelect || null;
        this.selectedItem = null;
        this.activeTab = 'browse';
        this.uploadError = '';
        document.body.classList.add('overflow-hidden');
        this.fetchMedia(1, detail.currentUrl || null);
    },

    closeModal() {
        this.isOpen = false;
        this.selectedItem = null;
        this.onSelectCallback = null;
        this.uploadError = '';
        document.body.classList.remove('overflow-hidden');
    },

    selectItem(item) {
        this.selectedItem = item;
    },

    confirmSelection() {
        if (this.selectedItem && typeof this.onSelectCallback === 'function') {
            this.onSelectCallback(this.selectedItem);
        }
        this.closeModal();
    },

    handleSearchInput() {
        clearTimeout(this.searchTimeout);
        this.searchTimeout = setTimeout(() => {
            this.fetchMedia(1);
        }, 300);
    },

    setFilter(type) {
        if (this.filterType === type) {
            this.filterType = '';
        } else {
            this.filterType = type;
        }
        this.fetchMedia(1);
    },

    async fetchMedia(page = 1, preselectUrl = null) {
        this.loading = true;
        try {
            const params = new URLSearchParams({
                format: 'json',
                page: page,
                per_page: 18,
            });
            if (this.searchQuery) {
                params.append('search', this.searchQuery);
            }
            if (this.filterType) {
                params.append('type', this.filterType);
            }

            const response = await fetch(`/admin/media?${params.toString()}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (response.ok) {
                const data = await response.json();
                this.items = data.data || [];
                this.pagination = {
                    current_page: data.current_page || 1,
                    last_page: data.last_page || 1,
                    total: data.total || 0,
                    prev_page_url: data.prev_page_url,
                    next_page_url: data.next_page_url,
                };

                if (preselectUrl && this.items.length > 0) {
                    const matched = this.items.find(item => item.url === preselectUrl);
                    if (matched) {
                        this.selectedItem = matched;
                    }
                }
            }
        } catch (err) {
            console.error('Failed to load media:', err);
        } finally {
            this.loading = false;
        }
    },

    handleDrop(e) {
        this.isDragging = false;
        const files = e.dataTransfer?.files;
        if (files && files.length > 0) {
            this.uploadFile(files[0]);
        }
    },

    handleFileInput(e) {
        const files = e.target?.files;
        if (files && files.length > 0) {
            this.uploadFile(files[0]);
            e.target.value = '';
        }
    },

    async uploadFile(file) {
        if (!file) return;
        this.uploading = true;
        this.uploadError = '';

        const formData = new FormData();
        formData.append('file', file);
        formData.append('name', file.name.replace(/\.[^/.]+$/, ''));

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        try {
            const response = await fetch('/admin/media', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok && result.media) {
                this.activeTab = 'browse';
                this.items.unshift(result.media);
                this.selectedItem = result.media;
                this.pagination.total++;
            } else {
                this.uploadError = result.message || (result.errors ? Object.values(result.errors).flat().join(', ') : 'Upload failed.');
            }
        } catch (err) {
            this.uploadError = 'Network error while uploading. Please try again.';
            console.error('Upload error:', err);
        } finally {
            this.uploading = false;
        }
    }
}));

// Reusable Media Select Field Component
Alpine.data('mediaSelect', (initialValue = '') => ({
    imageUrl: initialValue,
    showUrlInput: false,
    openPicker() {
        window.dispatchEvent(new CustomEvent('open-media-modal', {
            detail: {
                currentUrl: this.imageUrl,
                onSelect: (media) => {
                    this.imageUrl = media.url;
                }
            }
        }));
    },
    clearImage() {
        this.imageUrl = '';
    }
}));

// Initialize Alpine
Alpine.start();

// IntersectionObserver for smooth scroll reveals
document.addEventListener('DOMContentLoaded', () => {
    // 1. Scroll reveal observer
    const revealElements = document.querySelectorAll('.reveal-on-scroll');
    
    if ('IntersectionObserver' in window && revealElements.length > 0) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const delay = el.getAttribute('data-reveal-delay');
                    if (delay) {
                        el.style.transitionDelay = `${delay}ms`;
                    }
                    el.classList.add('is-revealed');
                    observer.unobserve(el);
                }
            });
        }, {
            root: null,
            rootMargin: '0px 0px -40px 0px',
            threshold: 0.12
        });

        revealElements.forEach(el => revealObserver.observe(el));
    } else {
        // Fallback for browsers without IntersectionObserver
        revealElements.forEach(el => el.classList.add('is-revealed'));
    }

    // 2. Number counter animation for statistics
    const counterElements = document.querySelectorAll('[data-counter]');
    if ('IntersectionObserver' in window && counterElements.length > 0) {
        const counterObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = parseInt(el.getAttribute('data-counter'), 10);
                    const suffix = el.getAttribute('data-counter-suffix') || '';
                    const duration = 1400; // ms
                    const startTime = performance.now();

                    const updateCounter = (currentTime) => {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        // Ease-out cubic curve
                        const easeOut = 1 - Math.pow(1 - progress, 3);
                        const currentVal = Math.floor(easeOut * target);
                        
                        el.textContent = `${currentVal}${suffix}`;

                        if (progress < 1) {
                            requestAnimationFrame(updateCounter);
                        } else {
                            el.textContent = `${target}${suffix}`;
                        }
                    };

                    requestAnimationFrame(updateCounter);
                    observer.unobserve(el);
                }
            });
        }, { threshold: 0.2 });

        counterElements.forEach(el => counterObserver.observe(el));
    }
});
