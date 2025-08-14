<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class Documents extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'tailwind';

    protected $listeners = ['documentDeleted' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $document = Document::findOrFail($id);

        if ($document->fichier && Storage::disk('public')->exists($document->fichier)) {
            Storage::disk('public')->delete($document->fichier);
        }

        $document->delete();

        session()->flash('message', 'Document supprimé avec succès.');

        $this->dispatch('documentDeleted');
    }

    public function render()
    {
        $documents = Document::query()
            ->when($this->search, function ($query) {
                $searchTerm = "%{$this->search}%";

                $query->where(function ($q) use ($searchTerm) {
                    $q->where('reference', 'like', $searchTerm)
                      ->orWhere('objet', 'like', $searchTerm)
                      ->orWhere('description', 'like', $searchTerm)
                      ->orWhere('type_document', 'like', $searchTerm)
                      ->orWhere('date_document', 'like', $searchTerm)
                      ->orWhere('provenance', 'like', $searchTerm)
                      ->orWhere('destinataire', 'like', $searchTerm)
                      ->orWhere('statut', 'like', $searchTerm)
                      ->orWhere('priorite', 'like', $searchTerm)
                      ->orWhere('mention', 'like', $searchTerm)
                      ->orWhere('observations', 'like', $searchTerm)
                      ->orWhere('slug', 'like', $searchTerm);
                });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.pages.documents', compact('documents'));
    }
}
