<div>
    @include('layouts.delete-confirmation-modal')
    @include('livewire.clases.clases-estudiante-edit-modal')

    <div id="accordion-flush-{{ $clase->id }}-estudiantes" data-accordion="collapse"
        data-active-classes="bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
        data-inactive-classes="text-gray-500 dark:text-gray-400">

        <h3 id="accordion-flush-heading-ingreso-d">
            <div
                class="flex items-center justify-between w-full pb-2 text-left rtl:text-right text-gray-700 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
                <div>
                    <h3 class="uppercase text-xs font-semibold">Estudiantes
                        @if(count($clase->estudiantes))
                        <span class="pill-primary-600">{{ count($clase->estudiantes) }}</span>
                        @endif
                    </h3>
                </div>
                <div>
                    <button class="link-primary" type="submit" wire:click="edit" title="Agregar Estudiante">
                        <i class="fa-solid fa-plus-large mr-1"></i>
                    </button>
                    @if (count($clase->estudiantes))
                        <button type="button"
                            data-accordion-target="#accordion-flush-body-{{ $clase->id }}-estudiantes"
                            aria-expanded="false"
                            aria-controls="accordion-flush-body-{{ $clase->id }}-tutores">
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    @endif
                <div>
            </div>
        </h3>
        @if (count($clase->estudiantes))
            <div id="accordion-flush-body-{{ $clase->id }}-estudiantes" class="hidden"
                aria-labelledby="accordion-flush-heading-{{ $clase->id }}-estudiantes">
                <div class="t-head">
                    <div class="tr grid grid-cols-12 gap-0">
                        <div class="th col-span-8">Estudiante</div>
                        <div class="th col-span-2 text-center">Calificación</div>
                        <div class="th col-span-2"></div>
                    </div>
                </div>
                <div class="t-body text-gray-500 text-xs mb-8">
                    @foreach ($clase->estudiantes->sortBy('estudiante.fullname') as $e)
                    <div class="tr grid grid-cols-12 gap-0">
                        <div class="td col-span-8">
                            <button wire:click='edit({{ $e }})' class="link-primary">{{ $e->estudiante->fullname }}</button>
                        </div>
                        <div class="td col-span-2 text-center">
                            @if($e->calificacion < 6 OR $e->acreditada == 2)
                            <span class="text-red-600">
                                @if($e->calificacion)
                                    {{ $e->calificacion }}
                                @elseif($e->acreditada==1)
                                    AC
                                @elseif($e->acreditada==2)
                                    NA
                                @endif
                            </span>
                            @else
                                @if($e->calificacion)
                                    {{ $e->calificacion }}
                                @elseif($e->acreditada==1)
                                    AC
                                @elseif($e->acreditada==2)
                                    NA
                                @endif
                            @endif
                        </div>
                        <div class="td col-span-2 text-right">
                            <button type="button" wire:click='deleteEstudiante({{ $e }})' class="link-danger" title="Eliminar Estudiante">
                                <i class="fa-regular fa-trash fa-lg"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @else
            <span class="italic text-sm text-gray-400">No hay tutores registrados para esta clase.</span>
        @endif
    </div>
</div>
