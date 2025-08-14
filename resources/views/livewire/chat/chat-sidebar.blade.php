<div class="w-[380px] border-r border-gray-800 h-screen flex flex-col bg-gray-850">

    <!-- 🧭 Onglets -->
    <div class="flex bg-gray-800/70 backdrop-blur-sm rounded-xl shadow-md ring-1 ring-gray-700 overflow-hidden m-2">

        <button
            wire:click="switchTab('users')"
            class="flex-1 py-3 text-center font-semibold text-lg transition-colors duration-300 relative focus:outline-none
                @if($activeTab === 'users')
                    text-blue-400 bg-gray-900 shadow-inner
                @else
                    text-gray-400 hover:text-blue-300 hover:bg-gray-700
                @endif
            ">
            👥 Utilisateurs

            {{-- Soulignement animé --}}
            @if($activeTab === 'users')
                <span class="absolute bottom-0 left-0 w-full h-1 bg-blue-500 rounded-t-md animate-slideIn"></span>
            @endif
        </button>

        <button
            wire:click="switchTab('conversations')"
            class="flex-1 py-3 text-center font-semibold text-lg transition-colors duration-300 relative focus:outline-none
                @if($activeTab === 'conversations')
                    text-blue-400 bg-gray-900 shadow-inner
                @else
                    text-gray-400 hover:text-blue-300 hover:bg-gray-700
                @endif
            ">
            🗂️ Conversations

            {{-- Soulignement animé --}}
            @if($activeTab === 'conversations')
                <span class="absolute bottom-0 left-0 w-full h-1 bg-blue-500 rounded-t-md animate-slideIn"></span>
            @endif
        </button>

    </div>



    <!-- 🧍 Utilisateurs -->
    @if ($activeTab === 'users')
        <div class="flex-1 overflow-y-auto scrollbar-custom">
            <livewire:chat.chat-utilisateurs />
        </div>
    @endif

    <!-- 📜 Conversations -->
    @if ($activeTab === 'conversations')
        <div class="flex-1 overflow-y-auto scrollbar-custom">
            <livewire:chat.chat-list />
        </div>
    @endif

</div>
