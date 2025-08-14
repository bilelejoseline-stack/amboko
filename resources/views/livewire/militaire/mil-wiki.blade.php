@php use Carbon\Carbon; @endphp

<div class="max-w-5xl mx-auto bg-white shadow rounded p-8 prose prose-lg">

    <!-- Nom complet et avatar -->
    <h1 class="text-4xl font-bold mb-4 text-center text-gray-900">{{ $militaire->nom_complet }}</h1>

    <div class="flex items-center gap-6 mb-6">
        <img
            src="{{ $militaire->avatar ? asset('storage/' . $militaire->avatar) : asset('images/default-avatar.png') }}"
            alt="Avatar de {{ $militaire->nom_complet }}"
            class="w-32 h-32 rounded-full border object-cover"
        >
        <div>
            <p><strong>Matricule :</strong> {{ $militaire->matricule ?? 'N/A' }}</p>
            <p><strong>Grade Actuel :</strong> {{ $militaire->grade->nom_grade ?? 'Non défini' }}</p>
            <p><strong>Fonction :</strong> {{ $militaire->fonction ?? 'N/A' }}</p>
            <p><strong>Unité :</strong> {{ $militaire->unite ?? 'N/A' }}</p>
            <p><strong>Statut :</strong> {{ $militaire->statut ?? 'N/A' }}</p>
        </div>
    </div>

    <!-- Chronologie -->
    <h2 class="text-2xl font-semibold mt-8 text-gray-800">📅 Chronologie de Service</h2>
    <ul class="timeline pl-6 border-l-2 border-blue-600">
        <li class="mb-4 ml-4">
            <div class="text-sm text-gray-500">{{ optional($militaire->date_incorporation)->format('d/m/Y') ?? 'Date non renseignée' }}</div>
            <div><strong>Incorporation :</strong> à {{ $militaire->lieu_incorporation ?? 'Lieu non renseigné' }}</div>
        </li>

        @php
            $historiques = $militaire->historiques ?? collect();
        @endphp

        @forelse($historiques->sortBy('date_evenement') as $event)
            <li class="mb-4 ml-4">
                <div class="text-sm text-gray-500">{{ optional($event->date_evenement)->format('d/m/Y') ?? 'Date inconnue' }}</div>
                <div><strong>{{ ucfirst($event->type) }} :</strong> {{ $event->description }}</div>
            </li>
        @empty
            <li class="ml-4 text-gray-500">Aucun événement enregistré.</li>
        @endforelse
    </ul>

    <!-- Promotions et Affectations -->
    <h2 class="text-2xl font-semibold mt-8 text-gray-800">🪖 Promotions et Affectations</h2>
    <ul class="list-disc pl-6">
        @forelse($militaire->promotions as $promotion)
            <li>
                <strong>{{ optional($promotion->date_promotion)->format('d/m/Y') ?? 'Date inconnue' }}</strong> :
                Promu au grade de <strong>{{ $promotion->grade->nom_grade ?? 'Grade inconnu' }}</strong>
                ({{ $promotion->motif ?? 'Motif non précisé' }})
            </li>
        @empty
            <li>Pas de promotion enregistrée.</li>
        @endforelse
    </ul>

    <h3 class="text-xl mt-4 text-gray-800">📍 Affectations</h3>
    <ul class="list-disc pl-6">
        @forelse($militaire->affectations as $affectation)
            <li>
                <strong>{{ optional($affectation->date_debut)->format('d/m/Y') ?? 'Date inconnue' }}</strong> à
                <strong>{{ $affectation->unite ?? 'Unité inconnue' }}</strong>
                ({{ $affectation->fonction ?? 'Fonction inconnue' }}),
                {{ $affectation->en_cours ? 'En cours' : 'Terminée le ' . optional($affectation->date_fin)->format('d/m/Y') }}
            </li>
        @empty
            <li>Aucune affectation enregistrée.</li>
        @endforelse
    </ul>

    <!-- Famille -->
    <h2 class="text-2xl font-semibold mt-8 text-gray-800">👨‍👩‍👧 Famille</h2>
    <p><strong>Épouse :</strong> {{ $militaire->epouse ?? 'Non renseigné' }}</p>
    <p><strong>Père :</strong> {{ $militaire->papa ?? 'Non renseigné' }}</p>
    <p><strong>Mère :</strong> {{ $militaire->maman ?? 'Non renseigné' }}</p>

    <h3 class="text-xl mt-4 text-gray-800">Enfants</h3>
    <ul class="list-disc pl-6">
        @forelse ($militaire->enfants as $enfant)
            <li>
                {{ $enfant->nom_complet ?? 'Nom inconnu' }}
                ({{ $enfant->sexe ?? '?' }}, né(e) le {{ optional($enfant->date_naissance)->format('d/m/Y') ?? 'date inconnue' }})
                à {{ $enfant->lieu_naissance ?? 'lieu inconnu' }}
            </li>
        @empty
            <li>Aucun enfant enregistré.</li>
        @endforelse
    </ul>

    <!-- Études et Formations -->
    <h2 class="text-2xl font-semibold mt-8 text-gray-800">🎓 Études et Formations</h2>

    <h3 class="text-xl mt-4 text-gray-800">Études Civiles</h3>
    <ul class="list-disc pl-6">
        @forelse($militaire->etudesCiviles as $etude)
            <li>
                <strong>{{ $etude->diplome ?? $etude->intitule ?? 'Diplôme inconnu' }}</strong> —
                {{ $etude->etablissement ?? 'Établissement inconnu' }},
                {{ $etude->lieu ?? 'Lieu inconnu' }}
                ({{ $etude->annee_obtention ?? optional($etude->date_fin)->format('Y') ?? 'Année inconnue' }})
            </li>
        @empty
            <li>Aucune étude civile enregistrée.</li>
        @endforelse
    </ul>

    <h3 class="text-xl mt-4 text-gray-800">Études Militaires</h3>
    <ul class="list-disc pl-6">
        @forelse($militaire->etudesMilitaires as $formation)
            <li>
                <strong>{{ $formation->titre ?? 'Formation inconnue' }}</strong> —
                {{ $formation->centre ?? 'Centre inconnu' }},
                {{ $formation->pays ?? 'Pays inconnu' }}
                ({{ $formation->annee_obtention ?? optional($formation->date_fin)->format('Y') ?? 'Année inconnue' }})
            </li>
        @empty
            <li>Aucune formation militaire enregistrée.</li>
        @endforelse
    </ul>

    <!-- Spécialités -->
    <h3 class="text-xl mt-4 text-gray-800">🛠️ Spécialités / Compétences</h3>
    <ul class="list-disc pl-6">
        @forelse($militaire->specialites as $specialite)
            <li>{{ $specialite->nom ?? 'Spécialité inconnue' }} — {{ $specialite->description ?? 'Pas de description' }}</li>
        @empty
            <li>Pas de spécialités renseignées.</li>
        @endforelse
    </ul>

    <!-- Dernières paies -->
    <h2 class="text-2xl font-semibold mt-8 text-gray-800">💵 Dernières Paies</h2>
    <table class="table-auto w-full border mt-4">
        <thead class="bg-gray-200 text-gray-800">
            <tr>
                <th class="p-2 border">Mois</th>
                <th class="p-2 border">Année</th>
                <th class="p-2 border">Solde de Base</th>
                <th class="p-2 border">Prime Combat</th>
                <th class="p-2 border">Retenue</th>
                <th class="p-2 border">Net à Payer</th>
            </tr>
        </thead>
        <tbody>
            @foreach($militaire->paies->sortByDesc(fn($p) => $p->annee . str_pad($p->mois, 2, '0', STR_PAD_LEFT))->take(5) as $paie)
                <tr>
                    <td class="p-2 border">{{ Carbon::createFromFormat('m', $paie->mois)->locale('fr')->isoFormat('MMMM') }}</td>
                    <td class="p-2 border">{{ $paie->annee }}</td>
                    <td class="p-2 border">{{ number_format($paie->solde_base, 2, ',', ' ') }} CDF</td>
                    <td class="p-2 border">{{ number_format($paie->prime_combat, 2, ',', ' ') }} CDF</td>
                    <td class="p-2 border">{{ number_format($paie->retenue, 2, ',', ' ') }}</td>
                    <td class="p-2 border">{{ number_format($paie->net_a_payer, 2, ',', ' ') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Télécharger PDF -->
    <div class="mt-8 text-right">
        <a href="{{ route('militaire.export.pdf', $militaire->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Télécharger PDF
        </a>
    </div>

</div>
