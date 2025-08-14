<!DOCTYPE html>
<html lang="fr" x-data x-init="$nextTick(() => ScrollReveal().reveal('[data-reveal]', { duration: 1000, distance: '40px', origin: 'bottom' }))" x-cloak>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'FARDC - Forces Armées de la RDC') }}</title>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

    {{-- Vite (CSS + JS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Livewire Styles --}}
    @livewireStyles

    {{-- Toastr CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    {{-- SEO --}}
    <meta name="description" content="Site officiel des Forces Armées de la République Démocratique du Congo. Honneur, Discipline, Engagement.">
    <meta name="keywords" content="FARDC, Armée, RDC, Forces Armées, République Démocratique du Congo, Sécurité, Défense">
    <meta name="author" content="AJADACC">

    {{-- Custom Styles --}}
    @stack('styles')

    <style>
        html { scroll-behavior: smooth; }
        [x-cloak] { display: none !important; }
        /* Marquee animation (optionnel) */
        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
        .animate-marquee {
            display: inline-block;
            animation: marquee 25s linear infinite;
        }
        /* Bounce-in animation */
        @keyframes bounce-in {
            0% { transform: translateY(100%); opacity: 0; }
            60% { transform: translateY(-20%); opacity: 1; }
            80% { transform: translateY(10%); }
            100% { transform: translateY(0); }
        }
        .animate-bounce-in {
            animation: bounce-in 0.6s ease-out;
        }


        .scrollbar-hide {
    -ms-overflow-style: none; /* IE et Edge */
    scrollbar-width: none; /* Firefox */
}
.scrollbar-hide::-webkit-scrollbar {
    display: none; /* Chrome, Safari, Opera */
}

    </style>

    <!-- Ajoutez dans votre CSS Tailwind (si nécessaire) -->
    <style>
    .fade-in {
        opacity: 0;
        animation: fadeIn 1s forwards;
    }
    .fade-out {
        opacity: 1;
        animation: fadeOut 1s forwards;
    }
    @keyframes fadeIn {
        to { opacity: 1; }
    }
    @keyframes fadeOut {
        to { opacity: 0; }
    }
    </style>
    <style>
        .scrollbar-hide {
    -ms-overflow-style: none; /* IE et Edge */
    scrollbar-width: none; /* Firefox */
}
.scrollbar-hide::-webkit-scrollbar {
    display: none; /* Chrome, Safari, Opera */
}

    </style>
</head>

<body class="bg-[#0f172a] text-white font-sans antialiased flex flex-col min-h-screen">

    {{-- Header Livewire --}}
    <livewire:pages.header />

    {{-- Breaking News (Livewire) --}}
    <livewire:pages.info-army />

    {{-- Main Content --}}
    <main class="flex-1">
        {{ $slot }}
    </main>

    {{-- Scroll to Top Button --}}
    <div x-data="{ showTop: false }"
         x-init="window.addEventListener('scroll', () => { showTop = window.scrollY > 300 })"
         x-show="showTop" x-transition
         class="fixed bottom-6 right-6 z-50">
        <button @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="bg-blue-600 hover:bg-blue-800 text-white rounded-full p-4 shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5" />
            </svg>
        </button>
    </div>

    {{-- Footer Livewire --}}
    <livewire:pages.footer />

    {{-- JS Libraries --}}
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script>
        function heroSlider(heroes) {
            return {
                heroes: heroes,
                currentIndex: 0,
                displayedTitle: '',
                displayedSubtitle: '',
                typingSpeed: 100,
                currentCharIndex: 0,
                isTypingTitle: true,
                startTyping() {
                    this.typeNextChar();
                    this.startSlideShow();
                },
                typeNextChar() {
                    let currentHero = this.heroes[this.currentIndex];
                    let text = this.isTypingTitle ? currentHero.title : currentHero.subtitle;

                    if (this.currentCharIndex < text.length) {
                        if (this.isTypingTitle) {
                            this.displayedTitle += text.charAt(this.currentCharIndex);
                        } else {
                            this.displayedSubtitle += text.charAt(this.currentCharIndex);
                        }
                        this.currentCharIndex++;
                        setTimeout(() => this.typeNextChar(), this.typingSpeed);
                    } else {
                        if (this.isTypingTitle) {
                            this.isTypingTitle = false;
                            this.currentCharIndex = 0;
                            setTimeout(() => this.typeNextChar(), 500);
                        }
                    }
                },
                startSlideShow() {
                    setInterval(() => {
                        this.nextSlide();
                    }, 7000); // Change image every 7 seconds
                },
                nextSlide() {
                    this.currentIndex = (this.currentIndex + 1) % this.heroes.length;
                    this.resetTyping();
                },
                resetTyping() {
                    this.displayedTitle = '';
                    this.displayedSubtitle = '';
                    this.currentCharIndex = 0;
                    this.isTypingTitle = true;
                    this.typeNextChar();
                }
            }
        }
    </script>


    {{-- Livewire Scripts --}}
    @livewireScripts

    {{-- Toastr Notifications --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: "4000",
                extendedTimeOut: "1000"
            };

            // Flash messages from session
            @if(session()->has('message'))
                toastr.success("{{ session('message') }}");
            @endif

            @if(session()->has('error'))
                toastr.error("{{ session('error') }}");
            @endif

            // Custom Livewire toastr events
            window.addEventListener('toastr:success', event => {
                toastr.success(event.detail.message);
            });

            window.addEventListener('toastr:error', event => {
                toastr.error(event.detail.message);
            });
        });
    </script>

    {{-- ScrollReveal Animations --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            ScrollReveal().reveal('[data-reveal]', {
                origin: 'bottom',
                distance: '40px',
                duration: 1000,
                delay: 200,
                easing: 'ease-in-out',
                reset: false
            });
        });
    </script>

    <script>
        // Afficher les messages flash via Toastr
        document.addEventListener('DOMContentLoaded', function () {
            @if(session()->has('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if(session()->has('error'))
                toastr.error("{{ session('error') }}");
            @endif
        });
    </script>


    {{-- Custom Scripts --}}
    @stack('scripts')

</body>
</html>
