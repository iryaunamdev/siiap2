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
                    <x-label value="Semestre" />
                    <x-select class="form-select w-48" wire:model.live='filters.semestre'>
                        <option value="" hidden selected></option>
                            @foreach($c_semestres as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                    </x-select>
                </div>
                <button class="link-danger ml-2 {{ !array_key_exists('semestre', $filters) ? 'hidden' : ''}}"
                        wire:click="clearFilters('semestre')">
                    <i class="fa-solid fa-xmark fa-lg"></i>
                </button>
            </div>

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

            <div class="grid grid-flow-col justify-stretch py-2">
                <div>
                    <x-label value="Tipo de materia" />
                    <x-select class="form-select w-48" wire:model.live='filters.tipo'>
                        <option value="" hidden selected></option>
                            @foreach($c_tipos as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                    </x-select>
                </div>
                <button class="link-danger ml-2 {{ !array_key_exists('tipo', $filters) ? 'hidden' : ''}}"
                        wire:click="clearFilters('tipo')">
                    <i class="fa-solid fa-xmark fa-lg"></i>
                </button>
            </div>

            <div class="grid grid-flow-col justify-stretch py-2">
                <div>
                    <x-label value="Programa" />
                    <x-select class="form-select w-48 text-xs" wire:model.live='filters.programa'>
                        <option value="" hidden selected></option>
                            @foreach($c_programas as $item)
                                <option value="{{ $item->id }}">[{{ $item->clave }}] {{ $item->nombre }}</option>
                            @endforeach
                    </x-select>
                </div>
                <button class="link-danger ml-2 {{ !array_key_exists('programa', $filters) ? 'hidden' : ''}}"
                        wire:click="clearFilters('programa')">
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
                <x-ordering-button ordering="true" :direction="$field === 'semestre' ? $direction : null" wire:click="sortBy('semestre')"
                        class="th">Semestre</x-ordering-button>
                <x-ordering-button :ordering="false" class="th">Adscripción</x-ordering-button>

                <div class="col-span-6 grid grid-cols-12 gap-0">
                    <x-ordering-button :ordering="true" :direction="$field === 'materia' ? $direction : null" wire:click="sortBy('materia')"
                    class="th col-span-8">
                    Materia</x-ordering-button>
                    <x-ordering-button :ordering="false" class="th col-span-4">Programa</x-ordering-button>
                </div>

                <div class="col-span-4 grid grid-cols-7 gap-0">
                    <x-ordering-button :ordering="false" class="th text-center" title="Tutorias de doctorado (actuales/total)">Tipo</x-ordering-button>
                    <x-ordering-button :ordering="false" class="th text-center" title="Materias impartidas (actuales/total)">Horas</x-ordering-button>
                    <x-ordering-button :ordering="false" class="th text-center" title="Graduados de maestría (actuales/total)">Cred.</x-ordering-button>
                    <x-ordering-button :ordering="false" class="th text-center" title="Graduados de maestría (actuales/total)">Grupo</x-ordering-button>
                    <x-ordering-button :ordering="false" class="th text-center" title="Graduados de doctorado (actuales/total)">T.Est.</x-ordering-button>
                    <x-ordering-button :ordering="false" class="th text-center" title="Sinodal (seguimientos academicos)">T.Tut.</x-ordering-button>
                    <div></div>
                </div>
            </div>
        </div>

        @forelse ($clases as $clase)
            <div class="tr-stripp border-t {{ $loop->iteration % 2 ? 'bg-white' : 'bg-gray-50' }} grid grid-cols-12 gap-0 "
                wire:loading.class.delay='opacity-50'>

                <div class="td-1">{{ $clase->semestre ? $clase->semestre->nombre : '' }}</div>
                <div class="td-1">{{ $clase->adscripcion ? $clase->adscripcion->clave : '' }}</div>
                <div class="col-span-6 grid grid-cols-12 gap-0">
                    <div class="td-1 col-span-8"><a href="{{ route('clases.edit', $clase->id) }}"
                        class="link-primary">{{ $clase->materia ? $clase->materia->nombre : ''}}</a><br>
                        <span class="italic text-gray-500 text-xs">{{ $clase->titulo_alt }}</span>
                    </div>
                    <div class="td-1 col-span-4 text-xs">[{{ $clase->programa ? $clase->programa->clave : '' }}] {{ $clase->programa ? $clase->programa->nombre : '' }}</div>
                </div>

                <div class="col-span-4 grid grid-cols-7 gap-0">
                    <div class="td-1 text-center text-xs">{{ $clase->tipo ? $clase->tipo->clave : '' }}</div>
                    <div class="td-1 text-center text-xs">{{ $clase->horas ? str_pad($clase->horas, 2, '0', STR_PAD_LEFT) : '' }}</div>
                    <div class="td-1 text-center text-xs">{{ $clase->creditos > 0 ? str_pad($clase->creditos, 2, '0', STR_PAD_LEFT) : '' }}</div>
                    <div class="td-1 text-center text-xs">{{ $clase->grupo ? str_pad($clase->grupo, 2, '0', STR_PAD_LEFT) : '' }}</div>
                    <div class="td-1 text-center text-xs">{{ count($clase->estudiantes) ? str_pad(count($clase->estudiantes), 2, '0', STR_PAD_LEFT) : '' }}</div>
                    <div class="td-1 text-center text-xs">{{ count($clase->tutores) ? str_pad(count($clase->tutores), 2, '0', STR_PAD_LEFT) : '' }}</div>
                    <div class="td-1 text-right">
                        @if (
                                !count($clase->estudiantes) &&
                                !count($clase->tutores) &&
                                !count($clase->documentos)
                            )
                            <button wire:click="$dispatch('confirm-delete-clase', {'clase':{{ $clase }}})"><i
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

    <div class="mt-4">{{ $clases->links() }}</div>
</div>
