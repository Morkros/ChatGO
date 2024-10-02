<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserChat extends Component
{
    public $selectedContactId;
    public $messages;
    protected $listeners = ['SelectContact' => 'loadChat', 'Refresh', 'MessageSend' => 'onMessageReceived'];
    public $user;
    public $receptor;

    public function Refresh(){
        $this->loadChat($this->selectedContactId);
        $this->dispatch('messagesUpdated');
    }

    public function onMessageReceived($mensaje)
    {
        // Decodificar el mensaje JSON a un array asociativo
        $data = json_decode($mensaje, true);
    
        // Verificar si json_decode devolvió un array
        if (is_array($data)) {
            try {
                // Crear una nueva instancia de Message
                $mensaje = new Message($data);
    
                // Asegurarse de que $this->messages es una colección o array
                if (is_array($this->messages) || $this->messages instanceof \Illuminate\Support\Collection) {
                    $this->messages[] = $mensaje; // Agregar el mensaje a la colección
                } else {
                    throw new \Exception('La propiedad $messages no es una colección o array.');
                }
            } catch (\Exception $e) {
                // Manejar errores si el modelo no puede ser creado o el mensaje es inválido
                Log::error('Error al procesar el mensaje.', ['exception' => $e->getMessage(), 'data' => $data]);
            }
        } else {
            Log::error('Error al decodificar JSON:', ['json' => $mensaje]);
        }
    }

    public function loadChat($contactId)
    {
        $this->selectedContactId = $contactId;
        $this->user = Auth::user();
        $this->receptor = User::find($contactId);
        $emisor = $this->user->id;
        $this->messages = Message::select('messages.*', 'translations.message_translated')
            ->leftJoin('translations', 'messages.translated_message_id', '=', 'translations.id')
            ->where(function ($query) use ($emisor, $contactId) {
                $query->where('messages.transmitter_id', $emisor)
                ->where('messages.receiver_id', $contactId);
            })
            ->orWhere(function ($query) use ($emisor, $contactId) {
                $query->where('messages.transmitter_id', $contactId)
                ->where('messages.receiver_id', $emisor);
            })
            ->orderBy('messages.created_at', 'asc')
            ->take(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.user-chat');
    }
}
