<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
<<<<<<< Updated upstream
use App\Models\User;
use App\Models\Message;
=======
>>>>>>> Stashed changes

class ListContact extends Component
{
    public $id;
    public $contacts;
    public $selectedContactId;
    protected $listeners = ['Notification'];
<<<<<<< Updated upstream
    
    public function Evento($contact_id)
    {
=======

    public function Evento($contact_id) {
>>>>>>> Stashed changes
        $this->selectedContactId = $contact_id;
        $this->dispatch('SelectContact',$contact_id);
        $this->loadContacts();
    }
    
    public function mount()
    {
        $this->loadContacts();
    }
    
    public function loadContacts(){
        $this->contacts = Contact::select('contacts.*')
        ->selectRaw('(SELECT MAX(created_at) 
                        FROM messages m 
                        WHERE (m.transmitter_id = contacts.user_id AND m.receiver_id = contacts.id_contact)
                            OR (m.transmitter_id = contacts.id_contact AND m.receiver_id = contacts.user_id)
                        ) AS last_message_created_at')
        ->selectRaw('(SELECT COUNT(*)
                        FROM messages m
                        WHERE (m.transmitter_id = contacts.id_contact AND m.receiver_id = contacts.user_id AND is_read IS null)
                        ) 
                        AS unread_message')
        ->where('contacts.user_id', Auth::id())
        ->get();
    }
    
    public function Notification(Message $mensaje) {
        if ((!$this->selectedContactId)||(!$mensaje->transmitter_id == $this->selectedContactId)) {
                Message::where('receiver_id', $this->selectedContactId)
                ->update(['is_read' => now()]);
                return $this->loadContacts();
        }
        // return $this->loadContacts();
    }

    public function render()
    {
        return view('livewire.list-contact');
    }
}


