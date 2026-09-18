@props([
    'title' => null,
    'description' => null,
    'image' => null,
    'type' => 'website',
])

@php
    $siteName = setting('site_name', config('agency.name', 'VIP Digital Hub'));
    $pageTitle = $title 
        ? "{$title} — {$siteName}" 
        : setting('default_meta_title', config('agency.default_seo.title', "{$siteName} — Software Development & Digital Marketing Agency"));
    $metaDescription = $description 
        ?? setting('default_meta_description', config('agency.default_seo.description', 'VIP Digital Hub is a technology and digital marketing agency offering custom software, web & mobile applications, and SEO.'));
    $ogImage = $image ?? asset('images/og-image.jpg');
    $currentUrl = url()->current();
@endphp

<title>{{ $pageTitle }}</title>
<meta name="description" content="{{ $metaDescription }}">
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ $currentUrl }}">

<!-- Open Graph -->
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:url" content="{{ $currentUrl }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:image" content="{{ $ogImage }}">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $pageTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
<meta name="twitter:image" content="{{ $ogImage }}">
