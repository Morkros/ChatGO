<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UserChat extends Component
{
    public $selectedContactId;
    public $messages;
    protected $listeners = ['SelectContact' => 'changeContact', 'Refresh', 'MessageSend' => 'onMessageReceived','loadMoreMessages'];
    public $user;
    public $receptor;
    public $lastLoadedMessageId;
    public $limiteCargaInicial = 9;
    public $limiteCarga = 1;
    
    public function changeContact($contactId){
        $this->messages = [];
        $this->lastLoadedMessageId=0;
        $this->selectedContactId = $contactId;
        $this->loadChat();
        // dd($this->messages);
    }
    
    public function Refresh(){
        $this->loadChat();
    }


    public function loadChat()
    {
        $this->user = Auth::user();
        $this->receptor = User::find($this->selectedContactId);
        $emisor = $this->user->id;
        
        $this->messages = Message::with('translation')
        ->where('transmitter_id', $emisor)->where('receiver_id', $this->receptor->id)
        ->orWhere('transmitter_id', $this->receptor->id)->where('receiver_id', $emisor)
        ->orderBy('created_at', 'desc')
        ->limit($this->limiteCargaInicial)
        ->get()
        ->reverse();
        
        // Actualiza el ID del último mensaje cargado
        if ($this->messages->isNotEmpty()) {
            $this->lastLoadedMessageId = $this->messages->first()->id;
        }
        //dd($this->lastLoadedMessageId);
        $this->dispatch("MensajesCargadosInicio");
    }
    
    public function loadMoreMessages()
    {
        if (!$this->lastLoadedMessageId) {
            return; // No hay más mensajes que cargar
        }
        
        $this->user = Auth::user();
        $this->receptor = User::find($this->selectedContactId);
        $emisor = $this->user->id;
        
        //DB::enableQueryLog();
        // Obtener mensajes anteriores
        $moreMessages = Message::with('translation')
        ->where('id', '<', $this->lastLoadedMessageId)
        ->where(function($query) use ($emisor) {
            $query->where(function($subQuery) use ($emisor) {
                $subQuery->where('transmitter_id', $emisor)
                         ->where('receiver_id', $this->receptor->id);
            })
            ->orWhere(function($subQuery) use ($emisor) {
                $subQuery->where('transmitter_id', $this->receptor->id)
                         ->where('receiver_id', $emisor);
            });
        })
        ->limit($this->limiteCarga)
        ->orderBy('created_at', 'desc')
        ->get()
        ->reverse();
    
        
        //$queries = DB::getQueryLog();
        //dd($queries);

        if ($moreMessages->isEmpty()) {
            $this->dispatch("MensajesTotalCargados");
            return $this->lastLoadedMessageId = NULL; // No hay más mensajes que cargar
        }
        
        $this->lastLoadedMessageId = $moreMessages->first()->id;
        //dd($this->lastLoadedMessageId,$moreMessages);
        
        // Concatenar los mensajes nuevos a la colección existente
        $this->messages = $moreMessages->concat($this->messages);

        // Actualiza el ID del último mensaje cargado
        $this->dispatch("MensajesCargados");
    }
    public function render()
    {
        return view('livewire.user-chat');
    }
}
