<div class="flex-1 p-4 overflow-y-auto dark:text-white">
    @if($selectedContactId)
            @foreach($messages as $message)
                <li>
                    {{$message}}
                </li>
            @endforeach
    @else
        <p class="dark: text-white">Seleccionar Chat.</p>
    @endif
</div>

