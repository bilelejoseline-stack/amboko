<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Militaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'nom',
        'postnom',
        'prenom',
        'slug',
        'user_id',
        'grade_id',
        'fonction',
        'unite',
        'date_incorporation',
        'lieu_incorporation',
        'date_naissance',
        'lieu_naissance',
        'sexe',
        'etat_civil',
        'epouse',
        'papa',
        'maman',
        'province_id',
        'district_id',
        'territoire_id',
        'collectivite_id',
        'localite_id',
        'province',
        'district',
        'territoire',
        'collectivite',
        'localite',
        'statut',
        'code',
        'adresse',
        'telephone',
        'avatar',
    ];

    protected $casts = [
        'date_incorporation' => 'date',
        'date_naissance' => 'date',
    ];

    // Générer slug, user_id et matricule automatiquement lors de la création
    protected static function booted()
    {
        static::creating(function ($militaire) {
            // Générer slug unique
            $militaire->slug = Str::slug("{$militaire->nom}-{$militaire->postnom}-{$militaire->prenom}-" . uniqid());

            // Si user connecté et pas de user_id assigné
            if (Auth::check() && empty($militaire->user_id)) {
                $militaire->user_id = Auth::id();
            }

            // Générer matricule si absent et si les données nécessaires sont là
            if (empty($militaire->matricule)
                && !empty($militaire->sexe)
                && !empty($militaire->date_naissance)
                && !empty($militaire->date_incorporation)
            ) {
                $dateNaissance = $militaire->date_naissance instanceof \DateTime
                    ? $militaire->date_naissance
                    : new \DateTime($militaire->date_naissance);

                $dateIncorporation = $militaire->date_incorporation instanceof \DateTime
                    ? $militaire->date_incorporation
                    : new \DateTime($militaire->date_incorporation);

                $matricule = $militaire->generateMatricule(
                    strtoupper(substr($militaire->sexe, 0, 1)), // 'M' ou 'F'
                    $dateNaissance,
                    $dateIncorporation
                );

                $militaire->matricule = $matricule;
            }
        });
    }

    /**
     * Génération du matricule selon règles :
     * 12 chiffres concaténés : sexe (1/2), année naissance (2), année incorporation (2),
     * 5 chiffres aléatoires, jour naissance (2).
     */
    protected function generateMatricule(string $sexe, \DateTime $dateNaissance, \DateTime $dateIncorporation): string
    {
        $sexCode = $sexe === 'M' ? '1' : '2';
        $anneeNaissance = $dateNaissance->format('y');    // ex: 81
        $anneeIncorporation = $dateIncorporation->format('y'); // ex: 99
        $codeRandom = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT); // 5 chiffres aléatoires
        $jourNaissance = $dateNaissance->format('d');     // ex: 22

        return $sexCode . $anneeNaissance . $anneeIncorporation . $codeRandom . $jourNaissance;
    }

    // === Accessor personnalisé pour nom complet
    public function getNomCompletAttribute(): string
    {
        return strtoupper("{$this->nom} {$this->postnom} {$this->prenom}");
    }

    // === Relations ===

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function enfants()
    {
        return $this->hasMany(Enfant::class);
    }

    public function paies()
    {
        return $this->hasMany(Paie::class)->orderByDesc('annee')->orderByDesc('mois');
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class)->orderByDesc('date_promotion');
    }

    public function affectations()
    {
        return $this->hasMany(Affectation::class)->orderByDesc('date_debut');
    }

    public function specialites()
    {
        return $this->belongsToMany(Specialite::class)->withTimestamps();
    }

    public function etudesCiviles()
    {
        return $this->hasMany(EtudeCivile::class)->orderByDesc('date_debut');
    }

    public function etudesMilitaires()
    {
        return $this->hasMany(EtudeMilitaire::class)->orderByDesc('date_debut');
    }

    public function historiques()
    {
        return $this->hasMany(HistoriqueMilitaire::class)->orderBy('date_evenement');
    }

    // Relations géographiques

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function territoire()
    {
        return $this->belongsTo(Territoire::class);
    }

    public function collectivite()
    {
        return $this->belongsTo(Collectivite::class);
    }

    public function localite()
    {
        return $this->belongsTo(Localite::class);
    }

    /**
     * Statut actif ?
     */
    public function estActif(): bool
    {
        return $this->statut === 'Actif';
    }

    /**
     * Exemple de relation spécifique (CEMGS)
     */
    public function cemgs()
    {
        return $this->hasMany(Cemg::class, 'militaire_id');
    }
}
