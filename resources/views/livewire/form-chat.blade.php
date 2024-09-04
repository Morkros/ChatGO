<div class="p-2 border-t border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-transparent flex items-center">
    <input type="text" wire:model="mensaje" placeholder="Escribe un mensaje..."
        class="flex-1 p-2 border rounded-lg bg-white placeholder-white dark:bg-gray-600 focus:border-indigo-600 text-white ">
    <button wire:click="store()" class="ml-2 p-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600">Enviar</button>
</div>
