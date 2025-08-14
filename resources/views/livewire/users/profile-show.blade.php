<div class="max-w-3xl mx-auto bg-[#1B1C17] text-[#D7D2B7] rounded-lg shadow-lg p-8 border border-[#444A27] mt-10">

    {{-- En-tête --}}
    <div class="flex items-center space-x-6 mb-6">
        <img src="{{ $user->avatar ?? 'https://via.placeholder.com/150' }}"
             alt="Photo militaire de {{ $user->name }}"
             class="w-36 h-36 rounded-full border-4 border-[#6B7046] object-cover shadow-md">

        <div>
            <h1 class="text-4xl font-extrabold uppercase tracking-wide text-[#B9B48A]">{{ $user->name }}</h1>
            <p class="text-[#8A8B55] uppercase font-semibold mt-1">{{ $user->grade ?? 'Grade Inconnu' }}</p>
            <p class="text-[#A3A375] italic mt-2 max-w-md">{{ $user->role ?? 'Militaire engagé' }}</p>
        </div>
    </div>

    {{-- Informations personnelles --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-lg">
        <div>
            <h2 class="font-semibold text-[#8A8B55] mb-2 border-b border-[#6B7046] pb-1">Informations personnelles</h2>
            <ul class="space-y-1 text-[#C4C1A4]">
                <li><strong>Nom complet :</strong> {{ $user->name }}</li>
                <li><strong>Nom d'utilisateur :</strong> {{ $user->username }}</li>
                <li><strong>Email :</strong> {{ $user->email }}</li>
                <li><strong>Date de naissance :</strong> {{ $user->birthdate ?? 'Non renseignée' }}</li>
                <li><strong>Téléphone :</strong> {{ $user->phone ?? 'Non renseigné' }}</li>
                <li><strong>Adresse :</strong> {{ $user->address ?? 'Non renseignée' }}</li>
                <li><strong>Genre :</strong> {{ ucfirst($user->gender ?? 'Non renseigné') }}</li>
                <li><strong>Matricule :</strong> {{ $user->matricule ?? '---' }}</li>
            </ul>
        </div>

        {{-- Détails de service --}}
        <div>
            <h2 class="font-semibold text-[#8A8B55] mb-2 border-b border-[#6B7046] pb-1">Détails de service</h2>
            <ul class="space-y-1 text-[#C4C1A4]">
                <li><strong>Grade :</strong> {{ $user->grade ?? 'Inconnu' }}</li>
                <li><strong>Rôle :</strong> {{ $user->role ?? 'Non spécifié' }}</li>
                <li><strong>Statut :</strong>
                    @if($user->is_active)
                        <span class="text-green-400 font-semibold">Actif</span>
                    @else
                        <span class="text-red-500 font-semibold">Inactif</span>
                    @endif
                </li>
            </ul>
        </div>
    </div>


    {{-- Invitation --}}
    @auth
        @if(auth()->id() !== $user->id)
            <div class="mt-6">
                @if(auth()->user()->hasSentRequestTo($user->id))
                    <button disabled class="bg-yellow-500 text-white px-4 py-2 rounded cursor-not-allowed">
                        Invitation envoyée ⏳
                    </button>
                @elseif(auth()->user()->isFriendWith($user->id))
                    <button disabled class="bg-green-600 text-white px-4 py-2 rounded cursor-not-allowed">
                        Vous êtes amis ✅
                    </button>
                @else
                    <button
                        wire:click="sendRequest({{ $user->id }})"
                        class="bg-[#6B7046] hover:bg-lime-500 hover:text-[#6B7046] text-white px-4 py-2 rounded"
                    >
                        ➕ Inviter en ami
                    </button>
                @endif
            </div>
        @endif
    @endauth


        {{-- Citation --}}
        <blockquote class="mt-8 italic text-[#A3A375] border-l-4 border-[#6B7046] pl-4 max-w-2xl">
            "{{ $user->motto ?? 'La discipline forge le soldat, la loyauté forge l’homme.' }}"
        </blockquote>

</div>
