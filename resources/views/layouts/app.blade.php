<!doctype html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Maestro Ramcen | Santuario espiritual, ceremonias mayas y spa holístico en Yucatán')</title>
    <meta name="description" content="@yield('description', 'Vive una experiencia de transformación con Maestro Ramcen: ceremonias mayas, spa holístico, vapor, terapias, hipnosis y bienestar emocional en un santuario natural.')">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/') }}">

    <meta property="og:type" content="website">
    <meta property="og:title" content="Maestro Ramcen | Santuario espiritual premium">
    <meta property="og:description" content="Ceremonias mayas, sanación holística, reprogramación mental, spa, piscina y vapor para reconectar contigo.">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:image" content="{{ asset('images/ramcen/editorial/hero-maya-sanctuary-editorial.jpg') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Maestro Ramcen | Santuario espiritual premium">
    <meta name="twitter:description" content="Inicia un proceso de transformación interior en un santuario natural.">
    <meta name="twitter:image" content="{{ asset('images/ramcen/editorial/hero-maya-sanctuary-editorial.jpg') }}">

    @php
        $localBusinessSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => 'Maestro Ramcen',
            'image' => asset('images/ramcen/editorial/hero-maya-sanctuary-editorial.jpg'),
            'description' => 'Santuario espiritual con ceremonias mayas, spa holístico, vapor, terapias e hipnosis.',
            'telephone' => '+52 999 329 2148',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Komchén',
                'addressRegion' => 'Yucatán',
                'addressCountry' => 'MX',
            ],
            'sameAs' => ['https://www.facebook.com/MaestroRamcen/'],
            'openingHoursSpecification' => [[
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => 'Saturday',
                'opens' => '11:11',
                'closes' => '23:11',
            ]],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($localBusinessSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-ink text-warm antialiased">
    @yield('content')
</body>
</html>
