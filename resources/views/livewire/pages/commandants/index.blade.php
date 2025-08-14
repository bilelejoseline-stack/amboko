<section id="commandants-supremes" class="bg-gray-900 text-gray-100 py-16 px-6 md:px-12">
  <div class="max-w-7xl mx-auto space-y-12">

    <div class="text-center">
      <h2 class="text-4xl font-bold text-yellow-400">Commandants Suprêmes des Armées</h2>
      <p class="mt-2 text-lg text-gray-300">De l’époque de l’ANC à la FARDC – Chefs d’État et Commandants Suprêmes</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

      @forelse($commandants as $cmd)
      <a href="{{ route('commandants.show', $cmd->slug) }}" class="block bg-gray-800 p-6 rounded-2xl shadow-md hover:shadow-lg transition">
        <img src="{{ asset('storage/' . $cmd->image) }}" alt="{{ $cmd->nom }}" class="w-full h-56 object-cover rounded-lg mb-4">
        <h3 class="text-xl font-semibold text-white">{{ $cmd->nom }}</h3>
        <p class="text-sm text-gray-400">{{ $cmd->debut }} – {{ $cmd->fin }}</p>
        <p class="mt-2 text-indigo-500">{{ $cmd->titre }}</p>
      </a>
      @empty
          <div class="mt-10 text-center sr-structure-fade">
            <blockquote class="text-xl italic text-gray-400 border-l-4 border-indigo-500 pl-6 max-w-2xl mx-auto">
              Aucun commandant enregistré pour le moment.
            </blockquote>
          </div>
      @endforelse
    </div>
  </div>
</section>
