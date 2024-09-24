<div class="p-2 bg-gray-100 bg-transparent flex items-center">
    <input type="text" wire:model="mensaje" placeholder="Escribe un mensaje..."
        class="flex-1 p-2 border rounded-lg bg-white bg-gray-600 focus:border-indigo-600 "
        wire:keydown.enter="store()"  wire:loading.attr="disabled">
        <button wire:click="store()"  wire:loading.attr="disabled" class="ml-2 p-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600" >
            Enviar
        </button>
        
        
        
</div>