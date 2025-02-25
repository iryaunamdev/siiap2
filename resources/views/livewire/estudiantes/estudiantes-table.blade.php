<div>
    <div class="mb-4 flex justify-start">
        <x-input type=text placeholder="Búsqueda general" class="text-sm" wire:model.live='search' />
        <x-secondary-button id="dropdownFilterButton" data-dropdown-toggle="dropdownFilter" class="rounded-md ml-2"
            type="button">
            Filtros
            <i class="fa-regular fa-filter fa-lg ml-2"></i>
            <span
                class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full {{ !count($filters) ? 'hidden' : '' }}">{{ count($filters) }}</span>
        </x-secondary-button>
        <!-- Dropdown menu -->
        <div id="dropdownFilter"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-52 dark:bg-gray-700 px-4 py-4">

            <div class="grid grid-flow-col justify-stretch py-2">
                <div>
                    <x-label value="Grado" />
                    <x-select class="form-select w-48" wire:model.live='filters.grado'>
                        <option value="" hidden selected></option>
                        @foreach ($c_grados as $item)
                            <option value="{{ $item->clave }}">{{ $item->nombre }}</option>
                        @endforeach
                        <option value="NO">Sin definir</option>
                    </x-select>
                </div>
                <button class="inline link-danger ml-2 {{ !array_key_exists('grado', $filters) ? 'hidden' : '' }}"
                    wire:click="clearFilters('grado')">
                    <i class="fa-solid fa-xmark fa-lg"></i>
                </button>
            </div>
            <div class="grid grid-flow-col justify-stretch place-content-center py-2">
                <div>
                    <x-label value="Semestre (inscrito)" />
                    <x-select class="form-select w-48" wire:model.live='filters.semestre_i'>
                        <option value="" hidden selected></option>
                        @foreach ($c_semestres as $item)
                            <option value="{{ $item->id }}">{{ $item->clave }}</option>
                        @endforeach
                    </x-select>

                </div>
                <button class="link-danger ml-2 {{ !array_key_exists('semestre_i', $filters) ? 'hidden' : '' }}"
                    wire:click="clearFilters('semestre_i')">
                    <i class="fa-solid fa-xmark fa-lg"></i>
                </button>
            </div>
            <div class="grid grid-flow-col justify-stretch py-2">
                <div>
                    <x-label value="Adscripción" />
                    <x-select class="form-select w-48" wire:model.live='filters.adscripcion'>
                        <option value="" hidden selected></option>
                        @foreach ($c_adscripciones as $item)
                            <option value="{{ $item->id }}">{{ $item->clave }}</option>
                        @endforeach
                    </x-select>
                </div>
                <button class="link-danger ml-2 {{ !array_key_exists('adscripcion', $filters) ? 'hidden' : '' }}"
                    wire:click="clearFilters('adscripcion')">
                    <i class="fa-solid fa-xmark fa-lg"></i>
                </button>
            </div>

            <div class="grid grid-flow-col justify-stretch py-2">
                <div>
                    <x-label value="Estatus" />
                    <x-select class="form-select w-48" wire:model.live='filters.estatus'>
                        <option value="" hidden selected></option>
                        <option value="A">Activo</option>
                        <option value="G">Graduado</option>
                        <option value="B">Baja</option>
                    </x-select>
                </div>
                <button
                    class="link-danger ml-2 py-2 place-self-center  {{ !array_key_exists('estatus', $filters) ? 'hidden' : '' }}"
                    wire:click="clearFilters('estatus')">
                    <i class="fa-solid fa-xmark fa-lg"></i>
                </button>
            </div>

            <x-button class="rounded-md w-full mt-2 {{ !count($filters) ? 'hidden' : '' }}"
                wire:click='clearFilters'>Quitar filtros</x-button>
        </div>
        <div class="relative ml-2">
            <x-input type="number" class="text-sm w-32" wire:model.live='paginate' title="Registros por página"/>
            <div class="absolute top-2 start-9 flex items-center text-sm text-gray-700">
                <span>Registros</span>
            </div>
        </div>

    </div>
    <div class="table">
        <div class="thead">
            <div class="grid grid-cols-12 gap-0">
                <div class="col-span-2 grid grid-cols-3 gap-0">
                    {{-- <div></div> --}}
                    <x-ordering-button ordering="true" :direction="$field === 'cuenta' ? $direction : null" wire:click="sortBy('cuenta')"
                        class="th col-span-2">Cuenta UNAM</x-ordering-button>
                </div>
                <x-ordering-button :ordering="true" :direction="$field === 'fullname' ? $direction : null" wire:click="sortBy('fullname')"
                    class="th col-span-4">
                    Nombre del Estudiante</x-ordering-button>
                <x-ordering-button :ordering="false" class="th col-span-2">Adscripción</x-ordering-button>
                <div class="col-span-4 grid grid-cols-6 gap-0">
                    <x-ordering-button :ordering="false" class="th text-center">Activo</x-ordering-button>
                    <x-ordering-button :ordering="false" class="th text-center">I. MAE.</x-ordering-button>
                    <x-ordering-button :ordering="false" class="th text-center">G. MAE.</x-ordering-button>
                    <x-ordering-button :ordering="false" class="th text-center">I. DOC.</x-ordering-button>
                    <x-ordering-button :ordering="false" class="th text-center">G. DOC.</x-ordering-button>
                    <div></div>
                </div>
            </div>
        </div>
        @forelse ($estudiantes as $estudiante)
            <div class="tr-stripp border-t {{ $loop->iteration % 2 ? 'bg-white' : 'bg-gray-50' }} grid grid-cols-12 gap-0 text-xs"
                wire:loading.class.delay='opacity-50'>
                <div class="col-span-2 grid grid-cols-3 gap-0">
                    {{--
                    <div class="td-1">
                        <img src="{{ Avatar::create(strtoupper($estudiante->fullname))->toBase64(); }}" alt="{{ $estudiante->fullname }}" class="w-10"/>
                    </div>
                    --}}
                    <div class="td-2 col-span-2">{{ $estudiante->cuenta }}</div>
                </div>
                <div class="td-2 text-[0.878rem] col-span-4"><a href="{{ route('estudiantes.edit', $estudiante->id) }}"
                        class="link-primary">{{ $estudiante->fullname }}</a></div>
                <div class="td-2 col-span-2">
                    {{ $estudiante->inscripciones->first() ? $estudiante->inscripciones->first()->adscripcion->clave : '' }}
                </div>
                <div class="col-span-4 grid grid-cols-6 gap-0">
                    <div class="td-2 text-center">
                        <i
                            class="fa-solid fa-circle fa-sm {{ is_activo($estudiante->inscripciones) ? 'text-green-600' : 'text-red-600' }}"></i>

                    </div>
                    <div class="td-2 text-center">
                        {{ $estudiante->ingreso_m ? $estudiante->ingreso_m->semestre->nombre : '' }}</div>
                    <div class="td-2 text-center">
                        @if ($estudiante->graduacion_m)
                            {{ $estudiante->graduacion_m->semestre->nombre }}
                        @elseif($estudiante->baja_m)
                            <i class="fa-solid fa-ban text-gray-500" title="Baja"></i>
                        @endif
                    </div>
                    <div class="td-2 text-center">
                        {{ $estudiante->ingreso_d ? $estudiante->ingreso_d->semestre->nombre : '' }}</div>
                    <div class="td-2 text-center">
                        @if ($estudiante->graduacion_d)
                            {{ $estudiante->graduacion_d->semestre->nombre }}
                        @elseif($estudiante->baja_d)
                            <i class="fa-solid fa-ban text-gray-500" title="Baja"></i>
                        @endif
                    </div>
                    <div class="td-2 text-right">
                        @if (
                            !$estudiante->ingreso_m &&
                                !$estudiante->ingreso_d &&
                                !$estudiante->graduacion_m &&
                                !$estudiante->graduacion_d &&
                                !$estudiante->baja_m &&
                                !$estudiante->baja_d &&
                                !count($estudiante->inscripciones_m) &&
                                !count($estudiante->inscripciones_d) &&
                                !count($estudiante->seguimientos) &&
                                !count($estudiante->clases))
                            <button
                                wire:click="$dispatch('confirm-delete-estudiante', {'estudiante':{{ $estudiante }}})"><i
                                    class="fa-regular fa-trash link-danger fa-lg"></i></button>
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
    <div class="mt-4">{{ $estudiantes->links() }}</div>
</div>
