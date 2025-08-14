<div class="min-h-screen flex items-center justify-center bg-gray-900 text-white px-4" x-data="{ show: false }" >
    <div id="checkpointBox" class="w-full max-w-md p-8 bg-gray-800 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center">🔐 Accès sécurisé</h1>

        <form wire:submit.prevent="checkCode" novalidate>
            <div class="relative mb-4">
                <label for="code" class="sr-only">Code d'accès</label>
                <input
                    id="code"
                    :type="show ? 'text' : 'password'"
                    wire:model.defer="code"
                    placeholder="Entrez votre code"
                    autofocus
                    class="w-full px-4 py-3 rounded bg-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                />
                <button type="button" @click="show = !show" class="absolute right-3 top-3 text-indigo-400 text-sm select-none" tabindex="-1">
                    <span x-text="show ? 'Cacher' : 'Voir'"></span>
                </button>
            </div>

            @error('code')
            <div class="mb-4 text-red-500 text-sm font-semibold">
                {{ $message }}
            </div>
            @enderror

            <button
                type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 py-3 rounded font-semibold transition"
            >
                Valider
            </button>
        </form>
    </div>
</div>
