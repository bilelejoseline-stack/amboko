<div class="p-4 space-y-4 bg-gray-900 text-white rounded shadow-md max-w-md mx-auto">

    @if(session()->has('message'))
        <div class="p-2 bg-green-700 rounded text-green-200">
            {{ session('message') }}
        </div>
    @endif

    @if($invitations->isEmpty())
        <p class="text-gray-400 text-center italic">Aucune invitation en attente.</p>
    @else
        <ul class="space-y-3">
            @foreach($invitations as $invitation)
                <li class="flex items-center justify-between bg-gray-800 rounded px-4 py-3 shadow-inner hover:bg-gray-700 transition">

                    <div>
                        <span class="font-semibold text-blue-400">
                            {{ $invitation->sender->name ?? 'Utilisateur inconnu' }}
                        </span>
                        <span class="text-sm text-gray-400 ml-2">
                            souhaite devenir votre ami.
                        </span>
                    </div>

                    <div class="flex space-x-2">

                        <button
                            @click.stop
                            wire:click="accepterInvitation({{ $invitation->id }})"
                            class="bg-green-600 hover:bg-green-700 px-3 py-1 rounded text-sm font-semibold transition"
                        >
                            ✅ Accepter
                        </button>

                        <button
                            @click.stop
                            wire:click="refuserInvitation({{ $invitation->id }})"
                            class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-sm font-semibold transition"
                        >
                            ❌ Refuser
                        </button>

                    </div>
                </li>
            @endforeach
        </ul>
    @endif

</div>
