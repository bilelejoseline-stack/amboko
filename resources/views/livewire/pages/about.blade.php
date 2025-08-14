<section id="about" class="py-16 bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Title -->
        <div class="text-center mb-12"
             x-data
             x-init="ScrollReveal().reveal($el, { delay: 100, distance: '50px', origin: 'bottom' })">
            <h2 class="text-4xl font-bold text-green-400">À propos</h2>
            <p class="mt-4 text-gray-300 max-w-2xl mx-auto">
                Découvrez les valeurs, les missions et l'engagement des FARDC.
            </p>
        </div>

        @if($hasAbouts)
            @foreach($abouts as $index => $about)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start mb-16">
                    
                    <!-- Texte + Image -->
                    <div x-data 
                         x-init="ScrollReveal().reveal($el, { delay: 200, distance: '50px', origin: 'left' })">
                        <h3 class="text-2xl font-semibold mb-4 text-white">
                            {{ $about->title }}
                        </h3>

                        @if($about->image)
                            <img src="{{ asset('storage/' . $about->image) }}" alt="{{ $about->title }}"
                                 class="w-full h-auto rounded-lg mb-6 opacity-90 hover:opacity-100 transition duration-300">
                        @endif

                        <p class="text-gray-300 mb-4">
                            {{ $about->subtitles[0]['value'] ?? 'Pas de sous-titre disponible.' }}
                        </p>

                        <div class="text-gray-300 prose prose-invert text-justify mb-4">
                            {!! $about->descriptions[0]['value'] ?? '<p>Aucune description disponible.</p>' !!}
                        </div>
                    </div>

                    <!-- Vidéo locale ou lecteur par défaut -->
                    <div x-data 
                         x-init="ScrollReveal().reveal($el, { delay: 300, distance: '50px', origin: 'right' })">
                        <p class="italic text-gray-400 mb-6">
                            {{ ucfirst(str_replace('-', ' ', $about->slug)) }}
                        </p>

                        <ul class="space-y-4 mb-6">
                            <li class="flex items-start space-x-2">
                                <i class="text-green-400 bi bi-check-circle-fill"></i>
                                <span>Discipline, intégrité, loyauté.</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <i class="text-green-400 bi bi-check-circle-fill"></i>
                                <span>Défendre le peuple avec courage.</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <i class="text-green-400 bi bi-check-circle-fill"></i>
                                <span>Unis pour la patrie, forts pour la paix.</span>
                            </li>
                        </ul>

                        <div class="relative mt-4" 
                             x-data 
                             x-init="ScrollReveal().reveal($el, { delay: 400, distance: '50px', origin: 'bottom' })">

                            @if(!empty($about->video))
                                <!-- Vidéo locale (mp4/webm) -->
                                <video controls class="w-full h-auto rounded-lg">
                                    <source src="{{ asset('storage/' . $about->video) }}" type="video/mp4">
                                    Votre navigateur ne supporte pas la lecture vidéo.
                                </video>
                            @else
                                <!-- YouTube par défaut -->
                                <div class="aspect-w-16 aspect-h-9">
                                    <iframe class="rounded-lg w-full h-full"
                                            src="https://www.youtube.com/embed/Y7f98aduVJ8" 
                                            title="Vidéo FARDC" 
                                            frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                            allowfullscreen>
                                    </iframe>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center py-12">
                <p class="text-gray-400">Aucune donnée disponible actuellement.</p>
            </div>
        @endif
    </div>
</section>
