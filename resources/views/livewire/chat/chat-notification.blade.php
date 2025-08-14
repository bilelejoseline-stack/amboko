<div x-data="{ open: false }" class="relative">
    <!-- 🔔 Icône cloche -->
    <button @click="open = !open" class="relative text-white focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-5-5.917V5a2 2 0 10-4 0v.083A6.002 6.002 0 004 11v3.159c0 .538-.214 1.055-.595 1.436L2 17h5m7 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>

        @if ($count > 0)
            <!-- 🔴 Badge de notifications -->
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1 py-0.5 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                {{ $count }}
            </span>
        @endif
    </button>

    <!-- 📥 Liste des notifications -->
    <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-2 w-72 bg-gray-800 border border-gray-700 rounded shadow-lg z-50">
        <div class="p-4">
            <h3 class="text-sm text-green-400 font-bold mb-2">Invitations reçues</h3>

            @forelse($requests as $request)
                <div class="bg-gray-700 p-2 rounded mb-2 text-sm flex justify-between items-center">
                    <div>
                        <p class="font-semibold">{{ $request->sender->name }}</p>
                        <p class="text-xs text-gray-300">{{ $request->sender->email }}</p>
                    </div>
                    <div class="flex gap-1">
                        <button wire:click="accept({{ $request->id }})" class="text-green-500 hover:underline">✔</button>
                        <button wire:click="decline({{ $request->id }})" class="text-red-500 hover:underline">✖</button>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 text-sm italic">Aucune invitation pour l’instant.</p>
            @endforelse
        </div>
    </div>
</div>
