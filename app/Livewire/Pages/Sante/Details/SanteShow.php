<?php

namespace App\Livewire\Pages\Sante\Details;

use Livewire\Component;
use App\Models\SanteMilitaire;

class SanteShow extends Component
{
    public SanteMilitaire $article;

    public function mount(string $slug): void
    {
        // Sécurité : chercher uniquement les articles actifs
        $this->article = SanteMilitaire::where('slug', $slug)
            ->where('active', true)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.pages.sante.details.sante-show', [
            'article' => $this->article,
        ])->title($this->article->titre);
    }
}
