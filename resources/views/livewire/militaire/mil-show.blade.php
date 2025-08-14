<div class="max-w-6xl mx-auto p-6 bg-gray-900 text-white rounded-lg shadow-lg space-y-6">
  <!-- Gestion des notifications Alpine.js + toastr -->
<div x-data
     x-init="
        window.addEventListener('toastr', event => {
            const { type, message } = event.detail;
            toastr[type](message);
        });
     ">
</div>
<div class="border border-gray-800">
    <!-- En-tête -->
    <div class="flex items-center justify-between border-b border-gray-800 bg-gray-800  p-2">
        <h2 class="text-2xl font-bold">Fiche Complète du Militaire</h2>
        <a href="{{ route('mil.list') }}" class="text-blue-400 hover:underline">&larr; Retour à la liste</a>
    </div>
    <div class=" p-2">
      <!-- Avatar et Infos principales -->
      <div class="flex items-center space-x-6">
          <img src="{{ $militaire->avatar }}" alt="Avatar" class="w-24 h-24 rounded-full border border-gray-700">
          <div>
              <h3 class="text-xl text-gray-500 font-semibold">{{ $militaire->nom_complet }}</h3>
              <p>Matricule : <span class="font-mono">{{ $militaire->matricule }}</span></p>
              <p>Grade : {{ $militaire->grade->nom_grade ?? 'Non défini' }}</p>
              <p>Unite : {{ $militaire->unite }}</p>
              <p>Statut : {{ $militaire->statut }}</p>
              <p>Code : {{ $militaire->code }}</p>
          </div>
      </div>
    </div>
