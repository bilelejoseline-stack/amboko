<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Document;

class DocumentForm extends Form
{
    #[Validate('required|string|max:255')]
    public $reference = '';

    #[Validate('required|string|max:255')]
    public $objet = '';

    #[Validate('required|string|max:255')]
    public $type_document = '';

    #[Validate('nullable|date')]
    public $date_document = '';

    #[Validate('nullable|date')]
    public $date_reception = '';

    #[Validate('nullable|date')]
    public $date_sortie = '';

    #[Validate('nullable|string|max:255')]
    public $provenance = '';

    #[Validate('nullable|string|max:255')]
    public $destinataire = '';

    #[Validate('required|string')]
    public $statut = 'Enregistré';

    #[Validate('required|string')]
    public $priorite = 'Normale';

    #[Validate('nullable|string')]
    public $description = '';

    #[Validate('nullable|string')]
    public $mention = '';

    #[Validate('nullable|string')]
    public $observations = '';

    #[Validate('nullable|file|max:2048')]
    public $fichier;

    public function store()
    {
        $this->validate();

        $fichierPath = null;
        if ($this->fichier) {
            $fichierPath = $this->fichier->store('documents', 'public');
        }

        $slugBase = str_slug($this->reference);
        $slug = $slugBase;
        $counter = 1;

        while (Document::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $counter++;
        }

        $data = [
            'reference' => $this->reference,
            'objet' => $this->objet,
            'description' => $this->description,
            'type_document' => $this->type_document,
            'date_document' => $this->date_document,
            'date_reception' => $this->date_reception,
            'date_sortie' => $this->date_sortie,
            'provenance' => $this->provenance,
            'destinataire' => $this->destinataire,
            'statut' => $this->statut,
            'priorite' => $this->priorite,
            'mention' => $this->mention,
            'observations' => $this->observations,
            'slug' => $slug,
        ];

        if ($fichierPath) {
            $data['fichier'] = $fichierPath;
        }

        $data['user_id'] = auth()->id();

        Document::create($data);
    }
}
