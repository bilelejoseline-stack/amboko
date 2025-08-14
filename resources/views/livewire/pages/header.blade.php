<header class="bg-[#1e293b] shadow-md sticky top-0 z-50" x-data="{ open: false, openUser: false }">
    <div class="max-w-7xl mx-auto px-4 md:px-8 py-4 flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo-fardc.png') }}" alt="Logo FARDC" class="h-10 w-auto">
            <h1 class="text-2xl font-bold text-yellow-400">FARDC</h1>
        </div>

        <!-- Bouton menu mobile -->
        <button @click="open = !open" class="md:hidden text-yellow-400 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Navigation desktop -->
        <nav class="hidden md:flex items-center space-x-6">
            <a href="/" class="hover:text-yellow-500 transition">Accueil</a>
            <a href="#" class="hover:text-yellow-500 transition">Mission</a>
            <a href="#" class="hover:text-yellow-500 transition">Galerie</a>
            <a href="#" class="hover:text-yellow-500 transition">Contact</a>

            <!-- Recherche avec suggestions -->
            <div class="capitalize ">
                <livewire:militaire.search-militaires />
            </div>

            @auth
            <!-- Notifications -->
            <div class="flex items-center space-x-4">
                <div class="relative" x-data="{ open: false }">
                    <!-- Icône cliquable -->
                    <button @click="open = !open" class="text-yellow-400 hover:text-yellow-500 transition relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 11.5a8.38 8.38 0 01-.9 3.8L21 21l-5.7-1.6a8.5 8.5 0 111.7-10.6" />
                        </svg>
                        <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">
                            {{ $messageCount ?? 3 }}
                        </span>
                    </button>

                    <!-- Menu déroulant -->
                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute right-0 mt-2 w-64 bg-gray-800 text-white rounded-lg shadow-lg z-50">
                        <div class="p-3 border-b border-gray-700 font-semibold">
                            Messages
                        </div>

                        @if (!empty($messages) && count($messages) > 0)
                        <ul>
                            @foreach ($messages as $message)
                            <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer">
                                <div class="font-bold text-sm">{{ $message->sender_name }}</div>
                                <div class="text-xs text-gray-400 truncate">{{ $message->content }}</div>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <div class="px-4 py-3 text-gray-400 text-sm">
                            Aucun message.
                        </div>
                        @endif

                        <div class="border-t border-gray-700">
                            <a href="{{ route('chat.index') }}"
                                class="block px-4 py-2 text-center text-blue-400 hover:underline">
                                Voir tous les messages
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Amis -->
                <div class="relative" x-data="{ open: false }">
                    <!-- Icône cliquable -->
                    <button @click="open = !open" class="text-yellow-400 hover:text-yellow-500 transition relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1
                     m3-4a4 4 0 100-8 4 4 0 000 8zm6 4a4 4 0 100-8 4 4 0 000 8z" />
                        </svg>
                        <span
                            class="absolute -top-2 -right-2 bg-yellow-400 text-black text-xs w-5 h-5 flex items-center justify-center rounded-full">
                            {{ $friendCount ?? 5 }}
                        </span>
                    </button>

                    <!-- Menu déroulant -->
                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute right-0 mt-2 w-64 bg-gray-800 text-white rounded-lg shadow-lg z-50">
                        <div class="p-3 border-b border-gray-700 font-semibold">
                            Amis
                        </div>

                        @if (!empty($friends) && count($friends) > 0)
                        <ul>
                            @foreach ($friends as $friend)
                            <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer flex items-center gap-2">
                                <img src="{{ $friend->avatar_url ?? 'https://via.placeholder.com/40' }}"
                                    alt="{{ $friend->name }}" class="w-8 h-8 rounded-full">
                                <span class="truncate">{{ $friend->name }}</span>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <div class="px-4 py-3 text-gray-400 text-sm">
                            Aucun ami trouvé.
                        </div>
                        @endif

                        <div class="border-t border-gray-700">
                            <a href="{{ route('friends.index') }}"
                                class="block px-4 py-2 text-center text-blue-400 hover:underline">
                                Voir tous les amis
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Utilisateur -->
            <div class="relative" x-data="{ openUser: false }">
                <button @click="openUser = !openUser"
                    class="flex items-center space-x-2 text-yellow-400 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                    </svg>
                    <span class="hidden md:inline">{{ auth()->user()->name }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" :class="{ 'rotate-180': openUser }"
                        class="h-4 w-4 transition-transform duration-300" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="openUser" x-transition
                    class="absolute right-0 mt-2 w-48 bg-[#1e293b] rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50">
                    <a href="{{ route('dashboard') }}"
                        class="block px-4 py-2 text-sm text-yellow-400 hover:bg-yellow-600 hover:text-white transition">Tableau
                        de bord</a>
                    <a href="{{ route('profile.show', auth()->user()) }}"
                        class="block px-4 py-2 text-sm text-yellow-400 hover:bg-yellow-600 hover:text-white transition">Profil</a>
                    @auth
                    @if (auth()->user()->role === 'admin' || auth()->user()->role === 'super_admin')
                    <a href="{{ route('mil.list') }}"
                        class="block px-4 py-2 text-sm text-yellow-400 hover:bg-yellow-600 hover:text-white transition">Mil</a>
                    <a href="{{ route('mil.retraite') }}"
                        class="block px-4 py-2 text-sm text-yellow-400 hover:bg-yellow-600 hover:text-white transition">Mil
                        Retraités</a>
                    <a href="{{ route('mil.decede') }}"
                        class="block px-4 py-2 text-sm text-yellow-400 hover:bg-yellow-600 hover:text-white transition">Mil
                        DCD</a>
                    <a href="{{ route('documents.index') }}"
                        class="block px-4 py-2 text-sm text-yellow-400 hover:bg-yellow-600 hover:text-white transition">Document</a>
                    @endif
                    @endauth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-red-600 hover:text-white transition">Déconnexion</button>
                    </form>
                </div>
            </div>
            @else
            <a href="{{ route('login') }}" class="text-sm text-gray-200 hover:text-yellow-400 transition">Connexion</a>
            <a href="{{ route('register') }}"
                class="ml-2 text-sm bg-yellow-500 hover:bg-yellow-600 text-black font-bold px-4 py-2 rounded-xl transition-all">Inscription</a>
            @endauth
        </nav>
    </div>

    <!-- Menu mobile -->
    <div x-show="open" x-transition
        class="md:hidden px-4 py-4 border-t border-gray-700 space-y-2 bg-[#1e293b] max-w-md mx-auto">
        <a href="/" class="block text-white hover:text-yellow-400">Accueil</a>
        <a href="#missions" class="block text-white hover:text-yellow-400">Mission</a>
        <a href="#galerie" class="block text-white hover:text-yellow-400">Galerie</a>
        <a href="#contact" class="block text-white hover:text-yellow-400">Contact</a>

        @auth
        <!-- Icônes Mobile -->
        <div class="flex space-x-4 mt-2">
            <a href="#" class="relative text-yellow-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 11.5a8.38 8.38 0 01-.9 3.8L21 21l-5.7-1.6a8.5 8.5 0 111.7-10.6" />
                </svg>
                <span
                    class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">
                    {{ $messageCount ?? 3 }}
                </span>
            </a>
            <a href="#" class="relative text-yellow-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m3-4a4 4 0 100-8 4 4 0 000 8zm6 4a4 4 0 100-8 4 4 0 000 8z" />
                </svg>
                <span
                    class="absolute -top-1 -right-1 bg-yellow-500 text-black text-xs w-5 h-5 flex items-center justify-center rounded-full">
                    {{ $friendCount ?? 5 }}
                </span>
            </a>
        </div>

        <a href="{{ route('dashboard') }}" class="block text-yellow-400 hover:text-yellow-600">Tableau de bord</a>
        <a href="{{ route('profile.show', auth()->user()) }}"
            class="block text-yellow-400 hover:text-yellow-600">Profil</a>
        @auth
        @if (auth()->user()->role === 'admin' || auth()->user()->role === 'super_admin')
        <a href="{{ route('mil.list') }}"
            class="block px-4 py-2 text-sm text-yellow-400 hover:bg-yellow-600 hover:text-white transition">Mil</a>
        <a href="{{ route('mil.retraite') }}"
            class="block px-4 py-2 text-sm text-yellow-400 hover:bg-yellow-600 hover:text-white transition">Mil
            Retraités</a>
        <a href="{{ route('mil.decede') }}"
            class="block px-4 py-2 text-sm text-yellow-400 hover:bg-yellow-600 hover:text-white transition">Mil DCD</a>
        <a href="{{ route('documents.index') }}"
            class="block px-4 py-2 text-sm text-yellow-400 hover:bg-yellow-600 hover:text-white transition">Document</a>
        @endif
        @endauth
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block w-full text-left text-red-400 hover:text-red-600">Déconnexion</button>
        </form>
        @else
        <a href="{{ route('login') }}" class="block text-gray-200 hover:text-yellow-400">Connexion</a>
        <a href="{{ route('register') }}"
            class="block text-black bg-yellow-400 hover:bg-yellow-600 px-3 py-2 rounded-xl font-bold text-center">Inscription</a>
        @endauth
    </div>
</header>