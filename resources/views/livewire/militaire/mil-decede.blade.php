<section class="bg-[#1c2321] text-[#c8d5bf] p-6 my-16 rounded-lg shadow-lg max-w-7xl mx-auto">
  <div class="mb-4 flex justify-between items-center">
      <div class="text-2xl font-bold border-b border-[#40503f] pb-2 flex items-center space-x-6">
          <h2>Militaires Décédés</h2>
          <div class="text-yellow-300">Effectif : {{ $effectif }}</div>
      </div>

      <input
          type="text"
          wire:model.live="search"
          placeholder="Recherche matricule, nom, prénom..."
          class="px-3 py-2 rounded border border-gray-600 bg-[#2e3a2f] text-[#c8d5bf] focus:outline-none focus:ring-2 focus:ring-yellow-400"
      />
  </div>


    @if($militaires->isEmpty())
        <p class="text-yellow-400 italic">Aucun militaire décédé trouvé.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse border border-[#40503f]">
                <thead>
                    <tr class="bg-[#40503f]">
                        <th class="border border-[#2e3a2f] px-4 py-1 text-left">Matricule</th>
                        <th class="border border-[#2e3a2f] px-4 py-1 text-left">Nom complet</th>
                        <th class="border border-[#2e3a2f] px-4 py-1 text-left">Date de naissance</th>
                        <th class="border border-[#2e3a2f] px-4 py-1 text-left">Date d’incorporation</th>
                        <th class="border border-[#2e3a2f] px-4 py-1 text-left">Statut</th>
                        <th class="border border-[#2e3a2f] px-4 py-1 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($militaires as $militaire)
                        <tr class="hover:bg-[#4c604d] transition-colors duration-200">
                            <td class="border border-[#2e3a2f] px-4 py-1">{{ $militaire->matricule }}</td>
                            <td class="border border-[#2e3a2f] px-4 py-1">{{ $militaire->prenom }} {{ $militaire->postnom }} {{ $militaire->nom }}</td>
                            <td class="border border-[#2e3a2f] px-4 py-1">{{ \Carbon\Carbon::parse($militaire->date_naissance)->format('d/m/Y') }}</td>
                            <td class="border border-[#2e3a2f] px-4 py-1">{{ \Carbon\Carbon::parse($militaire->date_incorporation)->format('d/m/Y') }}</td>
                            <td class="border border-[#2e3a2f] px-4 py-1">{{ $militaire->statut }}</td>
                            <td class="border border-[#2e3a2f] px-4 py-1">
                              <a href="{{ route('militaire.show', ['slug' => $militaire->slug])}}" class="hover:underline hover:text-yellow-300">Voir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $militaires->links() }}
        </div>
    @endif
</section>
