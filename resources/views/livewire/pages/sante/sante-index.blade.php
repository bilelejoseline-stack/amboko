<!-- resources/views/livewire/pages/sante/sante-index.blade.php -->

<div class="bg-gray-900 text-white max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-2 gap-8 items-center rounded-lg shadow-lg">

    <!-- Texte à gauche -->
    <div>
        <h2 class="text-3xl font-bold mb-4">Santé Militaire</h2>
        <p class="text-gray-300 mb-6">
            Découvrez nos services et conseils pour la santé des militaires : prévention, soins et bien-être.
        </p>
        <a href="{{ route('sante.index') }}"
           class="inline-block px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
            Voir plus
        </a>
    </div>

    <!-- Image unique, fade in/out -->
    <div
        x-data="{
            articles: @js($articles),
            index: 0,
            duration: 5000,
            init() {
                if (this.articles.length > 1) {
                    setInterval(() => {
                        this.index = (this.index + 1) % this.articles.length;
                    }, this.duration);
                }
            }
        }"
        class="relative w-full h-64 md:h-96 rounded-lg overflow-hidden bg-gray-700"
    >
        <template x-if="articles.length === 0">
            <div class="w-full h-full flex items-center justify-center text-gray-400">
                Aucune image disponible.
            </div>
        </template>

        <template x-if="articles.length > 0">
            <div class="absolute inset-0 w-full h-full">
                <img :src="articles[index].image"
                     :alt="articles[index].titre"
                     loading="lazy"
                     class="w-full h-full object-cover transition-opacity duration-1000"
                     x-show="true"
                     x-transition:enter="transition-opacity duration-1000"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity duration-1000"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                >

                <!-- Overlay avec titre et lien -->
                <div class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-center p-4">
                    <h3 class="text-lg font-semibold text-white mb-2" x-text="articles[index].titre"></h3>
                    <a :href="'/sante/' + articles[index].slug"
                       class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition">
                        Détails
                    </a>
                </div>
            </div>
        </template>
    </div>
</div>
