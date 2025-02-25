<div id="accordion-flush-clases-m" data-accordion="collapse"
    data-active-classes="bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
    data-inactive-classes="text-gray-500 dark:text-gray-400">
    <h3 id="accordion-flush-heading-ingreso-m">
        <div class="flex items-center justify-between w-full pb-2 text-left rtl:text-right text-gray-700 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
            <h3 class="uppercase text-xs font-semibold">Materias impartidas (Maestría)
            @if (count($tutor->materias_m))
                <span class="pill-primary-600 ml-4">{{ count($tutor->materias_m) }} materias</span>
            @endif
            </h3>

            <button type="button" data-accordion-target="#accordion-flush-body-clases-m" aria-expanded="false"
                    aria-controls="accordion-flush-body-ct-m" title="">
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
            </button>
        </div>
    </h3>

    @if(count($tutor->materias_m))
    <div id="accordion-flush-body-clases-m" class="hidden" aria-labelledby="accordion-flush-heading-clases-m">
        <div class="t-head">
            <div class="tr grid grid grid-cols-12">
                <div class="th">Sem.</div>
                <div class="th col-span-2">Adsc.</div>
                <div class="th col-span-6">Materia/Programa</div>
                <div class="th text-center">Tipo</div>
                <div class="th text-center">Hrs.</div>
                <div class="th text-center">Est.</div>
            </div>
        </div>
        <div class="t-body">
            @foreach ($tutor->materias_m->sortByDesc('clase.semestre.nombre') as $c )
            <div class="tr grid grid grid-cols-12 py-2 text-xs">
                <div class="col-span-1">{{ $c->clase->semestre->nombre }}</div>
                <div class="col-span-2">{{ $c->clase->adscripcion->clave }}</div>
                <div class="col-span-6">
                    {{ $c->clase->materia->nombre }}
                    @if($c->clase->titulo_alt)
                    <br><span class="text-gray-400 italic">{{ $c->clase->titulo_alt}}</span>
                    @endif
                    <br><span class="text-gray-600">[{{ $c->clase->programa->clave }}] {{ $c->clase->programa->nombre }}</span>
                </div>
                <div class="text-center">{{ $c->clase->tipo->clave }}</div>
                <div class="text-center">{{ $c->clase->horas }}</div>
                <div class="text-center">{{ count($c->clase->estudiantes) }}</div>
            </div>
            @endforeach
        </div>
    </div>
    @else
        <span class="italic text-sm text-gray-400">No hay registros de materias de maestría.</span>
    @endif
</div>

