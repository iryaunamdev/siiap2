<x-dialog-modal wire:model='duplicarModal' maxWidth="md">
    <x-slot name="title">
        <span class="text-sm font-normal text-blue-900">
            <span class="text-base font-normal text-blue-900">{{ $materia ? $materia->nombre : ''}}</span>

        </span>
        {{--
        {{ $to_duplicate->grupo ? $to_duplicate->grupo : ''}}</span>
        <span class="text-sm font-normal text-blue-900">{{ $to_duplicate->materia ? $to_duplicate->materia->nombre : ''}}</span>
        <span class="pill-secondary">{{ $to_duplicate->tipo ? $to_duplicate->tipo->nombre : '' }}</span>--}}
    </x-slot>
    <x-slot name="content">
        <div class="grid grid-cols-12 gap-4">
            <div class="relative col-span-4">
                <x-select-float wire:model='semestre_id' :error="$errors->first('semestre_id')">
                    <option value="" hidden selected></option>
                    @foreach ($c_semestres as $item)
                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                    @endforeach
                </x-select-float>
                <x-label-float value="Semestre" />
            </div>
            <div class="relative col-span-4">
                <x-input-float type="number"  autofocus :error="$errors->first('grupo')"
                                placeholder="Grupo" wire:model='grupo' min=0 class="text-sm"
                                />
                <x-label-float value="Grupo" class="text-sm"/>
            </div>
            <div class="relative col-span-full">
                <x-select-float wire:model='adscripcion_id' :error="$errors->first('adscripcion_id')" class="text-sm">
                    <option value="" hidden selected></option>
                    @foreach ($c_adscripciones as $item)
                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                    @endforeach
                </x-select-float>
                <x-label-float value="Adscripción" />
            </div>
        </div>

    </x-slot>
    <x-slot name="footer">
        <x-button wire:click="duplicar" wire:loading.attr="disabled" class="rounded-s-lg">
            Duplicar
        </x-button>
        <x-secondary-button wire:click="closeModal()" wire:loading.attr="disabled" class="rounded-e-lg">
            Cerrar
        </x-secondary-button>
    </x-slot>
</x-dialog-modal>
