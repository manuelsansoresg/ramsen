<!doctype html>
<html lang="es" class="scroll-smooth">
<head>
    @php
        $pageTitle = trim($__env->yieldContent('title', 'Maestro Ramcen | Santuario espiritual, ceremonias mayas y spa holístico en Yucatán'));
        $pageDescription = trim($__env->yieldContent('description', 'Vive una experiencia de transformación con Maestro Ramcen: ceremonias mayas, spa holístico, vapor, terapias, hipnosis y bienestar emocional en un santuario natural.'));
        $pageCanonical = trim($__env->yieldContent('canonical', url()->current()));
        $pageImage = trim($__env->yieldContent('image', asset('images/ramcen/spa-holistico-maestro-ramcen.png')));
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ $pageCanonical }}">

    <meta property="og:type" content="website">
    <meta property="og:locale" content="es_MX">
    <meta property="og:site_name" content="Maestro Ramcen">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:url" content="{{ $pageCanonical }}">
    <meta property="og:image" content="{{ $pageImage }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ $pageImage }}">

    @php
        $localBusinessSchema = [
            '@context' => 'https://schema.org',
            '@type' => ['LocalBusiness', 'HealthAndBeautyBusiness'],
            'name' => 'Maestro Ramcen',
            'url' => url('/'),
            'image' => $pageImage,
            'description' => $pageDescription,
            'telephone' => '+52 999 329 2148',
            'priceRange' => '$$',
            'areaServed' => ['Mérida', 'Komchén', 'Yucatán'],
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Komchén',
                'addressRegion' => 'Yucatán',
                'addressCountry' => 'MX',
            ],
            'sameAs' => [
                'https://www.facebook.com/MaestroRamcen',
                'https://www.youtube.com/@MaestroRamcen',
            ],
            'openingHoursSpecification' => [[
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => 'Saturday',
                'opens' => '11:11',
                'closes' => '23:11',
            ]],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($localBusinessSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @stack('schema')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-ink text-warm antialiased">
    @yield('content')

    @stack('scripts')
</body>
</html>
