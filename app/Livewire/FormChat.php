<?php

namespace App\Livewire;

use App\Http\Controllers\TranslationController;
use App\Models\Message;
use App\Models\Translation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FormChat extends Component
{
    public $mensaje;
    public $SelectedContactId;

    protected $listeners = ['SelectContact' => 'selectContact'];

    public function selectContact($contactId)
    {
        $this->SelectedContactId = $contactId;
    }

    public function store()
    {
        $emisor = User::find(Auth::id());
        $receptor = User::find($this->SelectedContactId);
        if ($emisor->language != $receptor->language) {
            $resultTranslate = TranslationController::translate($this->mensaje, $emisor->language, $receptor->language);
            $translationSave = Translation::create([
                'message_translated' => $resultTranslate
            ]);
        } else {
            $translationSave = null;
        }

        Message::create([
            'transmitter_id' => $emisor->id,
            'receiver_id' => $receptor->id,
            'body' => $this->mensaje,
            'translated_message_id' => $translationSave->id,
        ]);
        
        $this->mensaje = "";
        $this->dispatch('Refresh', $this->SelectedContactId);
    }

    public function render()
    {
        return view('livewire.form-chat');
    }
}
