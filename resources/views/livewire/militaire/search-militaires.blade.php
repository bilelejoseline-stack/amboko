<div class="relative hidden md:block w-[400px]" x-data="{ open: false }" @click.away="open = false">
    
    {{-- Champ de recherche --}}
    <input 
        type="text" 
        wire:model.live="search" 
        placeholder="Rechercher un militaire..."
        @focus="open = true"
        class="w-full px-4 py-2 rounded-md border border-gray-600 bg-gray-700 text-white
               focus:outline-none focus:ring-2 focus:ring-blue-500"
        aria-autocomplete="list"
        aria-expanded="open"
    />

    {{-- Suggestions --}}
    @if (!empty($suggestions) && count($suggestions) > 0)
        <div 
            class="absolute w-full mt-1 bg-[#1e293b] pb-6 text-white rounded-md shadow-lg z-50 max-h-64 overflow-y-auto scrollbar-hide"
            x-show="open"
        >
            @foreach ($suggestions as $militaire)
                <a href="{{ route('militaire.show', ['slug' => $militaire->slug]) }}"
                   class="flex items-center px-4 py-2 hover:bg-yellow-500 hover:text-black transition text-[16px]">
                    
                    {{-- Avatar --}}
                    @if ($militaire->avatar)
                        <img src="{{ asset('storage/' . $militaire->avatar) }}"
                            alt="Avatar de {{ $militaire->nom }}"
                            class="w-8 h-8 rounded-full object-cover mr-3">
                    @else
                        <div class="w-8 h-8 flex items-center justify-center rounded-full bg-yellow-500 text-black font-bold mr-3">
                            {{ strtoupper(mb_substr($militaire->nom, 0, 1)) }}
                        </div>
                    @endif

                    {{-- Infos du militaire --}}
                    <div>
                        <span class="font-semibold">
                            {{ $militaire->grade?->abreviation ?? '' }}
                        </span>
                        <span>
                            {{ $militaire->nom }} {{ $militaire->postnom }} {{ $militaire->prenom }}
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    @elseif(strlen($search) > 0)
        <div 
            class="absolute w-full mt-1 bg-[#1e293b] text-white rounded-md shadow-lg z-50"
            x-show="open"
        >
            <div class="px-4 py-2 text-gray-400">
                Aucun résultat trouvé
            </div>
        </div>
    @endif
</div>
