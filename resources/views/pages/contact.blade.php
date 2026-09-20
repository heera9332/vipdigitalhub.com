@php
    $siteName = setting('site_name', config('agency.name', 'VIP Digital Hub'));
    $phone = setting('site_phone', config('agency.phone', '+91 7000153244'));
    $email = setting('site_email', config('agency.email', 'vipdigitalhub@gmail.com'));
    $address = setting('site_address', config('agency.address', 'Front of Petrol Pump, House No. 2, Shravan Kanta, NZM Bypass Road, Estate, Bhopal, Madhya Pradesh 462021'));
    $hours = setting('business_hours', config('agency.business_hours', 'Mon - Sat: 9:00 AM - 7:00 PM'));
    $whatsappUrl = config('social.links.whatsapp.url', 'https://wa.me/917000153244');
    $mapsUrl = setting('google_maps_url', 'https://maps.google.com/?q=Bhopal,Madhya+Pradesh');
@endphp

<x-layouts.app 
    title="Contact Us — Start a Project or Inquire"
    description="Get in touch with VIP Digital Hub to discuss your software development, web app, SaaS, or digital marketing requirements. We respond within 24 hours."
>
    <!-- Header Hero -->
    <x-ui.section spacing="lg" class="bg-gradient-to-b from-brand-50/50 via-white to-slate-50 border-b border-slate-200/80">
        <x-ui.container>
            <div class="max-w-3xl mx-auto text-center space-y-6">
                <div class="animate-fade-in-up">
                    <x-ui.badge variant="brand">Let's Talk Business</x-ui.badge>
                </div>
                
                <h1 class="animate-fade-in-up delay-150 text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-950 tracking-tight leading-tight">
                    Start a Project With <span class="bg-gradient-to-r from-brand-600 to-amber-500 bg-clip-text text-transparent">VIP Digital Hub</span>
                </h1>

                <p class="animate-fade-in-up delay-250 text-lg sm:text-xl text-slate-600 leading-relaxed max-w-2xl mx-auto font-normal">
                    Have an upcoming project, need to scale an engineering team, or want to audit your marketing performance? Fill out the form below or contact us directly.
                </p>
            </div>
        </x-ui.container>
    </x-ui.section>

    <!-- Main Contact Section -->
    <x-ui.section spacing="default" class="bg-slate-50" id="project-enquiry">
        <x-ui.container>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
                <!-- Left Column: Contact Cards & Info -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="reveal-on-scroll space-y-3">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-950 tracking-tight">
                            Direct Contact Information
                        </h2>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            Our team is based in Bhopal, India, serving ambitious clients globally. We typically respond to new project inquiries within one business day.
                        </p>
                    </div>

                    <!-- Direct Info Cards -->
                    <div class="space-y-4">
                        <!-- Phone Card -->
                        <div class="group reveal-on-scroll p-5 rounded-md border border-slate-200/90 bg-white shadow-sm hover:shadow-lg hover:border-brand-300 hover:-translate-y-1 transition-all duration-300 flex items-start gap-4" data-reveal-delay="100">
                            <div class="w-10 h-10 rounded-md bg-brand-50 text-brand-600 flex items-center justify-center shrink-0 transition-transform duration-300 group-hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <div class="text-xs font-mono uppercase tracking-wider text-slate-400 font-semibold">Phone / WhatsApp</div>
                                <a href="tel:{{ str_replace(' ', '', $phone) }}" class="text-base font-bold text-slate-900 hover:text-brand-600 transition-colors block mt-0.5">
                                    {{ $phone }}
                                </a>
                                <div class="mt-1">
                                    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 inline-flex items-center gap-1 hover:gap-1.5 transition-all">
                                        <span>Chat on WhatsApp</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Email Card -->
                        <div class="group reveal-on-scroll p-5 rounded-md border border-slate-200/90 bg-white shadow-sm hover:shadow-lg hover:border-brand-300 hover:-translate-y-1 transition-all duration-300 flex items-start gap-4" data-reveal-delay="150">
                            <div class="w-10 h-10 rounded-md bg-brand-50 text-brand-600 flex items-center justify-center shrink-0 transition-transform duration-300 group-hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <div class="text-xs font-mono uppercase tracking-wider text-slate-400 font-semibold">Email Us</div>
                                <a href="mailto:{{ $email }}" class="text-base font-bold text-slate-900 hover:text-brand-600 transition-colors block mt-0.5 break-all">
                                    {{ $email }}
                                </a>
                                <span class="text-xs text-slate-500">For proposals & RFP submissions</span>
                            </div>
                        </div>

                        <!-- Office Location Card -->
                        <div class="group reveal-on-scroll p-5 rounded-md border border-slate-200/90 bg-white shadow-sm hover:shadow-lg hover:border-brand-300 hover:-translate-y-1 transition-all duration-300 flex items-start gap-4" data-reveal-delay="200">
                            <div class="w-10 h-10 rounded-md bg-brand-50 text-brand-600 flex items-center justify-center shrink-0 transition-transform duration-300 group-hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <div class="text-xs font-mono uppercase tracking-wider text-slate-400 font-semibold">Office Address</div>
                                <p class="text-xs text-slate-700 leading-relaxed mt-1">
                                    {{ $address }}
                                </p>
                                <div class="mt-2">
                                    <a href="{{ $mapsUrl }}" target="_blank" rel="noopener noreferrer" class="text-xs font-semibold text-brand-600 hover:text-brand-700 inline-flex items-center gap-1 hover:gap-1.5 transition-all">
                                        <span>Open in Google Maps</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Operating Hours -->
                        <div class="group reveal-on-scroll p-5 rounded-md border border-slate-200/90 bg-white shadow-sm hover:shadow-lg hover:border-brand-300 hover:-translate-y-1 transition-all duration-300 flex items-start gap-4" data-reveal-delay="250">
                            <div class="w-10 h-10 rounded-md bg-brand-50 text-brand-600 flex items-center justify-center shrink-0 transition-transform duration-300 group-hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <div class="text-xs font-mono uppercase tracking-wider text-slate-400 font-semibold">Business Hours</div>
                                <div class="text-sm font-semibold text-slate-800 mt-0.5">{{ $hours }}</div>
                                <span class="text-xs text-slate-500">Emergency DevOps on-call 24/7 for managed clients</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Interactive Contact Form -->
                <div class="lg:col-span-7 reveal-on-scroll" data-reveal-delay="150">
                    <div class="rounded-md border border-slate-200/90 bg-white p-8 sm:p-10 shadow-xl space-y-6">
                        <div>
                            <h3 class="text-2xl font-bold text-slate-950 tracking-tight">
                                Project Inquiry Form
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                                Tell us about your project requirements and goals. All inquiries are strictly protected under confidentiality.
                            </p>
                        </div>

                        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                            @csrf

                            <!-- Honeypot spam protection field (must remain empty) -->
                            <div class="hidden" aria-hidden="true">
                                <label for="website_url">Leave this field blank</label>
                                <input type="text" name="website_url" id="website_url" tabindex="-1" autocomplete="off">
                            </div>

                            <!-- Name & Email Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="name" class="block text-xs font-semibold text-slate-800 mb-1.5">
                                        Your Full Name <span class="text-rose-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        id="name" 
                                        value="{{ old('name') }}" 
                                        required 
                                        placeholder="John Doe"
                                        class="w-full px-4 py-3 rounded-md border {{ $errors->has('name') ? 'border-rose-400 bg-rose-50/20' : 'border-slate-300 bg-white' }} text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 shadow-xs transition-all focus:shadow-sm"
                                    >
                                    @error('name')
                                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-xs font-semibold text-slate-800 mb-1.5">
                                        Work Email Address <span class="text-rose-500">*</span>
                                    </label>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        id="email" 
                                        value="{{ old('email') }}" 
                                        required 
                                        placeholder="john@company.com"
                                        class="w-full px-4 py-3 rounded-md border {{ $errors->has('email') ? 'border-rose-400 bg-rose-50/20' : 'border-slate-300 bg-white' }} text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 shadow-xs transition-all focus:shadow-sm"
                                    >
                                    @error('email')
                                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone & Company Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="phone" class="block text-xs font-semibold text-slate-800 mb-1.5">
                                        Phone Number <span class="text-slate-400 font-normal">(Optional)</span>
                                    </label>
                                    <input 
                                        type="tel" 
                                        name="phone" 
                                        id="phone" 
                                        value="{{ old('phone') }}" 
                                        placeholder="+1 (555) 000-0000"
                                        class="w-full px-4 py-3 rounded-md border {{ $errors->has('phone') ? 'border-rose-400 bg-rose-50/20' : 'border-slate-300 bg-white' }} text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 shadow-xs transition-all focus:shadow-sm"
                                    >
                                    @error('phone')
                                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="company" class="block text-xs font-semibold text-slate-800 mb-1.5">
                                        Company / Organization <span class="text-slate-400 font-normal">(Optional)</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="company" 
                                        id="company" 
                                        value="{{ old('company') }}" 
                                        placeholder="Acme Technologies"
                                        class="w-full px-4 py-3 rounded-md border {{ $errors->has('company') ? 'border-rose-400 bg-rose-50/20' : 'border-slate-300 bg-white' }} text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 shadow-xs transition-all focus:shadow-sm"
                                    >
                                    @error('company')
                                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Service & Budget Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="service" class="block text-xs font-semibold text-slate-800 mb-1.5">
                                        Service Interested In
                                    </label>
                                    <select 
                                        name="service" 
                                        id="service"
                                        class="w-full px-4 py-3 rounded-md border border-slate-300 bg-white text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 shadow-xs transition-all focus:shadow-sm"
                                    >
                                        <option value="">-- Select a Service --</option>
                                        @foreach ($services as $key => $srv)
                                            <option value="{{ $srv['title'] }}" {{ (old('service', $selectedService) === $key || old('service', $selectedService) === $srv['slug'] || old('service') === $srv['title']) ? 'selected' : '' }}>
                                                {{ $srv['title'] }}
                                            </option>
                                        @endforeach
                                        <option value="General Software Consulting" {{ old('service') === 'General Software Consulting' ? 'selected' : '' }}>General Software Consulting</option>
                                    </select>
                                    @error('service')
                                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="budget" class="block text-xs font-semibold text-slate-800 mb-1.5">
                                        Estimated Budget
                                    </label>
                                    <select 
                                        name="budget" 
                                        id="budget"
                                        class="w-full px-4 py-3 rounded-md border border-slate-300 bg-white text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 shadow-xs transition-all focus:shadow-sm"
                                    >
                                        <option value="">-- Select Budget Range --</option>
                                        <option value="Under $2,500" {{ old('budget') === 'Under $2,500' ? 'selected' : '' }}>Under $2,500</option>
                                        <option value="$2,500 - $5,000" {{ old('budget') === '$2,500 - $5,000' ? 'selected' : '' }}>$2,500 - $5,000</option>
                                        <option value="$5,000 - $15,000" {{ old('budget') === '$5,000 - $15,000' ? 'selected' : '' }}>$5,000 - $15,000</option>
                                        <option value="$15,000 - $50,000" {{ old('budget') === '$15,000 - $50,000' ? 'selected' : '' }}>$15,000 - $50,000</option>
                                        <option value="$50,000+" {{ old('budget') === '$50,000+' ? 'selected' : '' }}>$50,000+</option>
                                    </select>
                                    @error('budget')
                                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Message Area -->
                            <div>
                                <label for="message" class="block text-xs font-semibold text-slate-800 mb-1.5">
                                    Project Scope & Requirements <span class="text-rose-500">*</span>
                                </label>
                                <textarea 
                                    name="message" 
                                    id="message" 
                                    rows="5" 
                                    required 
                                    placeholder="Please describe your product concept, target timeline, technical requirements, or key problems you are looking to solve..."
                                    class="w-full px-4 py-3 rounded-md border {{ $errors->has('message') ? 'border-rose-400 bg-rose-50/20' : 'border-slate-300 bg-white' }} text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500/40 focus:border-brand-500 shadow-xs transition-all focus:shadow-sm"
                                >{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-2">
                                <button 
                                    type="submit" 
                                    class="group cta-shimmer w-full inline-flex items-center justify-center px-6 py-4 rounded-md text-base font-semibold text-white bg-brand-500 hover:bg-brand-600 shadow-md shadow-brand-500/25 hover:shadow-brand-500/35 active:scale-[0.98] transition-all hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2"
                                >
                                    <span>Send Project Inquiry</span>
                                    <svg class="w-5 h-5 ml-2 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </button>
                            </div>

                            <div class="text-center text-xs text-slate-400 pt-2">
                                We respect your privacy. No spam. You'll hear directly from our engineering team.
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </x-ui.container>
    </x-ui.section>
</x-layouts.app>
