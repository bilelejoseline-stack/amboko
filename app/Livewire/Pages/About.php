<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\About as AboutFARDC;
use Illuminate\Support\Str;

class About extends Component
{
    public $abouts = [];

    public function mount()
    {
        // ⚠️ Correction : utiliser les bons champs actuels (subtitles, descriptions)
        $this->abouts = AboutFARDC::where('active', true)
            ->latest() // Trie par created_at DESC
            ->take(1)
            ->get(['title', 'subtitles', 'descriptions', 'image', 'slug', 'video']);


        // Générer le slug si absent
        foreach ($this->abouts as $about) {
            if (empty($about->slug)) {
                $about->slug = Str::slug($about->title);
            }
        }
    }

    public function render()
    {
        return view('livewire.pages.about', [
            'abouts' => $this->abouts,
            'hasAbouts' => $this->abouts->isNotEmpty(),
        ]);
    }
}
