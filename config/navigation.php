<?php

return [
    'main' => [
        [
            'label' => 'Home',
            'route' => 'home',
            'url' => '/',
        ],
        [
            'label' => 'Services',
            'route' => 'services',
            'url' => '/services',
        ],
        [
            'label' => 'About Us',
            'route' => 'about',
            'url' => '/about-us',
        ],
        [
            'label' => 'Projects',
            'route' => 'projects',
            'url' => '/projects',
        ],
        [
            'label' => 'Posts',
            'route' => 'posts.index',
            'url' => '/posts',
        ],
        [
            'label' => 'Contact',
            'route' => 'contact',
            'url' => '/contact',
        ],
    ],
    'cta' => [
        'label' => 'Start a Project',
        'route' => 'contact',
        'url' => '/contact',
    ],
    'footer' => [
        'quick_links' => [
            ['label' => 'About Us', 'route' => 'about', 'url' => '/about-us'],
            ['label' => 'Our Services', 'route' => 'services', 'url' => '/services'],
            ['label' => 'Case Studies / Projects', 'route' => 'projects', 'url' => '/projects'],
            ['label' => 'Blog & Articles', 'route' => 'posts.index', 'url' => '/posts'],
            ['label' => 'Contact Us', 'route' => 'contact', 'url' => '/contact'],
        ],
        'legal' => [
            ['label' => 'Privacy Policy', 'route' => null, 'url' => '/privacy-policy'],
            ['label' => 'Terms of Service', 'route' => null, 'url' => '/terms-of-service'],
        ],
    ],
];
