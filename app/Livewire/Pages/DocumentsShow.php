<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Document;

class DocumentsShow extends Component
{
    public $document;

    public function mount($slug)
    {
        // Recherche du document avec slug
        $this->document = Document::where('slug', $slug)
                                  ->firstOrFail();

        // Redirection SEO si le slug ne correspond pas exactement
        if ($this->document->slug !== $slug) {
            return redirect()->route('documents.show', [
                'slug' => $this->document->slug,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.pages.documents-show', [
            'document' => $this->document,
        ]);
    }
}
