<x-confirmation-modal wire:model='deleteModal' maxWidth="sm" >
    <x-slot name="title">
        <span class="text-sm font-normal text-red-900">
            <span class="text-base font-normal text-red-900">Eliminar registro</span>
        </span>
    </x-slot>
    <x-slot name="content">
        <div class="grid grid-cols-12 gap-4">
            <div class="relative col-span-full">
                <p class="text-sm text-gray-600">¿Está seguro de que desea eliminar este registro?</p>
            </div>
        </div>
    </x-slot>
    <x-slot name="footer">
        <x-danger-button wire:click="delete" wire:loading.attr="disabled" class="rounded-s-lg">
            Eliminar
        </x-danger-button>
        <x-secondary-button wire:click="$set('deleteModal', false)" wire:loading.attr="disabled" class="rounded-e-lg">
            Cerrar
        </x-secondary-button>
    </x-slot>
</x-confirmation-modal>
