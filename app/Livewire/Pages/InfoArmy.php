<?php

namespace App\Livewire\Pages;

use App\Models\InfoArmy as InfoModel;
use Livewire\Component;

class InfoArmy extends Component
{
    public $infos = [];
    public $hasInfos = false;

    public function mount()
    {
        $this->infos = InfoModel::where('active', true)
            ->orderBy('priority')
            ->get()
            ->toArray();

        $this->hasInfos = count($this->infos) > 0;
    }

    public function render()
    {
        return view('livewire.pages.info-army', [
            'infos' => $this->infos,
            'hasInfos' => $this->hasInfos,
        ]);
    }
}
