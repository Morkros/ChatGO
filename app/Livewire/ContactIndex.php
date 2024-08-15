<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Models\User;


class ContactIndex extends Component
{
    public $id;
    public $contacts = [];

    public function mount()
    {
        $this->id = Auth::id();  // Obtén el ID del usuario autenticado

        // Obtener la lista de contactos asociados al usuario autenticado
        $Listcontacts = Contact::where('user_id', $this->id)->get();

        // Iterar sobre cada contacto para obtener su información detallada
        foreach ($Listcontacts as $contact) {
            $user = User::find($contact->id_contact);

            $this->contacts[] = (object) [
                'id' => $user->id,
                'name' => $user->username,
                'email' => $user->email,
                // Agrega aquí cualquier otro campo que necesites del usuario
            ];
        }
        //dd($this->contacts);
    }


    public function render()
    {
        return view('livewire.contact-index');
    }
}
