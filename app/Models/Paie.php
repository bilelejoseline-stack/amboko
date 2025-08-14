<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class Paie extends Model
{
    use HasFactory, SoftDeletes;

    // Champs remplissables en masse
    protected $fillable = [
        'militaire_id',
        'solde_base',
        'prime_combat',
        'prime_risque',
        'autres_primes',
        'retenue',
        'net_a_payer',
        'mois',
        'annee',
    ];

    // Cast des champs pour formatage correct
    protected $casts = [
        'solde_base' => 'decimal:2',
        'prime_combat' => 'decimal:2',
        'prime_risque' => 'decimal:2',
        'autres_primes' => 'decimal:2',
        'retenue' => 'decimal:2',
        'net_a_payer' => 'decimal:2',
        'mois' => 'string',
        'annee' => 'integer',
    ];

    /**
     * Relation vers le militaire concerné.
     */
    public function militaire()
    {
        return $this->belongsTo(Militaire::class);
    }

    /**
     * Calcul automatique du net à payer à la création et à la mise à jour.
     */
    protected static function booted()
    {
        static::creating(function ($paie) {
            $paie->calculerNetAPayer();
        });

        static::updating(function ($paie) {
            $paie->calculerNetAPayer();
        });
    }

    /**
     * Méthode pour calculer le net à payer.
     */
    public function calculerNetAPayer()
    {
        $this->net_a_payer = $this->solde_base
            + $this->prime_combat
            + $this->prime_risque
            + $this->autres_primes
            - $this->retenue;
    }

    /**
     * Mutator : formate le mois à deux chiffres "01" à "12".
     */
     public function setMoisAttribute($value)
     {
         // Si c'est une date, extraire le mois
         if (strtotime($value)) {
             $mois = Carbon::parse($value)->month;
         } else {
             $mois = intval($value);
         }

         // Stocker en 2 chiffres
         $this->attributes['mois'] = str_pad($mois, 2, '0', STR_PAD_LEFT);
     }


    /**
     * Accessor : nom du mois en français (ex : janvier, février...).
     */
    public function getNomMoisAttribute()
    {
        try {
            $mois = (int) $this->mois;
            return Carbon::create()->month($mois)->locale('fr')->translatedFormat('F');
        } catch (\Exception $e) {
            return 'Mois invalide';
        }
    }
}
