<div class=" bg-gray-900 my-10 border border-gray-800 text-white rounded-lg shadow-md max-w-6xl mx-auto space-y-6">

<div class="flex items-center justify-between border-b border-gray-700 rounded-t-lg p-6 bg-gray-800">
  <!-- Logo -->
  <div class="flex items-center space-x-3">
      <img src="{{ asset('images/logo-fardc.png') }}" alt="Logo FARDC" class="h-12 w-auto">
      <h1 class="text-3xl font-bold text-yellow-400">FARDC</h1>
  </div>
  <h2 class="text-3xl font-bold">Créer un Militaire</h2>

</div>

    <form wire:submit.prevent="save" class="">
      <div class="p-6">
        <!-- Informations de base -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label>Matricule</label>
                <input type="text" wire:model.defer="matricule" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
                @error('matricule') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Nom</label>
                <input type="text" wire:model.defer="nom" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
                @error('nom') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Postnom</label>
                <input type="text" wire:model.defer="postnom" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
                @error('postnom') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Prénom</label>
                <input type="text" wire:model.defer="prenom" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
                @error('prenom') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Grade</label>
                <select wire:model.defer="grade_id" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
                    <option value="">-- Sélectionner --</option>
                    @foreach($grades as $grade)
                        <option value="{{ $grade->id }}">{{ $grade->nom_grade }}</option>
                    @endforeach
                </select>
                @error('grade_id') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Fonction</label>
                <input type="text" wire:model.defer="fonction" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
                @error('fonction') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Unité</label>
                <input type="text" wire:model.defer="unite" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
                @error('unite') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
              <label>Date d'incorporation</label>
              <input type="date" wire:model.defer="date_incorporation" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
              @error('date_incorporation') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
              <label>Lieu d'incorporation</label>
              <input type="text" wire:model.defer="lieu_incorporation" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
              @error('lieu_incorporation') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>


        </div>

        <!-- Localisation et Infos Personnelles -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div>
                <label>Date de Naissance</label>
                <input type="date" wire:model.defer="date_naissance" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
                @error('date_naissance') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Lieu de Naissance</label>
                <input type="text" wire:model.defer="lieu_naissance" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
                @error('lieu_naissance') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Sexe</label>
                <select wire:model.defer="sexe" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
                    <option value="">-- Choisir --</option>
                    <option value="Masculin">Masculin</option>
                    <option value="Féminin">Féminin</option>
                </select>
                @error('sexe') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>État Civil</label>
                <select wire:model.defer="etat_civil" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
                    <option value="Célibataire">Célibataire</option>
                    <option value="Marié(e)">Marié(e)</option>
                    <option value="Veuf(ve)">Veuf(ve)</option>
                </select>
                @error('etat_civil') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Nom de l'Épouse</label>
                <input type="text" wire:model.defer="epouse" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
                @error('epouse') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Nom du Père</label>
                <input type="text" wire:model.defer="papa" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
                @error('papa') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Nom de la Maman</label>
                <input type="text" wire:model.defer="maman" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
                @error('maman') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Province</label>
                <input type="text" wire:model.defer="province" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
                @error('province') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
              <label>District</label>
              <input type="text" wire:model.defer="district" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
              @error('district') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
              <label>Térritoire</label>
              <input type="text" wire:model.defer="territoire" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
              @error('territoire') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
              <label>Collectivité</label>
              <input type="text" wire:model.defer="collectivite" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
              @error('collectivite') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
              <label>Localité</label>
              <input type="text" wire:model.defer="localite" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
              @error('localite') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>


            <div>
                <label>Téléphone</label>
                <input type="text" wire:model.defer="telephone" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
                @error('telephone') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Adresse</label>
                <input type="text" wire:model.defer="adresse" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
                @error('adresse') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
              <label>Avatar</label>
              <input type="file" wire:model.defer="avatar" class="w-full p-2 bg-gray-800 border border-gray-600 rounded">
              @error('avatar') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

        </div>

        <!-- Section des Enfants -->
        <div class="mt-6">
            <h3 class="text-xl font-bold mb-2">Enfants</h3>

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


        </div>

      </div>
      <div class="flex items-center justify-between border-t border-gray-700 rounded-b-lg p-6 bg-gray-800">
        <button type="button" wire:click="addEnfant" class=" bg-green-600 hover:bg-green-700 px-4 py-2 rounded">+ Ajouter Enfant</button>
        <!-- Soumettre -->
        <div class="">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded">Enregistrer</button>
        </div>
      </div>
    </form>
</div>
