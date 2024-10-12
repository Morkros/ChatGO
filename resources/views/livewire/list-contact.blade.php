<div class="p-4">
    <ul class="space-y-0.5">
        @foreach ($contacts as $contact)
            <button type="button"
                class="relative w-full text-white py-2 px-4 rounded-lg hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-75 transition duration-200
            {{ $selectedContactId === $contact->user->id ? 'bg-indigo-500' : '' }}"
                wire:click="Evento({{ $contact->user->id }})"
                {{ $selectedContactId === $contact->user->id ? 'disabled' : '' }}>
                {{-- {{ $contact->name }} --}}
                    <div>
                        <span>{{ $contact->name }}</span>
                        @if (($selectedContactId !== $contact->user->id) && ($contact->unread_message > 0))
                            <span class="bg-red-500 text-white rounded-full px-2">{{ $contact->unread_message }}</span>
                        @endif
                    </div>
            </button>
        @endforeach
    </ul>
</div>
