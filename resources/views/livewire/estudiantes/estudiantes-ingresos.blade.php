<div>
    @if($grado)
        @include('livewire.estudiantes.estudiantes-accordion-ingresos-m')
    @else
        @include('livewire.estudiantes.estudiantes-accordion-ingresos-d')
    @endif

    @include('layouts.delete-confirmation-modal')

    <x-dialog-modal wire:model="showIngresosModal" maxWidth="sm">
        <x-slot name="title">
            {{ $card_title }}
        </x-slot>
        <x-slot name="content">
            <form>
                <div class="grid grid-cols-12 gap-4">
                    <div class="relative col-span-12 md:col-span-6">
                        <x-select-float wire:model='semestre_id' :error="$errors->first('semestre_id')">
                            <option value="" hidden selected></option>
                            @foreach($c_semestres as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </x-select-float>
                        <x-label-float value="Semestre" />
                    </div>
                    <div class="relative col-span-12 md:col-span-6">
                        <x-select-float wire:model='grado_id'
                                        :error="$errors->first('grado_id')" :disabled="$is_update">
                            <option value="" hidden selected></option>
                            @foreach($c_grados as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </x-select-float>
                        <x-label-float value="Grado" />
                    </div>

                    <div class="relative col-span-12">
                        <x-select-float wire:model='programa_id' :error="$errors->first('programa_id')" class="text-sm">
                            <option value="" hidden selected></option>
                            @foreach($c_programas as $item)
                                <option value="{{ $item->id }}">[{{ $item->clave }}] {{ $item->nombre }}</option>
                            @endforeach
                        </x-select-float>
                        <x-label-float value="Programa de ingreso" />
                    </div>

                    <h3 class="col-span-full text-base border-b text-gray-500">Datos de procedencia</h3>

                    <div class="relative col-span-12">
                        <x-select-float wire:model='universidad_id' :error="$errors->first('universidad_id')" class="text-xs">
                            <option value="" hidden selected></option>
                            @foreach($c_universidades as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </x-select-float>
                        <x-label-float value="Universidad de procedencia" />
                    </div>

                    <div class="relative col-span-12">
                        <x-select-float wire:model='procedencia_id' :error="$errors->first('procedencia_id')" class="text-xs">
                            <option value="" hidden selected></option>
                            @foreach($c_procedencias as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </x-select-float>
                        <x-label-float value="Programa de procedencia" />
                    </div>

                    <div class="relative col-span-4">
                        <x-input-float type="number"  autofocus :error="$errors->first('promedio')"
                                        placeholder="Promedio" wire:model='promedio' min=0 max=10 lang="en" class="text-sm"
                                        />
                        <x-label-float value="Promedio" class="text-xs" />
                    </div>
                </div>
            </form>
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
</div>

