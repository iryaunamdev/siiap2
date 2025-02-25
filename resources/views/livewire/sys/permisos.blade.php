<div>
    <x-dialog-modal wire:model.live="showModalPermisos" maxWidth="sm">
        <x-slot name="title">
            {{ $card_title }}
        </x-slot>

        <x-slot name="content">
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="role_name" value="Nombre del rol" />
                <x-input id="role_name" type="text" class="mt-1 block w-full uppercase" required autocomplete="role_name" wire:model='role_name' />
                <x-input-error for="role_name" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="store()" wire:loading.attr="disabled" class="rounded-md mr-1">
                Guardar
            </x-button>
            <x-secondary-button wire:click="closeModal()" wire:loading.attr="disabled" class="rounded-md">
                Cerrar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    @include('layouts.delete-confirmation-modal')
</div>
