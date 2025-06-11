@if($estudiante)
<div id="accordion-flush-materias-maestria" data-accordion="collapse"
    data-active-classes="bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
    data-inactive-classes="text-gray-500 dark:text-gray-400">
    <h3 id="accordion-flush-heading-materias-maestria-{{ $estudiante->id }}">
        <div
            class="flex items-center justify-between w-full pb-2 text-left rtl:text-right text-gray-700 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
            <div>
                <button class="text-xs font-semibold uppercase ">
                    Materias de maestría
                    @if (count($estudiante->materias_maestria))
                        <span class="pill-primary"><span
                                class="font-semibold">{{ count($estudiante->materias_maestria) }}</span> materias
                            cursadas </span>
                    @endif
                </button>
            </div>
            @if (count($estudiante->materias_maestria))
                <button type="button"
                    data-accordion-target="#accordion-flush-body-materias-maestria-{{ $estudiante->id }}"
                    aria-expanded="false" aria-controls="accordion-flush-body-materias-maestria-{{ $estudiante->id }}">
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            @endif
        </div>
    </h3>

    @if (count($estudiante->materias_maestria))
        <div id="accordion-flush-body-materias-maestria-{{ $estudiante->id }}" class="hidden"
            aria-labelledby="accordion-flush-heading-materias-maestria-{{ $estudiante->id }}">

            <div class="t-head border-b border-gray-200 dark:border-gray-700">
                <div class="tr grid grid-cols-12 gap-0">
                    <div class="th col-span-2">Sem.</div>
                    <div class="th col-span-6">Materia</div>
                    <div class="th col-span-1">Tipo</div>
                    <div class="th col-span-2">Adsc.</div>
                    <div class="th col-span-1">Calif</div>
                </div>
            </div>
            <div class="t-body text-gray-500 text-xs mb-8">
                @foreach ($estudiante->materias_maestria->sortByDesc('clase.semestre.nombre') as $m)
                    <div class="tr grid grid-cols-12 gap-0">
                        <div class="td col-span-2">{{ $m->clase->semestre->nombre }}</div>
                        <div class="td col-span-6">{{ $m->clase->materia->nombre }}
                            @if ($m->clase->materia->titulo_alt)
                                <br> <span class="italic">"{{ $m->clase->materia->titulo_alt }}"</span>
                            @endif
                        </div>
                        <div class="td col-span-1">{{ $m->clase->tipo->clave }}</div>
                        <div class="td col-span-2">{{ $m->clase->adscripcion->clave }}</div>
                        <div class="td col-span-1">
                            @if ($m->calificacion)
                                <span
                                    class="{{ $m->calificacion < 6 ? 'text-red-800' : '' }}">{{ $m->calificacion }}</span>
                            @elseif($m->acreditada)
                                <span
                                    class="{{ $m->acreditada ? 'text-green-600' : 'text-red-800' }}">{{ $m->acreditada ? 'AC' : 'NA' }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
                <div class="tr grid grid-cols-12 gap-0 bg-gray-200">
                    <div class="td col-span-11 text-right">Promedio general</div>
                    <div class="td col-span-1 font-semibold">{{ round(promedio($estudiante->materias_maestria->whereNotNull('calificacion')), 1) }}</div>
                </div>
                <div class="tr grid grid-cols-12 gap-0 bg-gray-100">
                    <div class="td col-span-11 text-right">Promedio materias básicas</div>
                    <div class="td col-span-1 font-semibold">{{ round(promedio($estudiante->materias_basicas->whereNotNull('calificacion')), 1) }}</div>
                </div>
            </div>
        </div>
    @else
        <div class="italic text-xs text-gray-400 p-2">No hay registro de materias de maestría</div>
    @endif
</div>

<div id="accordion-flush-materias-propedeutico" data-accordion="collapse"
    data-active-classes="bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
    data-inactive-classes="text-gray-500 dark:text-gray-400" class="mt-4">
    <h3 id="accordion-flush-heading-materias-maestria-{{ $estudiante->id }}">
        <div
            class="flex items-center justify-between w-full pb-2 text-left rtl:text-right text-gray-700 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
            <div>
                <button class="text-xs font-semibold uppercase ">
                    Materias curso propedeútico
                    @if (count($estudiante->materias_propedeutico))
                        <span class="pill-primary"><span
                                class="font-semibold">{{ count($estudiante->materias_propedeutico) }}</span> materias
                            cursadas </span>
                    @endif
                </button>
            </div>

            @if (count($estudiante->materias_propedeutico))
                <button type="button"
                    data-accordion-target="#accordion-flush-body-materias-propedeutico-{{ $estudiante->id }}"
                    aria-expanded="false" aria-controls="accordion-flush-body-materias-maestria-{{ $estudiante->id }}">
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            @endif
        </div>
    </h3>

    @if (count($estudiante->materias_propedeutico))
        <div id="accordion-flush-body-materias-propedeutico-{{ $estudiante->id }}" class="hidden"
            aria-labelledby="accordion-flush-heading-materias-propedeutico-{{ $estudiante->id }}">
            <div class="t-head border-b border-gray-200 dark:border-gray-700">
                <div class="tr grid grid-cols-12 gap-0">
                    <div class="th col-span-2">Sem.</div>
                    <div class="th col-span-7">Materia</div>
                    <div class="th col-span-2">Adsc.</div>
                    <div class="th col-span-1">Calif</div>
                </div>
            </div>
            <div class="t-body text-gray-500 text-xs mb-8">
                @foreach ($estudiante->materias_propedeutico->sortByDesc('clase.semestre.nombre') as $m)
                    <div class="tr grid grid-cols-12 gap-0">
                        <div class="td col-span-2">{{ $m->clase->semestre->nombre }}</div>
                        <div class="td col-span-7">{{ $m->clase->materia->nombre }}
                            @if ($m->clase->materia->titulo_alt)
                                <br> <span class="italic">"{{ $m->clase->materia->titulo_alt }}"</span>
                            @endif
                        </div>
                        <div class="td col-span-2">{{ $m->clase->adscripcion->clave }}</div>
                        <div class="td col-span-1">
                            @if ($m->calificacion)
                                <span
                                    class="{{ $m->calificacion < 6 ? 'text-red-800' : '' }}">{{ $m->calificacion }}</span>
                            @elseif($m->acreditada)
                                <span
                                    class="{{ $m->acreditada ? 'text-green-600' : 'text-red-800' }}">{{ $m->acreditada ? 'AC' : 'NA' }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
                <div class="tr grid grid-cols-12 gap-0 bg-gray-200">
                    <div class="td col-span-11 text-right">Promedio propedeútico</div>
                    <div class="td col-span-1 font-semibold">{{ round(promedio($estudiante->materias_propedeutico->whereNotNull('calificacion')), 1) }}</div>
                </div>
            </div>
        </div>
    @else
        <div class="italic text-xs text-gray-400 p-2">No hay registro de materias de propedéutico</div>
    @endif
</div>
@else
<div class="italic text-xs text-gray-400 p-2">No hay registro de estudiante.</div>
@endif
