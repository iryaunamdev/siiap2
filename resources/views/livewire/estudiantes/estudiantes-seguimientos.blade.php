<div>
    <div class="flex items-center justify-between w-full pb-2 text-left rtl:text-right text-gray-700 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 mb-4">
        <h3 class="uppercase text-xs font-semibold mt-4">Seguimiento Académico</h3>
        <div>
            <button class="link-primary" type="submit" wire:click="editSeguimiento" title="Agregar seguimiento">
                <i class="fa-solid fa-plus-large mr-1"></i>
            </button>
        </div>
    </div>

    @include('livewire.estudiantes.estudiantes-accordion-seguimientos')
    @include('layouts.delete-confirmation-modal')

    <x-dialog-modal wire:model="showSeguimientosModal">
        <x-slot name="title">
            {{ $card_title }}
        </x-slot>
        <x-slot name="content">
            <form>
                <div class="grid grid-cols-12 gap-4">

                    <div class="relative col-span-3">
                        <x-input-float type="date"  autofocus :error="$errors->first('fecha')"
                                        placeholder="fecha" wire:model='fecha' class="text-sm"
                                        />
                        <x-label-float value="Fecha" class="text-sm" />
                    </div>

                    <div class="relative col-span-12 md:col-span-4">
                        <x-select-float wire:model='tipo_id' :error="$errors->first('tipo_id')" class="text-sm">
                            <option value="" hidden selected></option>
                            @foreach($c_tipos as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </x-select-float>
                        <x-label-float value="Tipo de trabajo" />
                    </div>

                    <div class="relative col-span-12 md:col-span-5">
                        <x-select-float wire:model='estatus_id' :error="$errors->first('estatus_id')" class="text-sm">
                            <option value="" hidden selected></option>
                            @foreach($c_estatus as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </x-select-float>
                        <x-label-float value="Estatus" />
                    </div>

                    <div class="relative col-span-full">
                        <x-input-float type="text"  autofocus :error="$errors->first('titulo')"
                                        placeholder="Título" wire:model='titulo' class="text-sm"
                                        />
                        <x-label-float value="Título" class="text-sm" />
                    </div>

                    <div class="relative col-span-4">
                        <x-input-float type="text"  autofocus :error="$errors->first('bibcode')"
                                        placeholder="Bibcode" wire:model='bibcode' class="text-sm"
                                        />
                        <x-label-float value="Bibcode" class="text-sm" />
                    </div>
                    <div class="relative col-span-4">
                        <x-input-float type="text"  autofocus :error="$errors->first('doi')"
                                        placeholder="DOI" wire:model='doi' class="text-sm"
                                        />
                        <x-label-float value="DOI" class="text-sm" />
                    </div>

                    <div class="relative col-span-full">
                        <x-textarea-float autofocus :error="$errors->first('comentarios')"
                                        placeholder="Comentarios" wire:model='comentarios' class="text-sm" rows=4
                                        />
                        <x-label-float value="Comentarios" class="text-sm" />
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
