<div id="accordion-flush-seguimientos" data-accordion="collapse"
    data-active-classes="bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
    data-inactive-classes="text-gray-500 dark:text-gray-400"
    class="mt-4">
    <h3 id="accordion-flush-heading-ingreso-d">
        <div class="flex items-center justify-between w-full pb-2 text-left rtl:text-right text-gray-700 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
            <h3 class="uppercase text-xs font-semibold">Sinodal (seguimiento académico)
            @if (count($tutor->seguimientos))
                <span class="pill-primary-600 ml-4">{{ count($tutor->seguimientos) }} seguimientos</span>
            @endif
            </h3>

            <button type="button" data-accordion-target="#accordion-flush-body-seguimientos" aria-expanded="false"
                    aria-controls="accordion-flush-body-ct-m" title="">
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
            </button>
        </div>
    </h3>

    @if(count($tutor->seguimientos))
    <div id="accordion-flush-body-seguimientos" class="hidden" aria-labelledby="accordion-flush-heading-seguimientos">
        <div class="t-body">
            @foreach ($tutor->seguimientos->sortByDesc('seguimiento.fecha') as $g )
            <div class="tr grid grid grid-cols-12 py-2 text-sm">
                <div class="col-span-2">{{ $g->seguimiento->fecha->format('d/m/Y') }}</div>
                <div class="col-span-7">
                    {{ $g->seguimiento->estudiante->fullname }}<br>
                    <span class="pill-primary">{{ $g->seguimiento->tipo->nombre }}</span>
                </div>
                <div class="col-span-3">
                    <span class="
                            @if($g->seguimiento->estatus)
                                @if (in_array($g->seguimiento->estatus->clave, ['AP', 'AA', 'A2']))
                                    badge-success
                                @elseif(in_array($g->seguimiento->estatus->clave, ['AC']))
                                    badge-warning
                                @elseif(in_array($g->seguimiento->estatus->clave, ['AE']))
                                    badge-info
                                @elseif(in_array($g->seguimiento->estatus->clave, ['NA']))
                                    badge-danger
                                @endif
                            @else
                                badge-light
                            @endif
                        ">
                        {{ $g->seguimiento->estatus ? $g->seguimiento->estatus->nombre : 'Sin definir' }}
                        </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
        <span class="italic text-sm text-gray-400">No hay registros tutorias de maestría.</span>
    @endif
</div>

