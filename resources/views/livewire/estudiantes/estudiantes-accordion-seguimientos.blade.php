@foreach ($estudiante->seguimientos as $seguimiento)
    <div id="accordion-flush-{{ $seguimiento->id }}" data-accordion="collapse"
        data-active-classes="bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
        data-inactive-classes="text-gray-500 dark:text-gray-400">

        <h3 id="accordion-flush-heading-{{ $estudiante->id }}-{{ $seguimiento->id }}">
            <div
                class="flex items-center justify-between w-full pb-2 text-left rtl:text-right text-gray-700 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
                <div>
                    <button wire:click='editSeguimiento({{ $seguimiento }})' class="text-sm text-blue-600 hover:text-blue-400 focus:text-blue-400">
                        <span class="mr-4">{{ $seguimiento->fecha->format('Y/m/d') }}</span>
                        <span class="mr-4">{{ $seguimiento->tipo->nombre }}</span>
                        <span class="
                            @if($seguimiento->estatus)
                                @if (in_array($seguimiento->estatus->clave, ['AP', 'AA', 'A2']))
                                    badge-success
                                @elseif(in_array($seguimiento->estatus->clave, ['AC']))
                                    badge-warning
                                @elseif(in_array($seguimiento->estatus->clave, ['AE']))
                                    badge-info
                                @elseif(in_array($seguimiento->estatus->clave, ['NA']))
                                    badge-danger
                                @endif
                            @else
                                badge-light
                            @endif
                        ">
                        {{ $seguimiento->estatus ? $seguimiento->estatus->nombre : 'Sin definir' }}
                        </span>
                    </button>
                    @if($seguimiento->titulo)
                    <br><span class="italic text-xs text-gray-400">"{{ $seguimiento->titulo ?? 'Título sin definir' }}"</span>
                    @endif
                </div>
                <div>
                    <button type="button" wire:click='addSinodal({{ $seguimiento->id }})' class="link-primary mr-4" title="Agregar Sinodal"><i class="fa-solid fa-users-medical"></i></button>

                    <button type="button" wire:click='deleteSeguimiento({{ $seguimiento }})' class="link-danger mr-4" title="Eliminar registro de seguimiento"><i class="fa-regular fa-trash"></i></button>

                    @if($seguimiento->doi OR $seguimiento->bibcode OR $seguimiento->comentarios OR count($seguimiento->sinodales))
                        <button type="button"
                            data-accordion-target="#accordion-flush-body-{{ $estudiante->id }}-{{ $seguimiento->id }}"
                            aria-expanded="false"
                            aria-controls="accordion-flush-body-{{ $estudiante->id }}-{{ $seguimiento->id }}">
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    @endif
                </div>
            </div>
        </h3>
        <div id="accordion-flush-body-{{ $estudiante->id }}-{{ $seguimiento->id }}" class="hidden"
            aria-labelledby="accordion-flush-heading-{{ $estudiante->id }}-{{ $seguimiento->id }}">
            <div class="grid grid-cols-2 gap-4 mx-4">
                @if($seguimiento->doi)
                    <div class="text-xs"><span class="uppercase font-semibold text-[0.70rem]">Doi:</span> {{ $seguimiento->doi }}</div>
                @elseif($seguimiento->bibcode)
                    <div class="text-xs"><span class="uppercase font-semibold text-[0.70rem]">Bibcode:</span> {{ $seguimiento->bibcode }}</div>
                @endif
            </div>

            @if (count($seguimiento->sinodales))
                <div class="t-head border-b border-gray-200 dark:border-gray-700">
                    <div class="tr grid grid-cols-12 gap-0">
                        <div class="th col-span-1">Sinodales</div>
                        <div class="th col-span-2"></div>
                    </div>
                </div>
                <div class="t-body text-gray-500 text-xs mb-4">
                @foreach ($seguimiento->sinodales->sortBy('tutor.fullname') as $sinodal)
                    <div class="tr grid grid-cols-12 gap-0">
                        <div class="td col-span-10">{{ $sinodal->tutor->fullname }}</div>
                        <div class="td col-span-2 text-right">
                            <button type="button" wire:click='deleteSinodal({{ $sinodal }})' class="link-danger" title="Eliminar registro de ingreso"><i class="fa-regular fa-trash fa-lg"></i></button>
                        </div>
                    </div>
                @endforeach
                </div>
            @endif

            @if ($seguimiento->comentarios)
                <div class="text-xs mx-4 mb-4">
                    <span class="uppercase font-semibold text-[0.70rem]">Comentarios</span><br>
                    <p>{{ $seguimiento->comentarios }}</p>
                </div>
            @endif
        </div>
    </div>
@endforeach
