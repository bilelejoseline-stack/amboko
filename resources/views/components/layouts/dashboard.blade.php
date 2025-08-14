<!DOCTYPE html>
<html lang="fr"
      x-data
      x-init="$nextTick(() => ScrollReveal().reveal('[data-reveal]', { duration: 1000, distance: '40px', origin: 'bottom' }))"
      x-cloak>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FARDC - Authentification</title>

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Livewire Styles --}}
    @livewireStyles

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- SEO meta tags --}}
    <meta name="description" content="Site officiel des Forces Armées de la République Démocratique du Congo. Honneur, Discipline, Engagement.">
    <meta name="keywords" content="FARDC, Armée, RDC, Forces Armées, République Démocratique du Congo, Sécurité, Défense">
    <meta name="author" content="AJADACC">
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
      integrity="sha256-sA+e2kYsc+pWe+JfYwSEzsklZh0iV0UE1sjP7p/8hmw="
      crossorigin=""
    />

        {{-- Animation Tailwind (si tu veux) --}}
        <style>
            .animate-fade-in {
                animation: fadeIn 1s ease-out both;
            }

            @keyframes fadeIn {
                0% { opacity: 0; transform: translateY(20px); }
                100% { opacity: 1; transform: translateY(0); }
            }
        </style>

    {{-- Styles personnalisés --}}
    @stack('styles')


</head>

<body class="bg-[#0f172a] text-white font-sans antialiased flex flex-col min-h-screen">



    {{-- Contenu dynamique --}}
    <main class="flex-1">
        {{ $slot }}
    </main>




    {{-- Livewire Scripts --}}
    @livewireScripts

    {{-- Scripts personnalisés --}}
    @stack('scripts')
    
</body>
</html>
