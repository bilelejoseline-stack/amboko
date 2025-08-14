<div class="max-w-3xl mx-auto p-6 bg-gray-900 text-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Modifier le Militaire</h2>

    @if (session()->has('success'))
        <div class="bg-green-600 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="update" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1">Matricule</label>
                <input wire:model.defer="matricule" type="text" class="w-full p-2 bg-gray-800 rounded border border-gray-600">
                @error('matricule') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block mb-1">Nom</label>
                <input wire:model.defer="nom" type="text" class="w-full p-2 bg-gray-800 rounded border border-gray-600">
                @error('nom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block mb-1">Post-nom</label>
                <input wire:model.defer="postnom" type="text" class="w-full p-2 bg-gray-800 rounded border border-gray-600">
                @error('postnom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block mb-1">Prénom</label>
                <input wire:model.defer="prenom" type="text" class="w-full p-2 bg-gray-800 rounded border border-gray-600">
                @error('prenom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block mb-1">Grade</label>
                <select wire:model.defer="grade_id" class="w-full p-2 bg-gray-800 rounded border border-gray-600">
                    <option value="">-- Sélectionner un grade --</option>
                    @foreach (\App\Models\Grade::all() as $grade)
                        <option value="{{ $grade->id }}">{{ $grade->nom_grade }}</option>
                    @endforeach
                </select>
                @error('grade_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block mb-1">Fonction</label>
                <input wire:model.defer="fonction" type="text" class="w-full p-2 bg-gray-800 rounded border border-gray-600">
                @error('fonction') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block mb-1">Unité</label>
                <input wire:model.defer="unite" type="text" class="w-full p-2 bg-gray-800 rounded border border-gray-600">
                @error('unite') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block mb-1">Statut</label>
                <select wire:model.defer="statut" class="w-full p-2 bg-gray-800 rounded border border-gray-600">
                    <option value="">-- Choisir statut --</option>
                    <option value="Actif">Actif</option>
                    <option value="Réserve">Réserve</option>
                    <option value="Retraité">Retraité</option>
                </select>
                @error('statut') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded">Mettre à jour</button>
        </div>
    </form>
</div>
