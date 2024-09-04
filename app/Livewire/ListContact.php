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
    
    public function Evento($contact_id)
    {
        $this->dispatch('SelectContact',$contact_id);
    }

    public function mount()
    {
        $this->id = Auth::id(); 
        $Listcontacts = Contact::where('user_id', $this->id)->get(); // Cambiar Consulta
        foreach ($Listcontacts as $contact) {
            $user = User::find($contact->id_contact);
            
            $this->contacts[] = (object) [
                'id' => $user->id,
                'name' => $user->username,
                'email' => $user->email,
            ];
        }
        //dd($this->contacts);
    }


    public function render()
    {
        return view('livewire.list-contact');
    }
}


