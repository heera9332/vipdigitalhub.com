<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Resend, Postmark, AWS, and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Agency Service Offerings
    |--------------------------------------------------------------------------
    */
    'offerings' => [
        'web-development' => [
            'title' => 'Web Development',
            'slug' => 'web-development',
            'short_description' => 'Fast, scalable, modern web applications built for business results.',
            'full_description' => 'End-to-end web engineering that combines responsive design, rock-solid security, high performance, and seamless user experiences.',
            'icon' => 'globe',
            'features' => ['Responsive Design', 'API Integration', 'Performance Tuning', 'SEO Optimization'],
            'cta' => 'Build Your Web App',
        ],
        'custom-software' => [
            'title' => 'Custom Software Development',
            'slug' => 'custom-software-development',
            'short_description' => 'Tailored software solutions solving complex operational challenges.',
            'full_description' => 'We engineer bespoke software platforms, ERPs, CRMs, and internal systems customized specifically to automate your business operations.',
            'icon' => 'code',
            'features' => ['Custom Architecture', 'Workflow Automation', 'Secure Infrastructure', 'Ongoing Support'],
            'cta' => 'Discuss Your Custom Software',
        ],
        'saas-development' => [
            'title' => 'SaaS Development',
            'slug' => 'saas-development',
            'short_description' => 'Multi-tenant, subscription-ready software products from idea to launch.',
            'full_description' => 'Architecting and launching subscription software products with multi-tenancy, Stripe billing, role permissions, and scalable databases.',
            'icon' => 'cloud',
            'features' => ['Multi-tenant Architecture', 'Subscription & Billing', 'User Access Controls', 'Scalable Cloud Ready'],
            'cta' => 'Launch Your SaaS',
        ],
        'laravel-development' => [
            'title' => 'Laravel Development',
            'slug' => 'laravel-development',
            'short_description' => 'High-performance Laravel applications following best practices.',
            'full_description' => 'Robust enterprise Laravel development with clean architecture, Eloquent optimization, queued jobs, automated tests, and RESTful APIs.',
            'icon' => 'layers',
            'features' => ['Clean Architecture', 'REST & GraphQL APIs', 'Queue & Worker Systems', 'Enterprise Security'],
            'cta' => 'Hire Laravel Experts',
        ],
        'nodejs-development' => [
            'title' => 'Node.js Development',
            'slug' => 'nodejs-development',
            'short_description' => 'High-throughput microservices, real-time engines, and REST APIs.',
            'full_description' => 'Asynchronous, event-driven Node.js backend services and WebSocket solutions capable of handling intensive workloads with minimal latency.',
            'icon' => 'cpu',
            'features' => ['Microservices', 'Real-time WebSockets', 'High-concurrency APIs', 'Database Optimization'],
            'cta' => 'Scale with Node.js',
        ],
        'react-development' => [
            'title' => 'React Development',
            'slug' => 'react-development',
            'short_description' => 'Interactive, responsive, and intuitive web interfaces.',
            'full_description' => 'Stateful single-page applications, component libraries, and modular user interfaces built with React best practices.',
            'icon' => 'component',
            'features' => ['State Management', 'Modular Components', 'Responsive UI', 'Interactive Dashboards'],
            'cta' => 'Build with React',
        ],
        'nextjs-development' => [
            'title' => 'Next.js Development',
            'slug' => 'nextjs-development',
            'short_description' => 'Blazing fast Server-Side Rendered (SSR) & static applications.',
            'full_description' => 'Enterprise SSR and hybrid Next.js web applications optimized for Core Web Vitals, organic search traffic, and lightning-speed loads.',
            'icon' => 'zap',
            'features' => ['SSR & SSG', 'Core Web Vitals Optimization', 'Server Actions', 'Full-stack Performance'],
            'cta' => 'Build with Next.js',
        ],
        'wordpress-development' => [
            'title' => 'WordPress Development',
            'slug' => 'wordpress-development',
            'short_description' => 'Custom WordPress themes, plugins, and lightning-fast editorial setups.',
            'full_description' => 'Bespoke WordPress theme and plugin development without bloated page builders, engineered for speed, security, and effortless publishing.',
            'icon' => 'layout',
            'features' => ['Custom Block Themes', 'Plugin Development', 'Headless WP Options', 'Security Hardening'],
            'cta' => 'Get Custom WordPress',
        ],
        'woocommerce-development' => [
            'title' => 'WooCommerce Development',
            'slug' => 'woocommerce-development',
            'short_description' => 'High-converting online stores built for scale and revenue growth.',
            'full_description' => 'End-to-end e-commerce solutions with payment gateway integrations, shipping rules, product filters, and high-conversion checkout flows.',
            'icon' => 'shopping-cart',
            'features' => ['Custom Checkout Flows', 'Payment Integrations', 'Speed Optimization', 'Inventory Sync'],
            'cta' => 'Scale Your Store',
        ],
        'mobile-app-development' => [
            'title' => 'Mobile App Development',
            'slug' => 'mobile-app-development',
            'short_description' => 'Native and cross-platform mobile apps for iOS and Android.',
            'full_description' => 'Engaging mobile applications with fluid animations, push notifications, offline support, and seamless backend API integrations.',
            'icon' => 'smartphone',
            'features' => ['iOS & Android', 'Offline Capabilities', 'Push Notifications', 'App Store Deployment'],
            'cta' => 'Develop Your App',
        ],
        'ui-ux-development' => [
            'title' => 'UI/UX Development',
            'slug' => 'ui-ux-development',
            'short_description' => 'Intuitive product wireframes, interactive prototypes, and design systems.',
            'full_description' => 'User-first research, visual interface design, and seamless interactive prototyping that converts visitors into loyal customers.',
            'icon' => 'palette',
            'features' => ['Design Systems', 'Figma Wireframing', 'User Research', 'Interactive Prototypes'],
            'cta' => 'Design Your Product',
        ],
        'seo' => [
            'title' => 'SEO (Search Engine Optimization)',
            'slug' => 'seo',
            'short_description' => 'Data-driven technical SEO, on-page optimization, and high search rankings.',
            'full_description' => 'Comprehensive search optimization including technical audits, schema markup, Core Web Vitals optimization, and keyword rank growth.',
            'icon' => 'trending-up',
            'features' => ['Technical Audits', 'Structured Data Schema', 'On-Page Optimization', 'Keyword Strategy'],
            'cta' => 'Grow Your Rankings',
        ],
        'digital-marketing' => [
            'title' => 'Digital Marketing',
            'slug' => 'digital-marketing',
            'short_description' => 'Growth strategies that amplify your brand reach and customer acquisition.',
            'full_description' => 'Omnichannel digital marketing campaigns combining content distribution, email funnels, search marketing, and social awareness.',
            'icon' => 'megaphone',
            'features' => ['Content Strategy', 'Funnel Marketing', 'Audience Growth', 'Analytics & Reporting'],
            'cta' => 'Supercharge Growth',
        ],
        'performance-marketing' => [
            'title' => 'Performance Marketing',
            'slug' => 'performance-marketing',
            'short_description' => 'High-ROI paid campaigns across Google Ads, Meta, and LinkedIn.',
            'full_description' => 'Precision PPC and paid social advertising optimized for low CPA, high return on ad spend (ROAS), and scalable lead generation.',
            'icon' => 'target',
            'features' => ['Google & Meta Ads', 'Conversion Tracking', 'A/B Testing', 'ROAS Optimization'],
            'cta' => 'Scale Paid Ads',
        ],
        'website-maintenance' => [
            'title' => 'Website Maintenance',
            'slug' => 'website-maintenance',
            'short_description' => 'Proactive updates, security patches, regular backups, and 24/7 uptime monitoring.',
            'full_description' => 'Continuous technical maintenance keeping your digital assets updated, securely backed up, shielded against vulnerabilities, and always fast.',
            'icon' => 'shield-check',
            'features' => ['24/7 Monitoring', 'Security Patches', 'Daily Backups', 'Emergency Support'],
            'cta' => 'Protect Your Site',
        ],
    ],

];
