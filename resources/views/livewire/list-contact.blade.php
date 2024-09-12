<div class="p-4">
    <ul class="space-y-0.5">
        @foreach($contacts as $contact)
            <li>
                <button 
                    type="button" 
                    class="w-full text-white py-2 px-4 rounded-lg hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-75 transition duration-200
                    {{ $selectedContactId === $contact->id ? 'bg-indigo-500' : '' }}"
                    wire:click="Evento({{ $contact->id }})"
                    {{ $selectedContactId === $contact->id ? 'disabled' : '' }}
                    >
                    {{ $contact->name }}
                </button>
            </li>
        @endforeach
    </ul>
</div>

