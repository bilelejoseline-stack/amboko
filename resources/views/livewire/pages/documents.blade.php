<div class="p-4 dark:bg-gray-900 dark:text-gray-100 min-h-screen">

    <div class="p-6 mt-18 bg-gray-900 min-h-screen text-white">

      @if (session()->has('message'))
          <div class="bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-100 p-3 rounded mb-4">
              {{ session('message') }}
          </div>
      @endif        <!-- Barre de recherche et bouton -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <div class="w-full md:w-1/3 mb-4 md:mb-0">
                <input type="text" wire:model.live="search" placeholder="Search documents..."
                       class="w-full px-4 py-2 rounded-md border border-gray-600 bg-gray-700 text-white
                              focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <a href="{{ route('documents.create') }}">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                    Add New Document
                </button>
            </a>
        </div>

        <!-- Tableau dynamique des documents -->
        <div class="overflow-x-auto bg-gray-800 rounded-lg shadow">
            <table class="w-full table-auto text-white">
                <thead>
                    <tr class="bg-gray-700 text-gray-200 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Reference</th>
                        <th class="py-3 px-6 text-left">Objet</th>
                        <th class="py-3 px-6 text-left">Type</th>
                        <th class="py-3 px-6 text-left">Date Doc</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-300 text-sm">
                    @forelse ($documents as $doc)
                        <tr class="border-b border-gray-700 hover:bg-gray-600">
                            <td class="py-3 px-6 text-left">{{ $doc->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $doc->reference }}</td>
                            <td class="py-3 px-6 text-left">{{ $doc->objet }}</td>
                            <td class="py-3 px-6 text-left">{{ $doc->type_document }}</td>
                            <td class="py-3 px-6 text-left">{{ $doc->date_document ? \Carbon\Carbon::parse($doc->date_document)->translatedFormat('d F Y') : 'NULL' }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center" x-data="{ confirmDelete: false }">
                                    <a href="{{ route('documents.show', ['slug' => $doc->slug]) }}" class="w-4 mr-2 transform hover:text-blue-400 hover:scale-110">
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                          stroke="currentColor" class="w-5 h-5 mr-2">
                                          <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                      </svg>
                                    </a>
                                    <a href="{{ route('documents.edit', ['slug' => $doc->slug]) }}" class="w-4 mr-2 transform hover:text-blue-400 hover:scale-110">
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                          stroke="currentColor" class="w-5 h-5 mr-2">
                                          <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                      </svg>
                                    </a>

                                    <!-- Bouton Supprimer qui ouvre la modale -->
                                    <button @click="confirmDelete = true" class="w-4 mr-2 transform hover:text-red-400 hover:scale-110">
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                          stroke="currentColor" class="w-5 h-5 mr-2">
                                          <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                      </svg>
                                    </button>

                                    <!-- Modale -->
                                    <div
                                        x-show="confirmDelete"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 scale-90"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-90"
                                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 backdrop-blur-sm z-50"
                                        @click.away="confirmDelete = false"
                                        role="dialog" aria-modal="true" aria-labelledby="modal-title"
                                    >
                                        <div
                                            class="bg-white dark:bg-gray-900 rounded-lg shadow-2xl max-w-md w-full mx-4 p-6
                                                   border border-gray-300 dark:border-gray-700
                                                   flex flex-col"
                                        >
                                            <header class="flex items-center mb-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" />
                                                </svg>
                                                <h2 id="modal-title" class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                                                    Confirmer la suppression
                                                </h2>
                                            </header>

                                            <p class="text-gray-700 dark:text-gray-300 mb-6 leading-relaxed text-center">
                                                Êtes-vous sûr de vouloir supprimer
                                                <span class="font-bold text-red-600 dark:text-red-400">{{ $doc->reference }}</span> ?
                                                Cette action est <span class="italic">irréversible</span>.
                                            </p>

                                            <div class="flex justify-center space-x-4">
                                                <button
                                                    @click="confirmDelete = false"
                                                    class="px-5 py-2 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200
                                                           hover:bg-gray-300 dark:hover:bg-gray-600 transition duration-200 font-medium"
                                                >
                                                    Annuler
                                                </button>

                                                <button
                                                    wire:click="delete({{ $doc->id }})"
                                                    @click="confirmDelete = false"
                                                    class="px-5 py-2 rounded-md bg-red-600 text-white font-semibold
                                                           hover:bg-red-700 dark:hover:bg-red-500 transition duration-200 shadow-md
                                                           focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"
                                                >
                                                    Supprimer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 px-6 text-center text-gray-400">
                                Aucun document trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        <div class="mt-4">
            {{ $documents->links() }}
        </div>

    </div>

</div>
