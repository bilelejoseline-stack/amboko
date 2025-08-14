<div class="max-w-5xl mx-auto p-6 bg-gray-900 rounded-lg shadow-lg text-white">

    <!-- Titre principal -->
    <h1 class="text-3xl font-bold mb-4">{{ $article->titre }}</h1>

    <!-- Sous-titre unique (du modèle) -->
    @if($article->sous_titre)
        <h2 class="text-lg text-gray-400 mb-4">{{ $article->sous_titre }}</h2>
    @endif

    <!-- Image principale -->
    @if($article->image)
        <img src="{{ $article->image }}"
             alt="{{ $article->titre }}"
             class="w-full h-auto rounded-lg mb-6 border border-gray-700">
    @endif

    <!-- Description unique (du modèle) -->
    @if($article->description)
    <div class="text-gray-300 leading-relaxed mb-6 prose prose-invert max-w-none first:mt-0 last:mb-0">
        {!! $article->description !!}
    </div>

    @endif

    <!-- Contenus multiples (JSON) -->
    @if(is_array($article->contenus) && count($article->contenus) > 0)
        <div class="space-y-6">
            @foreach($article->contenus as $contenu)
                <div class="bg-gray-800 p-4 rounded-lg border border-gray-700">
                    @if(!empty($contenu['sous_titre']))
                        <h3 class="text-xl font-semibold text-blue-400 mb-2">{{ $contenu['sous_titre'] }}</h3>
                    @endif

                    @if(!empty($contenu['description']))
                        <p class="text-gray-300">
                            {!! $contenu['description'] !!}
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <!-- Bouton retour -->
    <a href="{{ route('sante.index') }}"
       class="inline-block mt-8 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition">
        Retour à la liste
    </a>
</div>
