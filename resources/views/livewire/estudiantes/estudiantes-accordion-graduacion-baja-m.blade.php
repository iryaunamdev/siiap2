<div id="accordion-flush-baja-m" data-accordion="collapse"
    data-active-classes="bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
    data-inactive-classes="text-gray-500 dark:text-gray-400" class="mt-4">

    <h3 id="accordion-flush-heading-baja-m">
        <div
            class="flex items-center justify-between w-full pb-2 text-left rtl:text-right text-gray-700 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
            <div class="w-4/5">
                <h3 class="uppercase text-xs font-semibold">
                    @if (isset($estudiante->graduacion_m))
                        Graduación
                    @elseif(isset($estudiante->baja_m))
                        Baja
                    @else
                        Graduación / Baja
                    @endif
                </h3>
                @if (isset($estudiante->graduacion_m))
                    <button wire:click="editGraduacion({{ $estudiante->graduacion_m }})"  class="text-sm text-blue-600 hover:text-blue-400 focus:text-blue-400">
                        <span class="mr-4">{{ $estudiante->graduacion_m->semestre->nombre }}</span>
                        <span>{{ $estudiante->graduacion_m->modalidad->nombre }}</span>
                    </button>
                    <br><span class="italic text-xs text-gray-400">
                        "{{ $estudiante->graduacion_m->titulo ?? 'Título sin definir' }}"
                    </span>
                @elseif(isset($estudiante->baja_m))
                    <button wire:click="editBaja({{ $estudiante->baja_m }})" class="text-sm text-blue-600 hover:text-blue-400 focus:text-blue-400">
                        <i class="fa-solid fa-ban mr-4 text-red-600"></i>
                        <span class="mr-4">{{ $estudiante->baja_m->semestre->nombre }}</span>
                        <span class="mr-4">{{ $estudiante->baja_m->tipo->nombre }}</span>
                        <span>{{ $estudiante->baja_m->motivo->nombre }}</span>
                    </button>
                @endif
            </div>

            <div>
            @if (isset($estudiante->graduacion_m))
                <button type="button" wire:click='addSinodal({{ $estudiante->graduacion_m->id }})'
                    class="link-primary mr-4" title="Agregar Sinodal"><i class="fa-solid fa-users-medical"></i></button>
                <button type="button" wire:click='deleteConfirmationG({{ $estudiante->graduacion_m }})'
                    class="link-danger mr-4" title="Eliminar registro de ingreso"><i
                        class="fa-regular fa-trash"></i></button>
                <button type="button" data-accordion-target="#accordion-flush-body-baja-m" aria-expanded="false"
                    aria-controls="accordion-flush-body-{{ $estudiante->ingreso_m ? $estudiante->ingreso_m->id : '' }}-1">
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            @elseif(isset($estudiante->baja_m))
                <button type="button" wire:click='deleteConfirmationB({{ $estudiante->baja_m }})'
                    class="link-danger mr-4" title="Eliminar registro de ingreso"><i
                        class="fa-regular fa-trash"></i></button>
            @else
                    <button class="link-primary mr-4" type="submit" wire:click="editGraduacion" title="Agregar graduación">
                        <i class="fa-solid fa-plus-large mr-1"></i>
                    </button>
                    <button class="link-danger" type="submit" wire:click="editBaja" title="Dar de baja el estudiante">
                        <i class="fa-solid fa-ban"></i>
                    </button>
            @endif
            </div>
        </div>
    </h3>

    @if (isset($estudiante->graduacion_m))
        <div id="accordion-flush-body-baja-m" class="hidden" aria-labelledby="accordion-flush-heading-baja-m">
            <div class="t-head border-b border-gray-200 dark:border-gray-700">
                <div class="tr grid grid-cols-12 gap-0">
                    <div class="th col-span-10">Sinodales</div>
                    <div class="th col-span-2"></div>
                </div>
            </div>
            <div class="t-body text-gray-500 text-xs mb-8">
                @foreach ($estudiante->graduacion_m->sinodales->sortBy('tutor.fullname') as $sinodal)
                    <div class="tr grid grid-cols-12 gap-0">
                        <div class="td col-span-10">
                            {{ $sinodal->tutor->fullname }}
                        </div>
                        <div class="td col-span-2 text-right">
                            <button type="button" wire:click='deleteConfirmationS({{ $sinodal }})'
                                class="link-danger" title="Eliminar registro de ingreso"><i
                                    class="fa-regular fa-trash fa-lg"></i></button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @elseif(isset($estudiante->baja_m))
    @else
        <span class="italic text-sm text-gray-400">No hay registros de graduación o baja.</span>
    @endif
</div>
