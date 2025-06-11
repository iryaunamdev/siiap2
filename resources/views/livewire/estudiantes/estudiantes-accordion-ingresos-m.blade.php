<div id="accordion-flush-ingreso-m" data-accordion="collapse"
    data-active-classes="bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
    data-inactive-classes="text-gray-500 dark:text-gray-400">
    <h3 id="accordion-flush-heading-ingreso-m">
        <div
            class="flex items-center justify-between w-full pb-2 text-left rtl:text-right text-gray-700 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
            <div>
                <h3 class="uppercase text-xs font-semibold">Ingreso</h3>
                @if (isset($estudiante->ingreso_m))
                    <button class="text-sm link-primary"
                        wire:click="editIngreso({{ $estudiante->ingreso_m->id }})">
                        <span class="mr-4">{{ $estudiante->ingreso_m->semestre->nombre }}</span>
                        <span>[{{ $estudiante->ingreso_m->programa ? $estudiante->ingreso_m->programa->clave : '' }}]
                            {{ $estudiante->ingreso_m->programa ? $estudiante->ingreso_m->programa->nombre : ''}}</span>
                    </button>
                @endif
            </div>
            @if (isset($estudiante->ingreso_m))
            <div>
                <button type="button" wire:click='deleteConfirmation({{ $estudiante->ingreso_m }})' class="link-danger mr-4" title="Eliminar registro de ingreso"><i class="fa-regular fa-trash"></i></button>
                <button type="button" data-accordion-target="#accordion-flush-body-ingreso-m" aria-expanded="false"
                    aria-controls="accordion-flush-body-ingreso-m" title="">
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </div>
            @else
            <button class="link-primary" type="submit" wire:click="editIngreso" title="Agregar ingreso a maestría">
                <i class="fa-solid fa-plus-large mr-1"></i>
            </button>
            @endif
        </div>
    </h3>

    @if (isset($estudiante->ingreso_m))
        <div id="accordion-flush-body-ingreso-m" class="hidden" aria-labelledby="accordion-flush-heading-ingreso-m">
            <div class="t-head border-b border-gray-200 dark:border-gray-700">
                <div class="tr grid grid-cols-12 gap-0">
                    <div class="th col-span-5">Universidad de procedencia</div>
                    <div class="th col-span-5">Programa de procedencia</div>
                    <div class="th col-span-2">Promedio</div>
                </div>
            </div>
            <div class="t-body text-gray-500 text-xs mb-8">
                <div class="tr grid grid-cols-12 gap-0">
                    <div class="td col-span-5">
                        {{ $estudiante->ingreso_m->universidad ? $estudiante->ingreso_m->universidad->nombre : '' }}
                    </div>
                    <div class="td col-span-5">
                        {{ $estudiante->ingreso_m->procedencia ? $estudiante->ingreso_m->procedencia->nombre : '' }}
                    </div>
                    <div class="td col-span-2">
                        {{ $estudiante->ingreso_m->promedio ? $estudiante->ingreso_m->promedio : '' }}</div>
                </div>
            </div>
        </div>
    @else
        <span class="italic text-sm text-gray-400">No hay registros de ingreso en maestría.</span>
    @endif
</div>
