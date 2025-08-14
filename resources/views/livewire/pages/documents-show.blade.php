<div class="p-8 bg-gray-900 text-gray-100 min-h-screen relative" style="background: url('{{ asset('images/bg-auth.jpeg') }}') no-repeat center center/cover;">
  <!-- Overlay sombre -->
  <div class="absolute inset-0 bg-black bg-opacity-70 z-0"></div>

  <!-- Contenu principal -->
  <div class="relative z-10 max-w-4xl mx-auto bg-gray-800 rounded-xl shadow-lg p-6 space-y-4 border border-gray-700">

    <!-- Titre -->
    <div class="border-b border-gray-600 pb-4 mb-4">
      <h1 class="text-3xl font-extrabold text-yellow-400 flex items-center gap-2">
        📄 {{ $document->objet }}
      </h1>
      <p class="text-sm text-gray-400 mt-1">
        Consulté le {{ now()->format('d/m/Y à H:i') }}
      </p>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto mt-4">
      <table class="w-full table-auto border border-gray-600 text-sm bg-gray-900 text-white">
        <tbody>
          @php
            $fields = [
              'Objet' => $document->objet,
              'Référence' => $document->reference,
              'Date Doc' => $document->date_document ? \Carbon\Carbon::parse($document->date_document)->translatedFormat('d F Y') : null,
              'Date Réception' => $document->date_reception ? \Carbon\Carbon::parse($document->date_reception)->translatedFormat('d F Y') : null,
              'Date Sortie' => $document->date_sortie ? \Carbon\Carbon::parse($document->date_sortie)->translatedFormat('d F Y') : null,
              'Type' => $document->type_document,
              'Statut' => $document->statut,
              'Provenance' => $document->provenance,
              'Destinataire' => $document->destinataire,
              'Description' => $document->description,
              'Mention' => $document->mention,
              'Utilisateur' => $document->user->name ?? null,
              'Observations' => $document->observations,
            ];
          @endphp

          @foreach($fields as $label => $value)
            <tr class="border-b border-gray-600">
              <td class="font-semibold text-indigo-300 px-4 py-2">{{ $label }}</td>
              <td class="px-4 py-2">{{ $value ?? 'NULL' }}</td>
            </tr>
          @endforeach

          <!-- Priorité spécifique avec couleur -->
          <tr class="border-b border-gray-600">
            <td class="font-semibold text-indigo-300 px-4 py-2">Priorité</td>
            <td class="px-4 py-2">
              <span class="{{
                $document->priorite === 'Urgente' ? 'text-red-400 font-bold' :
                ($document->priorite === 'Haute' ? 'text-orange-400' :
                ($document->priorite === 'Basse' ? 'text-green-400' : 'text-gray-400')) }}">
                {{ $document->priorite ?? 'NULL' }}
              </span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Fichier joint -->
    @if ($document->fichier)
      <div class="mt-6 bg-gray-700 p-4 rounded-lg flex flex-col sm:flex-row items-start sm:items-center gap-4">
        <div class="flex items-center gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          <span class="text-sm font-medium text-gray-200">Fichier prêt au téléchargement</span>
        </div>

        <a href="{{ asset('storage/documents/' . $document->fichier) }}"
           class="inline-flex items-center bg-blue-600 hover:bg-blue-800 text-white font-semibold px-4 py-2 rounded-lg transition shadow"
           target="_blank" download>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
          </svg>
          Télécharger
        </a>
      </div>
    @endif

    <!-- Actions -->
    <div class="pt-6 flex justify-between gap-4">
      <a href="{{ route('documents.index') }}"
         class="inline-flex items-center text-yellow-400 hover:text-yellow-300 hover:underline font-semibold transition">
        ← Retour à la liste
      </a>

      <a href="{{ route('documents.edit', ['slug' => $document->slug]) }}"
         class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg shadow transition">
         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square mr-3" viewBox="0 0 16 16">
           <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
           <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
         </svg>
        Modifier
      </a>
    </div>

  </div>
</div>
