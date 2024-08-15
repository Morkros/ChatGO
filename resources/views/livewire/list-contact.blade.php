<div class="p-4">
    <ul class="space-y-0.5">
        @foreach($contacts as $contact)
            <li>
                <button 
                    type="button" 
                    class="w-full dark:text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 transition duration-200"
                    wire:click="Evento({{ $contact->id }})">
                    {{ $contact->name }}
                </button>
            </li>
        @endforeach
    </ul>
</div>

