<div class="max-w-4xl mx-auto p-6 bg-[#1B1C17] text-[#D7D2B7] rounded-lg shadow-lg">

    {{-- Recherche --}}
    <input type="text" wire:model.debounce.500ms="search"
           placeholder="🔍 Rechercher un utilisateur..."
           class="w-full px-4 py-2 mb-6 rounded border border-[#444A27] bg-[#2A2C22] text-[#D7D2B7] focus:outline-none focus:ring-2 focus:ring-green-400" />

    {{-- Utilisateurs à inviter --}}
    <h2 class="text-xl font-bold mb-3 text-green-400">👥 Utilisateurs à inviter</h2>

    @if($users->isEmpty())
        <p class="italic text-gray-400 mb-4">Aucun utilisateur à inviter.</p>
    @else
        <ul class="space-y-3 mb-6">
            @foreach($users as $user)
                <li class="flex justify-between items-center bg-[#2A2C22] p-3 rounded">
                    <div>
                        <p class="font-semibold">{{ $user->name }}</p>
                        <p class="text-sm text-gray-400">{{ $user->email }}</p>
                    </div>
                    <button wire:click="sendRequest({{ $user->id }})"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                        ➕ Inviter
                    </button>
                </li>
            @endforeach
        </ul>
    @endif

    {{-- Invitations envoyées --}}
    <h2 class="text-xl font-bold mb-3 text-yellow-400">📩 Invitations envoyées</h2>
    @if($pendingRequests->isEmpty())
        <p class="italic text-gray-400 mb-4">Aucune invitation en attente.</p>
    @else
        <ul class="space-y-3 mb-6">
            @foreach($pendingRequests as $request)
                <li class="flex justify-between items-center bg-[#2A2C22] p-3 rounded">
                    <div>
                        <p class="font-semibold">{{ $request->receiver->name }}</p>
                        <p class="text-sm text-gray-400">{{ $request->receiver->email }}</p>
                    </div>
                    <button wire:click="removeFriend({{ $request->receiver->id }})"
                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                        ❌ Annuler
                    </button>
                </li>
            @endforeach
        </ul>
    @endif

    {{-- Invitations reçues --}}
    <h2 class="text-xl font-bold mb-3 text-green-400">📨 Invitations reçues</h2>
    @if($receivedRequests->isEmpty())
        <p class="italic text-gray-400 mb-4">Aucune invitation reçue.</p>
    @else
        <ul class="space-y-3 mb-6">
            @foreach($receivedRequests as $request)
                <li class="flex justify-between items-center bg-[#2A2C22] p-3 rounded">
                    <div>
                        <p class="font-semibold">{{ $request->sender->name }}</p>
                        <p class="text-sm text-gray-400">{{ $request->sender->email }}</p>
                    </div>
                    <div class="space-x-2">
                        <button wire:click="acceptRequest({{ $request->id }})"
                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                            ✅ Accepter
                        </button>
                        <button wire:click="rejectRequest({{ $request->id }})"
                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                            ❌ Refuser
                        </button>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    {{-- Liste des amis --}}
    <h2 class="text-xl font-bold mb-3 text-blue-400">🤝 Amis</h2>
    @if($friends->isEmpty())
        <p class="italic text-gray-400">Vous n'avez pas encore d'amis.</p>
    @else
        <ul class="space-y-3">
            @foreach($friends as $friend)
                <li class="flex justify-between items-center bg-[#2A2C22] p-3 rounded">
                    <div>
                        <p class="font-semibold">{{ $friend->name }}</p>
                        <p class="text-sm text-gray-400">{{ $friend->email }}</p>
                    </div>
                    <button wire:click="removeFriend({{ $friend->id }})"
                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                        👋 Supprimer
                    </button>
                </li>
            @endforeach
        </ul>
    @endif

</div>
