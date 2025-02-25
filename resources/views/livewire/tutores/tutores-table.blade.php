<div>
    <div class="mb-4 flex justify-start">
        <x-input type=text placeholder="Búsqueda general" class="text-sm" wire:model.live='search' />
        <x-secondary-button id="dropdownFilterButton" data-dropdown-toggle="dropdownFilter" class="rounded-md ml-2"
            type="button">
            Filtros
            <i class="fa-regular fa-filter fa-lg ml-2"></i>
            <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full {{ !count($filters) ? 'hidden' : '' }}">{{ count($filters) }}</span>
        </x-secondary-button>

        <!-- Dropdown menu -->
        <div id="dropdownFilter"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-52 dark:bg-gray-700 px-4 py-4">

            <div class="grid grid-flow-col justify-stretch py-2">
                <div>
                    <x-label value="Adscripción" />
                    <x-select class="form-select w-48" wire:model.live='filters.adscripcion'>
                        <option value="" hidden selected></option>
                            @foreach($c_adscripciones as $item)
                                <option value="{{ $item->id }}">{{ $item->clave }}</option>
                            @endforeach
                    </x-select>
                </div>
                <button class="link-danger ml-2 {{ !array_key_exists('adscripcion', $filters) ? 'hidden' : ''}}"
                        wire:click="clearFilters('adscripcion')">
                    <i class="fa-solid fa-xmark fa-lg"></i>
                </button>
            </div>

            <!-- Clear filters -->
            <x-button class="rounded-md w-full mt-2 {{ !count($filters) ? 'hidden' : '' }}" wire:click='clearFilters'>Quitar filtros</x-button>
        </div>
    </div>


    <div class="table">
        <div class="thead">
            <div class="grid grid-cols-12 gap-0">
                <div class="col-span-2 grid grid-cols-3 gap-0">
                    <div></div>
                    <x-ordering-button ordering="true" :direction="$field === 'clave' ? $direction : null" wire:click="sortBy('clave')"
                        class="th col-span-2">No. Trabajador</x-ordering-button>
                </div>
                <x-ordering-button :ordering="true" :direction="$field === 'fullname' ? $direction : null" wire:click="sortBy('fullname')"
                    class="th col-span-3">
                    Nombre del Tutor</x-ordering-button>
                <x-ordering-button :ordering="false" class="th col-span-2">Adscripción</x-ordering-button>
                <div class="col-span-5 grid grid-cols-8 gap-0">
                    <x-ordering-button :ordering="false" class="th text-center">Activo</x-ordering-button>
                    <x-ordering-button :ordering="false" class="th text-center" title="Tutorias de maestría (actuales/total)">T. MAE.</x-ordering-button>
                    <x-ordering-button :ordering="false" class="th text-center" title="Tutorias de doctorado (actuales/total)">T. DOC.</x-ordering-button>
                    <x-ordering-button :ordering="false" class="th text-center" title="Materias impartidas (actuales/total)">MAT. I.</x-ordering-button>
                    <x-ordering-button :ordering="false" class="th text-center" title="Graduados de maestría (actuales/total)">G. MAE.</x-ordering-button>
                    <x-ordering-button :ordering="false" class="th text-center" title="Graduados de doctorado (actuales/total)">G. DOC.</x-ordering-button>
                    <x-ordering-button :ordering="false" class="th text-center" title="Sinodal (seguimientos academicos)">SIN.</x-ordering-button>
                    <div></div>
                </div>
            </div>
        </div>
        @forelse ($tutores as $tutor)
            <div class="tr-stripp border-t {{ $loop->iteration % 2 ? 'bg-white' : 'bg-gray-50' }} grid grid-cols-12 gap-0 "
                wire:loading.class.delay='opacity-50'>
                <div class="col-span-2 grid grid-cols-3 gap-0">
                    <div class="td-1">
                        <img src="{{ Avatar::create(strtoupper($tutor->fullname))->toBase64(); }}" alt="{{ $tutor->fullname }}" class="w-10"/>
                    </div>
                    <div class="td-1 col-span-2">{{ $tutor->clave }}</div>
                </div>
                <div class="td-1 col-span-3"><a href="{{ route('tutores.edit', $tutor->id) }}"
                        class="link-primary">{{ $tutor->fullname }}</a></div>

                <div class="td-1 col-span-2">{{ $tutor->adscripcion->clave }}</div>

                <div class="col-span-5 grid grid-cols-8 gap-0">
                    <div class="td-1 text-center">
                        <i class="fa-solid fa-circle fa-sm {{ $tutor->activo ? 'text-green-600' : 'text-red-600' }}"></i>

                    </div>
                    <div class="td-1 text-center text-xs">
                        @if(count($tutor->comites_m))
                        <span class="{{ count($tutor->comites_m->where('inscripcion.semestre.nombre', currentSemestre())->sortByDesc('inscripcion.semestre.nombre')->groupBy('estudiante_id')) ? 'text-blue-600' : 'text-gray-400' }}">{{ count($tutor->comites_m->where('inscripcion.semestre.nombre', currentSemestre())->sortByDesc('inscripcion.semestre.nombre')->groupBy('estudiante_id')) }}</span> /
                        {{ count($tutor->comites_m->sortByDesc('inscripcion.semestre.nombre')->groupBy('estudiante_id')) }}
                        @endif
                    </div>
                    <div class="td-1 text-center text-xs">
                        @if(count($tutor->comites_d))
                        <span class="{{ count($tutor->comites_d->where('inscripcion.semestre.nombre', currentSemestre())->sortByDesc('inscripcion.semestre.nombre')->groupBy('estudiante_id')) ? 'text-blue-600' : 'text-gray-400' }}">{{ count($tutor->comites_d->where('inscripcion.semestre.nombre', currentSemestre())->sortByDesc('inscripcion.semestre.nombre')->groupBy('estudiante_id')) }}</span> /
                        {{ count($tutor->comites_d->sortByDesc('inscripcion.semestre.nombre')->groupBy('estudiante_id')) }}
                        @endif
                    </div>
                    <div class="td-1 text-center text-xs">
                        @if(count($tutor->clases))
                        <span class="{{ count($tutor->clases->where('clase.semestre.nombre', currentSemestre())) ? 'text-blue-600' : 'text-gray-400' }}">{{ count($tutor->clases->where('clase.semestre.nombre', currentSemestre())) }}</span> /
                        {{ count($tutor->clases) }}
                        @endif
                    </div>
                    <div class="td-1 text-center text-xs">
                        @if(count($tutor->graduados_m))
                        <span class="{{ count($tutor->graduados_m->where('graduacion.semestre.nombre', currentSemestre())) ? 'text-blue-600' : 'text-gray-400' }}">{{ count($tutor->graduados_m->where('graduacion.semestre.nombre', currentSemestre())) }}</span> /
                        {{ count($tutor->graduados_m) }}
                        @endif
                    </div>
                    <div class="td-1 text-center text-xs">
                        @if(count($tutor->graduados_d))
                        <span class="{{ count($tutor->graduados_d->where('graduacion.semestre.nombre', currentSemestre())) ? 'text-blue-600' : 'text-gray-400' }}">{{ count($tutor->graduados_d->where('graduacion.semestre.nombre', currentSemestre())) }}</span> /
                        {{ count($tutor->graduados_d) }}
                        @endif
                    </div>
                    <div class="td-1 text-center text-xs">
                        @if(count($tutor->seguimientos))
                        <span class="{{ count($tutor->seguimientos->where('seguimiento.semestre.nombre', currentSemestre())) ? 'text-blue-600' : 'text-gray-400' }}">{{ count($tutor->seguimientos->where('seguimiento.semestre.nombre', currentSemestre())) }}</span> /
                        {{ count($tutor->seguimientos) }}
                        @endif
                    </div>
                    <div class="td-1 text-right">
                        @if (
                                !count($tutor->comites) &&
                                !count($tutor->graduados) &&
                                !count($tutor->seguimientos) &&
                                !count($tutor->clases))
                            <button
                                wire:click="$dispatch('confirm-delete-tutor', {'tutor':{{ $tutor }}})"><i
                                    class="fa-regular fa-trash link-danger"></i></button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="tr-stripp border-t bg-white" wire:loading.class.delay='opacity-50'>
                <div class="td-1 text-gray-500">
                    No se encontraron resultados
                </div>
            </div>
        @endforelse
    </div>
    <div class="mt-4">{{ $tutores->links() }}</div>
</div>
