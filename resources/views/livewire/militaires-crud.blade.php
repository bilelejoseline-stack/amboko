<div class="p-6 bg-gray-900 text-white min-h-screen">
    <h2 class="text-3xl font-bold mb-6">Ajouter un Militaire</h2>

    @if (session()->has('success'))
        <div class="bg-green-500 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        <!-- Informations Militaire -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block">Matricule</label>
                <input type="text" wire:model="militaire.matricule" class="w-full p-2 bg-gray-800 border border-gray-700 rounded" />
                @error('militaire.matricule') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Nom</label>
                <input type="text" wire:model="militaire.nom" class="w-full p-2 bg-gray-800 border border-gray-700 rounded" />
                @error('militaire.nom') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Postnom</label>
                <input type="text" wire:model="militaire.postnom" class="w-full p-2 bg-gray-800 border border-gray-700 rounded" />
                @error('militaire.postnom') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Prénom</label>
                <input type="text" wire:model="militaire.prenom" class="w-full p-2 bg-gray-800 border border-gray-700 rounded" />
                @error('militaire.prenom') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Grade</label>
                <select wire:model="militaire.grade_id" class="w-full p-2 bg-gray-800 border border-gray-700 rounded">
                    <option value="">-- Choisir --</option>
                    @foreach($grades as $grade)
                        <option value="{{ $grade->id }}">{{ $grade->nom_grade }}</option>
                    @endforeach
                </select>
                @error('militaire.grade_id') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Fonction</label>
                <input type="text" wire:model="militaire.fonction" class="w-full p-2 bg-gray-800 border border-gray-700 rounded" />
                @error('militaire.fonction') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Unité</label>
                <input type="text" wire:model="militaire.unite" class="w-full p-2 bg-gray-800 border border-gray-700 rounded" />
                @error('militaire.unite') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Date d'incorporation</label>
                <input type="date" wire:model="militaire.date_incorporation" class="w-full p-2 bg-gray-800 border border-gray-700 rounded" />
                @error('militaire.date_incorporation') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Lieu d'incorporation</label>
                <input type="text" wire:model="militaire.lieu_incorporation" class="w-full p-2 bg-gray-800 border border-gray-700 rounded" />
                @error('militaire.lieu_incorporation') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Date de naissance</label>
                <input type="date" wire:model="militaire.date_naissance" class="w-full p-2 bg-gray-800 border border-gray-700 rounded" />
                @error('militaire.date_naissance') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Lieu de naissance</label>
                <input type="text" wire:model="militaire.lieu_naissance" class="w-full p-2 bg-gray-800 border border-gray-700 rounded" />
                @error('militaire.lieu_naissance') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Sexe</label>
                <select wire:model="militaire.sexe" class="w-full p-2 bg-gray-800 border border-gray-700 rounded">
                    <option value="">-- Sélectionner --</option>
                    <option value="M">Masculin</option>
                    <option value="F">Féminin</option>
                </select>
                @error('militaire.sexe') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">État Civil</label>
                <input type="text" wire:model="militaire.etat_civil" class="w-full p-2 bg-gray-800 border border-gray-700 rounded" />
            </div>

            <div>
                <label class="block">Nom de l'épouse</label>
                <input type="text" wire:model="militaire.epouse" class="w-full p-2 bg-gray-800 border border-gray-700 rounded" />
            </div>

            <div>
                <label class="block">Nom du père</label>
                <input type="text" wire:model="militaire.papa" class="w-full p-2 bg-gray-800 border border-gray-700 rounded" />
                @error('militaire.papa') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Nom de la mère</label>
                <input type="text" wire:model="militaire.maman" class="w-full p-2 bg-gray-800 border border-gray-700 rounded" />
                @error('militaire.maman') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block">Province</label>
                <input type="text" wire:model="militaire.province" class="w-full p-2 bg-gray-800 border border-gray-700 rounded" />
            </div>

            <div>
                <label class="block">Téléphone</label>
                <input type="text" wire:model="militaire.telephone" class="w-full p-2 bg-gray-800 border border-gray-700 rounded" />
            </div>

            <div>
                <label class="block">Adresse</label>
                <input type="text" wire:model="militaire.adresse" class="w-full p-2 bg-gray-800 border border-gray-700 rounded" />
            </div>

            <div>
                <label class="block">Avatar</label>
                <input type="file" wire:model="militaire.avatar" class="w-full p-2 bg-gray-800 border border-gray-700 rounded" />
                @error('militaire.avatar') <span class="text-red-500">{{ $message }}</span> @enderror

                @if ($militaire['avatar'])
                    <img src="{{ $militaire['avatar']->temporaryUrl() }}" class="mt-2 w-32 h-32 object-cover rounded-full" />
                @endif
            </div>
        </div>

        <!-- Enfants -->
        <h3 class="text-xl font-bold mt-8 mb-4">Enfants</h3>
        @foreach($enfants as $index => $enfant)
        <div class="flex items-center justify-between space-x-3">

        <div class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-2 p-4 bg-gray-800 rounded w-full items-center">
            <input type="text" wire:model="enfants.{{ $index }}.nom" placeholder="Nom"
                class="p-2 bg-gray-700 border border-gray-600 rounded w-full" />

            <input type="text" wire:model="enfants.{{ $index }}.postnom" placeholder="Postnom"
                class="p-2 bg-gray-700 border border-gray-600 rounded w-full" />

            <input type="text" wire:model="enfants.{{ $index }}.prenom" placeholder="Prénom"
                class="p-2 bg-gray-700 border border-gray-600 rounded w-full" />

            <input type="date" wire:model="enfants.{{ $index }}.date_naissance"
                class="p-2 bg-gray-700 border border-gray-600 rounded w-full" />

            <input type="text" wire:model="enfants.{{ $index }}.lieu_naissance" placeholder="Lieu de naissance"
                class="p-2 bg-gray-700 border border-gray-600 rounded w-full" />

            <select wire:model="enfants.{{ $index }}.sexe"
                class="p-2 bg-gray-700 border border-gray-600 rounded w-full">
                <option value="">Sexe</option>
                <option value="M">Masculin</option>
                <option value="F">Féminin</option>
            </select>


        </div>
        <!-- Bouton Supprimer aligné à droite -->
        <div class=" ">
            <button type="button" wire:click="removeEnfant({{ $index }})"
                class="text-red-500 hover:underline hover:text-red-400 transition duration-200 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                </svg>
            </button>
        </div>

      </div>

        @endforeach

        <button type="button" wire:click="addEnfant" class="bg-blue-600 px-4 py-2 rounded hover:bg-blue-700">Ajouter un enfant</button>

        <!-- Bouton de soumission -->
        <div class="mt-6">
            <button type="submit" class="bg-green-600 px-6 py-2 rounded text-white hover:bg-green-700">Enregistrer</button>
        </div>
    </form>
</div>
