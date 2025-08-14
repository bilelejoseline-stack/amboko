<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Friendship;
use Illuminate\Support\Facades\Auth;

class NotificationInvitations extends Component
{
    public $invitations = [];

    protected $listeners = ['invitationRecue' => 'loadInvitations'];

    public function mount()
    {
        $this->loadInvitations();
    }

    public function loadInvitations()
    {
        $this->invitations = Friendship::with('sender')
            ->where('receiver_id', Auth::id())
            ->where('status', 'pending')
            ->latest()
            ->get();
    }

    public function accepterInvitation($id)
    {
        $invitation = Friendship::where('id', $id)
            ->where('receiver_id', Auth::id())
            ->first();

        if ($invitation) {
            $invitation->update(['status' => 'accepted']);
            session()->flash('message', 'Invitation acceptée.');
            $this->loadInvitations();
        }
    }

    public function refuserInvitation($id)
    {
        $invitation = Friendship::where('id', $id)
            ->where('receiver_id', Auth::id())
            ->first();

        if ($invitation) {
            $invitation->update(['status' => 'rejected']);
            session()->flash('message', 'Invitation refusée.');
            $this->loadInvitations();
        }
    }

    public function render()
    {
        return view('livewire.chat.notification-invitations');
    }
}
