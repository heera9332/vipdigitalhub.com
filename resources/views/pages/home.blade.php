<x-layouts.app 
    title="Custom Software Development & Digital Marketing Agency"
    description="VIP Digital Hub is a premium software development and digital marketing agency specializing in custom web applications, SaaS, mobile apps, and business growth."
>
    <!-- 1. Hero Section -->
    <x-ui.section spacing="lg" class="pt-12 sm:pt-16 pb-20 sm:pb-28">
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(45rem_50rem_at_top,theme(colors.orange.100),theme(colors.slate.50))] opacity-60"></div>
        <div class="absolute inset-y-0 right-1/2 -z-10 mr-16 w-[200%] origin-bottom-left skew-x-[-30deg] bg-white shadow-xl shadow-brand-500/5 ring-1 ring-brand-50 sm:mr-28 lg:mr-0 xl:mr-16 xl:origin-center"></div>

        <x-ui.container>
            <div class="max-w-3xl mx-auto text-center space-y-8">
                <!-- Staggered Entrance Item 1: Badge -->
                <div class="animate-fade-in-up">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full border border-brand-200/80 bg-brand-50 text-brand-700 text-xs font-semibold shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-brand-500 animate-ping"></span>
                        <span>Accepting New Software & Marketing Projects</span>
                    </div>
                </div>

                <!-- Staggered Entrance Item 2: Heading -->
                <h1 class="animate-fade-in-up delay-150 text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-slate-950 leading-[1.1]">
                    We Build Software That <span class="bg-gradient-to-r from-brand-600 via-brand-500 to-amber-500 bg-clip-text text-transparent">Scales Businesses</span>.
                </h1>

                <!-- Staggered Entrance Item 3: Subtitle -->
                <p class="animate-fade-in-up delay-250 text-lg sm:text-xl text-slate-600 leading-relaxed max-w-2xl mx-auto font-normal">
                    VIP Digital Hub engineers mission-critical web applications, high-throughput SaaS platforms, and performance-driven digital marketing campaigns designed to convert.
                </p>

                <!-- Staggered Entrance Item 4: CTAs -->
                <div class="animate-fade-in-up delay-300 pt-2 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <x-ui.button variant="primary" size="lg" :href="route('contact')" class="w-full sm:w-auto shadow-brand-500/30">
                        <span>Start a Project</span>
                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1.5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </x-ui.button>

                    <x-ui.button variant="outline" size="lg" :href="route('projects')" class="w-full sm:w-auto">
                        <span>View Our Work</span>
                    </x-ui.button>
                </div>

                <!-- Staggered Entrance Item 5: Proof Points with Animated Counters -->
                <div class="animate-fade-in-up delay-400 pt-8 border-t border-slate-200/60 grid grid-cols-2 sm:grid-cols-4 gap-6 text-left">
                    <div class="p-3 rounded-md hover:bg-white/60 transition-colors">
                        <div class="text-2xl sm:text-3xl font-extrabold text-slate-900" data-counter="50" data-counter-suffix="+">50+</div>
                        <div class="text-xs text-slate-500 font-medium">Projects Delivered</div>
                    </div>
                    <div class="p-3 rounded-md hover:bg-white/60 transition-colors">
                        <div class="text-2xl sm:text-3xl font-extrabold text-slate-900" data-counter="99" data-counter-suffix="%">99%</div>
                        <div class="text-xs text-slate-500 font-medium">On-Time Completion</div>
                    </div>
                    <div class="p-3 rounded-md hover:bg-white/60 transition-colors">
                        <div class="text-2xl sm:text-3xl font-extrabold text-slate-900" data-counter="8" data-counter-suffix="+ Yrs">8+ Yrs</div>
                        <div class="text-xs text-slate-500 font-medium">Engineering Depth</div>
                    </div>
                    <div class="p-3 rounded-md hover:bg-white/60 transition-colors">
                        <div class="text-2xl sm:text-3xl font-extrabold text-slate-900">24/7</div>
                        <div class="text-xs text-slate-500 font-medium">Dedicated Support</div>
                    </div>
                </div>
            </div>
        </x-ui.container>
    </x-ui.section>

    <!-- 2. Technology & Trust Strip -->
    <section class="reveal-on-scroll py-10 border-y border-slate-200/80 bg-white/60">
        <x-ui.container>
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="text-xs uppercase tracking-wider font-bold text-slate-400 shrink-0">
                    Trusted Technology Stack:
                </div>
                <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 text-slate-500 text-sm font-semibold">
                    <span class="hover:text-brand-600 hover:scale-105 transition-all cursor-default">Laravel</span>
                    <span class="hover:text-brand-600 hover:scale-105 transition-all cursor-default">PHP 8.5</span>
                    <span class="hover:text-brand-600 hover:scale-105 transition-all cursor-default">Vue.js</span>
                    <span class="hover:text-brand-600 hover:scale-105 transition-all cursor-default">React / Next.js</span>
                    <span class="hover:text-brand-600 hover:scale-105 transition-all cursor-default">Tailwind CSS</span>
                    <span class="hover:text-brand-600 hover:scale-105 transition-all cursor-default">Node.js</span>
                    <span class="hover:text-brand-600 hover:scale-105 transition-all cursor-default">MySQL</span>
                    <span class="hover:text-brand-600 hover:scale-105 transition-all cursor-default">Redis</span>
                    <span class="hover:text-brand-600 hover:scale-105 transition-all cursor-default">AWS Cloud</span>
                </div>
            </div>
        </x-ui.container>
    </section>

    <!-- 3. Core Services Overview -->
    <x-ui.section spacing="default" class="bg-slate-50">
        <x-ui.container>
            <div class="reveal-on-scroll flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6">
                <div class="space-y-3 max-w-xl">
                    <x-ui.badge variant="brand">Our Core Capabilities</x-ui.badge>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 tracking-tight">
                        Engineered for High Performance & Measurable Growth
                    </h2>
                    <p class="text-slate-600 text-base">
                        From architecting complex SaaS platforms to scaling revenue through technical SEO and conversion rate optimization.
                    </p>
                </div>
                <x-ui.button variant="outline" :href="route('services')" class="shrink-0">
                    <span>Explore All 15+ Services</span>
                    <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </x-ui.button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($services as $key => $service)
                    <div class="reveal-on-scroll" data-reveal-delay="{{ $loop->index * 80 }}">
                        <x-cards.service 
                            :title="$service['title']"
                            :slug="$service['slug']"
                            :shortDescription="$service['short_description']"
                            :features="$service['features'] ?? []"
                            :icon="$service['icon'] ?? 'globe'"
                            :cta="$service['cta'] ?? 'Learn More'"
                        />
                    </div>
                @endforeach
            </div>
        </x-ui.container>
    </x-ui.section>

    <!-- 4. Agency Story & Value Proposition -->
    <x-ui.section spacing="default" class="bg-white">
        <x-ui.container>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div class="reveal-on-scroll space-y-6">
                    <x-ui.badge variant="brand">About VIP Digital Hub</x-ui.badge>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 tracking-tight leading-tight">
                        We Combine Deep Engineering Rigor With Strategic Market Execution
                    </h2>
                    <p class="text-slate-600 text-base leading-relaxed">
                        Too many businesses struggle with agencies that either understand code but miss business strategy, or marketing agencies that fail on technical execution. VIP Digital Hub bridges that divide.
                    </p>
                    <p class="text-slate-600 text-base leading-relaxed">
                        We build robust, maintainable monolithic and cloud applications with clean code architecture, automated test suites, and high-conversion UX designed to generate sustainable long-term value.
                    </p>

                    <div class="space-y-3.5 pt-2">
                        <div class="flex items-start gap-3 p-3 rounded-md hover:bg-slate-50 transition-colors">
                            <div class="w-6 h-6 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div class="text-sm text-slate-700">
                                <strong class="font-semibold text-slate-900">Zero Technical Debt:</strong> Clean Eloquent queries, normalized schemas, and automated testing ensure your software never becomes legacy after launch.
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-md hover:bg-slate-50 transition-colors">
                            <div class="w-6 h-6 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div class="text-sm text-slate-700">
                                <strong class="font-semibold text-slate-900">Direct Partner Access:</strong> Work directly with seasoned senior engineers and marketing strategists without intermediary layers.
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-md hover:bg-slate-50 transition-colors">
                            <div class="w-6 h-6 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div class="text-sm text-slate-700">
                                <strong class="font-semibold text-slate-900">Full IP Ownership:</strong> Complete source code, database architectures, and deployment pipelines belong 100% to you.
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <x-ui.button variant="secondary" :href="route('about')">
                            <span>Read Our Full Story</span>
                            <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </x-ui.button>
                    </div>
                </div>

                <!-- Visual Comparison / Capabilities Card -->
                <div class="reveal-on-scroll relative" data-reveal-delay="200">
                    <div class="absolute -inset-4 bg-gradient-to-r from-brand-500/20 to-amber-500/20 rounded-md blur-2xl -z-10 animate-pulse-glow"></div>
                    <div class="rounded-md border border-slate-200/90 bg-slate-950 text-white p-8 sm:p-10 shadow-2xl space-y-8">
                        <div>
                            <div class="text-xs font-mono uppercase tracking-widest text-brand-400 mb-2">Capabilities Matrix</div>
                            <h3 class="text-2xl font-bold tracking-tight text-white">Full-Stack Digital Powerhouse</h3>
                        </div>

                        <div class="space-y-6">
                            <div class="p-4.5 rounded-md bg-slate-900/90 border border-slate-800 space-y-2 hover:border-brand-500/40 hover:bg-slate-900 transition-all">
                                <div class="flex items-center justify-between text-sm font-semibold text-white">
                                    <span>Software & Cloud Architecture</span>
                                    <span class="text-brand-400 font-mono text-xs">Enterprise Ready</span>
                                </div>
                                <p class="text-xs text-slate-400 leading-relaxed">
                                    Laravel 13, MySQL, Redis, RESTful & GraphQL APIs, Multi-tenant SaaS, Microservices, and Cloud deployments.
                                </p>
                            </div>

                            <div class="p-4.5 rounded-md bg-slate-900/90 border border-slate-800 space-y-2 hover:border-brand-500/40 hover:bg-slate-900 transition-all">
                                <div class="flex items-center justify-between text-sm font-semibold text-white">
                                    <span>Modern Web & Mobile Interfaces</span>
                                    <span class="text-brand-400 font-mono text-xs">Sub-Second UX</span>
                                </div>
                                <p class="text-xs text-slate-400 leading-relaxed">
                                    Tailwind CSS v4, Vue.js, React, Next.js, Flutter, responsive viewports, and accessibility (WCAG).
                                </p>
                            </div>

                            <div class="p-4.5 rounded-md bg-slate-900/90 border border-slate-800 space-y-2 hover:border-brand-500/40 hover:bg-slate-900 transition-all">
                                <div class="flex items-center justify-between text-sm font-semibold text-white">
                                    <span>Growth & Marketing Engineering</span>
                                    <span class="text-brand-400 font-mono text-xs">High ROI</span>
                                </div>
                                <p class="text-xs text-slate-400 leading-relaxed">
                                    Technical SEO, Core Web Vitals optimization, Meta / Google ad campaigns, and automated sales funnels.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-ui.container>
    </x-ui.section>

    <!-- 5. Featured Projects Showcase -->
    <x-ui.section spacing="default" class="bg-slate-50">
        <x-ui.container>
            <div class="reveal-on-scroll flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6">
                <div class="space-y-3 max-w-xl">
                    <x-ui.badge variant="brand">Case Studies</x-ui.badge>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 tracking-tight">
                        Featured Client Work
                    </h2>
                    <p class="text-slate-600 text-base">
                        Real-world software platforms, digital products, and high-converting websites delivered for forward-thinking clients.
                    </p>
                </div>
                <x-ui.button variant="outline" :href="route('projects')" class="shrink-0">
                    <span>View All Projects</span>
                    <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </x-ui.button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($featuredProjects as $project)
                    <div class="reveal-on-scroll" data-reveal-delay="{{ $loop->index * 120 }}">
                        <x-cards.project :project="$project" />
                    </div>
                @endforeach
            </div>
        </x-ui.container>
    </x-ui.section>

    <!-- 6. Our 4-Step Agile Process -->
    <x-ui.section spacing="default" class="bg-white">
        <x-ui.container>
            <div class="reveal-on-scroll text-center max-w-2xl mx-auto mb-16 space-y-3">
                <x-ui.badge variant="brand">Predictable Delivery</x-ui.badge>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 tracking-tight">
                    How We Bring Your Vision To Market
                </h2>
                <p class="text-slate-600 text-base">
                    A disciplined 4-stage delivery lifecycle ensuring transparency, rapid feedback, and zero guesswork.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="reveal-on-scroll relative p-7 rounded-md border border-slate-200/90 bg-slate-50/70 space-y-4 hover:shadow-md hover:border-brand-300 hover:-translate-y-1 transition-all duration-300" data-reveal-delay="0">
                    <div class="w-10 h-10 rounded-md bg-brand-500 text-white font-mono font-bold flex items-center justify-center text-sm shadow-sm shadow-brand-500/20">
                        01
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Discovery & Strategy</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        We dissect your business goals, user personas, technical constraints, and data flows to map out a concrete blueprint.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="reveal-on-scroll relative p-7 rounded-md border border-slate-200/90 bg-slate-50/70 space-y-4 hover:shadow-md hover:border-brand-300 hover:-translate-y-1 transition-all duration-300" data-reveal-delay="100">
                    <div class="w-10 h-10 rounded-md bg-brand-500 text-white font-mono font-bold flex items-center justify-center text-sm shadow-sm shadow-brand-500/20">
                        02
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Architecture & UX</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Designing database models, scalable APIs, and intuitive UI wireframes validated before writing a single line of backend logic.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="reveal-on-scroll relative p-7 rounded-md border border-slate-200/90 bg-slate-50/70 space-y-4 hover:shadow-md hover:border-brand-300 hover:-translate-y-1 transition-all duration-300" data-reveal-delay="200">
                    <div class="w-10 h-10 rounded-md bg-brand-500 text-white font-mono font-bold flex items-center justify-center text-sm shadow-sm shadow-brand-500/20">
                        03
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Agile Engineering</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Weekly test-driven sprints with automated CI/CD pipelines, giving you access to staging environments to test features live.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="reveal-on-scroll relative p-7 rounded-md border border-slate-200/90 bg-slate-50/70 space-y-4 hover:shadow-md hover:border-brand-300 hover:-translate-y-1 transition-all duration-300" data-reveal-delay="300">
                    <div class="w-10 h-10 rounded-md bg-brand-500 text-white font-mono font-bold flex items-center justify-center text-sm shadow-sm shadow-brand-500/20">
                        04
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Launch & Scale</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Zero-downtime production deployment, telemetry monitoring, search engine indexation, and proactive ongoing maintenance.
                    </p>
                </div>
            </div>
        </x-ui.container>
    </x-ui.section>

    <!-- 7. Client Testimonials -->
    <x-ui.section spacing="default" class="bg-slate-50">
        <x-ui.container>
            <div class="reveal-on-scroll text-center max-w-2xl mx-auto mb-14 space-y-3">
                <x-ui.badge variant="brand">Client Testimonials</x-ui.badge>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 tracking-tight">
                    Trusted By Founders & Tech Leaders
                </h2>
                <p class="text-slate-600 text-base">
                    Read how our software engineering and marketing strategies helped clients grow.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="reveal-on-scroll" data-reveal-delay="0">
                    <x-cards.testimonial 
                        quote="VIP Digital Hub delivered our multi-tenant SaaS 3 weeks ahead of schedule. Their Laravel and database optimization shaved our average page load time down to 180ms."
                        author="Vikram Sharma"
                        role="CTO"
                        company="StackConsole Inc."
                    />
                </div>
                <div class="reveal-on-scroll" data-reveal-delay="100">
                    <x-cards.testimonial 
                        quote="The medical EHR portal they built is both intuitive for our clinical staff and fully HIPAA-compliant. Their team's proactive suggestions during discovery saved us thousands in cloud fees."
                        author="Dr. Priya Mehta"
                        role="Managing Director"
                        company="MedPulse Clinics"
                    />
                </div>
                <div class="reveal-on-scroll" data-reveal-delay="200">
                    <x-cards.testimonial 
                        quote="Our e-commerce revenue increased by 140% in four months after VIP Digital Hub revamped our store architecture and overhauled our technical SEO."
                        author="Arun Nair"
                        role="Founder & CEO"
                        company="RetailMax Brands"
                    />
                </div>
            </div>
        </x-ui.container>
    </x-ui.section>

    <!-- 8. Latest Insights / Blog -->
    @if ($latestPosts->isNotEmpty())
        <x-ui.section spacing="default" class="bg-white">
            <x-ui.container>
                <div class="reveal-on-scroll flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6">
                    <div class="space-y-3 max-w-xl">
                        <x-ui.badge variant="brand">Engineering & Marketing Insights</x-ui.badge>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 tracking-tight">
                            Latest Articles & Case Notes
                        </h2>
                        <p class="text-slate-600 text-base">
                            Practical guides on software engineering, Laravel performance, SaaS metrics, and modern search engine optimization.
                        </p>
                    </div>
                    <x-ui.button variant="outline" :href="route('posts.index')" class="shrink-0">
                        <span>Read All Posts</span>
                        <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </x-ui.button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($latestPosts as $post)
                        <div class="reveal-on-scroll" data-reveal-delay="{{ $loop->index * 100 }}">
                            <x-cards.post :post="$post" />
                        </div>
                    @endforeach
                </div>
            </x-ui.container>
        </x-ui.section>
    @endif

    <!-- 9. High Impact Call to Action -->
    <x-ui.section spacing="default" class="bg-slate-50">
        <x-ui.container>
            <x-sections.cta />
        </x-ui.container>
    </x-ui.section>
</x-layouts.app>
