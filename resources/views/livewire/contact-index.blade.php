<x-app-layout>
    <style>
        .custom-min-h {
            min-height: calc(100vh - 65px);
            max-height: calc(100vh - 65px); 
        }
    </style>
    <div class="bg-white dark:bg-gray-800 custom-min-h w-full mx-auto rounded-lg shadow-lg flex flex-col">
        <div class="flex flex-1 overflow-hidden">
            {{-- barra --}}
            <div class="w-64 bg-gray-100 dark:bg-gray-700 border-r border-gray-300 dark:border-gray-600 overflow-y-auto">
                @foreach ($collection as $item)
                    
                @endforeach
            </div>
            
        </div>
    </div>
</x-app-layout>

