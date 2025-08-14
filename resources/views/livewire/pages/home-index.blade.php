<div>
  <livewire:pages.heros />
  <livewire:pages.about />

  <section id="structure" class="bg-gray-700 py-24 px-6 md:px-12 text-gray-100 border-b border-gray-500">
    <div class="max-w-7xl mx-auto space-y-16 text-center sr-structure-fade">

      <div>
        <div>
          <h3 class="text-3xl font-extrabold text-white uppercase "
            style="text-shadow: 1px 1px 2px rgba(33, 33, 33, 0.5);">Structure de l’État-Major Général</h3>
          <p class="mt-4 text-white text-lg max-w-3xl mx-auto">
            L’ordre et la stratégie au cœur de la défense nationale. Chaque entité joue un rôle clé dans la stabilité du
            pays.
          </p>
        </div>
        <div class=" flex justify-center items-center h-32">
          <img src="{{ asset('images/logo-fardc.png') }}" alt="Logo FARDC"
            class="h-28 w-28 border border-red-500 rounded-full bg-gray-900">
        </div>

        <div>
          <h2 class="text-4xl font-extrabold text-yellow-400 uppercase">Haut commandement</h2>
        </div>
      </div>

      <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 text-left items-stretch">

        <!-- Chef d'État-Major Général -->
        <a href="{{ route('cemg') }}"
          class="block w-full h-full hover:scale-[1.02] transform transition duration-300 shadow-xl  rounded-xl shadow-gray-900">
          <div
            class="bg-gray-800 p-6  rounded-xl w-full h-full min-h-[250px] flex flex-col justify-between leading-tight">
            <div class="space-y-4">
              <h3 class="text-xl font-semibold text-indigo-400">Chef d'État-Major Général</h3>
              <p class="text-gray-300 text-sm">
                Autorité suprême opérationnelle des FARDC, chargé de coordonner toutes les forces et garantir l’unité
                stratégique.
              </p>
            </div>
          </div>
        </a>

        <!-- CEMG Adjoint Opérations et Renseignements -->
        <a href="{{ route('cemg.adjt.ops.rens') }}"
          class="block w-full h-full hover:scale-[1.02] transform transition duration-300 shadow-xl  rounded-xl shadow-gray-900">
          <div
            class="bg-gray-800 p-6 rounded-xl shadow-lg w-full h-full min-h-[250px] flex flex-col justify-between leading-tight">
            <div class="space-y-4">
              <h3 class="text-xl font-semibold text-indigo-400">CEMG Adjoint – Opérations & Renseignements</h3>
              <p class="text-gray-300 text-sm">
                Supervise les opérations militaires et les services de renseignement. Il coordonne le Sous-État-Major
                des Opérations et celui des Renseignements.
              </p>
            </div>
          </div>
        </a>

        <!-- CEMG Adjoint Administration et Logistique -->
        <a href="{{ route('cemg.adjt.adm.log') }}"
          class="block w-full h-full hover:scale-[1.02] transform transition duration-300 shadow-xl  rounded-xl shadow-gray-900">
          <div
            class="bg-gray-800 p-6 rounded-xl shadow-lg w-full h-full min-h-[250px] flex flex-col justify-between leading-tight">
            <div class="space-y-4">
              <h3 class="text-xl font-semibold text-indigo-400">CEMG Adjoint – Administration & Logistique</h3>
              <p class="text-gray-300 text-sm">
                Responsable de la gestion administrative, du soutien logistique et du bon fonctionnement des ressources
                des FARDC. Il contrôle les Sous-États-Majors de l’Administration et de la Logistique.
              </p>
            </div>
          </div>
        </a>

      </div>

      <div class="mt-10 text-center sr-structure-fade">
        <blockquote class="text-xl italic text-gray-400 border-l-4 border-indigo-500 pl-6 max-w-2xl mx-auto">
          "Une armée bien structurée est une nation en paix." — Doctrine FARDC
        </blockquote>
      </div>

    </div>
  </section>

  <!-- Stats Section Moderne Militaire -->
  <section id="stats" class="py-20 bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data
      x-init="ScrollReveal().reveal('.stat-item', { interval: 200, distance: '60px', origin: 'bottom', duration: 1200, easing: 'ease-out' })">

      <!-- Titre Section -->
      <div class="text-center mb-16">
        <h2 class="text-4xl font-extrabold tracking-tight">Statistiques Opérationnelles</h2>
        <p class="text-gray-400 mt-2 max-w-2xl mx-auto">
          Puissance, précision et performance au service de la patrie. Chaque chiffre raconte une victoire.
        </p>
      </div>

      <!-- Grille Stats -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 text-center">

        <!-- Stat Item 1 -->
        <div class="stat-item flex flex-col items-center">
          <!-- SVG Icon: Shield Check -->
          <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor"
            class="text-yellow-400 mb-3" viewBox="0 0 16 16">
            <path
              d="M5.854 5.146a.5.5 0 0 0-.708.708L7.5 8.207l3.354-3.353a.5.5 0 0 0-.708-.708L7.5 6.793 5.854 5.146z" />
            <path
              d="M8 0c-.69 0-1.375.13-2.02.385a7.25 7.25 0 0 0-1.89.97 6.967 6.967 0 0 0-1.413 1.286 6.967 6.967 0 0 0-1.286 1.413 7.25 7.25 0 0 0-.97 1.89A6.983 6.983 0 0 0 0 8c0 1.009.196 1.992.578 2.89a7.25 7.25 0 0 0 .97 1.89 6.967 6.967 0 0 0 1.286 1.413 6.967 6.967 0 0 0 1.413 1.286 7.25 7.25 0 0 0 1.89.97A6.983 6.983 0 0 0 8 16a6.983 6.983 0 0 0 2.89-.578 7.25 7.25 0 0 0 1.89-.97 6.967 6.967 0 0 0 1.413-1.286 6.967 6.967 0 0 0 1.286-1.413 7.25 7.25 0 0 0 .97-1.89A6.983 6.983 0 0 0 16 8a6.983 6.983 0 0 0-.578-2.89 7.25 7.25 0 0 0-.97-1.89 6.967 6.967 0 0 0-1.286-1.413 6.967 6.967 0 0 0-1.413-1.286 7.25 7.25 0 0 0-1.89-.97A6.983 6.983 0 0 0 8 0z" />
          </svg>
          <h3 class="text-4xl font-bold" x-data="{ count: 0 }" x-init="let target = 500; let step = target / 50;
                      let interval = setInterval(() => {
                        if (count < target) count += step;
                        else { count = target; clearInterval(interval); }
                      }, 20);" x-text="Math.floor(count)"></h3>
          <p class="text-gray-400 mt-1">Missions Réussies</p>
        </div>

        <!-- Stat Item 2 -->
        <div class="stat-item flex flex-col items-center">
          <!-- SVG Icon: Globe -->
          <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="text-blue-400 mb-3"
            viewBox="0 0 16 16">
            <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm1.5 0a6.5 6.5 0 1 0 13 0 6.5 6.5 0 0 0-13 0z" />
          </svg>
          <h3 class="text-4xl font-bold" x-data="{ count: 0 }" x-init="let target = 1200; let step = target / 50;
                      let interval = setInterval(() => {
                        if (count < target) count += step;
                        else { count = target; clearInterval(interval); }
                      }, 20);" x-text="Math.floor(count)"></h3>
          <p class="text-gray-400 mt-1">Opérations Mondiales</p>
        </div>

        <!-- Stat Item 3 -->
        <div class="stat-item flex flex-col items-center">
          <!-- SVG Icon: Clock -->
          <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="text-green-400 mb-3"
            viewBox="0 0 16 16">
            <path d="M8 3.5a.5.5 0 0 1 .5.5v4l3 1.5a.5.5 0 0 1-.5.866L8 8.5V4a.5.5 0 0 1 .5-.5z" />
            <path d="M8 16A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
          </svg>
          <h3 class="text-4xl font-bold" x-data="{ count: 0 }" x-init="let target = 8000; let step = target / 50;
                      let interval = setInterval(() => {
                        if (count < target) count += step;
                        else { count = target; clearInterval(interval); }
                      }, 20);" x-text="Math.floor(count)"></h3>
          <p class="text-gray-400 mt-1">Heures de Vol</p>
        </div>

        <!-- Stat Item 4 -->
        <div class="stat-item flex flex-col items-center">
          <!-- SVG Icon: People -->
          <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="text-red-400 mb-3"
            viewBox="0 0 16 16">
            <path d="M13 7a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM9 7a2 2 0 1 1-4 0 2 2 0 0 1 4 0z" />
            <path fill-rule="evenodd"
              d="M4 13s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4zm0 1h8a1 1 0 0 0 1-1c0-.681-.316-1.316-.86-1.724C11.38 10.38 9.962 10 8 10c-1.962 0-3.38.38-4.14.276C3.316 11.684 3 12.319 3 13a1 1 0 0 0 1 1z" />
          </svg>
          <h3 class="text-4xl font-bold" x-data="{ count: 0 }" x-init="let target = 150; let step = target / 50;
                      let interval = setInterval(() => {
                        if (count < target) count += step;
                        else { count = target; clearInterval(interval); }
                      }, 20);" x-text="Math.floor(count)"></h3>
          <p class="text-gray-400 mt-1">Commandos Formés</p>
        </div>

      </div>

    </div>
  </section>

  <section id="services" class="py-16 bg-gray-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Section Title -->
      <div class="text-center mb-12" x-data
        x-init="ScrollReveal().reveal($el, { delay: 100, distance: '50px', origin: 'bottom' })">
        <h2 class="text-4xl font-bold mb-4">Nos Services</h2>
        <p class="text-lg text-gray-400">Découvrez nos prestations pensées pour répondre à vos besoins avec efficacité
          et innovation.</p>
      </div>

      <!-- Services Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        <!-- Service Item -->
        <div class="bg-gray-700 p-6 rounded-xl shadow-lg relative" x-data
          x-init="ScrollReveal().reveal($el, { delay: 100, distance: '50px', origin: 'bottom' })">
          <div class="text-indigo-400 text-4xl mb-4">
            <i class="bi bi-activity"></i>
          </div>
          <h3 class="text-xl font-semibold mb-2">Analyse Dynamique</h3>
          <p class="text-gray-400">Des solutions sur-mesure pour optimiser vos performances avec précision et fiabilité.
          </p>
          <a href="service-details.html" class="absolute inset-0" aria-label="Lire plus"></a>
        </div>

        <!-- Service Item -->
        <div class="bg-gray-700 p-6 rounded-xl shadow-lg relative" x-data
          x-init="ScrollReveal().reveal($el, { delay: 200, distance: '50px', origin: 'bottom' })">
          <div class="text-indigo-400 text-4xl mb-4">
            <i class="bi bi-broadcast"></i>
          </div>
          <h3 class="text-xl font-semibold mb-2">Communication Digitale</h3>
          <p class="text-gray-400">Renforcez votre présence en ligne avec des stratégies modernes et adaptées.</p>
          <a href="service-details.html" class="absolute inset-0" aria-label="Lire plus"></a>
        </div>

        <!-- Service Item -->
        <div class="bg-gray-700 p-6 rounded-xl shadow-lg relative" x-data
          x-init="ScrollReveal().reveal($el, { delay: 300, distance: '50px', origin: 'bottom' })">
          <div class="text-indigo-400 text-4xl mb-4">
            <i class="bi bi-easel"></i>
          </div>
          <h3 class="text-xl font-semibold mb-2">Design Intuitif</h3>
          <p class="text-gray-400">Création d'interfaces élégantes et fonctionnelles pour une expérience utilisateur
            fluide.</p>
          <a href="service-details.html" class="absolute inset-0" aria-label="Lire plus"></a>
        </div>

        <!-- Service Item -->
        <div class="bg-gray-700 p-6 rounded-xl shadow-lg relative" x-data
          x-init="ScrollReveal().reveal($el, { delay: 400, distance: '50px', origin: 'bottom' })">
          <div class="text-indigo-400 text-4xl mb-4">
            <i class="bi bi-bounding-box-circles"></i>
          </div>
          <h3 class="text-xl font-semibold mb-2">Solutions Intégrées</h3>
          <p class="text-gray-400">Un accompagnement global pour vos projets techniques et technologiques.</p>
          <a href="service-details.html" class="absolute inset-0" aria-label="Lire plus"></a>
        </div>

        <!-- Service Item -->
        <div class="bg-gray-700 p-6 rounded-xl shadow-lg relative" x-data
          x-init="ScrollReveal().reveal($el, { delay: 500, distance: '50px', origin: 'bottom' })">
          <div class="text-indigo-400 text-4xl mb-4">
            <i class="bi bi-calendar4-week"></i>
          </div>
          <h3 class="text-xl font-semibold mb-2">Gestion de Projet</h3>
          <p class="text-gray-400">Organisation et exécution méthodique pour la réussite de vos ambitions.</p>
          <a href="service-details.html" class="absolute inset-0" aria-label="Lire plus"></a>
        </div>

        <!-- Service Item -->
        <div class="bg-gray-700 p-6 rounded-xl shadow-lg relative" x-data
          x-init="ScrollReveal().reveal($el, { delay: 600, distance: '50px', origin: 'bottom' })">
          <div class="text-indigo-400 text-4xl mb-4">
            <i class="bi bi-chat-square-text"></i>
          </div>
          <h3 class="text-xl font-semibold mb-2">Consulting Stratégique</h3>
          <p class="text-gray-400">Des conseils avisés pour prendre des décisions éclairées et durables.</p>
          <a href="service-details.html" class="absolute inset-0" aria-label="Lire plus"></a>
        </div>

      </div>
    </div>
  </section>

  <livewire:pages.commandants.index />

  <section class="relative bg-gray-900 py-16 px-6 md:px-12 lg:px-20">
    <!-- Image de fond -->
    <div class="absolute inset-0 bg-cover bg-center opacity-20"
      style="background-image: url('{{ asset('images/tech-bg.webp') }}');"></div>

    <div class="relative z-10 max-w-6xl mx-auto text-center">
      <h2 class="text-3xl md:text-4xl font-bold text-yellow-400 mb-6 sr-title">
        Technologie & Innovation des FARDC
      </h2>
      <p class="text-lg text-gray-300 max-w-3xl mx-auto mb-12 sr-sub">
        Les Forces Armées de la République Démocratique du Congo investissent dans des solutions modernes
        pour renforcer la défense nationale, optimiser la logistique, et assurer la sécurité des citoyens.
      </p>

      <!-- Grille des innovations -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- Carte 1 -->
        <a href="{{ route('militaire.communication') }}"
          class="block bg-gray-800 rounded-xl shadow-lg p-6 hover:shadow-2xl hover:scale-105 transition transform sr-card">
          <div class="flex items-center justify-center w-16 h-16 mx-auto bg-yellow-500 rounded-full mb-4">
            <svg class="h-8 w-8 text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M12 8v4l3 3"></path>
              <path d="M20.4 15a9 9 0 11-16.8 0"></path>
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-white mb-3">Communication Sécurisée</h3>
          <p class="text-gray-400 text-sm">
            Déploiement de systèmes cryptés pour garantir la confidentialité des échanges stratégiques.
          </p>
        </a>

        <!-- Carte 2 -->
        <a href="{{ route('militaire.drones') }}"
          class="block bg-gray-800 rounded-xl shadow-lg p-6 hover:shadow-2xl hover:scale-105 transition transform sr-card">
          <div class="flex items-center justify-center w-16 h-16 mx-auto bg-yellow-500 rounded-full mb-4">
            <svg class="h-8 w-8 text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M4 4h16v16H4z"></path>
              <path d="M4 9h16"></path>
              <path d="M9 4v16"></path>
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-white mb-3">Technologies Drones</h3>
          <p class="text-gray-400 text-sm">
            Utilisation de drones de surveillance pour améliorer la reconnaissance et les opérations sur terrain.
          </p>
        </a>

        <!-- Carte 3 -->
        <a href="{{ route('militaire.logistique') }}"
          class="block bg-gray-800 rounded-xl shadow-lg p-6 hover:shadow-2xl hover:scale-105 transition transform sr-card">
          <div class="flex items-center justify-center w-16 h-16 mx-auto bg-yellow-500 rounded-full mb-4">
            <svg class="h-8 w-8 text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M12 20h9"></path>
              <path d="M12 4h9"></path>
              <path d="M4 9h16"></path>
              <path d="M4 15h16"></path>
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-white mb-3">Modernisation Logistique</h3>
          <p class="text-gray-400 text-sm">
            Intégration de systèmes numériques pour la gestion des ressources et le suivi des matériels.
          </p>
        </a>

      </div>
    </div>
  </section>

  <!-- Section Santé Militaire Complète avec Livewire & Alpine.js -->
  <livewire:pages.sante.sante-index />

  <section id="sante-militaire" class="bg-gray-900 text-gray-100 py-20 px-6 md:px-12">
    <div class="max-w-7xl mx-auto space-y-12">

      <!-- Titre -->
      <div class="text-center">
        <h2 class="text-4xl font-extrabold text-teal-400">Santé Militaire</h2>
        <p class="mt-4 text-lg text-gray-300">Soigner pour combattre. Guérir pour servir.</p>
      </div>

      <!-- Missions -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
          <h3 class="text-2xl font-bold text-white mb-4">Missions principales</h3>
          <ul class="space-y-2 text-gray-300 list-disc list-inside">
            <li>Soins médicaux en temps de guerre et de paix</li>
            <li>Gestion des hôpitaux militaires</li>
            <li>Formation du personnel sanitaire militaire</li>
            <li>Soutien sanitaire lors des opérations de paix</li>
            <li>Lutte contre les maladies dans les zones de conflit</li>
          </ul>
        </div>

        <!-- Structures -->
        <div>
          <h3 class="text-2xl font-bold text-white mb-4">Structures médicales</h3>
          <ul class="space-y-2 text-gray-300 list-disc list-inside">
            <li>Hôpital Militaire de Camp Kokolo</li>
            <li>Centre Médical de Garnison</li>
            <li>Poste Médical de Terrain (PMF)</li>
            <li>Ambulances médicalisées</li>
            <li>Hôpital Militaire de Camp Tshatshi</li>
          </ul>
        </div>
      </div>

      <!-- Slogan -->
      <div class="text-center mt-12">
        <span class="text-xl italic text-teal-300">"Soigner pour combattre. Guérir pour servir."</span>
      </div>

    </div>
  </section>

  <section id="technologie-fardc" class="bg-gray-950 text-gray-100 py-20 px-6 md:px-12">
    <div class="max-w-7xl mx-auto space-y-14">

      <!-- Titre -->
      <div class="text-center">
        <h2 class="text-4xl font-extrabold text-cyan-400">Technologie & Inventions</h2>
        <p class="mt-4 text-lg text-gray-300 italic">"Imaginer, créer, protéger. L’innovation est une arme."</p>
      </div>

      <!-- Contenu -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <!-- Domaines -->
        <div>
          <h3 class="text-2xl font-semibold mb-4 text-white">Domaines technologiques</h3>
          <ul class="list-disc list-inside text-gray-300 space-y-2">
            <li>Drones de reconnaissance et combat</li>
            <li>Systèmes de surveillance électronique</li>
            <li>Cybersécurité & protection des données</li>
            <li>Arduino / Raspberry Pi pour détection</li>
            <li>Robots terrestres de soutien tactique</li>
          </ul>
        </div>

        <!-- Centres -->
        <div>
          <h3 class="text-2xl font-semibold mb-4 text-white">Nos laboratoires & initiatives</h3>
          <ul class="list-disc list-inside text-gray-300 space-y-2">
            <li>Cellule scientifique de l’État-Major Général</li>
            <li>Ateliers militaires à Kitona & Ndolo</li>
            <li>Partenariat avec écoles polytechniques</li>
            <li>Programme "Soldat-Ingénieur"</li>
          </ul>
        </div>
      </div>

      <!-- Footer -->
      <div class="text-center mt-10">
        <span class="text-lg text-cyan-300">L’armée du futur se bâtit aujourd’hui, à la sueur des idées.</span>
      </div>

    </div>
  </section>

  <section id="social-fardc" class="bg-gray-800 text-gray-100 py-20 px-6 md:px-12">
    <div class="max-w-7xl mx-auto space-y-12">

      <!-- Titre -->
      <div class="text-center">
        <h2 class="text-4xl font-extrabold text-yellow-300">Section Sociale des FARDC</h2>
        <p class="mt-4 text-lg text-gray-200 italic">"Servir, c’est aussi soulager. Protéger, c’est aussi reconstruire."
        </p>
      </div>

      <!-- Objectifs + Actions -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <!-- Objectifs -->
        <div>
          <h3 class="text-2xl font-semibold text-white mb-4">Objectifs principaux</h3>
          <ul class="list-disc list-inside text-gray-300 space-y-2">
            <li>Soutien aux familles militaires</li>
            <li>Œuvres de solidarité : orphelins, veuves</li>
            <li>Reconstruction post-conflit (routes, écoles)</li>
            <li>Centres de formation communautaire</li>
            <li>Projets jeunesse & citoyenneté</li>
          </ul>
        </div>

        <!-- Actions -->
        <div>
          <h3 class="text-2xl font-semibold text-white mb-4">Nos actions sociales</h3>
          <ul class="list-disc list-inside text-gray-300 space-y-2">
            <li>Logements sociaux pour soldats</li>
            <li>Distribution de vivres & eau potable</li>
            <li>Soutien psychologique post-trauma</li>
            <li>Encadrement des enfants militaires</li>
            <li>Partenariat avec les ONG & Églises</li>
          </ul>
        </div>
      </div>

      <!-- Citation -->
      <div class="text-center mt-12">
        <span class="text-xl text-yellow-400">"Le cœur du soldat bat aussi pour la paix et la justice sociale."</span>
      </div>

    </div>
  </section>

  <livewire:pages.galerie />
  <livewire:pages.teams />

  <section id="contact" class="bg-gray-900 text-gray-100 py-24 px-6 md:px-12 border-t border-gray-500">
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-16 items-start">

      <!-- Infos contact -->
      <div class="sr-contact-fade">
        <h2 class="text-4xl font-bold mb-4 text-white">Contactez-nous</h2>
        <p class="text-gray-400 mb-6">
          Une question ? Une collaboration ? Une mission spéciale ? N'hésitez pas à nous écrire. Nous répondrons avec
          loyauté et célérité.
        </p>

        <div class="space-y-4 text-sm text-gray-400">
          <p><strong>Email :</strong> <a href="mailto:commandement@forces-rdc.org"
              class="text-indigo-400 hover:underline">commandement@forces-rdc.org</a></p>
          <p><strong>Téléphone :</strong> +243 000 000 000</p>
          <p><strong>Quartier Général :</strong> Kinshasa, République Démocratique du Congo</p>
        </div>
      </div>

      <!-- Formulaire -->
      <form class="space-y-6 sr-contact-fade">
        <div>
          <label for="name" class="block text-sm font-medium">Nom complet</label>
          <input type="text" id="name"
            class="mt-1 w-full bg-gray-800 border border-gray-700 rounded-md p-3 text-sm placeholder-gray-500 focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="Capitaine Alain Mboko" required>
        </div>

        <div>
          <label for="email" class="block text-sm font-medium">Adresse email</label>
          <input type="email" id="email"
            class="mt-1 w-full bg-gray-800 border border-gray-700 rounded-md p-3 text-sm placeholder-gray-500 focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="vous@exemple.com" required>
        </div>

        <div>
          <label for="message" class="block text-sm font-medium">Message</label>
          <textarea id="message" rows="5"
            class="mt-1 w-full bg-gray-800 border border-gray-700 rounded-md p-3 text-sm placeholder-gray-500 focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="Votre message..." required></textarea>
        </div>

        <div>
          <button type="submit"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-md transition">
            Envoyer le message
          </button>
        </div>
      </form>

    </div>
  </section>

</div>