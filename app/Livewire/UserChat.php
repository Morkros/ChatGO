<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class UserChat extends Component
{
    public $selectedContactId;
    public $messages = [];

    protected $listeners = ['SelectContact' => 'loadChat','Refresh' => 'loadChat'];

    public function loadChat($contactId)
    {
        $this->selectedContactId = $contactId;
        $emisor = Auth::id();
        $this->messages = Message::where(function ($query) use ($emisor, $contactId) {
            $query->where('transmitter_id', $emisor)
                  ->where('receiver_id', $contactId);
        })->orWhere(function ($query) use ($emisor, $contactId) {
            $query->where('transmitter_id', $contactId)
                  ->where('receiver_id', $emisor);
        })->orderBy('created_at', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.user-chat');
    }
}
