<div class="p-4">
    <ul class="space-y-0.5">
        @foreach ($contacts as $contact)
        {{-- @dd($contacts) --}}
            <button type="button"
                class="relative w-full text-white py-2 px-4 rounded-lg hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-75 transition duration-200
            {{ $selectedContactId === $contact->user_id ? 'bg-indigo-500' : '' }}"
                wire:click="Evento({{ $contact->user_id }})"
                {{ $selectedContactId === $contact->user_id ? 'disabled' : '' }}>
                {{-- {{ $contact->name }} --}}
                    <div>
                        {{-- @dd($contacts) --}}
                        <span>{{ $contact->name ?? $contact->email }}</span>
                        @if (($selectedContactId !== $contact->user_id) && ($contact->unread_message_count > 0))
                            <span class="bg-red-500 text-white rounded-full px-2">{{ $contact->unread_message_count }}</span>
                        @endif
                    </div>
            </button>
        @endforeach
    </ul>
</div>
