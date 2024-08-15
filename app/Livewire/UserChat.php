<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Chat;

class UserChat extends Component
{
    public $selectedContactId;
    public $messages = [];

    protected $listeners = ['Evento' => 'loadChat'];

    public function loadChat($contactId)
    {
        $this->messages = [];
        $this->selectedContactId = $contactId;
        $this->messages = ["Mensajes con el usuario $this->selectedContactId"];

    }

    public function render()
    {
        return view('livewire.user-chat');
    }
}
