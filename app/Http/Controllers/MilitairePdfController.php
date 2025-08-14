<?php

namespace App\Http\Controllers;

use App\Models\Militaire;
use Barryvdh\DomPDF\Facade\Pdf;

class MilitairePdfController extends Controller
{
    public function exportPdf(Militaire $militaire)
    {
        $militaire->load([
            'grade',
            'promotions.grade',
            'affectations',
            'specialites',
            'etudesCiviles',
            'etudesMilitaires',
            'paies',
            'enfants',
        ]);

        $pdf = Pdf::loadView('militaire.pdf', compact('militaire'));

        return $pdf->download('fiche_militaire_' . $militaire->matricule . '.pdf');
    }
}
