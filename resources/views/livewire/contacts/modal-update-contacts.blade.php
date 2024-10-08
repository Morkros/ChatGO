<div>
    @if ($ModalUpdate)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <!-- Background backdrop, show/hide based on modal state -->
            <div class="fixed inset-0 bg-gray-700 bg-opacity-50 transition-opacity" aria-hidden="true"></div>

            <div class="fixed inset-0 w-screen overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0">
                    <!-- Modal panel, show/hide based on modal state -->
                    <div class="relative transform overflow-hidden rounded-lg bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        <div class="bg-gray-800 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-base font-semibold leading-6 text-white" id="modal-title">
                                    Modificar Contacto
                                </h3>
                                <button type="button" wire:click="closeModal('ModalUpdate')" class="text-gray-400 hover:text-white focus:outline-none">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="mt-4">
                                <label for="contactName" class="block text-sm font-medium text-gray-300">Nombre</label>
                                <input wire:model="name" id="contactName" type="text" class="block w-full bg-gray-700 text-white border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">

                                <label for="contactEmail" class="mt-4 block text-sm font-medium text-gray-300">Email</label>
                                <input wire:model="email" id="contactEmail" type="text" disabled class="block w-full bg-gray-700 text-white border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">

                                <button wire:click="updateContact()" wire:loading.attr="disabled" class="mt-3 bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                    Actualizar
                                </button>
                                @if ($aviso)
                                    <span class="ml-3 text-gray-500">{{ $aviso }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
