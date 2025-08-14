<div class="p-6 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen">
    <h2 class="text-2xl font-bold mb-6">
        {{ $existingDocument ? 'Modifier le document' : 'Enregistrer un nouveau document' }}
    </h2>

    @if (session()->has('message'))
        <div class="bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-100 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div>
            <label for="reference" class="block font-medium">Référence</label>
            <input type="text" id="reference" wire:model.defer="reference"
                class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100" />
            @error('reference') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="slug" class="block font-medium">Slug (automatique)</label>
            <input type="text" id="slug" value="{{ $slug }}" readonly
                class="mt-1 block w-full rounded bg-gray-100 dark:bg-gray-700 text-gray-500 cursor-not-allowed" />
        </div>

        <div>
            <label for="objet" class="block font-medium">Objet</label>
            <input type="text" id="objet" wire:model.defer="objet"
                class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100" />
            @error('objet') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="type_document" class="block font-medium">Type</label>
            <input type="text" id="type_document" wire:model.defer="type_document"
                class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100" />
            @error('type_document') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="date_document" class="block font-medium">Date du document</label>
            <input type="date" id="date_document" wire:model.defer="date_document"
                class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100" />
        </div>

        <div>
            <label for="date_reception" class="block font-medium">Date de réception</label>
            <input type="date" id="date_reception" wire:model.defer="date_reception"
                class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100" />
        </div>

        <div>
            <label for="date_sortie" class="block font-medium">Date de sortie</label>
            <input type="date" id="date_sortie" wire:model.defer="date_sortie"
                class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100" />
        </div>

        <div>
            <label for="provenance" class="block font-medium">Provenance</label>
            <input type="text" id="provenance" wire:model.defer="provenance"
                class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100" />
        </div>

        <div>
            <label for="destinataire" class="block font-medium">Destinataire</label>
            <input type="text" id="destinataire" wire:model.defer="destinataire"
                class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100" />
        </div>

        <div>
            <label for="statut" class="block font-medium">Statut</label>
            <select id="statut" wire:model.defer="statut"
                class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100">
                <option>Enregistré</option>
                <option>Envoyé</option>
                <option>Archivé</option>
            </select>
        </div>

        <div>
            <label for="priorite" class="block font-medium">Priorité</label>
            <select id="priorite" wire:model.defer="priorite"
                class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100">
                <option>Normale</option>
                <option>Haute</option>
                <option>Urgente</option>
            </select>
        </div>

        <div class="col-span-1 md:col-span-2">
            <label for="mention" class="block font-medium">Mention</label>
            <textarea id="mention" wire:model.defer="mention"
                class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100"></textarea>
        </div>

        <div class="col-span-1 md:col-span-2">
            <label for="observations" class="block font-medium">Observations</label>
            <textarea id="observations" wire:model.defer="observations"
                class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100"></textarea>
        </div>

        <div class="col-span-1 md:col-span-2">
            <label for="fichier" class="block font-medium">Fichier</label>
            <input type="file" id="fichier" wire:model="fichier"
                class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100" />
            @error('fichier') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="col-span-1 md:col-span-2 flex justify-between mt-6">
            <a href="{{ route('documents.index') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
                Retour
            </a>

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                {{ $existingDocument ? 'Mettre à jour' : 'Enregistrer' }}
            </button>
        </div>
    </form>
</div>
