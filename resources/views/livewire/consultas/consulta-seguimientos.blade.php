@extends('layouts.container_card_nav')

@section('title')
    Seguimiento Académico
@endsection

@section('body')
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

            {{-- <div class="grid grid-flow-col justify-stretch py-2">
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
            </div>--}}

            <!-- Clear filters -->
            <x-button class="rounded-md w-full mt-2 {{ !count($filters) ? 'hidden' : '' }}" wire:click='clearFilters'>Quitar filtros</x-button>
        </div>

        <div class="relative ml-2">
            <x-input type="number" class="text-sm w-32 p-2.5" wire:model.live='paginate' title="Registros por página"/>
            <span class="absolute text-sm text-gray-400 p-2.5 right-6">Registros</span>
        </div>
    </div>

    <div class="table">
        <div class="thead grid grid-cols-12 gap-0">
            <div class="col-span-8 grid grid-cols-12">
                <x-ordering-button :ordering="true" :direction="$field === 'fecha' ? $direction : null" wire:click="sortBy('fecha')" class="th col-span-2">
                    Fecha</x-ordering-button>
                <x-ordering-button :ordering="true" :direction="$field === 'estudiante' ? $direction : null" wire:click="sortBy('estudiante')"
                    class="th col-span-4">
                    Estudiante</x-ordering-button>
                <x-ordering-button :ordering="true" :direction="$field === 'titulo' ? $direction : null" wire:click="sortBy('titulo')" class="th col-span-6">
                    Título</x-ordering-button>
            </div>
            <x-ordering-button :ordering="true" :direction="$field === 'estatus' ? $direction : null" wire:click="sortBy('estatus')" class="th col-span-4">
                Estatus</x-ordering-button>
        </div>

        @forelse ($seguimientos as $seguimiento)
            <div class="tr-stripp border-t {{ $loop->iteration % 2 ? 'bg-white' : 'bg-gray-50' }} grid grid-cols-12 gap-0 "
                wire:loading.class.delay='opacity-50'>
                <div class="col-span-8 grid grid-cols-12">
                    <div class="td-2 col-span-2">{{ $seguimiento->fecha ? $seguimiento->fecha->format('d/m/Y')  : '' }}</div>
                    <div class="td-2 col-span-4">{{ $seguimiento->estudiante ? $seguimiento->estudiante->fullname : ''}}</div>
                    <div class="td-2 col-span-6 italic">{{ $seguimiento->titulo ?? '' }}</div>
                </div>
                <div class="td-2 col-span-4">
                    @if ($seguimiento->estatus)
                        <span
                            class="text-xs
                        @if (in_array($seguimiento->estatus->clave, ['AP', 'AA', 'A2'])) bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300
                        @elseif(in_array($seguimiento->estatus->clave, ['AE']))
                        bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300
                        @elseif(in_array($seguimiento->estatus->clave, ['NA']))
                        bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300
                        @elseif(in_array($seguimiento->estatus->clave, ['AC']))
                        bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300 @endif
                    ">
                            {{ $seguimiento->estatus ? $seguimiento->estatus->nombre : '' }}
                        </span>
                    @endif
                    <p class="text-xs text-gray-500 pl-4">{{ $seguimiento->comentarios ??'' }}</p>
                </div>
            </div>
        @empty
            <div></div>
        @endforelse
    </div>
    <div class="mt-6">
        {{ $seguimientos->links() }}
    </div>
@endsection
