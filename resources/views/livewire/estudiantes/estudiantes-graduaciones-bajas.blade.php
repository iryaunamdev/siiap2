<div>
    @if ($grado)
        @include('livewire.estudiantes.estudiantes-accordion-graduacion-baja-m')
    @else
        @include('livewire.estudiantes.estudiantes-accordion-graduacion-baja-d')
    @endif

    @include('layouts.delete-confirmation-modal')

    <!-- Graduacion -->
    <x-dialog-modal wire:model="showEditModal" maxWidth="xl">
        <x-slot name="title">
            {{ $card_title }}
        </x-slot>

        <x-slot name="content">
            <form>
                <div class="grid grid-cols-12 gap-4">
                    <div class="relative col-span-12 md:col-span-3">
                        <x-select-float wire:model='semestre_id' :error="$errors->first('semestre_id')">
                            <option value="" hidden selected></option>
                            @foreach ($c_semestres as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </x-select-float>
                        <x-label-float value="Semestre" />
                    </div>

                    <div class="relative col-span-12 md:col-span-4">
                        <x-input-float type="date" required autofocus placeholder="Fecha" wire:model='fecha'
                            :error="$errors->first('fecha')" class="text-sm" />
                        <x-label-float value="Fecha" />
                    </div>

                    <div class="relative col-span-12 md:col-span-6">
                        <x-select-float wire:model='modalidad_id' :error="$errors->first('modalidad_id')" class="text-xs">
                            <option value="" hidden selected></option>
                            @foreach ($c_modalidades as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </x-select-float>
                        <x-label-float value="Modalidad" />
                    </div>
                    <div class="relative col-span-12 md:col-span-6">
                        <x-select-float wire:model='adscripcion_id' :error="$errors->first('adscripcion_id')" class="text-xs">
                            <option value="" hidden selected></option>
                            @foreach ($c_adscripciones as $item)
                                <option value="{{ $item->id }}">{{ $item->clave }}</option>
                            @endforeach
                        </x-select-float>
                        <x-label-float value="Adscripcion" />
                    </div>

                    <div class="relative col-span-full">
                        <x-textarea-float :error="$errors->first('titulo')" wire:model='titulo' class="text-sm" rows=4 />
                        <x-label-float value="Título" />
                    </div>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="storeGrad()" wire:loading.attr="disabled" class="rounded-md mr-1">
                Guardar
            </x-button>
            <x-secondary-button wire:click="closeModal()" wire:loading.attr="disabled" class="rounded-md">
                Cerrar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Bajas -->
    <x-dialog-modal wire:model="showBajaModal" maxWidth="xl">
        <x-slot name="title">
            {{ $card_title }}
        </x-slot>

        <x-slot name="content">
            <form>
                <div class="grid grid-cols-12 gap-4">
                    <div class="relative col-span-12 md:col-span-3">
                        <x-select-float wire:model='semestre_id' :error="$errors->first('semestre_id')">
                            <option value="" hidden selected></option>
                            @foreach ($c_semestres as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </x-select-float>
                        <x-label-float value="Semestre" />
                    </div>

                    <div class="relative col-span-12 md:col-span-4">
                        <x-input-float type="date" required autofocus placeholder="Fecha" wire:model='fecha'
                            :error="$errors->first('fecha')" class="text-xs" />
                        <x-label-float value="Fecha" />
                    </div>
                    <div class="relative col-span-12 md:col-span-5">
                        <x-select-float wire:model='tipo_id' :error="$errors->first('tipo_id')">
                            <option value="" hidden selected></option>
                            @foreach ($c_tipos_bajas as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </x-select-float>
                        <x-label-float value="Tipo de baja" />
                    </div>
                    <div class="relative col-span-12 md:col-span-7">
                        <x-select-float wire:model='motivo_id' :error="$errors->first('motivo_id')" class="text-sm">
                            <option value="" hidden selected></option>
                            @foreach ($c_motivos as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </x-select-float>
                        <x-label-float value="Motivo de baja" />
                    </div>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="storeBaja()" wire:loading.attr="disabled" class="rounded-md mr-1">
                Guardar
            </x-button>
            <x-secondary-button wire:click="closeModal()" wire:loading.attr="disabled" class="rounded-md">
                Cerrar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Sinodal -->
    <x-dialog-modal wire:model="showSinodalModal" maxWidth="md">
        <x-slot name="title">
            {{ $card_title }}
        </x-slot>

        <x-slot name="content">
            <form>
                <div class="relative">
                    <x-select-float wire:model='tutor_id' :error="$errors->first('tutor_id')">
                        <option value="" hidden selected></option>
                        @foreach ($c_tutores as $item)
                            <option value="{{ $item->id }}">{{ $item->fullname }}</option>
                        @endforeach
                    </x-select-float>
                    <x-label-float value="Sinodal" />
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="storeSinodal()" wire:loading.attr="disabled" class="rounded-md mr-1">
                Guardar
            </x-button>
            <x-secondary-button wire:click="closeModal()" wire:loading.attr="disabled" class="rounded-md">
                Cerrar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
