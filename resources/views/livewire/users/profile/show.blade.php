<div class="bg-[#0f172a] text-white rounded-xl shadow-lg p-6 md:p-10 max-w-6xl mx-auto mt-2">
    <h2 class="text-3xl font-bold text-yellow-400 mb-6 flex items-center space-x-4">
      <div class="mr-4">
          <img src="{{ asset('storage/avatars/' . auth()->user()->photo) }}" alt="Avatar"
               class="w-32 h-32 rounded-full border-2 border-yellow-400 mt-2">
      </div>
       Profil de {{ auth()->user()->name }}
     </h2>

    <!-- Tabs -->
    <div x-data="{ tab: 'infos' }" class="space-y-6">
        <div class="flex space-x-4 border-b border-gray-700 pb-2">
            <button @click="tab = 'infos'" :class="{ 'border-b-2 border-yellow-400': tab === 'infos' }"
                class="text-white hover:text-yellow-400 transition px-4 py-2">Informations</button>
            <button @click="tab = 'securite'" :class="{ 'border-b-2 border-yellow-400': tab === 'securite' }"
                class="text-white hover:text-yellow-400 transition px-4 py-2">Sécurité</button>
            <button @click="tab = 'activite'" :class="{ 'border-b-2 border-yellow-400': tab === 'activite' }"
                class="text-white hover:text-yellow-400 transition px-4 py-2">Activité</button>
        </div>

        <!-- Onglet Informations -->
        <div x-show="tab === 'infos'" x-transition>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm text-gray-400">Nom complet</label>
                    <p class="font-semibold">{{ auth()->user()->name }}</p>
                </div>
                <div>
                    <label class="block text-sm text-gray-400">Nom d'utilisateur</label>
                    <p class="font-semibold">{{ auth()->user()->username }}</p>
                </div>
                <div>
                    <label class="block text-sm text-gray-400">Email</label>
                    <p class="font-semibold">{{ auth()->user()->email }}</p>
                </div>
                <div>
                    <label class="block text-sm text-gray-400">Téléphone</label>
                    <p class="font-semibold">{{ auth()->user()->phone }}</p>
                </div>
                <div>
                    <label class="block text-sm text-gray-400">Adresse</label>
                    <p class="font-semibold">{{ auth()->user()->address }}</p>
                </div>
                <div>
                    <label class="block text-sm text-gray-400">Date de naissance</label>
                    <p class="font-semibold">{{ auth()->user()->birthdate }}</p>
                </div>
                <div>
                    <label class="block text-sm text-gray-400">Sexe</label>
                    <p class="font-semibold capitalize">{{ auth()->user()->gender }}</p>
                </div>
                <div>
                    <label class="block text-sm text-gray-400">Grade</label>
                    <p class="font-semibold">{{ auth()->user()->grade }}</p>
                </div>
                <div>
                    <label class="block text-sm text-gray-400">Matricule</label>
                    <p class="font-semibold">{{ auth()->user()->matricule }}</p>
                </div>
                <div>
                    <label class="block text-sm text-gray-400">Rôle</label>
                    <p class="font-semibold">{{ auth()->user()->role }}</p>
                </div>
                <div>
                    <label class="block text-sm text-gray-400">Statut</label>
                    <p class="font-semibold">
                        @if(auth()->user()->is_active)
                            <span class="text-green-400">✅ Actif</span>
                        @else
                            <span class="text-red-400">❌ Inactif</span>
                        @endif
                    </p>
                </div>

            </div>
        </div>

        <!-- Onglet Sécurité -->
        <div x-show="tab === 'securite'" x-transition>
            <h3 class="text-xl font-semibold mb-4 text-yellow-300">🔐 Gérer votre sécurité</h3>
            <p class="text-sm text-gray-400 mb-2">Mot de passe, double authentification et connexions récentes à venir.</p>
            <p class="text-sm text-gray-500 italic">🛠️ Module en développement...</p>
        </div>

        <!-- Onglet Activité -->
        <div x-show="tab === 'activite'" x-transition>
            <h3 class="text-xl font-semibold mb-4 text-yellow-300">📈 Historique d'activité</h3>
            <p class="text-sm text-gray-400 mb-2">Connexion, actions importantes, changements de profil, etc.</p>
            <p class="text-sm text-gray-500 italic">🕵️‍♂️ Module en cours d'intégration...</p>
        </div>
    </div>
</div>
