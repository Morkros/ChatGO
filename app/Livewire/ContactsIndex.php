<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ContactsIndex extends Component
{
    public $user_id;
    public $contacts;
    public function mount(){
        $this->user_id = Auth::id();
        $this->contacts = DB::select(
            'SELECT users.*, contacts.* 
            FROM users 
            INNER JOIN contacts ON users.id = contacts.id_contact 
            WHERE contacts.user_id = :user_id',
            ['user_id' => $this->user_id]
        );
    }

    public function delete(){
        
    }

    public function render()
    {
        return view('livewire.contacts-index');
    }
}
