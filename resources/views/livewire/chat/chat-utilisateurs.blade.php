<div class="p-4 space-y-5 bg-[#1E211B] text-[#E2E8CE] rounded-2xl shadow-xl overflow-y-auto h-full scrollbar-custom">

    <!-- 🔍 Barre de recherche -->
    <input
        type="text"
        wire:model.live="search"
        placeholder="🔍 Rechercher un utilisateur..."
        class="w-full px-4 py-2 rounded-md bg-[#2B2D25] border border-[#4A4F38] text-[#E2E8CE] placeholder-[#90987A] focus:outline-none focus:ring-2 focus:ring-[#A9BA7D] transition"
    >

    <!-- ✅ Message flash -->
    @if(session()->has('message'))
        <div class="p-3 rounded-md bg-[#2D3B2C] text-green-400 text-sm shadow-inner border border-green-500/30">
            {{ session('message') }}
        </div>
    @endif

    <!-- 👥 Liste des utilisateurs -->
    @forelse($users as $user)
        <div class="flex items-center justify-between px-4 py-3 bg-[#252820] border border-[#373C2A] rounded-lg hover:bg-[#2C2F27] transition-all">

            <!-- 📸 Photo -->
            <div class="flex-shrink-0 mr-4">
                @if($user->photo)
                    <img src="{{ $user->photo }}" alt="Photo de {{ $user->name }}" class="w-12 h-12 rounded-full object-cover border border-gray-600" />
                @else
                    <div class="w-12 h-12 rounded-full bg-gray-700 flex items-center justify-center text-gray-400 font-semibold">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
            </div>

            <!-- 📄 Infos utilisateur -->
            <div class="flex-1 min-w-0">
                <div class="text-lg font-semibold text-[#F5F0E1] truncate">{{ $user->name }}</div>
                <div class="text-sm text-[#A9BA7D] truncate">{{ $user->email }}</div>
            </div>

            <!-- 🛡️ Statut d'amitié -->
            @php
                $existing = \App\Models\Friendship::where('sender_id', auth()->id())
                            ->where('receiver_id', $user->id)->first();
            @endphp

            @if(!$existing)
                <button
                    wire:click="sendInvitation({{ $user->id }})"
                    class="px-4 py-1.5 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition"
                >
                    ➕ Ajouter
                </button>
            @elseif($existing->status === 'pending')
                <span class="text-sm px-2 py-1 rounded bg-yellow-600/10 text-yellow-400 border border-yellow-500/30">
                    ⏳ En attente
                </span>
            @elseif($existing->status === 'accepted')
                <span class="text-sm px-2 py-1 rounded bg-green-600/10 text-green-400 border border-green-500/30">
                    ✅ Ami
                </span>
            @endif

        </div>
    @empty
        <p class="text-center text-[#80866B] italic">Aucun utilisateur trouvé pour le moment.</p>
    @endforelse
</div>
