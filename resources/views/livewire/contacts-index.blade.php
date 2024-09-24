<div>

    <table class="min-w-full divide-y divide-gray-700 bg-gray-800">
        <thead class="bg-gray-900">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                    Name
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                    Email
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                    <button wire:click="openModal('ModalAdd')"
                        class="bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Add Contact
                    </button>
                </th>
            </tr>
        </thead>
        <tbody class="bg-gray-800 divide-y divide-gray-700">
            @foreach ($contacts as $contact)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                        {{ $contact->username }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        {{ $contact->email }}
                    </td>
                    <td>
                        <button wire:click="delete({{ $contact->id }})"
                            wire:confirm="Are you sure you want to delete this post?"
                            class="bg-red-500 text-white font-semibold py-2 px-4 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('livewire.contacts.modal-add-contacts')
    <div>
