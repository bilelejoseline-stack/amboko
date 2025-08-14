<section id="team" class="bg-gray-800 py-14 px-6 md:px-12 text-gray-100" x-data="{ show: true }" x-init="setInterval(() => { show = false; setTimeout(() => show = true, 400); }, 4000)">
    <div class="max-w-7xl mx-auto space-y-16 text-center">

        <div class="sr-team-fade">
            <h2 class="text-4xl font-extrabold text-white">Notre Équipe</h2>
            <p class="mt-4 text-gray-400 text-lg max-w-2xl mx-auto">
                Des âmes passionnées, des esprits brillants, unis par le devoir et la vision.
            </p>
        </div>

        @if (count($visibleMembers) === 0)
            <div class="text-gray-500 mt-12 sr-team-fade">Aucun membre actif trouvé pour le moment.</div>
        @else
            <div wire:poll.4s="rotateTeam" class="relative sr-team-fade">
                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-8">
                    @foreach ($visibleMembers as $member)
                        <div class="bg-gray-700 pt-20 pb-6 mt-10 px-4 rounded-xl shadow-md text-center relative overflow-visible border-2 border-indigo-900">

                            <!-- Avatar -->
                            <img
                                src="{{ $member['name'] ? asset('storage/' . $member['avatar']) : 'https://via.placeholder.com/300x300?text=Avatar' }}"
                                alt="{{ $member['name'] }}"
                                class="w-32 h-32 rounded-full object-cover shadow-lg absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border-2 border-indigo-900"
                            >

                            <!-- Nom et rôle -->
                            <h4 class="text-lg font-bold text-indigo-400 mt-4">{{ $member['name'] }}</h4>
                            <p class="text-gray-300 text-sm mt-1">{{ $member['role'] }}</p>

                            <!-- Réseaux sociaux -->
                            <div class="mt-4 flex justify-center space-x-4 text-indigo-400">
                                <a href="{{ $member['facebook'] ?? '#' }}" target="_blank" aria-label="Facebook" class="hover:text-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M22 12.07C22 6.48 17.52 2 12 2S2 6.48 2 12.07c0 4.99 3.66 9.13 8.44 9.93v-7.03H7.9v-2.9h2.54v-2.22c0-2.5 1.49-3.88 3.77-3.88 1.09 0 2.23.2 2.23.2v2.46h-1.25c-1.23 0-1.62.77-1.62 1.56v1.88h2.76l-.44 2.9h-2.32v7.03C18.34 21.2 22 17.06 22 12.07z"/>
                                    </svg>
                                </a>
                                <a href="{{ $member['twitter'] ?? '#' }}" target="_blank" aria-label="Twitter" class="hover:text-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23 3a10.9 10.9 0 01-3.14.86 4.48 4.48 0 001.98-2.48 9.07 9.07 0 01-2.88 1.1 4.52 4.52 0 00-7.69 4.13 12.8 12.8 0 01-9.3-4.7 4.51 4.51 0 001.4 6.04 4.49 4.49 0 01-2.05-.56v.06a4.51 4.51 0 003.63 4.43 4.52 4.52 0 01-2.04.08 4.52 4.52 0 004.22 3.13A9.07 9.07 0 012 19.54 12.78 12.78 0 008.29 21c7.55 0 11.68-6.25 11.68-11.66 0-.18-.01-.36-.02-.53A8.18 8.18 0 0023 3z"/>
                                    </svg>
                                </a>
                                <a href="{{ $member['linkedin'] ?? '#' }}" target="_blank" aria-label="LinkedIn" class="hover:text-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M16 8a6 6 0 016 6v6h-4v-6a2 2 0 00-4 0v6h-4v-12h4v2zM2 9h4v12H2V9zM4 4a2 2 0 110 4 2 2 0 010-4z"/>
                                    </svg>
                                </a>
                                <a href="{{ $member['instagram'] ?? '#' }}" target="_blank" aria-label="Instagram" class="hover:text-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7zm10 3a1 1 0 110 2 1 1 0 010-2zm-5 3a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6z"/>
                                    </svg>
                                </a>
                            </div>

                            <!-- Bouton Follow -->
                            <div class="mt-6">
                                <button
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-full transition duration-300 ease-in-out shadow-md hover:shadow-lg"
                                >
                                    + Follow
                                </button>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</section>
