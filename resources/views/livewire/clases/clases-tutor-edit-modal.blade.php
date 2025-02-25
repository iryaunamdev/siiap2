<x-dialog-modal wire:model='showTutorModal' maxWidth="md">
    <x-slot name="title">
        {{ $card_title }}
    </x-slot>
    <x-slot name="content">
        <form class="grid grid-cols-12 gap-4">
            <div class="relative col-span-full">
                <x-select-float wire:model='tutor_id' :disabled="$update">
                    <option value="" hidden selected></option>
                    @foreach($c_tutores as $item)
                    <option value="{{ $item->id }}">{{ $item->fullname }}</option>
                    @endforeach
                </x-select-float>
                <x-label-float value="Tutor" />
            </div>
            <div class="form-check col-span-12">
                <x-checkbox wire:model="principal" />
                <x-label value="Tutor principal" class="inline-block ml-4" />
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-button wire:click="store()" wire:loading.attr="disabled" class="rounded-s-lg">
            Guardar
        </x-button>
        <x-secondary-button wire:click="closeModal()" wire:loading.attr="disabled" class="rounded-e-lg">
            Cerrar
        </x-secondary-button>
    </x-slot>
</x-dialog-modal>
