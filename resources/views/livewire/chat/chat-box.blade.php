<main class="flex-1 flex flex-col border-l border-gray-800 bg-gray-900">


    @if($selectedUser)
        <!-- En-tête avec photo, nom et email -->
        <livewire:chat.chat-body-header :user="$selectedUser" />

        <!-- Zone des messages -->
        <div class="flex-1 overflow-y-auto px-4 py-2 scrollbar-custom">
            <livewire:chat.chat-body-messages :userId="$selectedUser->id" />
        </div>

        <!-- Zone de saisie -->
        <footer class="px-6 py-3 border-t border-gray-800 bg-gray-800/70 text-sm text-gray-400 text-center">
          <livewire:chat.chat-body-input :userId="$selectedUser->id" />
        </footer>

    @else
        <!-- Message si aucun utilisateur sélectionné -->
        <div class="flex items-center justify-center flex-1 px-6 py-10 text-gray-400 text-center">
            <div>
                <p class="text-xl mb-2">👀 Aucune conversation sélectionnée</p>
                <p class="text-sm">Cliquez sur un ami dans la liste pour commencer à discuter.</p>
            </div>
        </div>
    @endif


</main>
