<div>

    <!-- 2. Hero section -->


    <section id="hero"
             x-data="heroSlider"
             x-init="start()"
             x-cloak
             class="relative h-screen w-full overflow-hidden text-white">

        <!-- ✅ SLIDER D'IMAGES DE FOND -->
        <template x-for="(image, index) in images" :key="index">
            <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000"
                 :style="`background-image: url('${image}')`"
                 :class="{ 'opacity-100': index === currentIndex, 'opacity-0': index !== currentIndex }">
            </div>
        </template>

        <!-- ✅ OVERLAY SOMBRE -->
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>

        <!-- ✅ CONTENU CENTRAL -->
        <div class="relative z-10 flex h-full items-center justify-center">
            <div class="text-center p-6"
                 x-data="typeWriterZoom"
                 x-init="start()">

                <h2 class="text-4xl md:text-6xl font-extrabold min-h-[4rem] tracking-wide flex justify-center flex-wrap gap-1 blinking-cursor">
                    <template x-for="(char, index) in characters" :key="index">
                        <span
                            x-text="char"
                            class="inline-block transform transition duration-300 ease-out scale-0"
                            :class="{ 'scale-100': index <= currentChar }">
                        </span>
                    </template>
                </h2>

                <p class="mt-4 text-lg">L'élite des Forces Armées Congolaises</p>
            </div>
        </div>
    </section>


    {{-- SECTION À PROPOS AVEC IMAGE --}}
    <section class="bg-gray-100 py-16 px-6">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center">

            {{-- IMAGE --}}
            <div>
                <img src="{{ asset('images/fardc-presentation.jpg') }}" alt="Militaires FARDC en formation" class="rounded-xl shadow-lg w-full object-cover h-96">
            </div>

            {{-- TEXTE --}}
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-green-900 uppercase mb-6">
                    🛡️ À propos des FARDC
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed">
                    Les <strong>Forces Armées de la République Démocratique du Congo (FARDC)</strong> forment le pilier de la sécurité nationale,
                    veillant jour et nuit à la souveraineté, à la paix et à la stabilité du pays.
                    Issues d’une histoire complexe et de multiples réformes, elles incarnent le courage et la résilience du peuple congolais.
                </p>
                <p class="text-lg text-gray-700 mt-4 leading-relaxed">
                    Elles interviennent non seulement dans les opérations militaires,
                    mais aussi dans les actions de développement, les secours en cas de catastrophes et le maintien de la paix à l’échelle régionale.
                </p>
                <p class="mt-6 text-gray-600 italic">
                    « Être soldat des FARDC, c’est défendre sans fléchir, servir sans faillir. »
                </p>
            </div>
        </div>
    </section>


    <!-- 3. Mission -->
    <section id="mission" class="py-16 bg-white" x-data>
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Notre Mission</h2>
            <p class="max-w-3xl mx-auto">
                Assurer la défense de la Nation, maintenir l'intégrité territoriale et protéger le peuple avec courage, loyauté et discipline.
            </p>

            <!-- Bouton avec lien vers la route missions -->
            <a href="{{ route('missions') }}"
               class="inline-block mt-6 px-6 py-2 bg-green-700 text-white font-semibold rounded-full shadow-md hover:bg-green-800 transition duration-300"
            >
                Voir plus
            </a>
        </div>
    </section>

    <section id="architecture-fardc" class="bg-gray-900 text-white py-16 px-4" x-data="{ visible: [] }"
             x-init="
                const els = $el.querySelectorAll('[data-id]');
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if(entry.isIntersecting){
                            visible.push(entry.target.dataset.id);
                        }
                    });
                }, { threshold: 0.3 });
                els.forEach(el => observer.observe(el));
             " x-cloak>

      <div class="max-w-7xl mx-auto">
        <div class="text-center mb-10" data-id="title"
             :class="{ 'opacity-100 translate-y-0': visible.includes('title'), 'opacity-0 translate-y-8': !visible.includes('title') }"
             class="transition-all duration-700">
          <h1 class="text-4xl font-bold uppercase text-yellow-400">Architecture des FARDC</h1>
          <p class="text-gray-300 mt-2">Structure des Forces Armées de la République Démocratique du Congo</p>

          <nav class="mt-6 flex flex-wrap justify-center gap-4 text-sm text-yellow-300 underline">
            <a href="#cemg">Chef EMG</a>
            <a href="#op-rens">Opérations & Renseignements</a>
            <a href="#adm-log">Administration & Logistique</a>
            <a href="#terrestre">Forces Terrestres</a>
            <a href="#aerienne">Forces Aériennes</a>
            <a href="#navale">Forces Navales</a>
          </nav>
        </div>

        <!-- Chef d'État-Major Général -->
        <div id="cemg" class="bg-gray-800 border border-yellow-500 px-8 py-5 rounded-xl shadow-lg text-center mb-8" data-id="cemg"
             :class="{ 'opacity-100 translate-y-0': visible.includes('cemg'), 'opacity-0 translate-y-8': !visible.includes('cemg') }"
             class="transition-all duration-700">
          <h2 class="text-2xl font-bold text-yellow-400">Chef d'État-Major Général</h2>
          <p class="text-sm text-gray-300 italic">Dispose de son propre cabinet</p>
        </div>

        <!-- Deux Chefs Adjoints -->
        <div class="grid md:grid-cols-2 gap-8 mb-12">
          <!-- Opérations et Renseignements -->
          <div id="op-rens" class="bg-gray-800 border border-blue-500 p-6 rounded-xl shadow-lg" data-id="op-rens"
               :class="{ 'opacity-100 translate-y-0': visible.includes('op-rens'), 'opacity-0 translate-y-8': !visible.includes('op-rens') }"
               class="transition-all duration-700">
            <h3 class="text-xl font-bold text-blue-400 text-center">
              <a href="/operations-renseignements" class="hover:underline hover:text-blue-200">CEMGA Adjoint : Opérations & Renseignements</a>
            </h3>
            <ul class="mt-4 text-sm text-gray-300 space-y-2 text-center">
              <li><a href="/operations" class="hover:text-blue-300">🔹 Sous-État-Major des Opérations</a></li>
              <li><a href="/renseignements" class="hover:text-blue-300">🔹 Sous-État-Major des Renseignements</a></li>
            </ul>
          </div>

          <!-- Administration et Logistique -->
          <div id="adm-log" class="bg-gray-800 border border-green-500 p-6 rounded-xl shadow-lg" data-id="adm-log"
               :class="{ 'opacity-100 translate-y-0': visible.includes('adm-log'), 'opacity-0 translate-y-8': !visible.includes('adm-log') }"
               class="transition-all duration-700">
            <h3 class="text-xl font-bold text-green-400 text-center">
              <a href="/administration-logistique" class="hover:underline hover:text-green-200">CEMGA Adjoint : Administration & Logistique</a>
            </h3>
            <ul class="mt-4 text-sm text-gray-300 space-y-2 text-center">
              <li><a href="/administration" class="hover:text-green-300">🔸 Sous-État-Major d’Administration</a></li>
              <li><a href="/logistique" class="hover:text-green-300">🔸 Sous-État-Major de Logistique</a></li>
            </ul>
          </div>
        </div>

        <!-- Trois Forces Spécialisées -->
        <div class="grid md:grid-cols-3 gap-6">
          <!-- Terrestres -->
          <div id="terrestre" class="bg-gray-800 border border-red-500 p-5 rounded-xl shadow-lg flex flex-col items-center justify-center text-center" data-id="terrestre"
               :class="{ 'opacity-100 translate-y-0': visible.includes('terrestre'), 'opacity-0 translate-y-8': !visible.includes('terrestre') }"
               class="transition-all duration-700">
            <div class="text-5xl mb-2">🪖</div>
            <h4 class="text-lg font-bold text-red-400">
              <a href="/forces-terrestres" class="hover:underline hover:text-red-200">État-Major Forces Terrestres</a>
            </h4>
            <ul class="mt-3 text-sm text-gray-300 space-y-1">
              <li>🗺️ Zones de Défense : 1ère, 2e, 3e</li>
              <li>🏛️ Départements : Admin, Logistique, Opérations, Rens</li>
            </ul>
          </div>

          <!-- Aériennes -->
          <div id="aerienne" class="bg-gray-800 border border-indigo-500 p-5 rounded-xl shadow-lg flex flex-col items-center justify-center text-center" data-id="aerienne"
               :class="{ 'opacity-100 translate-y-0': visible.includes('aerienne'), 'opacity-0 translate-y-8': !visible.includes('aerienne') }"
               class="transition-all duration-700">
            <div class="text-5xl mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" style="height:40px, width:40px;" width="22" height="22" fill="currentColor" class="bi bi-airplane-engines" viewBox="0 0 16 16">
                <path d="M8 0c-.787 0-1.292.592-1.572 1.151A4.35 4.35 0 0 0 6 3v3.691l-2 1V7.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.191l-1.17.585A1.5 1.5 0 0 0 0 10.618V12a.5.5 0 0 0 .582.493l1.631-.272.313.937a.5.5 0 0 0 .948 0l.405-1.214 2.21-.369.375 2.253-1.318 1.318A.5.5 0 0 0 5.5 16h5a.5.5 0 0 0 .354-.854l-1.318-1.318.375-2.253 2.21.369.405 1.214a.5.5 0 0 0 .948 0l.313-.937 1.63.272A.5.5 0 0 0 16 12v-1.382a1.5 1.5 0 0 0-.83-1.342L14 8.691V7.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v.191l-2-1V3c0-.568-.14-1.271-.428-1.849C9.292.591 8.787 0 8 0M7 3c0-.432.11-.979.322-1.401C7.542 1.159 7.787 1 8 1s.458.158.678.599C8.889 2.02 9 2.569 9 3v4a.5.5 0 0 0 .276.447l5.448 2.724a.5.5 0 0 1 .276.447v.792l-5.418-.903a.5.5 0 0 0-.575.41l-.5 3a.5.5 0 0 0 .14.437l.646.646H6.707l.647-.646a.5.5 0 0 0 .14-.436l-.5-3a.5.5 0 0 0-.576-.411L1 11.41v-.792a.5.5 0 0 1 .276-.447l5.448-2.724A.5.5 0 0 0 7 7z"/>
              </svg>              ️
            </div>
            <h4 class="text-lg font-bold text-indigo-400">
              <a href="/forces-aeriennes" class="hover:underline hover:text-indigo-200">État-Major Forces Aériennes</a>
            </h4>
            <ul class="mt-3 text-sm text-gray-300 space-y-1">
              <li>🛫 Bases Aériennes : Ndolo, Kitona, Kamina</li>
              <li>🏛️ Départements : Admin, Logistique, Opérations, Rens</li>
            </ul>
          </div>

          <!-- Navales -->
          <div id="navale" class="bg-gray-800 border border-cyan-500 p-5 rounded-xl shadow-lg flex flex-col items-center justify-center text-center" data-id="navale"
               :class="{ 'opacity-100 translate-y-0': visible.includes('navale'), 'opacity-0 translate-y-8': !visible.includes('navale') }"
               class="transition-all duration-700">
            <div class="text-5xl mb-2">⚓</div>
            <h4 class="text-lg font-bold text-cyan-400">
              <a href="/forces-navales" class="hover:underline hover:text-cyan-200">État-Major Forces Navales</a>
            </h4>
            <ul class="mt-3 text-sm text-gray-300 space-y-1">
              <li>⚓ Bases : Boma, Kalemie, Goma…</li>
              <li>🏛️ Départements : Admin, Logistique, Opérations, Rens</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section id="forces" class="slate-400 py-16">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-10">Nos Forces</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Forces Terrestres --}}
                {{-- Forces Terrestres avec slider fondu --}}
                <div
                    x-data="{
                        images: [
                            '{{ asset('images/terre.jpeg') }}',
                            '{{ asset('images/terre2.jpeg') }}',
                            '{{ asset('images/terre3.jpeg') }}'
                        ],
                        activeIndex: 0,
                        interval: null,
                        startSlider() {
                            this.interval = setInterval(() => {
                                this.activeIndex = (this.activeIndex + 1) % this.images.length;
                            }, 4000);
                        },
                        stopSlider() {
                            clearInterval(this.interval);
                        }
                    }"
                    x-cloak
                    x-init="startSlider()"
                    class="relative rounded-lg shadow overflow-hidden group cursor-pointer h-64"
                >

                    {{-- Images en fondu --}}
                    <template x-for="(image, index) in images" :key="index">
                        <div x-cloak x-show="activeIndex === index"
                             x-transition:enter="transition-opacity duration-1000"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition-opacity duration-1000"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="absolute inset-0 w-full h-full bg-cover bg-center"
                             :style="'background-image: url(' + image + ')'">
                        </div>
                    </template>

                    {{-- Overlay texte + bouton --}}
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white p-6 text-center z-10">
                        <h3 class="text-2xl font-bold mb-2">Forces Terrestres</h3>
                        <p class="mb-4">Opérations terrestres stratégiques à travers le territoire.</p>
                        <a href="{{ route('forces.terre') }}"
                           class="px-5 py-2 bg-blue-600 hover:bg-blue-700 rounded transition">
                            Voir plus
                        </a>
                    </div>

                </div>


                {{-- Forces Aériennes --}}
                {{-- Forces Aériennes avec slider fondu --}}
                <div
                    x-data="{
                        images: [
                            '{{ asset('images/aerienne.jpeg') }}',
                            '{{ asset('images/aerienne2.jpeg') }}',
                            '{{ asset('images/aerienne3.jpeg') }}'
                        ],
                        activeIndex: 0,
                        interval: null,
                        startSlider() {
                            this.interval = setInterval(() => {
                                this.activeIndex = (this.activeIndex + 1) % this.images.length;
                            }, 4000);
                        },
                        stopSlider() {
                            clearInterval(this.interval);
                        }
                    }"
                    x-init="startSlider()"
                    x-cloak
                    class="relative rounded-lg shadow overflow-hidden group cursor-pointer h-64"
                >

                    {{-- Images avec effet fondu --}}
                    <template x-for="(image, index) in images" :key="index">
                        <div x-cloak x-show="activeIndex === index"
                             x-transition:enter="transition-opacity duration-1000"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition-opacity duration-1000"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="absolute inset-0 w-full h-full bg-cover bg-center"
                             :style="'background-image: url(' + image + ')'">
                        </div>
                    </template>

                    {{-- Overlay avec texte et bouton --}}
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white p-6 text-center z-10">
                        <h3 class="text-2xl font-bold mb-2">Forces Aériennes</h3>
                        <p class="mb-4">Maîtrise du ciel congolais avec des unités aériennes modernes.</p>
                        <a href="{{ route('forces.air') }}"
                           class="px-5 py-2 bg-blue-600 hover:bg-blue-700 rounded transition">
                            Voir plus
                        </a>
                    </div>

                </div>


                {{-- Forces Navales --}}
                {{-- Forces Navales avec slider fondu --}}
                <div
                    x-data="{
                        images: [
                            '{{ asset('images/navale.jpeg') }}',
                            '{{ asset('images/navale2.jpeg') }}',
                            '{{ asset('images/navale3.jpeg') }}'
                        ],
                        activeIndex: 0,
                        interval: null,
                        startSlider() {
                            this.interval = setInterval(() => {
                                this.activeIndex = (this.activeIndex + 1) % this.images.length;
                            }, 4000);
                        },
                        stopSlider() {
                            clearInterval(this.interval);
                        }
                    }"
                    x-init="startSlider()"
                    class="relative rounded-lg shadow overflow-hidden group cursor-pointer h-64"
                >

                    {{-- Images en fond avec effet fade --}}
                    <template x-for="(image, index) in images" :key="index">
                        <div x-cloak x-show="activeIndex === index"
                             x-transition:enter="transition-opacity duration-1000"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition-opacity duration-1000"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="absolute inset-0 w-full h-full bg-cover bg-center"
                             :style="'background-image: url(' + image + ')'">
                        </div>
                    </template>

                    {{-- Overlay texte + bouton --}}
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white p-6 text-center z-10">
                        <h3 class="text-2xl font-bold mb-2">Forces Navales</h3>
                        <p class="mb-4">Surveillance des eaux et interventions maritimes.</p>
                        <a href="{{ route('forces.mer') }}"
                           class="px-5 py-2 bg-blue-600 hover:bg-blue-700 rounded transition">
                            Voir plus
                        </a>
                    </div>

                </div>


            </div>
        </div>
    </section>

    @livewire('forces-slider')
    @livewire('gallery-forces')



    <!-- 5. Animation Alpine.js -->
    <section class="py-16 bg-white">
        <div class="container mx-auto text-center">
            <div x-data="{ open: false }" x-cloak class="max-w-xl mx-auto">
                <button @click="open = !open" class="px-4 py-2 bg-gray-900 text-white rounded hover:bg-gray-700">Voir notre serment militaire</button>
                <p x-cloak x-show="open" x-transition class="mt-4 text-gray-700">"Je jure fidélité à la République et promets de défendre son peuple au prix de ma vie."</p>
            </div>
        </div>
    </section>

    <!-- 6. Statistiques -->
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div>
                <h3 class="text-4xl font-bold text-gray-800">+50 000</h3>
                <p class="text-gray-600">Soldats actifs</p>
            </div>
            <div>
                <h3 class="text-4xl font-bold text-gray-800">+120</h3>
                <p class="text-gray-600">Missions réussies</p>
            </div>
            <div>
                <h3 class="text-4xl font-bold text-gray-800">24/7</h3>
                <p class="text-gray-600">Vigilance constante</p>
            </div>
        </div>
    </section>

    <!-- 7. Vidéo / Témoignage -->
    <section class="py-16 bg-white text-center">
        <h2 class="text-3xl font-bold mb-6">Vivez leur histoire</h2>
        <video class="mx-auto w-2/3 rounded shadow" controls>
            <source src="/videos/temoignage.mp4" type="video/mp4">
        </video>
    </section>

    <!-- 8. Livewire component (exemple simple) -->
    <section class="bg-gray-200 py-16">
        <div class="container mx-auto">

        </div>
    </section>

    <!-- 9. Galerie -->
    <section id="galerie" class="py-16 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Galerie</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <img src="/images/galerie1.jpg" class="rounded shadow">
                <img src="/images/galerie2.jpg" class="rounded shadow">
                <img src="/images/galerie3.jpg" class="rounded shadow">
                <img src="/images/galerie4.jpg" class="rounded shadow">
            </div>
        </div>
    </section>

    <!-- 12. Carte interactive Google Maps -->
<section id="map" class="py-16 bg-gray-100">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-6">Localisation de l’État-Major Général</h2>
        <p class="mb-4 text-gray-700">Retrouvez-nous au cœur de Kinshasa, pour toute collaboration stratégique ou engagement militaire.</p>

        <div class="w-full h-96 rounded shadow overflow-hidden">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3975.8852820193135!2d15.2845!3d-4.3228!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1a6a327e10a9e135%3A0x8e7b5d5bc8e4b5a3!2sÉtat-Major%20G%C3%A9n%C3%A9ral%20des%20FARDC!5e0!3m2!1sfr!2scd!4v1685365420123!5m2!1sfr!2scd"
                width="100%"
                height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>


    <!-- 10. Appel à l'action -->
    <section class="bg-gray-800 text-white py-16 text-center">
        <h2 class="text-3xl font-bold">Rejoignez l'élite</h2>
        <p class="mt-2">Faites partie de l'histoire. Engagez-vous dès aujourd'hui.</p>
        <a href="#" class="inline-block mt-4 px-6 py-2 bg-red-600 hover:bg-red-700 rounded">Postuler</a>
    </section>

    <!-- 11. Footer -->
    @livewire('home.sections.footers')
</div>
