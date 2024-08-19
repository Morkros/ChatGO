<x-app-layout>

    <table class="min-w-full divide-y divide-gray-700 bg-gray-800">
        <thead class="bg-gray-900">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                    ID
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                    Username
                </th>
                <th>

                </th>
            </tr>
        </thead>
        <tbody class="bg-gray-800 divide-y divide-gray-700">
            @foreach ($contacts as $contact)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                        {{ $contact->id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        {{ $contact->username }}
                    </td>
                    <td>
                        <button wire:click="delete"
                        class="bg-red-500 text-white font-semibold py-2 px-4 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">   
                        Eliminar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-white mt-4">
        <!-- Si deseas mostrar algún otro contenido o mensaje, puedes hacerlo aquí -->
    </div>
</x-app-layout>

