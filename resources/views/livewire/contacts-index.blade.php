<div class="flex justify-center">
    <div class="overflow-x-auto w-full"> <!-- Wrapper responsive -->
        <table class="min-w-full divide-y divide-gray-700 bg-gray-800 rounded-lg">
            <thead class="bg-gray-900 sticky top-0">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider w-1/3"> <!-- Ancho ajustado -->
                        Name
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider w-1/3"> <!-- Ancho ajustado -->
                        Email
                    </th>
                    <th class="px-4 py-3 text-xs font-medium text-gray-300 uppercase tracking-wider w-1/3"> <!-- Ancho ajustado -->
                        <button wire:click="openModal('ModalAdd')"
                            class="bg-blue-500 text-white uppercase tracking-wider font-semibold py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Agregar
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-gray-800 divide-y divide-gray-700">
                @foreach ($contacts as $contact)
                <tr>
                    <td class="px-4 py-4 text-sm font-medium text-white whitespace-normal break-words"> <!-- Ajuste de texto -->
                        {{ $contact->name }}
                    </td>
                    <td class="px-4 py-4 text-sm text-gray-300 whitespace-normal break-words"> <!-- Ajuste de texto -->
                        {{ $contact->user->email }}
                    </td>
                    <td class="flex justify-center py-3 space-x-2"> <!-- Centrar botones -->
                        <button wire:click="modalUpdate({{ $contact->id }})" class="bg-yellow-700 text-white font-semibold py-2 px-2 rounded hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                        </button>
                        
                        <button wire:click="delete({{ $contact->id }})"
                            class="bg-red-500 text-white font-semibold py-2 px-2 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 1-1 0l-.5-8.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                            </svg>
                        </button>
                    </td>
                </tr>            
                @endforeach
            </tbody>
        </table>
    </div>
    @include('livewire.contacts.modal-add-contacts')
    @include('livewire.contacts.modal-update-contacts')
</div>

