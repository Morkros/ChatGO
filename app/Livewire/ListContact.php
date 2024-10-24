<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Models\Message;


class ListContact extends Component
{
    public $contacts;
    public $selectedContactId;
    protected $listeners = ['Notification'];

    public function Evento($contact_id)
    {
        $this->selectedContactId = $contact_id;
        $this->dispatch('SelectContact', $contact_id);
        $this->loadContacts();
    }

    public function mount()
    {
        $this->loadContacts();
    }

    public function loadContacts()
    {
        $user_id = Auth::id();
        // Para los contactos del usuario autenticado
        $contactsQuery = Contact::select('users.id as user_id', 'users.email', 'name')
            ->selectRaw('(SELECT MAX(m.created_at) 
              FROM messages m 
              WHERE (m.transmitter_id = contacts.id_contact AND m.receiver_id = contacts.user_id)
                 OR (m.transmitter_id = contacts.user_id AND m.receiver_id = contacts.id_contact)
             ) as last_message_created_at')
            ->selectRaw('(SELECT COUNT(*) 
              FROM messages m 
              WHERE m.transmitter_id = contacts.id_contact 
                AND m.receiver_id = contacts.user_id 
                AND m.is_read IS NULL
             ) as unread_message_count')
            ->join('users', 'users.id', '=', 'contacts.id_contact')
            ->where('contacts.user_id', $user_id);

        // Para los usuarios que no están en la lista de contactos pero han enviado mensajes
        $nonContactsQuery = Message::select('users.id as user_id', 'users.email',)
            ->selectRaw('NULL as contact_name')
            ->selectRaw('(SELECT MAX(m2.created_at)
              FROM messages m2
              WHERE m2.transmitter_id = messages.transmitter_id 
                AND m2.receiver_id = messages.receiver_id
             ) as last_message_created_at')
            ->selectRaw('(SELECT COUNT(*)
              FROM messages m2
              WHERE m2.transmitter_id = messages.transmitter_id 
                AND m2.receiver_id = messages.receiver_id 
                AND m2.is_read IS NULL
             ) as unread_message_count')
            ->join('users', 'users.id', '=', 'messages.transmitter_id')
            ->where('messages.receiver_id', $user_id)
            ->whereNotIn('messages.transmitter_id', function ($query) use ($user_id) {
                $query->select('contacts.id_contact')
                    ->from('contacts')
                    ->where('contacts.user_id', $user_id);
            });

        // Unión de ambas consultas
        $this->contacts = $contactsQuery->union($nonContactsQuery)->get();
        // dd($this->contacts);

    }

    public function Notification(Message $mensaje)
    {
        if ((!$this->selectedContactId) || (!$mensaje->transmitter_id == $this->selectedContactId)) {
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
