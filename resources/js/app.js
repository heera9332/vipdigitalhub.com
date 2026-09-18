import './bootstrap';
import Alpine from 'alpinejs';
import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Link from '@tiptap/extension-link';
import Image from '@tiptap/extension-image';

window.Alpine = Alpine;

// TipTap Rich-Text Editor Component for Admin Post Content Editing
Alpine.data('tiptapEditor', (config = {}) => ({
    editor: null,
    content: config.initialContent || '',
    isActive(name, opts = {}) {
        return this.editor ? this.editor.isActive(name, opts) : false;
    },
    init() {
        this.editor = new Editor({
            element: this.$refs.editorElement,
            extensions: [
                StarterKit.configure({
                    heading: {
                        levels: [2, 3, 4],
                    },
                }),
                Link.configure({
                    openOnClick: false,
                    HTMLAttributes: {
                        class: 'text-brand-600 underline font-medium hover:text-brand-700',
                    },
                }),
                Image.configure({
                    HTMLAttributes: {
                        class: 'rounded-xl max-w-full my-4 shadow-sm border border-slate-200',
                    },
                }),
            ],
            content: this.content,
            editorProps: {
                attributes: {
                    class: 'prose prose-slate max-w-none min-h-[350px] p-5 sm:p-6 focus:outline-none text-slate-800 leading-relaxed font-normal',
                },
            },
            onUpdate: ({ editor }) => {
                this.content = editor.getHTML();
                if (this.$refs.hiddenInput) {
                    this.$refs.hiddenInput.value = this.content;
                }
            },
            onSelectionUpdate: () => {
                this.$dispatch('editor-selection-change');
            },
        });
    },
    destroy() {
        if (this.editor) {
            this.editor.destroy();
        }
    },
    toggleBold() { this.editor?.chain().focus().toggleBold().run(); },
    toggleItalic() { this.editor?.chain().focus().toggleItalic().run(); },
    toggleStrike() { this.editor?.chain().focus().toggleStrike().run(); },
    toggleCode() { this.editor?.chain().focus().toggleCode().run(); },
    toggleHeading(level) { this.editor?.chain().focus().toggleHeading({ level }).run(); },
    toggleBulletList() { this.editor?.chain().focus().toggleBulletList().run(); },
    toggleOrderedList() { this.editor?.chain().focus().toggleOrderedList().run(); },
    toggleBlockquote() { this.editor?.chain().focus().toggleBlockquote().run(); },
    toggleCodeBlock() { this.editor?.chain().focus().toggleCodeBlock().run(); },
    setHorizontalRule() { this.editor?.chain().focus().setHorizontalRule().run(); },
    undo() { this.editor?.chain().focus().undo().run(); },
    redo() { this.editor?.chain().focus().redo().run(); },
    setLink() {
        const previousUrl = this.editor?.getAttributes('link').href || '';
        const url = window.prompt('Enter Link URL:', previousUrl);
        if (url === null) return;
        if (url === '') {
            this.editor?.chain().focus().extendMarkRange('link').unsetLink().run();
            return;
        }
        this.editor?.chain().focus().extendMarkRange('link').setLink({ href: url }).run();
    },
    addImage() {
        const url = window.prompt('Enter Image URL (e.g. /images/featured.jpg or https://...):');
        if (url) {
            this.editor?.chain().focus().setImage({ src: url }).run();
        }
    },
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
