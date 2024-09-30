<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Models\User;

class ListContact extends Component
{
    public $id;
    public $contacts = [];
    public $selectedContactId;
    
    public function Evento($contact_id)
    {
        $this->selectedContactId = $contact_id;
        $this->dispatch('SelectContact',$contact_id);
    }

    public function mount()
    {
        $this->id = Auth::id(); 
        $this->contacts = Contact::where('user_id', $this->id)->with('user')->get(); // Cambiar Consulta
    }


    public function render()
    {
        return view('livewire.list-contact');
    }
}


