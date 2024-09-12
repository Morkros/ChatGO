<div>

    <table class="min-w-full divide-y divide-gray-700 bg-gray-800">
        <thead class="bg-gray-900">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                    Email
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                    Username
                </th>
                <th class="text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                    <button @click="$dispatch('open-modal', 'addContactModal')"
                        class="justify-center bg-indigo-500 text-white font-semibold py-2 px-2 rounded hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                        Add
                    </button>
                </th>
            </tr>
        </thead>
        <tbody class="bg-gray-800 divide-y divide-gray-700">
            <x-modal name="addContactModal" :show="false" maxWidth="lg">
                <div class="p-6">
                    <input wire:model="email" type="text">
                    <button wire:click="addContact">Create</button>
                    <button @click="$dispatch('close-modal', 'addContactModal')"
                        class="bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Close
                    </button>
                </div>
            </x-modal>
              
            @foreach ($contacts as $contact)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                        {{ $contact->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        {{ $contact->username }}
                    </td>
                    <td>
                        <button wire:click="delete({{ $contact->id }})"
                            wire:confirm="Are you sure you want to delete this post?"
                            class="justify-center bg-red-500 text-white font-semibold py-2 px-3 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                            <x-delete-icon class="w-4 h-4 fill-current text-white" />
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
