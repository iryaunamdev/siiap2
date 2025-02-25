<x-dialog-modal wire:model="showModalItem" maxWidth="md">
    <x-slot name="title">
        {{ $card_title }}
    </x-slot>
    <x-slot name="content">
        <div class="grid grid-cols-2 gap-4">
            <div class="">
                <x-label for="clave" value="Clave" />
                <x-input id="clave" type="text" class="mt-1 block w-full" required autocomplete="clave"
                    wire:model='clave' />
                <x-input-error for="clave" class="mt-2" />
            </div>
            <div class="col-span-2">
                <x-label for="nombre" value="Descripción" />
                <x-input id="nombre" type="text" class="mt-1 block w-full" required autocomplete="nombre"
                    wire:model='nombre' />
                <x-input-error for="nombre" class="mt-2" />
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-button wire:click="storeItem" wire:loading.attr="disabled" class="rounded-md mr-2">Guardar</x-button>
        <x-secondary-button wire:click="closeModal()" wire:loading.attr="disabled" class="rounded-md">
            Cerrar
        </x-secondary-button>
    </x-slot>

</x-dialog-modal>
