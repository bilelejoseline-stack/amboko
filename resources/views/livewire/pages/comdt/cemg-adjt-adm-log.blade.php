<!-- SECTION: Présentation EMG Adjt Adm Log -->
<section class="bg-gray-900 py-12 px-6 md:px-24" x-data="{ open: false }" x-init="ScrollReveal().reveal('.reveal', { delay: 200, distance: '50px', origin: 'bottom', duration: 1000 });">
  <div class="text-center mb-12">
    <h2 class="text-4xl font-extrabold text-white reveal">EMG Adjt Adm Log</h2>
    <p class="text-lg text-gray-300 mt-2 reveal">Maillon stratégique des FARDC : Administration & Logistique</p>
  </div>

  <!-- Figures emblématiques -->
  <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
    <template x-for="person in [
      { name: 'Général Léon Richard Kasonga', img: 'https://b-onetv.cd/fardc-le-lieutenant-general-kasonga-cibangu-promu-chef-emg-adjt.jpg', date: 'Depuis 2022' },
      { name: 'Général Célestin Mbala Munsense', img: 'https://upload.wikimedia.org/wikipedia/commons/c/c9/Celestin_Mbala.jpg', date: '2014 - 2018' },
      { name: 'Général Jean-Lucien Bahuma', img: 'https://provincenordkivu.cd/entree-des-fardc-a-goma/images/bahuma.jpg', date: '2009 - 2014' },
      { name: 'Général Jules Banza Mwilambwe', img: 'https://kivutimes.com/le-chef-de-letat-major-general-adjoint.jpg', date: 'Depuis 2023' }
    ]" :key="person.name">
      <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg reveal">
        <img :src="person.img" class="h-56 w-full object-cover" :alt="person.name">
        <div class="p-4">
          <h3 class="text-lg font-bold text-white">[[ person.name ]]</h3>
          <p class="text-sm text-gray-400">[[ person.date ]]</p>
        </div>
      </div>
    </template>
  </div>

  <!-- Attributions du CEMG Adjt Adm Log -->
  <section class="bg-gray-900 text-gray-200 rounded-xl p-10 shadow-xl mb-16 reveal border border-gray-800" x-data x-init="ScrollReveal().reveal($el, { delay: 100, distance: '50px', origin: 'bottom' })">

    <!-- Titre principal -->
    <h3 class="text-3xl font-bold text-white mb-6">🎖️ Attributions du CEMG Adjt Adm Log</h3>

    <!-- Introduction -->
    <p class="text-gray-300 text-lg leading-relaxed mb-8">
      Le Chef d’État-Major Général Adjoint chargé de l’Administration et de la Logistique est le maillon silencieux mais essentiel de la structure militaire.
      À la croisée des chemins entre les ressources humaines et les moyens matériels, il assure le soutien intégral des forces en campagne comme en garnison.
    </p>

    <!-- Grille des attributions -->
    <div class="grid md:grid-cols-2 gap-6">

      <!-- Carte 1 -->
      <div class="bg-gray-700 rounded-lg p-6">
        <h4 class="text-xl font-semibold text-white mb-4">🏛️ Position hiérarchique et rôle central</h4>

        <p class="text-gray-300 mb-4">
          Comprendre le cœur stratégique de l’appareil militaire administratif et logistique des <strong>FARDC</strong> permet d’appréhender la portée du rôle du
          <strong>Chef d’État-Major Général Adjoint chargé de l’Administration et de la Logistique</strong> (CEMG Adjt Adm Log).
        </p>

        <p class="text-gray-300 mb-4">
          Dans la pyramide du commandement, il occupe une <span class="text-yellow-400 font-semibold">position charnière</span> : il est le
          <strong>deuxième dans la hiérarchie des Chefs Adjoints</strong>, aux côtés de son homologue chargé des
          <strong>Opérations et du Renseignement</strong>. À ce titre, il épaule directement le <strong>Chef d’État-Major Général</strong>.
        </p>

        <p class="text-gray-300 mb-4">
          Son autorité s’étend sur deux domaines cruciaux :
          <span class="text-white font-semibold">l’administration du personnel militaire</span> et
          <span class="text-white font-semibold">la logistique des forces</span>, tant en garnison qu’en opérations.
        </p>

        <ul class="list-disc pl-5 text-gray-300 space-y-2 mb-4">
          <li>Il coordonne les structures administratives et logistiques de toutes les composantes des FARDC.</li>
          <li>Il est l’interface directe entre les commandements territoriaux, les services centraux et le Haut Commandement.</li>
          <li>Il supervise les Chefs de Sous-État-Major (SEM) en charge de l’administration et de la logistique.</li>
          <li>Il participe aux décisions stratégiques avec un regard axé sur la soutenabilité des opérations.</li>
        </ul>

        <p class="italic text-gray-400">
          Sans ce poste, aucune armée ne tient dans la durée. Il ne fait pas la guerre en première ligne, mais il rend la guerre possible, soutenable et victorieuse.
        </p>
      </div>


      <!-- Carte 2 -->
      <div class="bg-gray-700 rounded-lg p-6">
        <h4 class="text-xl font-semibold text-white mb-2">🧑‍💼 Administration militaire</h4>
        <p class="text-gray-300 mb-4">
          Le Sous-État-Major de l’Administration (SEMA) est l’épine dorsale de la gestion du personnel militaire, assurant la continuité et la discipline au sein des FARDC.
        </p>
        <ul class="list-disc pl-5 text-gray-300 space-y-2">
          <li>Gestion complète des dossiers individuels des militaires (carrières, grades, décorations).</li>
          <li>Organisation des affectations, mutations, promotions et départs à la retraite.</li>
          <li>Suivi disciplinaire et encadrement administratif de toutes les unités.</li>
          <li>Gestion des pensions militaires et des ayants droit.</li>
          <li>Administration des hôpitaux militaires, écoles militaires, foyers, casernes, etc.</li>
          <li>Veille à la conformité réglementaire et au respect des procédures internes.</li>
        </ul>
        <p class="mt-4 italic text-gray-400">
          Il incarne l’ordre dans la vie militaire quotidienne, garantissant que chaque soldat soit reconnu, encadré, soutenu.
        </p>
      </div>


      <!-- Carte 3 -->
      <div class="bg-gray-700 rounded-lg p-6">
        <h4 class="text-xl font-semibold text-white mb-4">🏗️ Logistique opérationnelle</h4>

        <p class="text-gray-300 mb-4">
          La <span class="text-yellow-400 font-semibold">logistique</span> n’est pas un simple appui, c’est l’ossature invisible qui permet à l’armée de se mouvoir, de frapper, de résister.
          Le <strong>Chef EMG Adjt Adm Log</strong> est à la tête de cette machinerie silencieuse, garantissant la présence effective des moyens nécessaires à chaque mission militaire.
        </p>

        <p class="text-gray-300 mb-4">
          Son rôle couvre l’ensemble du cycle logistique, depuis la planification des besoins jusqu’à la livraison sur les lignes avancées.
          Rien ne bouge sans lui : pas de munitions, pas de transport, pas d’abris, pas de ravitaillement. Sa vision stratégique assure à la fois l’autonomie et la pérennité des forces armées.
        </p>

        <ul class="list-disc pl-6 text-gray-300 space-y-2 mb-4">
          <li><span class="font-medium text-white">Approvisionnement</span> : acquisition et distribution des ressources vitales (armes, munitions, tenues, équipements spéciaux).</li>
          <li><span class="font-medium text-white">Maintenance</span> : entretien et réparation des véhicules, armements, installations techniques et systèmes critiques.</li>
          <li><span class="font-medium text-white">Infrastructures</span> : supervision des casernes, dépôts logistiques, hôpitaux militaires, zones de transit et d’opérations.</li>
          <li><span class="font-medium text-white">Transport stratégique</span> : coordination des mouvements terrestres, aériens et fluviaux des troupes et matériels.</li>
          <li><span class="font-medium text-white">Gestion des stocks</span> : contrôle rigoureux des inventaires, vivres, carburants, matériels sanitaires et pièces de rechange.</li>
          <li><span class="font-medium text-white">Soutien en opérations</span> : projection logistique sur le terrain, y compris dans les zones de combat, en temps réel.</li>
        </ul>

        <p class="text-gray-400 italic">
          « Une armée affamée ne combat pas. Une armée sans essence ne se déplace pas. Une armée sans soutien logistique ne gagne jamais. »
          – Doctrine implicite du Chef EMG Adjt Adm Log
        </p>
      </div>


      <!-- Carte 4 -->
      <div class="bg-gray-700 rounded-lg p-6">
        <h4 class="text-xl font-semibold text-white mb-4">🔗 Coordination interservices</h4>

        <p class="text-gray-300 mb-4">
          La force de l’armée repose sur sa capacité à fonctionner comme un tout. Le <span class="text-yellow-400 font-semibold">Chef EMG Adjt Adm Log</span> est le point nodal entre les différents services et structures des FARDC. Il orchestre les interactions entre l’administration, la logistique, les finances, la santé, l’éducation militaire et les unités opérationnelles.
        </p>

        <p class="text-gray-300 mb-4">
          Il veille à la <span class="font-medium text-white">synergie</span> entre les sous-chefferies, les commandements territoriaux, les bases logistiques, et les écoles militaires pour garantir la fluidité des opérations et la cohérence des décisions. Rien ne doit être cloisonné : tout doit communiquer, se renforcer, s’aligner.
        </p>

        <ul class="list-disc pl-6 text-gray-300 space-y-2 mb-4">
          <li><span class="font-medium text-white">Harmonisation des ordres</span> entre les directions spécialisées (santé, matériel, finances, intendance...)</li>
          <li><span class="font-medium text-white">Interface directe</span> avec le Chef d’État-Major Général pour les besoins critiques interarmées.</li>
          <li><span class="font-medium text-white">Veille sur l’application</span> des directives dans les régions militaires, brigades et bataillons.</li>
          <li><span class="font-medium text-white">Gestion des urgences logistiques</span> en coordination avec le Chef EMG Ops/Rens.</li>
          <li><span class="font-medium text-white">Appui administratif</span> aux services de renseignement, opérations et formation.</li>
        </ul>

        <p class="text-gray-400 italic">
          « Une armée unifiée est une armée victorieuse. Le lien entre ses organes, c’est le cœur administratif et logistique. »<br>
          – Vision stratégique du Chef EMG Adjt Adm Log
        </p>
      </div>

      <!-- Carte 5 -->
      <div class="bg-gray-700 rounded-lg p-6">
        <h4 class="text-xl font-semibold text-white mb-4">📊 Appui stratégique</h4>

        <p class="text-gray-300 mb-4">
          En tant que cerveau logistique et administratif de l’armée, le <span class="text-yellow-400 font-semibold">Chef EMG Adjt Adm Log</span> joue un rôle de conseiller stratégique. Il ne se limite pas à la gestion quotidienne : il <span class="font-medium text-white">oriente les grandes décisions</span> militaires par des analyses, projections et recommandations de fond.
        </p>

        <p class="text-gray-300 mb-4">
          Il alimente l’État-Major Général en <span class="text-white font-medium">données fiables</span> : états du personnel, niveaux d’approvisionnement, capacités opérationnelles, besoins logistiques projetés, et risques liés à l’usure ou au moral des troupes.
        </p>

        <ul class="list-disc pl-6 text-gray-300 space-y-2 mb-4">
          <li><span class="text-white font-medium">Rapports périodiques</span> sur la condition humaine et matérielle des forces</li>
          <li><span class="text-white font-medium">Statistiques militaires</span> utiles à la planification stratégique (RH, matériel, logistique)</li>
          <li><span class="text-white font-medium">Anticipation des besoins</span> logistiques et humains selon les zones de conflit</li>
          <li><span class="text-white font-medium">Alerte précoce</span> sur les dysfonctionnements administratifs ou retards critiques</li>
          <li><span class="text-white font-medium">Participation active</span> aux réunions de haut commandement pour éclairer les décisions</li>
        </ul>

        <p class="text-gray-400 italic">
          « Celui qui éclaire le commandement n’est pas dans l’ombre : il éclaire la voie. »<br>
          – Devoir de vigilance du Chef EMG Adjt Adm Log
        </p>
      </div>


      <!-- Carte 6 -->
      <div class="bg-gray-700 rounded-lg p-6">
        <h4 class="text-xl font-semibold text-white mb-4">🔐 Interface technique</h4>

        <p class="text-gray-300 mb-4">
          Dans un monde militaire de plus en plus interconnecté, le <span class="text-yellow-400 font-semibold">Chef EMG Adjt Adm Log</span> agit comme une <span class="text-white font-medium">interface privilégiée</span> entre les FARDC et les entités extérieures.
        </p>

        <p class="text-gray-300 mb-4">
          Il représente l’armée dans les discussions portant sur les <span class="text-white font-medium">technologies de défense</span>, les <span class="text-white font-medium">partenariats logistiques</span>, les <span class="text-white font-medium">projets de coopération internationale</span>, ou encore les <span class="text-white font-medium">aides humanitaires et programmes de soutien</span>.
        </p>

        <ul class="list-disc pl-6 text-gray-300 space-y-2 mb-4">
          <li><span class="text-white font-medium">Collaboration avec les partenaires techniques</span> (sociétés privées, fabricants, bailleurs)</li>
          <li><span class="text-white font-medium">Gestion des conventions logistiques</span> et accords bilatéraux d’assistance</li>
          <li><span class="text-white font-medium">Suivi des dons militaires étrangers</span> et des livraisons stratégiques</li>
          <li><span class="text-white font-medium">Échanges avec les ONG</span> et les organismes internationaux (ONU, UA, etc.) pour l’appui logistique</li>
          <li><span class="text-white font-medium">Représentation dans les salons militaires</span> et foires de défense régionales</li>
        </ul>

        <p class="text-gray-400 italic">
          « Dans les coulisses des alliances, se trouve le pont humain de la logistique : discret, mais décisif. »
        </p>
      </div>

      <div class="bg-gray-700 rounded-lg p-6">
        <h4 class="text-xl font-semibold text-white mb-4">🛡️ Unités rattachées</h4>

        <p class="text-gray-300 mb-4">
          Le <span class="text-yellow-400 font-semibold">CEMG Adjt Adm Log</span> exerce son autorité sur un ensemble structuré d’unités administratives et logistiques, qui forment l’ossature invisible du fonctionnement quotidien des <strong>FARDC</strong>.
        </p>

        <p class="text-gray-300 mb-4">
          Ces structures spécialisées sont conçues pour exécuter avec précision les ordres stratégiques du haut commandement, dans les domaines allant de la gestion des ressources humaines à la maintenance lourde des matériels.
        </p>

        <ul class="list-disc pl-6 text-gray-300 space-y-2 mb-4">
          <li><span class="text-white font-medium">État-Major Administration</span> (EM Adm) – supervise le personnel, les dossiers, et l’organisation interne</li>
          <li><span class="text-white font-medium">État-Major Logistique</span> (EM Log) – en charge du ravitaillement, de l’entretien et du soutien matériel</li>
          <li><span class="text-white font-medium">Direction des Ressources Humaines</span> – élabore les plans de carrière, les mutations, les évaluations</li>
          <li><span class="text-white font-medium">Direction de la Santé Militaire</span> – gère les hôpitaux, les soins et la médecine opérationnelle</li>
          <li><span class="text-white font-medium">Direction des Infrastructures</span> – supervise les chantiers, casernes et bases logistiques</li>
          <li><span class="text-white font-medium">Service du Matériel et des Transports</span> – gestion des véhicules, des armements et de leur maintenance</li>
          <li><span class="text-white font-medium">Intendance Militaire Générale</span> – responsable de l’alimentation, habillement et approvisionnement de base</li>
          <li><span class="text-white font-medium">Archives et Documentation militaire</span> – conservation des dossiers, historiques et décisions stratégiques</li>
          <li><span class="text-white font-medium">Bataillon du Grand Quartier Général</span> – unité spéciale chargée de la sécurité, du soutien logistique et de la gestion interne du haut commandement militaire</li>
        </ul>

        <p class="text-gray-400 italic">
          « Derrière chaque commandement efficace se cache une colonne vertébrale logistique : ces unités sont les vertèbres de la puissance. »
        </p>
      </div>


    </div>

    <!-- Conclusion élargie -->
    <div class="mt-12 bg-gray-800 rounded-lg p-6">
      <h4 class="text-xl font-semibold text-white mb-4">🧭 Synthèse stratégique</h4>
      <p class="text-gray-300 mb-4">
        Deuxième dans la hiérarchie des Chefs Adjoints, aux côtés de celui des Opérations/Renseignements, ce Chef est le garant :
      </p>
      <ul class="list-disc list-inside text-gray-300 space-y-2">
        <li>De l’administration humaine et matérielle de l’armée congolaise</li>
        <li>De la gestion de carrière des militaires, de leur solde et bien-être</li>
        <li>Du soutien logistique permanent sur tous les théâtres d’opérations</li>
      </ul>
      <p class="mt-6 italic text-gray-400">
        Il n’y a pas de victoire sans logistique, ni de force sans structure.
        Ce Chef est le bâtisseur de l’ombre, pilier du soutien militaire durable.
      </p>
    </div>

  </section>

  <!-- Cabinet du CEMG Adjt Adm Log -->
  <div class="bg-gray-800 rounded-xl p-10 shadow-md mb-16 reveal">
    <h3 class="text-3xl font-bold text-white mb-6">🏛️ Cabinet du CEMG Adjt Adm Log</h3>
    <p class="text-gray-300 text-lg leading-relaxed mb-6">
      Le cabinet du CEMG Adjt Adm Log est une structure rapprochée, cœur de la coordination exécutive. Il se compose des personnes suivantes :
    </p>
    <ul class="list-disc pl-6 text-gray-300 space-y-2">
      <li>CEMG Adjt Adm Log</li>
      <li>Secrétaire particulier</li>
      <li>Aide de camp</li>
      <li>Chargé des Missions</li>
      <li>Directeur du Cabinet</li>
      <li>Conseiller Administration</li>
      <li>Conseiller Logistique</li>
      <li>Secrétariat Adm Log, composé de :
        <ul class="list-disc pl-6">
          <li>Secrétaire Adm</li>
          <li>Secrétaire Adjoint Log</li>
          <li>Deux Réceptionnistes</li>
          <li>Deux Officiers IN/OUT</li>
          <li>Pool Informatique :</li>
          <ul class="list-disc pl-6">
            <li>Chef de Pool Informatique</li>
            <li>Deux Opérateurs de Saisie</li>
          </ul>
        </ul>
      </li>
    </ul>
  </div>

  <!-- Accès aux sous-sections -->
  <div class="mt-12 text-center reveal">
    <h4 class="text-xl font-semibold text-gray-200 mb-2">Explorer les deux piliers opérationnels :</h4>
    <div class="flex justify-center gap-6">
      <a href="#administration" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow">Administration</a>
      <a href="#logistique" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow">Logistique</a>
    </div>
  </div>

  <!-- AlpineJS Template Interpolation fix -->
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.magic('interpolate', () => (template) => {
        return template.replace(/\[\[\s*(.*?)\s*\]\]/g, (_, match) => {
          return eval(match)
        });
      });
    });
  </script>
</section>
