<div class="p-4 bg-gray-800 text-white rounded space-y-4">
    <!-- 🔍 Barre de recherche -->
    <input
        type="text"
        wire:model.live="search"
        placeholder="🔍 Rechercher un ami..."
        class="w-full px-4 py-2 rounded bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring focus:ring-blue-400"
    />

    @forelse($friends as $friend)
        <div
            class="relative flex items-center justify-between bg-gray-700 p-3 rounded shadow hover:bg-gray-600 cursor-pointer group"
            wire:click="selectFriend({{ $friend->id }})"
        >
            <div class="flex items-center space-x-3">
                {{-- 🖼️ Avatar --}}
                @if($friend->photo)
                    <img src="{{ asset('storage/' . $friend->photo) }}" alt="{{ $friend->name }}"
                         class="w-10 h-10 rounded-full border border-gray-600 object-cover">
                @else
                    <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center text-sm font-semibold text-white">
                        {{ strtoupper(substr($friend->name, 0, 1)) }}
                    </div>
                @endif

                {{-- 📩 Infos utilisateur --}}
                <div class="flex flex-col">
                    <p class="font-bold text-white">{{ $friend->name }}</p>

                    @php
                        $last = $friend->last_message;
                        $isSender = $last && $last->from_id === auth()->id();
                    @endphp

                    @if($last)
                        <div class="flex items-center gap-1 text-sm text-gray-400">
                            {{-- ✔ Statut --}}
                            @if($isSender)
                                @if($last->read_at)
                                    <span class="text-blue-400">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                        <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0"/>
                                        <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"/>
                                      </svg>
                                    </span>
                                @elseif($friend->unread_count > 0)
                                    <span class="text-gray-400">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                        <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0"/>
                                        <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"/>
                                      </svg>
                                    </span>
                                @else
                                    <span class="text-gray-400">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
                                      </svg>
                                    </span>
                                @endif
                            @endif

                            <span class="truncate max-w-[160px]">
                                {{ Str::limit($last->content, 40) }}
                            </span>
                        </div>
                    @else
                        <p class="text-sm text-gray-400 italic">Aucune conversation</p>
                    @endif
                </div>
            </div>

            {{-- 🔴 Badge des messages non lus --}}
            <div class="flex flex-col items-end space-y-1">
                @if($friend->unread_count > 0)
                    <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold bg-red-600 text-white rounded-full">
                        {{ $friend->unread_count }}
                    </span>
                @endif

                {{-- ⋮ Menu dropdown au survol --}}
                <div
                    x-data="{ open: false }"
                    x-on:mouseenter="open = true"
                    x-on:mouseleave="open = false"
                    class="relative"
                >
                    <button class="text-gray-400 hover:text-white focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 6v.01M12 12v.01M12 18v.01"/>
                        </svg>
                    </button>

                    <div
                        x-show="open"
                        x-transition
                        class="absolute top-6 right-0 z-10 bg-gray-700 text-white rounded shadow-lg py-1 w-40"
                        style="display: none;"
                    >
                        <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-600">📄 Voir profil</a>
                        <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-600">📨 Archiver</a>
                        <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-600 text-red-400">❌ Supprimer</a>
                    </div>
                </div>

                {{-- ⏱️ Date du dernier message juste en dessous --}}
                @if($last)
                    <span class="text-xs text-gray-400">
                        {{ $last->created_at->diffForHumans(null, true) }}
                    </span>
                @endif
            </div>
        </div>
    @empty
        <p class="text-gray-400 italic">Aucun ami trouvé.</p>
    @endforelse
</div>
