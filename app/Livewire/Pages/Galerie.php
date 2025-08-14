<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Gallery;
use App\Models\GalleryCategory;

class Galerie extends Component
{
    use WithPagination;

    public $categories = [];
    public $selectedCategory = 'toutes';

    protected $paginationTheme = 'tailwind';

    protected $listeners = ['refreshGalerie' => '$refresh'];

    public function mount()
    {
        $this->categories = GalleryCategory::orderBy('name')->get();
    }

    public function updatingSelectedCategory()
    {
        $this->resetPage(); // Remettre la pagination à la page 1
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId === 'toutes' ? 'toutes' : (int) $categoryId;
        $this->resetPage(); // Toujours remettre la pagination à 1 si on change de catégorie
        $this->dispatch('refreshGalerie'); // Rafraîchir la vue manuellement
    }

    public function render()
    {
        $photos = Gallery::with('category')
            ->when($this->selectedCategory !== 'toutes', function ($query) {
                return $query->where('gallery_category_id', $this->selectedCategory);
            })
            ->where('active', true)
            ->latest()
            ->paginate(6);

        return view('livewire.pages.galerie', [
            'photos' => $photos,
            'categories' => $this->categories,
            'selectedCategory' => $this->selectedCategory,
        ]);
    }
}
