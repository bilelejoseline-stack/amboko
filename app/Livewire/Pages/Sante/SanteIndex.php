<?php
// App\Livewire\Pages\Sante\SanteIndex.php

namespace App\Livewire\Pages\Sante;

use Livewire\Component;
use App\Models\SanteMilitaire;

class SanteIndex extends Component
{
    public $articles = [];

    public function mount()
    {
        $this->articles = SanteMilitaire::where('active', true)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($article) {
                return [
                    'titre' => $article->titre,
                    'image' => asset('storage/' . $article->image), // 👈 bonne URL pour <img src="">
                    'slug'  => $article->slug,
                ];
            })
            ->filter(fn($a) => $a['image']) // filtrer ceux qui ont une image
            ->values();
    }

    public function render()
    {
        return view('livewire.pages.sante.sante-index', [
            'articles' => $this->articles,
        ]);
    }
}
