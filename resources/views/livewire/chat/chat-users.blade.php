<div class="p-4 bg-[#1E1E1E] rounded shadow-lg text-[#F0E6D2] transition-all">

    {{-- 🔍 Champ de recherche --}}
    <input
        type="text"
        wire:model.live="search"
        placeholder="🔎 Rechercher un utilisateur..."
        class="w-full px-3 py-2 mb-4 border border-gray-600 bg-gray-800 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
        aria-label="Rechercher un utilisateur"
    />

    {{-- 👥 Liste des utilisateurs filtrés --}}
    @forelse($users as $user)
        <div
            x-data="{ showMenu: false }"
            @mouseenter="showMenu = true"
            @mouseleave="showMenu = false"
            class="relative flex items-center justify-between bg-gray-800 p-3 mb-2 rounded-lg shadow-sm hover:bg-gray-700 transition"
        >
            <div class="flex items-center space-x-3">
                <img src="{{ $user->avatar_url }}"
                     alt="avatar de {{ $user->name }}"
                     class="w-10 h-10 rounded-full object-cover border border-gray-700" />
                <div>
                    <p class="text-sm font-semibold text-white">{{ $user->name }}</p>
                    <p class="text-xs text-gray-400">{{ '@' . $user->username }}</p>
                </div>
            </div>

            {{-- ⋮ Bouton menu --}}
            <div class="relative">
                <button @click="showMenu = !showMenu"
                        class="text-white hover:text-green-400 text-xl px-2 focus:outline-none">
                    ⋮
                </button>

                {{-- 📥 Menu contextuel --}}
                <div x-show="showMenu"
                     x-transition
                     @click.away="showMenu = false"
                     class="absolute right-0 mt-2 w-48 bg-gray-900 rounded shadow-lg border border-gray-700 z-50">

                    {{-- 🧑 Profil utilisateur --}}
                    <div class="flex items-center px-4 py-3 border-b border-gray-700">
                        <img src="{{ $user->profile_photo_url ?? 'https://via.placeholder.com/40' }}" alt="Avatar"
                             class="w-10 h-10 rounded-full mr-3 object-cover">
                        <div class="flex flex-col">
                            <span class="text-white font-semibold text-sm">{{ $user->name }}</span>
                            @if(!empty($user->bio))
                                <span class="text-gray-400 text-xs truncate max-w-[160px]">{{ $user->bio }}</span>
                            @endif
                            <a href="{{ route('profile.show', $user->id) }}"
                               class="text-blue-400 hover:underline text-xs mt-1">Voir profil</a>
                        </div>
                    </div>

                    @if(in_array($user->id, $pendingRequests))
                        {{-- ✅ Annuler l’invitation --}}
                        <button wire:click="cancelRequest({{ $user->id }})"
                                class="block w-full text-left text-sm text-red-400 hover:bg-gray-700 px-4 py-2">
                            ❌ Annuler
                        </button>
                    @else
                        {{-- 📩 Envoyer une invitation --}}
                        <button wire:click="sendRequest('{{ $user->id }}')"
                                class="block w-full text-left text-sm text-green-400 hover:bg-gray-700 px-4 py-2">
                            📩 Inviter
                        </button>
                    @endif

                    {{-- 🚫 Bloquer (optionnel) --}}
                    <button class="block w-full text-left text-sm text-yellow-400 hover:bg-gray-700 px-4 py-2">
                        🚫 Bloquer
                    </button>
                </div>

            </div>
        </div>
    @empty
        <p class="text-sm text-gray-400">Aucun utilisateur trouvé.</p>
    @endforelse
</div>
