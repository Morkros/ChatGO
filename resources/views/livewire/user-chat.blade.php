<div class="flex-1 p-4 overflow-y-auto dark:text-white" id="messages-container" style="height: 400px;">
    @if ($selectedContactId)
        <ul class="space-y-2">
            @foreach ($messages as $message)
                @php
                    $isUserMessage = $message->transmitter_id == $user->id;
                    $messageClass = $isUserMessage ? 'bg-emerald-500 text-black' : 'bg-orange-300 text-black';
                    // dd($message);
                @endphp
                <li class="flex {{ $isUserMessage ? 'justify-end' : 'justify-start' }}">
                    <div class="{{ $messageClass }} rounded-lg px-4 py-2 max-w-xs" x-data="{ showTranslated: true }">
                        @if ($isUserMessage)
                            {{ $message->body }}
                        @else
                            <div class="text-xs text-left text-gray-500 flex justify-between items-center">
                                <span>{{ $receptor->username }}</span>
                                @if ($message->translation->message_translated)
                                    <a class="text-[9px] text-gray-500 mt-1 px-2" href="javascript:void(0);"
                                        @click="showTranslated = !showTranslated">
                                        {{-- icono --}}
                                        <x-change-icon class="h-4 text-gray-500"></x-change-icon>
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
                        {{-- @if ($isUserMessage)
                            {{ $message->body }}
                        @else
                            <div class="text-xs text-left text-grey-500">{{ $receptor->username }}</div>
                            {{ $message->message_translated ?? $message->body }}
                        @endif
                        <div class="text-xs text-right text-white-500 mt-1">{{ $message->created_at->format('H:i') }}
                        </div> --}}
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
            console.log("Baja:", messagesContainer.scrollHeight - scrollHeightOld)
            messagesContainer.scrollTop = messagesContainer.scrollHeight -
                scrollHeightOld; // Ajusta scrollTop
            scrollHeightOld = messagesContainer.scrollHeight;
        }, 1);
    });
    document.addEventListener('MensajesCargadosInicio', function() {
        scrollToBottom();
    });
    // Función para hacer scroll al final
    function scrollToBottom() {
        setTimeout(() => {
            console.log("ScrollHeight:", messagesContainer.scrollHeight)
            messagesContainer.scrollTop = messagesContainer.scrollHeight; // Ajusta scrollTop
            scrollHeightOld = messagesContainer.scrollHeight;
        }, 10);
    }

    let cargar = true

    document.addEventListener('MensajesTotalCargados', function() {
        cargar = false
    });
    // Detectar si el usuario ha llegado al inicio del contenedor y llamar al método Livewire para cargar más mensajes
    messagesContainer.addEventListener('scroll', function() {
        console.log(this.scrollTop);
        if ((cargar) && (this.scrollTop === 0) && (messagesContainer.scrollHeight > messagesContainer
                .clientHeight)) {
            Livewire.dispatch('loadMoreMessages');
        }
    });
</script>
