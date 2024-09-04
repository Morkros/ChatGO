<div class="flex-1 p-4 overflow-y-auto dark:text-white">
    @if ($selectedContactId)
        <ul class="space-y-2">
            @foreach ($messages as $message)
            @php
                    $isUserMessage = $message->transmitter_id == $user->id;
                    $messageClass = $isUserMessage ? 'bg-emerald-500 dark:text-black' : 'bg-orange-300 dark:text-black';
                    // $messageBody = $isUserMessage ? $message->body : $message->message_translated;
                    @endphp
                <li class="flex {{ $isUserMessage ? 'justify-end' : 'justify-start' }}">
                    <div class="{{ $messageClass }} rounded-lg px-4 py-2 max-w-xs">
                        {{-- @dd($message,$message->created_at) --}}
                        @if ($isUserMessage)
                        {{ $message->body }}
                        @else
                        {{ $message->message_translated }}
                        @endif
                        <div class="text-xs text-right text-white-500 mt-1">{{ $message->created_at->format('H:i') }}</div>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="dark:text-white">Seleccionar Chat.</p>
    @endif
</div>
