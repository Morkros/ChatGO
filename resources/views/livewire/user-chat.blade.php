<div class="flex-1 p-4 overflow-y-auto dark:text-white" id="messages-container" style="height: 400px;">
    @if ($selectedContactId)
        <ul class="space-y-2">
            @foreach ($messages as $message)
                @php
                    $isUserMessage = $message->transmitter_id == $user->id;
                    $messageClass = $isUserMessage ? 'bg-emerald-500 text-black' : 'bg-orange-300 text-black';
                @endphp
                <li class="flex {{ $isUserMessage ? 'justify-end' : 'justify-start' }}">
                    <div class="{{ $messageClass }} rounded-lg px-4 py-2 max-w-xs">
                        @if ($isUserMessage)
                            {{ $message->body }}
                        @else
                            <div class="text-xs text-left text-gray-500">{{ $receptor->username }}</div>
                            {{ $message->message_translated ?? $message->body }}
                            @if ($message->message_translated)
                                <a class="text-[9px] text-left text-white-500 mt-1" href="">Mostrar original</a>
                            @endif
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
</div>

<script>
    const messagesContainer = document.getElementById('messages-container');
    let scrollHeightOld;
    // Mantener el scroll en la parte inferior al cargar la página
    document.addEventListener('MensajesCargados', function() {
        setTimeout(() => {
        console.log("Baja:",messagesContainer.scrollHeight-scrollHeightOld)
        messagesContainer.scrollTop = messagesContainer.scrollHeight-scrollHeightOld; // Ajusta scrollTop
        scrollHeightOld = messagesContainer.scrollHeight;
        }, 10);
    });
    document.addEventListener('MensajesCargadosInicio', function() {
        scrollToBottom();
    });
    // Función para hacer scroll al final
    function scrollToBottom() {
        setTimeout(() => {
        console.log("ScrollHeight:",messagesContainer.scrollHeight)
            messagesContainer.scrollTop = messagesContainer.scrollHeight; // Ajusta scrollTop
            scrollHeightOld = messagesContainer.scrollHeight;
        }, 10);
    }

    // Detectar si el usuario ha llegado al inicio del contenedor y llamar al método Livewire para cargar más mensajes
    messagesContainer.addEventListener('scroll', function() {
        if ((this.scrollTop === 0) && (messagesContainer.scrollHeight > messagesContainer.clientHeight)) {
            Livewire.dispatch('loadMoreMessages');
        }
    });
</script>
