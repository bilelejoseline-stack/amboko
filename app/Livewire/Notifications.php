<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class Notifications extends Component
{
    public array $notifications = [];

    #[On('notify')] // écoute l’événement 'notify'
    public function addNotification(string $message, string $type = 'success'): void
    {
        $this->notifications[] = [
            'message' => $message,
            'type' => $type,
        ];

        // Supprime la notification après 5 secondes (via dispatch à soi-même)
        $this->dispatch('remove-notification', index: count($this->notifications) - 1)->self();
    }

    #[On('remove-notification')]
    public function removeNotification(int $index): void
    {
        unset($this->notifications[$index]);
        $this->notifications = array_values($this->notifications);
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
