<section x-data="{
    sidebarOpen: false,
    notificationsOpen: false,
    darkMode: true,
}" :class="darkMode ? 'bg-[#1c2321] text-[#c8d5bf]' : 'bg-gray-100 text-gray-900'" class="min-h-screen flex font-sans">

  {{-- Sidebar --}}
  <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
         class="fixed inset-y-0 left-0 w-64 bg-[#2e3a2f] md:translate-x-0 transform transition-transform duration-300 z-50 border-r border-[#40503f]">
    <div class="px-4 py-6 text-xl font-extrabold tracking-widest  text-[#a0b489] uppercase">
      FARDC Command
    </div>
    <nav class="mt-6 space-y-2">
      <a href="#" class="flex items-center px-4 py-2 rounded hover:bg-[#4c604d] transition-colors duration-200">
        <x-heroicon-o-chart-bar class="w-5 h-5 mr-3 text-[#a0b489]" />
        Tableau de bord
      </a>

      <a href="#" class="flex items-center px-4 py-2 rounded hover:bg-[#4c604d] transition-colors duration-200">
        <x-heroicon-o-users class="w-5 h-5 mr-3 text-[#a0b489]" />
        Soldats
      </a>

      <a href="#" class="flex items-center px-4 py-2 rounded hover:bg-[#4c604d] transition-colors duration-200">
        <x-heroicon-o-cube-transparent class="w-5 h-5 mr-3 text-[#a0b489]" />
        Missions
      </a>

      <a href="#" class="flex items-center px-4 py-2 rounded hover:bg-[#4c604d] transition-colors duration-200">
        <x-heroicon-o-truck class="w-5 h-5 mr-3 text-[#a0b489]" />
        Véhicules
      </a>

      <a href="#" class="flex items-center px-4 py-2 rounded hover:bg-[#4c604d] transition-colors duration-200">
        <x-heroicon-o-shield-check class="w-5 h-5 mr-3 text-[#a0b489]" />
        Zones sécurisées
      </a>

      <a href="#" class="flex items-center px-4 py-2 rounded hover:bg-[#4c604d] transition-colors duration-200">
        <x-heroicon-o-map class="w-5 h-5 mr-3 text-[#a0b489]" />
        Carte tactique
      </a>

      <a href="#" class="flex items-center px-4 py-2 rounded hover:bg-[#4c604d] transition-colors duration-200">
        <x-heroicon-o-cog class="w-5 h-5 mr-3 text-[#a0b489]" />
        Paramètres
      </a>

      <a href="#" class="flex items-center px-4 py-2 rounded hover:bg-[#4c604d] transition-colors duration-200">
        <x-heroicon-o-document class="w-5 h-5 mr-3 text-[#a0b489]" />
        Rapports
      </a>
    </nav>
  </aside>

  {{-- Main content --}}
  <div class="flex-1 flex flex-col md:ml-64 transition-all duration-300">

    {{-- Header --}}
    <header :class="darkMode ? 'bg-[#2e3a2f] border-[#40503f]' : 'bg-white border-gray-300'" class="border-b p-4 flex justify-between items-center">
      <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-[#a0b489] hover:text-[#d3dcbc]">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
        </svg>
      </button>

      <h1 :class="darkMode ? 'text-[#a0b489]' : 'text-gray-900'" class="text-2xl font-semibold tracking-wide">Dashboard Commandant</h1>

      <div class="flex items-center space-x-4">

        {{-- Mode toggle --}}
        <button @click="darkMode = !darkMode"
          :class="darkMode ? 'text-[#a0b489]' : 'text-gray-700'"
          class="focus:outline-none"
          title="Basculer mode clair/sombre"
        >
          <template x-if="darkMode">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.66-11.66l-.7.7M4.34 19.66l-.7.7M21 12h-1M4 12H3m15.36 6.36l-.7-.7M6.34 6.34l-.7-.7"/>
              <circle cx="12" cy="12" r="5" stroke="currentColor" stroke-width="2" fill="none"/>
            </svg>
          </template>
          <template x-if="!darkMode">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" stroke="none">
              <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
            </svg>
          </template>
        </button>

        {{-- Notifications --}}
        <div class="relative" x-data="{ open: false }">
          <button @click="open = !open" class="relative focus:outline-none" title="Notifications">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
              <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-5-5.917V4a1 1 0 10-2 0v1.083A6 6 0 006 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">3</span>
          </button>

          <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-64 bg-[#2e3a2f] border border-[#40503f] rounded shadow-lg z-50 p-2 text-sm space-y-1">
            <div class="px-3 py-2 border-b border-[#40503f] font-semibold text-[#a0b489]">Alertes</div>
            <a href="#" class="block px-3 py-2 hover:bg-[#4c604d] rounded">Mouvement suspect détecté - Zone Est</a>
            <a href="#" class="block px-3 py-2 hover:bg-[#4c604d] rounded">Demande d’appui - Unité Alpha</a>
            <a href="#" class="block px-3 py-2 hover:bg-[#4c604d] rounded">Maintenance véhicule - VH-085</a>
          </div>
        </div>

        {{-- Utilisateur --}}
        <div x-data="{ open: false }" class="relative inline-block text-left">
          <div
              @mouseenter="open = true"
              @mouseleave="open = false"
              class="flex items-center cursor-pointer space-x-3 select-none"
          >
            <img
                src="{{ asset('storage/avatars/' . auth()->user()->avatar) }}"
                alt="Avatar"
                class="w-10 h-10 rounded-full object-cover border-2 border-[#40503f]"
                onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=4c604d&color=c8d5bf&rounded=true';"
            />
            <div class="text-[#c8d5bf] text-sm leading-tight">
              <div>Bienvenue, <span class="font-semibold">{{ auth()->user()->name }}</span></div>
              <div class="text-[#a0b489] text-xs">
                Rôle : {{ auth()->user()->role === 'super_admin' ? 'Super Admin' : auth()->user()->role }}
              </div>
            </div>
            <svg :class="{'rotate-180': open}" class="w-4 h-4 text-[#a0b489] transform transition-transform duration-300"
                 fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
          </div>
          <div
              x-show="open"
              x-transition
              @mouseenter="open = true"
              @mouseleave="open = false"
              class="absolute right-0 mt-2 w-48 bg-[#2e3a2f] border border-[#40503f] rounded-lg shadow-lg z-50 text-[#c8d5bf]"
          >
              <a href="#" class="block px-4 py-2 hover:bg-[#4c604d]">Profil</a>

              @auth
                  @if (auth()->user()->role === 'admin' || auth()->user()->role === 'super_admin')
                      <a href="/admin" class="block px-4 py-2 text-sm text-yellow-400 hover:bg-yellow-600 hover:text-white transition">
                          Paramètres
                      </a>
                      <a href="{{ route('mil.list') }}" class="block px-4 py-2 text-sm text-yellow-400 hover:bg-yellow-600 hover:text-white transition">
                          Mil
                      </a>
                      <a href="{{ route('mil.retraite') }}" class="block px-4 py-2 text-sm text-yellow-400 hover:bg-yellow-600 hover:text-white transition">
                          Mil Retraités
                      </a>
                      <a href="{{ route('mil.decede') }}" class="block px-4 py-2 text-sm text-yellow-400 hover:bg-yellow-600 hover:text-white transition">
                          Mil DCD
                      </a>
                      <a href="{{ route('documents.index') }}" class="block px-4 py-2 text-sm text-yellow-400 hover:bg-yellow-600 hover:text-white transition">
                          Document
                      </a>
                  @endif
              @endauth

              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="w-full text-left px-4 py-2 text-red-500 hover:bg-[#4c604d]">Déconnexion</button>
              </form>
          </div>

        </div>
      </div>
    </header>

    {{-- Main dashboard --}}
    <main class="p-6 grid gap-6 grid-cols-1 md:grid-cols-4 text-[#c8d5bf]">

      {{-- Stats --}}
      <div
        x-data="countUpOnVisible(1245)"
        x-init="init()"
        class="bg-[#3c4a3c] p-6 rounded-lg shadow-lg sr-card border border-[#40503f]"
      >
        <div class="text-sm uppercase text-[#a0b489] tracking-widest">Soldats actifs</div>
        <div class="mt-2 text-7xl font-extrabold" x-text="displayValue">0</div>
      </div>

      <div
        x-data="countUpOnVisible(1280)"
        x-init="init()"
        class="bg-[#3c4a3c] p-6 rounded-lg shadow-lg sr-card border border-[#40503f]"
      >
        <div class="text-sm uppercase text-[#a0b489] tracking-widest">Missions en cours</div>
        <div class="mt-2 text-7xl font-extrabold" x-text="displayValue">0</div>
      </div>

      <div
        x-data="countUpOnVisible(85)"
        x-init="init()"
        class="bg-[#3c4a3c] p-6 rounded-lg shadow-lg sr-card border border-[#40503f]"
      >
        <div class="text-sm uppercase text-[#a0b489] tracking-widest">Véhicules déployés</div>
        <div class="mt-2 text-7xl font-extrabold" x-text="displayValue">0</div>
      </div>

      {{-- Boutons d’actions rapides --}}
      <div class="bg-[#3c4a3c] p-6 rounded-lg shadow-lg border border-[#40503f] flex flex-col justify-center space-y-4">
        <button class="w-full py-2 bg-[#4c604d] hover:bg-[#6a875d] rounded font-semibold transition">+ Ajouter Soldat</button>
        <button class="w-full py-2 bg-[#4c604d] hover:bg-[#6a875d] rounded font-semibold transition">Générer Rapport</button>
        <button class="w-full py-2 bg-[#4c604d] hover:bg-[#6a875d] rounded font-semibold transition">Exporter Données</button>
      </div>

    </main>

  </div>

  @push('scripts')
  <script>
    function countUpOnVisible(target) {
      return {
        target,
        displayValue: 0,
        observer: null,
        intervalId: null,

        init() {
          this.observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
              if (entry.isIntersecting) {
                this.startCountUp();
                this.observer.disconnect();
              }
            });
          }, { threshold: 0.6 });

          this.observer.observe(this.$el);
        },

        startCountUp() {
          let start = 0;
          const duration = 1500; // ms
          const frameRate = 60;
          const totalFrames = Math.round(duration / (1000 / frameRate));
          let frame = 0;

          this.intervalId = setInterval(() => {
            frame++;
            const progress = frame / totalFrames;
            let currentValue = Math.floor(this.target * progress);

            this.displayValue = currentValue.toLocaleString();

            if (frame >= totalFrames) {
              this.displayValue = this.target.toLocaleString();
              clearInterval(this.intervalId);
            }
          }, 1000 / frameRate);
        }
      }
    }

  </script>

    <script>
      ScrollReveal().reveal('.sr-card', { origin: 'bottom', distance: '20px', duration: 600, interval: 100 });
    </script>
  @endpush

</section>
