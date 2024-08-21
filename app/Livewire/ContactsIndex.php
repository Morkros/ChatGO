<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Contact;

class ContactsIndex extends Component
{
    public $user_id;
    public $contacts;
    public function mount(){
        $this->user_id = Auth::id();
        $this->loadContacts();
    }

    public function loadContacts(){
        $this->contacts = DB::select(
            'SELECT users.*, contacts.* 
            FROM users 
            INNER JOIN contacts ON users.id = contacts.id_contact 
            WHERE contacts.user_id = :user_id',
            ['user_id' => $this->user_id]
        );
    }
    
    public function render()
    {
        return view('livewire.contacts-index');
    }

    public function delete($id) {
        // dd($id);
        Contact::find($id)->delete();
        $this->loadContacts();
        //session()->flash('message', 'Contact deleted successfully.');
    }
}
