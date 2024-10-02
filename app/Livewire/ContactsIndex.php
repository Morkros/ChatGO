<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Contact;
use App\Models\User;

class ContactsIndex extends Component
{
    public $user_id;
    public $name;
    public $email;
    public $contacts;

    //ModalUpdate
    public $contactUpdate;
    public $aviso;


    public function mount()
    {
        $this->user_id = Auth::id();
        $this->loadContacts();
    }

    public function loadContacts()
    {
        $this->contacts = Contact::where('user_id', $this->user_id)->with('user')->get();
    }

    public function delete($id)
    {
        Contact::find($id)->delete();
        $this->loadContacts();
    }
    public function render()
    {
        return view('livewire.contacts-index');
    }

    //Modales Agregar y Modificar

    public $ModalAdd = false;
    public $ModalUpdate = false;

    public function openModal($modal)
    {
        $this->name = "";
        $this->email = "";
        $this->$modal = true;
    }

    public function closeModal($modal)
    {
        $this->$modal = false;
    }
    // ModalAdd
    public function addContact()
    {
        $contactId = user::where('email', $this->email)->first();

        if ($contactId == null) {
            $this->aviso = "Email no encontrado.";
        } else {
            if ($this->contacts->contains('id_contact', $contactId->id)) {
                $this->aviso = "Email ya registrado.";
            } else {
                $newContact = contact::create([
                    'user_id' => $this->user_id,
                    'name' => $this->name,
                    'id_contact' => $contactId->id,
                ]);
                // $this->dispatch('contact-added');
                $newContact->user()->associate($contactId); // Establece la relación si es necesario
                // Agregar el nuevo contacto al array
                $this->contacts[] = $newContact;
                $this->closeModal("ModalAdd");
            }
        }
    }

    // retorna los datos del contacto al modal
    public function modalUpdate($id)
    {
        $this->openModal('ModalUpdate');
        $this->contactUpdate = Contact::with('user')->find($id);
        $this->name = $this->contactUpdate->name;
        $this->email = $this->contactUpdate->user->email;
    }

    public function updateContact()
    {
        // dd($contactUpdate)
        if (($this->contactUpdate->name != $this->name) or ($this->contactUpdate->user->email != $this->email)) {
            $this->contactUpdate->name = $this->name;
            if ($this->contactUpdate->save()) {
                $this->aviso = "Saved.";
                $this->loadContacts();
            }
        }
    }
}
