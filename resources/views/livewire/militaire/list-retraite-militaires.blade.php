<div class="p-12 dark:bg-gray-900 dark:text-gray-100 min-h-screen">
  <div class="p-6 mt-20 bg-gray-900 min-h-screen text-white rounded-lg shadow-lg">



    <!-- FILTRAGE -->
    <div class="mb-6 flex flex-col justify-between md:flex-row md:items-center md:space-x-6 space-y-4 md:space-y-0">

      <!-- Recherche texte -->
      <input
          type="text"
          wire:model.live="search"
          placeholder="Rechercher par nom, matricule, unité..."
          class="form-input rounded border border-gray-700 px-3 py-2 w-full md:w-1/2 bg-gray-800 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
      />

      <!-- TITRE -->
      <h4 class="text-2xl font-bold mb-6 text-indigo-400 tracking-wide">
        Liste des militaires à la retraite (≥ 65 ans de service)
      </h4>
    </div>

    <!-- TABLEAU -->
    <table class="table-auto w-full border-collapse border border-gray-700">
      <thead>
        <tr class="bg-gray-800">
          <th class="border border-gray-700 px-4 py-2 text-left">Matricule</th>
          <th class="border border-gray-700 px-4 py-2 text-left">Nom</th>
          <th class="border border-gray-700 px-4 py-2 text-left">Postnom</th>
          <th class="border border-gray-700 px-4 py-2 text-left">Prénom</th>
          <th class="border border-gray-700 px-4 py-2 text-left">Grade</th>
          <th class="border border-gray-700 px-4 py-2 text-left">Solde</th>
          <th class="border border-gray-700 px-4 py-2 text-left">Unité</th>
          <th class="border border-gray-700 px-4 py-2 text-left">Années Sv</th>
          <th class="border border-gray-700 px-4 py-2 text-left">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($militaires as $militaire)
          <tr class="hover:bg-gray-700">
            <td class="border border-gray-700 px-4 py-2">{{ $militaire->matricule }}</td>
            <td class="border border-gray-700 px-4 py-2">{{ $militaire->nom }}</td>
            <td class="border border-gray-700 px-4 py-2">{{ $militaire->postnom }}</td>
            <td class="border border-gray-700 px-4 py-2">{{ $militaire->prenom }}</td>
            <td class="border border-gray-700 px-4 py-2">{{ optional($militaire->grade)->nom_grade ?? '-' }}</td>
            <td class="border border-gray-700 px-4 py-2">{{ optional($militaire->grade)->solde_base ?? '-' }}</td>
            <td class="border border-gray-700 px-4 py-2">{{ $militaire->unite }}</td>
            <td class="border border-gray-700 px-4 py-2">
              {{ $currentYear - (int) substr($militaire->matricule, 0, 4) }}
            </td>
            <td class="border border-gray-700 px-4 py-2">
              <a href="{{ route('militaire.show', ['slug' => $militaire->slug])}}" class="hover:underline hover:text-indigo-500">Voir</a>
            </td>

          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center py-4">Aucun militaire en retraite trouvé.</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <div class="mt-4">
      {{ $militaires->links() }}
    </div>

  </div>
</div>
