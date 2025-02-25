<!-- Delete Confirmation Modal -->
<x-dialog-modal wire:model="deleteModal" maxWidth="md">
    <x-slot name="title">
        Confirmación de eliminación
    </x-slot>

    <x-slot name="content">
        {{ $delete_message ?? 'El registro se eliminará de manera permanente.' }}
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('deleteModal')" wire:loading.attr="disabled" class="rounded-md mr-2">
            Cancelar
        </x-secondary-button>

        <x-danger-button class="ml-3" wire:click="delete()" wire:loading.attr="disabled" class="rounded-md">
            Eliminar
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
