<div id="accordion-flush-ct-m" data-accordion="collapse"
    data-active-classes="bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
    data-inactive-classes="text-gray-500 dark:text-gray-400">
    <h3 id="accordion-flush-heading-ingreso-m">
        <div class="flex items-center justify-between w-full pb-2 text-left rtl:text-right text-gray-700 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
            <h3 class="uppercase text-xs font-semibold">Maestría
            @if (count($tutor->comites_m))
                <span class="pill-primary-600 ml-4">{{ count($tutor->comites_m->groupBy('estudiante_id')) }} Tutorias</span>
            @endif
            </h3>

            <button type="button" data-accordion-target="#accordion-flush-body-ct-m" aria-expanded="false"
                    aria-controls="accordion-flush-body-ct-m" title="">
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
            </button>
        </div>
    </h3>

    @if(count($tutor->comites_m))
    <div id="accordion-flush-body-ct-m" class="hidden" aria-labelledby="accordion-flush-heading-ct-m">
        <div class="t-body">
            @foreach ($tutor->comites_m->sortByDesc('inscripcion.semestre.nombre')->groupBy('estudiante_id') as $ct )
            <div class="tr grid grid grid-cols-12 py-2 text-sm">
                <div class="col-span-3">{{ $ct->last() ? $ct->last()->inscripcion->semestre->nombre : $ct->first()->inscripcion->semestre->nombre }} - {{ $ct->first()->inscripcion->semestre->nombre }}</div>
                <div class="col-span-6">
                    {{ $ct->first()->estudiante->fullname }}
                    @if($ct->first()->principal)
                        <br><span class="pill-primary">Principal</span>
                    @endif
                </div>
                <div class="col-span-3 text-right">{{ $ct->first()->inscripcion->adscripcion->clave }}</div>
            </div>
            @endforeach
        </div>
    </div>
    @else
        <span class="italic text-sm text-gray-400">No hay registros tutorias de maestría.</span>
    @endif
</div>

