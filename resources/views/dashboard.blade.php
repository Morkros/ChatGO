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
            <div class="sm:w-1/6 md:w-48 lg:w-64 bg-gray-100 dark:bg-gray-700 border-r border-gray-300 dark:border-gray-600 overflow-y-auto">
                @livewire('list-contact')
            </div>
            {{-- Mensajes --}}
            <div class="flex-1 flex flex-col overflow-hidden">
                @livewire('UserChat')
                {{-- Barra para enviar mensajes --}}
                @livewire('FormChat')   
            </div>
        </div>
    </div>
</x-app-layout>
