@if (isset($estudiante->inscripciones_m))
    @foreach ($estudiante->inscripciones_d->sortBy('semestre.nombre') as $inscripcion)
        <div id="accordion-flush-insc-d-{{ $inscripcion->id }}" data-accordion="collapse"
            data-active-classes="bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
            data-inactive-classes="text-gray-500 dark:text-gray-400">

            <h3 id="accordion-flush-heading-insc-d-{{ $inscripcion->id }}">
                <div
                    class="flex items-center justify-between w-full pb-2 text-left rtl:text-right text-gray-700 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
                    <div>
                        <button wire:click='editInscripcion({{ $inscripcion }})' class="text-sm text-blue-600 hover:text-blue-400 focus:text-blue-400">
                            <span class="mr-4">{{ $inscripcion->semestre->nombre }}</span>
                            <span class="mr-4">[{{ $inscripcion->programa->clave }}]
                                {{ $inscripcion->programa->nombre }}</span>
                            <span>{{ $inscripcion->adscripcion->clave }}</span>
                        </button>
                    </div>
                    <div>
                        <button type="button" wire:click='addCT({{ $inscripcion->id }})'
                            class="link-primary mr-4" title="Agregar Tutor"><i class="fa-solid fa-users-medical"></i></button>
                        <button type="button" wire:click='editInscripcion({{ $inscripcion }}, 1)'
                                class="link-info mr-4" title="Duplicar inscripción"><i class="fa-duotone fa-solid fa-copy"></i></button>
                        <button type="button" wire:click='deleteInscripcion({{ $inscripcion }})'
                            class="link-danger mr-4" title="Eliminar registro de ingreso"><i
                                class="fa-regular fa-trash"></i></button>
                        <button type="button"
                            data-accordion-target="#accordion-flush-body-insc-d-{{ $inscripcion->id }}"
                            aria-expanded="false"
                            aria-controls="accordion-flush-body-{{ $inscripcion->id }}">
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </div>
                </div>
            </h3>

            <div id="accordion-flush-body-insc-d-{{ $inscripcion->id }}" class="hidden"
                aria-labelledby="accordion-flush-heading-insc-d-{{ $inscripcion->id }}">
                <div class="t-head border-b border-gray-200 dark:border-gray-700">
                    <div class="tr grid grid-cols-12 gap-0">
                        <div class="th col-span-8">Comité Tutor</div>
                        <div class="th col-span-2"></div>
                        <div class="th col-span-2"></div>
                    </div>
                </div>
                <div class="t-body text-gray-500 text-xs mb-8">
                    @foreach ($inscripcion->comite->sortBy('tutor.fullname') as $ct)
                        <div class="tr grid grid-cols-12 gap-0">
                            <div class="td col-span-8">
                                {{ $ct->tutor->fullname }}
                            </div>
                            <div class="td col-span-2"><span
                                    class="badge-primary text-xs {{ !$ct->principal ? 'hidden' : '' }}">Principal</span>
                            </div>
                            <div class="td col-span-2 text-right">
                                <button type="button" wire:click='deleteCT({{ $ct }})'
                                class="link-danger" title="Eliminar registro de ingreso"><i
                                    class="fa-regular fa-trash fa-lg"></i></button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
@else
    <span class="italic text-sm text-gray-400">No hay registros de inscripción en doctorado.</span>
@endif
