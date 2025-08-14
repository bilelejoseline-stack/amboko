<div class="relative min-h-screen">

  <!-- Image de fond centrée, sans répétition -->
  <div class="absolute inset-0 bg-center bg-no-repeat bg-cover z-0 opacity-100"
       style="background-image: url('{{ asset('images/bg-auth.jpeg') }}'); background-color: #0f172a;">
  </div>

  <!-- Contenu principal -->
  <div class="relative z-10 px-36 py-10 bg-gray-900 bg-opacity-95 text-gray-100 min-h-screen" data-reveal>

    {{-- En-tête --}}
    <div class="flex items-center justify-between mb-6">
      <img class="rounded-full border border-indigo-500 w-24 h-24" src="{{ asset('images/logo-fardc.png') }}" alt="Logo FARDC" />
      <h2 class="text-2xl text-indigo-700 font-bold border border-indigo-700 bg-gray-900 px-6 py-2 rounded flex items-center space-x-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-file-earmark-bar-graph mr-3" viewBox="0 0 16 16">
          <path d="M10 13.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-6a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5z"/>
          <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
        </svg>
        <span>Nouveau Document</span>
      </h2>
    </div>

    {{-- Message flash --}}
    @if (session()->has('message'))
      <div class="bg-green-700 text-green-100 p-3 rounded mb-4">
        {{ session('message') }}
      </div>
    @endif

    {{-- Formulaire --}}
    <div class="p-6 bg-gray-900 opacity-80 border border-gray-800 text-white rounded-lg shadow-lg">
      <form
          wire:submit.prevent="save"
          x-data="{
            reference: @entangle('reference'),
            objet: @entangle('objet'),
            type_document: @entangle('type_document'),
            date_document: @entangle('date_document'),
            provenance: @entangle('provenance'),
            destinataire: @entangle('destinataire'),
            priorite: @entangle('priorite'),
            description: @entangle('description'),
            formFichier: @entangle('form.fichier'),

            errors: {},

            validateField(field, value) {
              if (!value || value.toString().trim() === '') {
                this.errors[field] = 'Ce champ est obligatoire';
              } else {
                delete this.errors[field];
              }
            },

            validateAll() {
              this.validateField('reference', this.reference);
              this.validateField('objet', this.objet);
              this.validateField('type_document', this.type_document);
              this.validateField('date_document', this.date_document);
              this.validateField('provenance', this.provenance);
              this.validateField('destinataire', this.destinataire);
              this.validateField('priorite', this.priorite);
              this.validateField('description', this.description);

              // Fichier est optionnel, donc pas obligatoire ici mais si tu veux, tu peux vérifier le type/taille

              return Object.keys(this.errors).length === 0;
            },

            submitForm() {
              if (this.validateAll()) {
                $wire.save();
              } else {
                const firstError = Object.keys(this.errors)[0];
                this.$refs[firstError].focus();
              }
            }
          }"
          @submit.prevent="submitForm()"
          class="space-y-6"
      >
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

          {{-- Référence --}}
          <div>
            <label for="reference" class="block text-indigo-500 font-medium">Référence</label>
            <input id="reference" type="text" x-model="reference" x-ref="reference"
                   @input="validateField('reference', reference)"
                   class="w-full px-3 py-2 border rounded bg-gray-800 text-white border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            <template x-if="errors.reference"><span class="text-red-500 text-sm" x-text="errors.reference"></span></template>
            @error('reference') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
          </div>

          {{-- Objet --}}
          <div class="col-span-2">
            <label for="objet" class="block text-indigo-500 font-medium">Objet</label>
            <input id="objet" type="text" x-model="objet" x-ref="objet"
                   @input="validateField('objet', objet)"
                   class="w-full px-3 py-2 border rounded bg-gray-800 text-white border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            <template x-if="errors.objet"><span class="text-red-500 text-sm" x-text="errors.objet"></span></template>
            @error('objet') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
          </div>

          {{-- Type de document --}}
          <div>
            <label for="type_document" class="block text-indigo-500 font-medium">Type de document</label>
            <select id="type_document" x-model="type_document" x-ref="type_document"
                    @change="validateField('type_document', type_document)"
                    class="w-full px-3 py-2 border rounded bg-gray-800 text-white border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
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
            <template x-if="errors.type_document"><span class="text-red-500 text-sm" x-text="errors.type_document"></span></template>
            @error('type_document') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
          </div>

          {{-- Date du document --}}
          <div>
            <label for="date_document" class="block text-indigo-500 font-medium">Date du document</label>
            <input id="date_document" type="date" x-model="date_document" x-ref="date_document"
                   @change="validateField('date_document', date_document)"
                   class="w-full px-3 py-2 border rounded bg-gray-800 text-white border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            <template x-if="errors.date_document"><span class="text-red-500 text-sm" x-text="errors.date_document"></span></template>
            @error('date_document') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
          </div>

          {{-- Provenance --}}
          <div>
            <label for="provenance" class="block text-indigo-500 font-medium">Provenance</label>
            <input id="provenance" type="text" x-model="provenance" x-ref="provenance"
                   @input="validateField('provenance', provenance)"
                   class="w-full px-3 py-2 border rounded bg-gray-800 text-white border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            <template x-if="errors.provenance"><span class="text-red-500 text-sm" x-text="errors.provenance"></span></template>
            @error('provenance') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
          </div>

          {{-- Destinataire --}}
          <div>
            <label for="destinataire" class="block text-indigo-500 font-medium">Destinataire</label>
            <input id="destinataire" type="text" x-model="destinataire" x-ref="destinataire"
                   @input="validateField('destinataire', destinataire)"
                   class="w-full px-3 py-2 border rounded bg-gray-800 text-white border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            <template x-if="errors.destinataire"><span class="text-red-500 text-sm" x-text="errors.destinataire"></span></template>
            @error('destinataire') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
          </div>

          {{-- Priorité --}}
          <div class="col-span-2">
            <label for="priorite" class="block text-indigo-500 font-medium">Priorité</label>
            <select id="priorite" x-model="priorite" x-ref="priorite"
                    @change="validateField('priorite', priorite)"
                    class="w-full px-3 py-2 border rounded bg-gray-800 text-white border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
              <option value="Normale">Normale</option>
              <option value="Basse">Basse</option>
              <option value="Haute">Haute</option>
              <option value="Urgente">Urgente</option>
            </select>
            <template x-if="errors.priorite"><span class="text-red-500 text-sm" x-text="errors.priorite"></span></template>
            @error('priorite') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
          </div>

          {{-- Description --}}
          <div class="col-span-2">
            <label for="description" class="block text-indigo-500 font-medium">Description</label>
            <textarea id="description" x-model="description" x-ref="description" rows="4"
                      @input="validateField('description', description)"
                      class="w-full px-3 py-2 border rounded bg-gray-800 text-white border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                      placeholder="Décrivez brièvement le contenu ou l’objet du document..."></textarea>
            <template x-if="errors.description"><span class="text-red-500 text-sm" x-text="errors.description"></span></template>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
          </div>

          {{-- Fichier (input file) --}}
          <div class="col-span-1" x-data="{ isDragging: false }"
               x-on:dragover.prevent="isDragging = true"
               x-on:dragleave.prevent="isDragging = false"
               x-on:drop.prevent="isDragging = false"
               x-on:drop="$refs.fileInput.files = $event.dataTransfer.files; $dispatch('input')">

            <label for="fileInput" class="block text-indigo-500 font-medium mb-1">Fichier</label>

            <div x-on:click="$refs.fileInput.click()"
                 class="w-full h-24 flex items-center justify-center border-2 border-dashed space-x-3 rounded-lg transition
                        bg-gray-800 text-white border-gray-600 hover:border-blue-500 cursor-pointer"
                 :class="{ 'border-blue-500 bg-gray-700': isDragging }">

              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
              </svg>

              <p class="text-sm">Déposez les fichiers ici ou cliquez pour sélectionner</p>
            </div>

            <input id="fileInput" type="file" wire:model="form.fichier" x-ref="fileInput" class="hidden">

            @error('form.fichier') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <template x-if="formFichier">
              <p class="mt-2 text-green-500 text-sm" x-text="'Fichier sélectionné : ' + formFichier.name"></p>
            </template>

          </div>

        </div>

        {{-- Boutons --}}
        <div class="pt-4 flex items-center justify-between">
          <a href="{{ route('documents.index') }}" class="bg-yellow-400 hover:bg-yellow-700 text-white px-4 py-2 rounded">
            Annuler
          </a>

          <button type="submit"
                  :disabled="Object.keys(errors).length > 0"
                  class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center space-x-2 disabled:opacity-50 disabled:cursor-not-allowed">
            <span>Enregistrer</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
