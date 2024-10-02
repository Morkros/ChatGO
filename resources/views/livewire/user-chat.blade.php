<div class="flex-1 p-4 overflow-y-auto dark:text-white" id="messages-container">
    @if ($selectedContactId)
        <ul class="space-y-2">
            @foreach ($messages as $message)
                @php
                    $isUserMessage = $message->transmitter_id == $user->id;
                    $messageClass = $isUserMessage ? 'bg-emerald-500 text-black' : 'bg-orange-300 text-black';
                    // $messageBody = $isUserMessage ? $message->body : $message->message_translated;
                @endphp
                <li class="flex {{ $isUserMessage ? 'justify-end' : 'justify-start' }}">
                    <div class="{{ $messageClass }} rounded-lg px-4 py-2 max-w-xs">
                        {{-- @dd($message,$receptor)  --}}
                        {{-- @dd($message) --}}
                        @if ($isUserMessage)
                            {{ $message->body }}
                        @else
                            <div class="text-xs text-left text-grey-500">{{ $receptor->username }}</div>
                            {{ $message->message_translated }}
                        @endif
                        <div class="text-xs text-right text-white-500 mt-1">{{ $message->created_at->format('H:i') }}
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-white">Seleccionar Chat.</p>
    @endif
    @push('scripts')
    <script>
    const messagesContainer = document.getElementById('messages-container');

    function scrollToBottom() {
        console.log();
        
        setTimeout(() => {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }, 100); // Ajusta el tiempo si es necesario
    }

    Livewire.on('messagesUpdated', scrollToBottom); // Escuchar el evento
</script>
@endpush
</div>

