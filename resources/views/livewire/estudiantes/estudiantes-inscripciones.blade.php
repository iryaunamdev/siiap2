<div>
    <div class="flex items-center justify-between w-full pb-2 text-left rtl:text-right text-gray-700 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
        <h3 class="uppercase text-xs font-semibold mt-4">
            Inscripciones
            @if($grado)
                @if(count($estudiante->inscripciones_m))
                <span class="pill-primary">[ {{ count($estudiante->inscripciones_m) }} semestres ]</span>
                @endif
            @else
                @if(count($estudiante->inscripciones_d))
                <span class="pill-primary">[ {{ count($estudiante->inscripciones_d) }} semestres ]</span>
                @endif
            @endif
        </h3>
        <button class="link-primary mr-4" type="submit" wire:click="editInscripcion" title="Agregar Inscripción">
                        <i class="fa-solid fa-plus-large mr-1"></i>
                    </button>
    </div>

    @if($grado)
        @include('livewire.estudiantes.estudiantes-accordion-inscripciones-m')
    @else
        @include('livewire.estudiantes.estudiantes-accordion-inscripciones-d')
    @endif

    @include('layouts.delete-confirmation-modal')

    <x-dialog-modal wire:model="showEditModal" maxWidth="sm">
        <x-slot name="title">
            {{ $card_title }}
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-12 gap-4">
                <div class="relative col-span-5">
                    <x-select-float wire:model='semestre_id' :error="$errors->first('semestre_id')">
                        <option value="" hidden selected></option>
                        @foreach ($c_semestres as $item)
                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </x-select-float>
                    <x-label-float value="Semestre" />
                </div>
                <div class="relative col-span-7">
                    <x-select-float wire:model='adscripcion_id' :error="$errors->first('adscripcion_id')">
                        <option value="" hidden selected></option>
                        @foreach ($c_adscripciones as $item)
                            <option value="{{ $item->id }}">{{ $item->clave }}</option>
                        @endforeach
                    </x-select-float>
                    <x-label-float value="Adscripción" />
                </div>
            </div>
            <div class="text-xs text-red-600 mt-2 {{ !$copy ? 'hidden' : '' }}">
                Para realizar un duplicado de registro es necesario especificar un <span class="font-semibold">semestre distinto</span>. Si el registro contiene Comité Tutor, este se copiara también.
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

    <x-dialog-modal wire:model="showCTModal" maxWidth="sm">
        <x-slot name="title">
            {{ $card_title }}
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-12 gap-4">
                <div class="relative col-span-12">
                    <x-select-float wire:model='tutor_id' :error="$errors->first('tutor_id')">
                        <option value="" hidden selected></option>
                        @foreach ($c_tutores as $item)
                            <option value="{{ $item->id }}">{{ $item->fullname }}</option>
                        @endforeach
                    </x-select-float>
                    <x-label-float value="Tutor" />
                </div>
                <div class="form-check col-span-12">
                    <x-checkbox wire:model="is_principal" />
                    <x-label value="Tutor principal" class="inline-block text-xs" />
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="storeCT()" wire:loading.attr="disabled" class="rounded-md mr-1">
                Guardar
            </x-button>
            <x-secondary-button wire:click="closeModal()" wire:loading.attr="disabled" class="rounded-md">
                Cerrar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
