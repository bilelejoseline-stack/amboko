<div class="p-8 min-h-screen flex justify-center items-start" 
     style="background: url('{{ asset('images/bg-auth.jpeg') }}') no-repeat center center/cover; position: relative;">
  <!-- Overlay sombre -->
  <div class="absolute inset-0 bg-black bg-opacity-70 z-0"></div>

  <div class="relative max-w-4xl w-full bg-gray-800 bg-opacity-90 rounded-xl shadow-lg p-6 space-y-4 border border-gray-700 z-10">

        <!-- Titre -->
        <div class="border-b border-gray-600 pb-4 mb-4">
            <h1 class="text-3xl font-extrabold text-yellow-400 flex items-center gap-2">
                ✏️ Modifier le document
            </h1>
            <p class="text-sm text-gray-400 mt-1">
                Utilisateur : {{ Auth::user()->name }}
            </p>
        </div>

        @if (session()->has('message'))
            <div class="mb-4 p-4 bg-green-700 text-white rounded shadow">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="update" class="space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                <!-- Référence -->
                <div>
                    <label class="block text-indigo-300 mb-1">Référence</label>
                    <input type="text" wire:model.defer="reference" class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700">
                    @error('reference') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Objet -->
                <div>
                    <label class="block text-indigo-300 mb-1">Objet</label>
                    <input type="text" wire:model.defer="objet" class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700">
                    @error('objet') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Type de document -->
                <div>
                    <label class="block text-indigo-300 mb-1">Type de document</label>
                    <select wire:model.defer="type_document" class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700">
                        <option value="">-- Sélectionner --</option>
                        <option value="Lettre">Lettre</option>
                        <option value="Rapport">Rapport</option>
                        <option value="Note">Note</option>
                        <option value="Décision">Décision</option>
                        <option value="Ordre de Mission">Ordre de Mission</option>
                        <option value="Instruction">Instruction</option>
                        <option value="Message">Message</option>
                        <option value="Mémo">Mémo</option>
                        <option value="Télégramme">Télégramme</option>
                        <option value="Ordonnance">Ordonnance</option>
                        <option value="Sitrep">Sitrep</option>
                        <option value="Fiche">Fiche</option>
                        <option value="Requête">Requête</option>
                        <option value="Autre">Autre</option>
                    </select>
                    @error('type_document') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Date du Document -->
                <div>
                    <label class="block text-indigo-300 mb-1">Date du Document</label>
                    <input type="date"
                           wire:model.lazy="date_document"
                           class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700"
                           value="{{ $date_document ? \Carbon\Carbon::parse($date_document)->format('Y-m-d') : '' }}">
                    @error('date_document')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    @if($date_document)
                        <p class="text-xs text-gray-400 mt-1">Formaté: {{ \Carbon\Carbon::parse($date_document)->format('d/m/Y') }}</p>
                    @else
                        <p class="text-xs text-red-400 mt-1 italic">Aucune date de document enregistrée.</p>
                    @endif
                </div>


                <!-- Date de Sortie -->
                <div>
                    <label class="block text-indigo-300 mb-1">Date de Sortie</label>
                    <input type="date"
                           wire:model.lazy="date_sortie"
                           class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700"
                           value="{{ $date_sortie ? \Carbon\Carbon::parse($date_sortie)->format('Y-m-d') : '' }}">
                    @error('date_sortie')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    @if($date_sortie)
                        <p class="text-xs text-gray-400 mt-1">Formaté: {{ \Carbon\Carbon::parse($date_sortie)->format('d/m/Y') }}</p>
                    @else
                        <p class="text-xs text-red-400 mt-1 italic">Aucune date de sortie enregistrée.</p>
                    @endif
                </div>


                <!-- Provenance -->
                <div>
                    <label class="block text-indigo-300 mb-1">Provenance</label>
                    <input type="text" wire:model.defer="provenance" class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700">
                    @error('provenance') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Destinataire -->
                <div>
                    <label class="block text-indigo-300 mb-1">Destinataire</label>
                    <input type="text" wire:model.defer="destinataire" class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700">
                    @error('destinataire') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Statut -->
                <div>
                    <label class="block text-indigo-300 mb-1">Statut</label>
                    <select wire:model.defer="statut" class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700">
                        <option value="Enregistré">Enregistré</option>
                        <option value="En attente">En attente</option>
                        <option value="Traite">Traite</option>
                        <option value="Classé">Classé</option>
                    </select>
                    @error('statut') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Priorité -->
                <div>
                    <label class="block text-indigo-300 mb-1">Priorité</label>
                    <select wire:model.defer="priorite" class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700">
                        <option value="Normale">Normale</option>
                        <option value="Basse">Basse</option>
                        <option value="Haute">Haute</option>
                        <option value="Urgente">Urgente</option>
                    </select>
                    @error('priorite') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Mention -->
                <div>
                    <label class="block text-indigo-300 mb-1">Mention</label>
                    <input type="text" wire:model.defer="mention"
                           class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700">
                    @error('mention')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    @if(!empty($mention))
                        <p class="text-xs text-gray-400 mt-1">Mention actuelle : <span class="text-green-400">{{ $mention }}</span></p>
                    @else
                        <p class="text-xs text-red-400 mt-1 italic">Aucune mention saisie pour ce document.</p>
                    @endif
                </div>


                <!-- Fichier -->
                <div class="sm:col-span-2">
                    <label class="block text-indigo-300 mb-1">Fichier</label>
                    <input type="file" wire:model="form.fichier"
                           class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700">
                    @error('form.fichier')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    @if($document->fichier)
                        <p class="mt-2 text-sm text-green-400">
                            Fichier actuel :
                            <a href="{{ asset('storage/' . $document->fichier) }}"
                               class="text-blue-400 underline" target="_blank">
                               Voir le fichier
                            </a>
                        </p>
                    @else
                        <p class="mt-2 text-sm text-red-400 italic">
                            Aucun fichier n’est actuellement associé à ce document.
                        </p>
                    @endif
                </div>


                <!-- Description -->
                <div class="sm:col-span-2">
                    <label class="block text-indigo-300 mb-1">Description</label>
                    <textarea wire:model="description"
                              class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700"></textarea>
                    @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    @if(!empty($description))
                        <p class="text-xs text-gray-400 mt-1">
                            Description actuelle : <span class="text-green-400">{{ $description }}</span>
                        </p>
                    @else
                        <p class="text-xs text-red-400 mt-1 italic">Aucune description saisie pour ce document.</p>
                    @endif
                </div>


                <!-- Observations -->
                <div class="sm:col-span-2">
                    <label class="block text-indigo-300 mb-1">Observations</label>
                    <textarea wire:model="observations"
                              class="w-full px-3 py-2 rounded bg-gray-800 border border-gray-700"></textarea>
                    @error('observations')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    @if(!empty($observations))
                        <p class="text-xs text-gray-400 mt-1">
                            Observations actuelles : <span class="text-green-400">{{ $observations }}</span>
                        </p>
                    @else
                        <p class="text-xs text-red-400 mt-1 italic">Aucune observation n’a encore été ajoutée.</p>
                    @endif
                </div>

            </div>

            <!-- Boutons -->
            <div class="pt-6 flex justify-between">
                <a href="{{ route('documents.index') }}"
                   class="inline-flex items-center text-yellow-400 hover:text-yellow-300 hover:underline font-semibold transition">
                    ← Retour à la liste
                </a>

                <button type="submit" class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg shadow transition">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy mr-3" viewBox="0 0 16 16">
                    <path d="M11 2H9v3h2z"/>
                    <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
                  </svg>
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
