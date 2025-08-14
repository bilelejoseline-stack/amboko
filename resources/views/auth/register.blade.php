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

        <!-- Formulaire -->
        <div class="relative z-10 flex flex-col items-center w-full max-w-md p-8 bg-gray-900 bg-opacity-80 rounded-xl shadow-2xl border border-gray-700 animate-fade-in">

            <h2 class="text-3xl font-bold text-center text-white mb-6">Créer un compte</h2>

            @if (session('status'))
                <div class="mb-4 text-sm font-medium text-green-400 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-6 w-full"
                  x-data="{ loading: false }"
                  @submit="if ($el.checkValidity()) loading = true">
                @csrf

                <!-- Nom -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nom complet</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Adresse e-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
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

                <!-- Confirmation mot de passe -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">Confirmer le mot de passe</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Bouton Register avec loading -->
                <div>
                    <button type="submit"
                        class="w-full flex items-center justify-center bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow disabled:opacity-50 disabled:cursor-not-allowed"
                        :disabled="loading">
                        <span x-show="!loading">Créer un compte</span>
                        <span x-show="loading" class="flex items-center">
                            <svg class="animate-spin h-5 w-5 mr-2 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            Création...
                        </span>
                    </button>
                </div>
            </form>

            <!-- Lien vers connexion -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-300">
                    Déjà un compte ?
                    <a href="{{ route('login') }}" class="text-indigo-400 hover:underline font-medium">
                        Se connecter
                    </a>
                </p>
            </div>

        </div>
    </div>

    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
</x-layouts.auth>
