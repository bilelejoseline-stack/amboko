<x-layouts.auth>
    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-12 relative bg-cover bg-center"
         style="background-image: url('{{ asset('images/bg-auth.webp') }}'); background-color: #0f172a;">

        <!-- Overlay noir semi-transparent -->
        <div class="absolute inset-0 bg-black opacity-60 z-0"></div>

        <!-- Logo FARDC -->
        <div class="mb-8 rounded-full border-2 border-yellow-500 bg-white p-2 shadow-lg relative z-10">
            <img src="{{ asset('images/logo-fardc.png') }}" alt="Logo FARDC"
                 class="h-24 w-auto rounded-full"
                 style="filter: brightness(1.2) contrast(1.3);">
        </div>

        <!-- Contenu au-dessus de l'overlay -->
        <div class="relative z-10 flex flex-col items-center w-full max-w-md p-8 bg-gray-900 bg-opacity-80 rounded-xl shadow-2xl border border-gray-700 animate-fade-in">

            <h2 class="text-3xl font-bold text-center text-white mb-6">FARDC</h2>

            @if (session('status'))
                <div class="mb-4 text-sm font-medium text-green-400 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Formulaire avec Alpine.js -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6 w-full"
                  x-data="{ loading: false }"
                  @submit="if ($el.checkValidity()) loading = true">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Adresse e-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mot de passe -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Mot de passe</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Souvenir & mot de passe oublié -->
                <div class="flex items-center justify-between">
                    <label for="remember" class="flex items-center text-sm text-gray-400">
                        <input type="checkbox" name="remember" id="remember" class="mr-2 rounded border-gray-600 bg-gray-700 text-indigo-500 focus:ring-indigo-500">
                        Se souvenir de moi
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-400 hover:underline">
                        Mot de passe oublié ?
                    </a>
                </div>

                <!-- Bouton Connexion avec spinner -->
                <div>
                    <button type="submit"
                        class="w-full flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow disabled:opacity-50 disabled:cursor-not-allowed"
                        :disabled="loading">
                        <span x-show="!loading">Connexion</span>
                        <span x-show="loading" class="flex items-center">
                            <svg class="animate-spin h-5 w-5 mr-2 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            Connexion...
                        </span>
                    </button>
                </div>
            </form>

            <!-- Lien vers l'inscription -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-300">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="text-indigo-400 hover:underline font-medium">
                        Créer un compte
                    </a>
                </p>
            </div>

        </div>
    </div>

</x-layouts.auth>
