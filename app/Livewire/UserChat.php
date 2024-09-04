<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class UserChat extends Component
{
    public $selectedContactId;
    public $messages = [];
    protected $listeners = ['SelectContact' => 'loadChat', 'Refresh' => 'loadChat'];
    public $user;
    public function loadChat($contactId)
    {
        $this->selectedContactId = $contactId;
        $this->user = Auth::user();
        $emisor = $this->user->id;
        $this->messages = Message::select('messages.*', 'translations.*') 
            ->leftJoin('translations', 'messages.translated_message_id', '=', 'translations.id')
            ->where(function ($query) use ($emisor, $contactId) {
                $query->where('messages.transmitter_id', $emisor)
                ->where('messages.receiver_id', $contactId);
            })
            ->orWhere(function ($query) use ($emisor, $contactId) {
                $query->where('messages.transmitter_id', $contactId)
                ->where('messages.receiver_id', $emisor);
            })
            ->orderBy('messages.created_at', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.user-chat');
    }
}
