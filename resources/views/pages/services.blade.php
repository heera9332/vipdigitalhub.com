<x-layouts.app 
    title="Our Services — Software Development & Digital Marketing"
    description="Explore VIP Digital Hub's full suite of technology and digital marketing services: custom software development, Laravel, SaaS, mobile apps, SEO, and performance marketing."
>
    <!-- Header Hero -->
    <x-ui.section spacing="lg" class="bg-gradient-to-b from-brand-50/50 via-white to-slate-50 border-b border-slate-200/80">
        <x-ui.container>
            <div class="max-w-3xl mx-auto text-center space-y-6">
                <div class="animate-fade-in-up">
                    <x-ui.badge variant="brand">Full-Service Digital Agency</x-ui.badge>
                </div>
                
                <h1 class="animate-fade-in-up delay-150 text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-950 tracking-tight leading-tight">
                    Technology & Marketing Services Tailored For <span class="bg-gradient-to-r from-brand-600 to-amber-500 bg-clip-text text-transparent">Scale</span>
                </h1>

                <p class="animate-fade-in-up delay-250 text-lg sm:text-xl text-slate-600 leading-relaxed max-w-2xl mx-auto font-normal">
                    We combine engineering excellence with revenue-focused digital marketing to deliver predictable, measurable results for high-growth businesses.
                </p>

                <div class="animate-fade-in-up delay-300 pt-2 flex flex-wrap items-center justify-center gap-4">
                    <x-ui.button variant="primary" size="lg" :href="route('contact')">
                        <span>Request a Custom Quote</span>
                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1.5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </x-ui.button>

                    <x-ui.button variant="outline" size="lg" :href="route('projects')">
                        <span>Browse Case Studies</span>
                    </x-ui.button>
                </div>
            </div>
        </x-ui.container>
    </x-ui.section>

    <!-- Services Grid -->
    <x-ui.section spacing="default" class="bg-slate-50">
        <x-ui.container>
            <div class="reveal-on-scroll mb-12 text-center max-w-2xl mx-auto space-y-3">
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-950 tracking-tight">
                    Our Core Specializations
                </h2>
                <p class="text-slate-600 text-sm sm:text-base">
                    Every service is executed with production-grade coding standards, rigorous testing, and proactive communication.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($services as $key => $service)
                    <div class="reveal-on-scroll" data-reveal-delay="{{ $loop->index * 60 }}">
                        <x-cards.service 
                            :title="$service['title']"
                            :slug="$service['slug']"
                            :shortDescription="$service['short_description']"
                            :features="$service['features'] ?? []"
                            :icon="$service['icon'] ?? 'globe'"
                            :cta="$service['cta'] ?? 'Inquire Now'"
                        />
                    </div>
                @endforeach
            </div>
        </x-ui.container>
    </x-ui.section>

    <!-- How We Deliver Services -->
    <x-ui.section spacing="default" class="bg-white border-t border-slate-200/80">
        <x-ui.container>
            <div class="reveal-on-scroll max-w-2xl mx-auto text-center mb-16 space-y-3">
                <x-ui.badge variant="brand">Quality Standards</x-ui.badge>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 tracking-tight">
                    Why Our Engineering Delivers Better Outcomes
                </h2>
                <p class="text-slate-600 text-base">
                    We adhere to enterprise-level software craftsmanship principles across every engagement.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="reveal-on-scroll p-7 rounded-md border border-slate-200/90 bg-slate-50/70 space-y-3 hover:shadow-md hover:border-brand-300 hover:-translate-y-1 transition-all duration-300" data-reveal-delay="0">
                    <div class="w-10 h-10 rounded-md bg-brand-50 text-brand-600 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Automated Testing & CI/CD</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Every feature is backed by feature and unit tests (PHPUnit / Pest), eliminating regressions and keeping deployment cycles safe and fast.
                    </p>
                </div>

                <div class="reveal-on-scroll p-7 rounded-md border border-slate-200/90 bg-slate-50/70 space-y-3 hover:shadow-md hover:border-brand-300 hover:-translate-y-1 transition-all duration-300" data-reveal-delay="100">
                    <div class="w-10 h-10 rounded-md bg-brand-50 text-brand-600 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Performance & Sub-Second Loads</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Database query optimization, eager-loading, Redis caching, and asset bundling via Vite produce blazing fast user experiences that rank high on Google.
                    </p>
                </div>

                <div class="reveal-on-scroll p-7 rounded-md border border-slate-200/90 bg-slate-50/70 space-y-3 hover:shadow-md hover:border-brand-300 hover:-translate-y-1 transition-all duration-300" data-reveal-delay="200">
                    <div class="w-10 h-10 rounded-md bg-brand-50 text-brand-600 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Security & OWASP Compliance</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        CSRF defense, SQL injection protection, rate limiting, and encrypted credential storage keep your application safe from vulnerability vectors.
                    </p>
                </div>
            </div>
        </x-ui.container>
    </x-ui.section>

    <!-- Bottom CTA -->
    <x-ui.section spacing="default" class="bg-slate-50">
        <x-ui.container>
            <x-sections.cta 
                title="Need a Custom Solution Tailored to Your Business?"
                subtitle="Schedule a free technical discovery call with our team. We'll help you assess feasibility, timelines, and budget."
                buttonText="Discuss Your Requirements"
            />
        </x-ui.container>
    </x-ui.section>
</x-layouts.app>
