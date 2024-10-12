<?php

namespace App\Livewire;

use App\Events\MessageSend;
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
    // Escucha de eventos
    protected $listeners = ['SelectContact' => 'selectContact'];
    
    protected $rules = [
        'message' => 'required|min:1|max:250',
        'email' => 'required|email',
    ];

    public function selectContact($contactId)
    {
        $this->SelectedContactId = $contactId;
    }

    public function store()
    {
        if (!Empty($this->mensaje)) {
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
    
            $message = Message::create([
                'transmitter_id' => $emisor->id,
                'receiver_id' => $receptor->id,
                'body' => $this->mensaje,
                'read' => false,
                'translated_message_id' => $translationSave->id ?? null,
            ]);
    
            event(new MessageSend($message)); // Enviar mensaje por Pusher
    
            $this->dispatch('Refresh', $this->SelectedContactId);
            $this->mensaje = "";
        }
    }
    
        public function render()
        {
            return view('livewire.form-chat');
        }
        
}
