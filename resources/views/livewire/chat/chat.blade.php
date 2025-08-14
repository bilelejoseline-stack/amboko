<div class="flex min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white">

    <!-- 📁 Barre latérale -->
    <aside>
        <livewire:chat.chat-sidebar />
    </aside>

    <!-- 💬 Chat principal -->

        <section class="flex-1 overflow-y-auto px-6 py-4 scrollbar-custom">
            <livewire:chat.chat-box />
        </section>



</div>
