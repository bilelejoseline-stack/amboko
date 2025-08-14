<section id="galerie" class="bg-gray-900 py-20 px-6 md:px-12 text-gray-100">
    <div class="max-w-7xl mx-auto space-y-12">

        <!-- Titre -->
        <div class="text-center">
            <h2 class="text-4xl font-extrabold text-white">Galerie d'Images</h2>
            <p class="mt-3 text-gray-400 text-lg">Souvenirs, missions et moments forts de l’État-Major Général.</p>
        </div>

        <!-- Menu catégories -->
        <div class="flex flex-wrap justify-center gap-3">
            <!-- Bouton Toutes -->
            <button wire:click="selectCategory('toutes')"
                    class="px-4 py-2 rounded-full border transition duration-300
                    {{ $selectedCategory === 'toutes' ? 'bg-indigo-500 text-white' : 'border-gray-600 text-gray-400 hover:bg-gray-700' }}">
                Toutes
            </button>

            <!-- Boutons dynamiques des catégories -->
            @foreach($categories as $cat)
                <button wire:click="selectCategory({{ $cat->id }})"
                        class="px-4 py-2 rounded-full border transition duration-300
                        {{ $selectedCategory == $cat->id ? 'bg-indigo-500 text-white' : 'border-gray-600 text-gray-400 hover:bg-gray-700' }}">
                    {{ ucfirst($cat->name) }}
                </button>
            @endforeach
        </div>

        <!-- Catégorie sélectionnée (affichage debug optionnel) -->
        <div class="text-center mt-4 text-sm text-gray-500">
            Catégorie sélectionnée :
            <span class="font-bold text-indigo-400">
                {{ is_numeric($selectedCategory) ? 'ID ' . $selectedCategory : $selectedCategory }}
            </span>
        </div>

        <!-- Galerie d'images -->
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-8 mt-8">
            @forelse($photos as $photo)
                <div class="bg-gray-800 p-4 rounded-xl shadow-md transition duration-300 hover:scale-[1.02]">
                    <img src="{{ asset('storage/' . $photo->image) }}"
                         alt="{{ $photo->title }}"
                         class="rounded-md w-full h-48 object-cover mb-3">
                    <h4 class="text-lg font-semibold text-indigo-400">{{ $photo->title }}</h4>
                    <p class="text-sm text-gray-300">{{ $photo->description }}</p>
                    @if($photo->category)
                        <p class="mt-1 text-xs text-gray-500 italic">Catégorie : {{ $photo->category->name }}</p>
                    @endif
                </div>
            @empty
                <p class="text-center text-gray-400 col-span-3">Aucune image trouvée dans cette catégorie.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-10 flex justify-center">
            {{ $photos->links() }}
        </div>

    </div>
</section>
