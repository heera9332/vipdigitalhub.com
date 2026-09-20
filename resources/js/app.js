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
            const url = window.prompt('Enter Image URL (e.g. /images/featured.jpg or https://...):');
            if (url) {
                editorInstance.chain().focus().setImage({ src: url }).run();
            }
        },
    };
});

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
