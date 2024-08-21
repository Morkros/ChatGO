<div class="p-2 border-t border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 flex items-center">
    <input type="text" wire:model="mensaje" placeholder="Escribe un mensaje..."
        class="flex-1 p-2 border rounded-lg bg-white dark:bg-gray-600 text-gray-800 ">
    <button wire:click="store()" class="ml-2 p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Enviar</button>
</div>
