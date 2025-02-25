<x-dialog-modal wire:model='showEstudianteModal' maxWidth="md">
    <x-slot name="title">
        {{ $card_title }}
    </x-slot>
    <x-slot name="content">
        <form class="grid grid-cols-12 gap-4">
            <div class="relative col-span-full">
                <x-select-float wire:model='estudiante_id' :disabled="$update">
                    <option value="" hidden selected></option>
                    @foreach($c_estudiantes as $item)
                    <option value="{{ $item->id }}">{{ $item->fullname }}</option>
                    @endforeach
                </x-select-float>
                <x-label-float value="Estudiante" />
            </div>

            <div class="relative col-span-4">
                <x-input-float type="number"  autofocus :error="$errors->first('calificacion')"
                                placeholder="Calificación" wire:model='calificacion' min=0 max=10 lang="en" class="text-sm"
                                />
                <x-label-float value="Promedio" class="text-sm" />
            </div>

            <div class="relative col-span-6">
                <x-select-float wire:model='acreditada' class="text-sm">
                    <option value=0>No definida</option>
                    <option value=1>[AC] Acreditada</option>
                    <option value=2>[NA] No Acreditada</option>
                </x-select-float>
                <x-label-float value="Acreditada" />
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
