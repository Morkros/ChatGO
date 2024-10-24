<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserChat extends Component
{
    public $messages;
    protected $listeners = ['SelectContact' => 'changeContact', 'Refresh', 'MessageSend' => 'onMessageReceived','loadMoreMessages'];
    public $mostrarMensajeOriginal;
    public $user;
    public $receptor;
    public $lastLoadedMessageId;
    public $limiteCargaInicial = 20;
    public $limiteCarga = 10;
    
    public function mount(){
        $this->user = Auth::user();
    }
    public function mostrarOriginal(){
        $this->mostrarMensajeOriginal = !$this->mostrarMensajeOriginal;
    }

    public function changeContact($contactId){
        $this->messages = [];
        $this->lastLoadedMessageId=0;
        $this->receptor = User::find($contactId);
        $this->loadChat();
    }
    
    public function Refresh(){
        if ($this->receptor) {
            $this->loadChat();
        }
    }


    public function loadChat()
    {
        $this->mostrarMensajeOriginal = true;
        $emisor = $this->user->id;
        //Actuliza los mensajes no leidos a leidos una vez que abre el chat
        Message::where('receiver_id', $emisor )->update(['is_read' => now()]);
        // $this->receptor = User::find($this->selectedContactId);
        
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
        // $this->dispatch('showTranslated', true);
    }
    
    public function loadMoreMessages()
    {
        
        if (!$this->lastLoadedMessageId) {
            return; // No hay más mensajes que cargar
        }
        
        // $this->user = Auth::user();
        // $this->receptor = User::find($this->selectedContactId);
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
    
        if ($moreMessages->isEmpty()) {
            $this->dispatch("MensajesTotalCargados");
            return $this->lastLoadedMessageId = NULL; // No hay más mensajes que cargar
        }
        
        $this->lastLoadedMessageId = $moreMessages->first()->id;
        
        // Concatenar los mensajes nuevos
        $this->messages = $moreMessages->concat($this->messages);

        // Evento para scroll
        $this->dispatch("MensajesCargados");
    }

    public function render()
    {
        return view('livewire.user-chat');
    }
}