</div>
    <!-- Conteneur 2 colonnes pour toutes les sections sauf paies -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">

        <!-- Infos personnelles -->
        <div class="border border-gray-800 p-4 ">
          <div class="bg-gray-800 p-2  items-center">
            <h3 class="text-xl font-bold mb-2">Informations personnelles</h3>
          </div>
          <div class="p-2">
            <p><strong>Fonction :</strong> {{ $militaire->fonction }}</p>
            <p><strong>Date d'incorporation :</strong> {{ $militaire->date_incorporation->format('d/m/Y') }}</p>
            <p><strong>Lieu d'incorporation :</strong> {{ $militaire->lieu_incorporation }}</p>
            <p><strong>Date de naissance :</strong> {{ $militaire->date_naissance->format('d/m/Y') }}</p>
            <p><strong>Lieu de naissance :</strong> {{ $militaire->lieu_naissance }}</p>
            <p><strong>Sexe :</strong> {{ $militaire->sexe }}</p>
            <p><strong>État civil :</strong> {{ $militaire->etat_civil }}</p>
          </div>
        </div>

        <!-- Localisation -->
        <div class="border border-gray-800 p-4 ">
          <div class="bg-gray-800 p-2  items-center">
            <h3 class="text-xl font-bold mb-2">Localisation</h3>
          </div>
          <div class="p-2">
            <p><strong>Province :</strong> {{ $militaire->province ?? 'Non défini' }}</p>
            <p><strong>District :</strong> {{ $militaire->district ?? 'Non défini' }}</p>
            <p><strong>Territoire :</strong> {{ $militaire->territoire ?? 'Non défini' }}</p>
            <p><strong>Collectivité :</strong> {{ $militaire->collectivite ?? 'Non défini' }}</p>
            <p><strong>Localité :</strong> {{ $militaire->localite ?? 'Non défini' }}</p>
          </div>
        </div>

        <div class="border border-gray-800 p-4 space-y-4">
          <!-- Promotions -->
          <div class="">
            <div class="bg-gray-800 p-2  items-center">
            <h3 class="text-xl font-bold mb-2">Promotions</h3>
          </div>
          <div class="p-2">
            @if($militaire->promotions->count())
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($militaire->promotions as $promotion)
                        <li>{{ $promotion->grade->nom_grade ?? 'Grade inconnu' }} - {{ $promotion->date_promotion->format('d/m/Y') }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-400">Aucune promotion enregistrée.</p>
            @endif
          </div>
          </div>

            <!-- Affectations -->
            <div class="">
                <div class="bg-gray-800 p-2  items-center">
                <h3 class="text-xl font-bold mb-2">Affectations</h3>
              </div>
              <div class="p-2">
                @if($militaire->affectations->count())
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($militaire->affectations as $affectation)
                            <li>{{ $affectation->fonction }} - {{ $affectation->unite }} ({{ $affectation->date_debut->format('d/m/Y') }})</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-400">Aucune affectation enregistrée.</p>
                @endif
              </div>
            </div>

            <!-- Spécialités -->
            <div class="">
              <div class="bg-gray-800 p-2  items-center">
                <h3 class="text-xl font-bold mb-2">Spécialités</h3>
              </div>
              <div class="p-2">
                @if($militaire->specialites->count())
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($militaire->specialites as $specialite)
                            <li>{{ $specialite->nom }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-400">Aucune spécialité enregistrée.</p>
                @endif
              </div>
            </div>
        </div>





        <!-- Études Militaires -->
        <div class="border border-gray-800 p-4 space-y-4">
          <div>
            <div class="bg-gray-800 p-2  items-center">
            <h3 class="text-xl font-bold mb-2">Études Militaires</h3>
            </div>
            <div class="p-2">
              @if($militaire->etudesMilitaires->count())
                  <ul class="list-disc pl-5 space-y-1">
                      @foreach($militaire->etudesMilitaires as $etude)
                          <li>{{ $etude->diplome }} - {{ $etude->ecole }} ({{ $etude->date_debut->format('Y') }} - {{ $etude->date_fin->format('Y') }})</li>
                      @endforeach
                  </ul>
              @else
                  <p class="text-gray-400">Aucune étude militaire enregistrée.</p>
              @endif
            </div>
          </div>

          <div>
            <!-- Études Civiles -->
            <div class="bg-gray-800 p-2  items-center">
              <h3 class="text-xl font-bold mb-2">Études Civiles</h3>
            </div>
            <div class="p-2">
            @if($militaire->etudesCiviles->count())
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($militaire->etudesCiviles as $etude)
                        <li>{{ $etude->diplome }} - {{ $etude->ecole }} ({{ $etude->date_debut->format('Y') }} - {{ $etude->date_fin->format('Y') }})</li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-400">Aucune étude civile enregistrée.</p>
            @endif
            </div>
          </div>
        </div>

        <!-- Historique Militaire -->
        <div class="border border-gray-800 p-4 ">
          <div>
            <div class="bg-gray-800 p-2  items-center">
              <h3 class="text-xl font-bold mb-2">Historique Militaire</h3>
            </div>
            <div class="p-2 ">
            @if($militaire->historiques->count())
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($militaire->historiques as $historique)
                        <li>{{ $historique->evenement }} - {{ $historique->date_evenement->format('d/m/Y') }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-400">Aucun historique enregistré.</p>
            @endif
          </div>
          </div>
        </div>

        <!-- Infos parentales -->
        <div class="border border-gray-800 p-4">
          <div>
            <div class="bg-gray-800 p-2  items-center">
            <h3 class="text-xl font-bold">Informations familiales</h3>
            </div>
            <div class=" p-2 ">
              <p><strong>Épouse :</strong> {{ $militaire->epouse }}</p>
              <p><strong>Père :</strong> {{ $militaire->papa }}</p>
              <p><strong>Mère :</strong> {{ $militaire->maman }}</p>
              <p><strong>Adresse :</strong> {{ $militaire->adresse }}</p>
              <p><strong>Téléphone :</strong> {{ $militaire->telephone }}</p>
              <p><strong>Créé par :</strong> {{ $militaire->user->name ?? 'Système' }}</p>
            </div>
          </div>
        </div>


        <!-- Enfants -->
        <div class="border border-gray-800 p-4 col-span-2">
          <h3 class="text-xl font-bold mb-2">Enfants</h3>
          @if($militaire->enfants->count())
              <div class="overflow-x-auto">
                  <table class="min-w-full bg-gray-800 text-white ">
                      <thead>
                          <tr class="bg-gray-700 text-left">
                              <th class="p-2">Nom Complet</th>
                              <th class="p-2">Date de Naissance</th>
                              <th class="p-2">Lieu de Naissance</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($militaire->enfants as $enfant)
                              <tr class="border-t border-gray-600">
                                  <td class="p-2">{{ $enfant->nom_complet }}</td>
                                  <td class="p-2">{{ $enfant->date_naissance->format('d/m/Y') }}</td>
                                  <td class="p-2">{{ $enfant->lieu_naissance }}</td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          @else
              <p class="text-gray-400">Aucun enfant enregistré.</p>
          @endif

        </div>



    </div> <!-- fin grille 2 colonnes -->

    <!-- Historique des Paies (plein largeur) -->
    <div class="mt-6">
        <h3 class="text-xl font-bold mb-2">Historique des Paies</h3>
        @if($militaire->paies->count())
            <div class="overflow-x-auto">
                <table class="min-w-full bg-gray-800 text-white rounded-lg">
                    <thead>
                        <tr class="bg-gray-700 text-left">
                            <th class="p-2">Mois</th>
                            <th class="p-2">Année</th>
                            <th class="p-2">Solde</th>
                            <th class="p-2">Prime</th>
                            <th class="p-2">Retenue</th>
                            <th class="p-2">Net à Payer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($militaire->paies as $paie)
                            <tr class="border-t border-gray-600">
                                <td class="p-2">{{ $paie->mois }}</td>
                                <td class="p-2">{{ $paie->annee }}</td>
                                <td class="p-2">{{ number_format($paie->solde_base, 0, ',', ' ') }} CDF</td>
                                <td class="p-2">{{ number_format($paie->prime_combat, 0, ',', ' ') }} CDF</td>
                                <td class="p-2">{{ number_format($paie->retenue, 0, ',', ' ') }} CDF</td>
                                <td class="p-2 font-semibold">{{ number_format($paie->net_a_payer, 0, ',', ' ') }} CDF</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-400">Aucune paie enregistrée.</p>
        @endif
    </div>

    <!-- Actions -->
    <!-- Bouton Supprimer avec modal -->
    <div x-data="{ open: false }" class="flex justify-end space-x-4 mt-6">
        <!-- Boutons classiques -->
        <a href="{{ route('militaire.edit', $militaire->slug) }}" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 rounded">
            Modifier
        </a>
        <a href="{{ route('militaire.wiki', $militaire->slug) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded">
            Fiche Détaillée
        </a>
        <button @click="open = true" class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded text-white">
            Supprimer
        </button>

        <!-- Modal -->
        <div x-show="open" x-cloak
             class="fixed inset-0 bg-black bg-opacity-40 backdrop-blur-sm flex items-center justify-center z-50"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">

            <div class="bg-white text-gray-800 rounded-lg shadow-lg p-6 max-w-md w-full relative">
                <button @click="open = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl">&times;</button>

                <h2 class="text-xl font-bold mb-4">Confirmation</h2>
                <p class="mb-4">
                    Êtes-vous sûr de vouloir supprimer <br>
                    <span class="font-semibold">{{ $militaire->grade->nom_grade }} {{ $militaire->nom_complet }}</span> ?
                    <br><span class="text-red-600 font-medium">Cette action est irréversible.</span>
                </p>

                <div class="flex justify-center space-x-4 mt-4">
                    <button @click="open = false" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded">
                        Annuler
                    </button>

                    <!-- Bouton Confirmer avec wire:loading -->
                    <button
                        wire:click="delete({{ $militaire->id }})"
                        @click="open = false"
                        wire:loading.attr="disabled"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded flex items-center space-x-2">

                        <!-- Spinner lors du chargement -->
                        <svg wire:loading wire:target="delete" class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>

                        <span wire:loading.remove wire:target="delete">Confirmer</span>
                        <span wire:loading wire:target="delete">Suppression...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
