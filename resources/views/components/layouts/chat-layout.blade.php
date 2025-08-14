<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- 🧠 Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
    /* Scrollbar fine et élégante */
    .scrollbar-custom::-webkit-scrollbar {
        width: 4px;
    }

    .scrollbar-custom::-webkit-scrollbar-track {
        background: #1f1f1f;
    }

    .scrollbar-custom::-webkit-scrollbar-thumb {
        background-color: #4B5563;
        border-radius: 8px;
        border: 1px solid #2d2d2d;
    }

    </style>

    <style>
    @keyframes slideIn {
      0% {
        transform: scaleX(0);
        transform-origin: left;
      }
      100% {
        transform: scaleX(1);
        transform-origin: left;
      }
    }

    .animate-slideIn {
      animation: slideIn 0.3s ease forwards;
    }
    </style>

    <style>
        .speech-bubble-right::before {
            content: "";
            position: absolute;
            border-left: 5px solid #16a34a; /* Vert foncé */
            border-right: 5px solid transparent;
            border-top: 5px solid #16a34a;
            border-bottom: 5px solid transparent;
            right: -10px;
            top: 0;
        }

        .speech-bubble-left::before {
            content: "";
            position: absolute;
            border-left: 5px solid transparent;
            border-right: 5px solid #374151; /* Gris foncé */
            border-top: 5px solid #374151;
            border-bottom: 5px solid transparent;
            left: -10px;
            top: 0;
        }
    </style>

    <!-- ✅ Livewire styles -->
    @livewireStyles

    <!-- 🧯 Stop Livewire from loading Alpine -->
    <script>
        window.deferLoadingAlpine = true;
    </script>

    <!-- ⚙️ App CSS & JS (contient Alpine via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="min-h-screen">

        <!-- 🚀 Navigation -->
        <header class="bg-gray-900 text-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
                <!-- 🏠 Logo -->
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" />
                    </svg>
                    <span class="font-bold text-lg text-green-400">{{ config('app.name', 'Laravel') }}</span>
                </div>

                <!-- 🔔 Notifications + Menu -->
                <div class="flex items-center space-x-4">
                    <!-- Livewire Notification Component -->
                    <livewire:chat.notification-invitations />

                    <!-- Menu Utilisateur -->
                    <div class="hidden md:flex items-center space-x-2">
                        <a href="#" class="text-sm text-gray-300 hover:text-green-400">Profil</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();"
                               class="text-sm text-red-400 hover:text-red-300">Déconnexion</a>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- 🧾 Contenu -->
        <main class="py-6">
            {{ $slot }}
        </main>

    </div>

    <!-- ✅ Livewire scripts (sans Alpine) -->
    @livewireScripts
</body>
</html>
