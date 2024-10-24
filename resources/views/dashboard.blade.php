<x-app-layout>
    <style>
        .custom-min-h {
            min-height: calc(100vh - 65px);
            max-height: calc(100vh - 65px); 
        }
        .custom-scroll {
            scrollbar-width: none; /* O 'auto' o 'none' */
            scrollbar-color: rgba(121, 121, 121, 0.3) transparent; /* Color del thumb y del track transparente */
            border-radius: 2px; /* Esquinas redondeadas */
        }
    </style>
    <div class="bg-gray-800 custom-min-h w-full mx-auto rounded-lg shadow-lg flex flex-col custom-scroll" >
        <div class="flex flex-1 overflow-hidden">
            {{-- Contactos --}}
            <div class="sm:w-1/6 md:w-48 lg:w-64 bg-gray-700 overflow-y-auto">
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
    <script>
        if (!window.userId || (window.userId !== {{ auth()->user()->id }}) ) {
            window.userId = {{ auth()->user()->id ?? 'null' }};
            console.log(window.userId);
        }
    </script>
</x-app-layout>
