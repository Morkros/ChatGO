<x-app-layout>
    <style>
        .custom-min-h {
            min-height: calc(100vh - 65px);
            max-height: calc(100vh - 65px); 
        }
    </style>
    <div class="bg-white dark:bg-gray-800 custom-min-h w-full mx-auto rounded-lg shadow-lg flex flex-col">
        <div class="flex flex-1 overflow-hidden">
            {{-- Contactos --}}
            <div class="w-32 bg-gray-100 dark:bg-gray-700 border-r border-gray-300 dark:border-gray-600 overflow-y-auto">
                @livewire('list-contact')
            </div>
            {{-- Mensajes --}}
            <div class="flex-1 flex flex-col overflow-hidden">
                @livewire('UserChat')
                {{-- Barra para enviar mensajes --}}
                <div class="p-2 border-t border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 flex items-center">
                    <input type="text" placeholder="Escribe un mensaje..."
                        class="flex-1 p-2 border rounded-lg bg-white dark:bg-gray-600 text-gray-800 dark:text-gray-200">
                    <button class="ml-2 p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
