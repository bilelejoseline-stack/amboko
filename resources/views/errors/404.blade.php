<x-layouts.auth>
<div class="bg-[#0f172a] text-white min-h-screen flex items-center justify-center p-4">
    <div class="text-center space-y-6">
        <img src="{{ asset('images/logo-fardc.png') }}" alt="Logo FARDC" class="mx-auto h-52 w-auto animate-pulse">

        <h1 class="text-6xl font-extrabold text-yellow-400 drop-shadow-lg" style="font-family: 'Anton', sans-serif;">
            404
        </h1>
        <p class="text-2xl font-semibold text-gray-300">
            Soldat, la page que tu cherches est introuvable.
        </p>
        <p class="text-gray-400 max-w-xl mx-auto">
            Comme dans une mission nocturne sans GPS, tu viens d’entrer dans une zone inconnue. Mais garde ton calme, et retourne au QG.
        </p>

        <a href="{{ route('home') }}"
           class="inline-block mt-6 px-6 py-3 bg-indigo-500 text-black font-bold rounded-xl hover:bg-yellow-600 transition-all shadow-lg">
            🏠 Retour à l’accueil
        </a>

        <div class="mt-10 text-sm text-gray-500 italic">
            <span>« L’obstacle sur la route devient la route. » — Marc Aurèle</span>
        </div>
    </div>
</div>
</x-layouts.auth>
