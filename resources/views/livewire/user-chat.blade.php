<div class="flex-1 p-4 overflow-y-auto dark:text-white" id="messages-container" style="height: 400px;">
    @if ($receptor)
        <ul class="space-y-2">
            @foreach ($messages as $message)
                @php
                    $isUserMessage = $message->transmitter_id == $user->id;
                    $messageClass = $isUserMessage ? 'bg-emerald-500 text-black' : 'bg-orange-300 text-black';
                    //  dd($message);
                @endphp
                <li class="flex {{ $isUserMessage ? 'justify-end' : 'justify-start' }}">
                    <div class="{{ $messageClass }} rounded-lg px-4 py-2 max-w-xs" x-data="{ showTranslated: true }">
                        @if ($isUserMessage)
                            {{ $message->body }}
                        @else
                            <div class="text-xs text-left text-gray-500 flex justify-between items-center">
                                <span>{{ $receptor->username }}</span>
                                @if (isset($message->translation->message_translated) && $message->body !== $message->translation->message_translated)
                                    <a class="text-[9px] text-gray-500 mt-1 px-2" href="javascript:void(0);"
                                        @click="showTranslated = !showTranslated">
                                        <x-change-icon class="h-3 pl-2 text-gray-500"></x-change-icon>
                                    </a>
                                @endif
                            </div>
                            <span x-show="showTranslated">
                                {{ $message->translation->message_translated ?? $message->body }}
                            </span>
                            <span x-show="!showTranslated">
                                {{ $message->body }}
                            </span>
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
    messagesContainer = document.getElementById('messages-container');

    // Mantener el scroll en la parte inferior al cargar la página
    document.addEventListener('MensajesCargadosInicio', function() {
        scrollToBottom();
        cargar = true // Inicializar carga mas mensajes al abrir chat
    });

    document.addEventListener('MensajesCargados', function() {
        requestAnimationFrame(() => {
            messagesContainer.scrollTop = messagesContainer.scrollHeight - scrollHeightOld;
            scrollHeightOld = messagesContainer.scrollHeight;
        });
    });

    // Función para hacer scroll al final
    function scrollToBottom() {
        setTimeout(() => {
            messagesContainer.scrollTop = messagesContainer.scrollHeight; // Ajusta scrollTop
            scrollHeightOld = messagesContainer.scrollHeight;
        }, 1);
    }

    document.addEventListener('MensajesTotalCargados', function() {
        cargar = false
    });

    // Detectar si el usuario ha llegado al inicio del contenedor y llamar al método Livewire para cargar más mensajes
    messagesContainer.addEventListener('scroll', function() {
        if ((cargar) && (this.scrollTop === 0) && (messagesContainer.scrollHeight > messagesContainer
                .clientHeight)) {
            Livewire.dispatch('loadMoreMessages');
        }
    });
</script>
