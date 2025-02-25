@extends('layouts.container_card_nav')

@section('title')
    Catálogos del sistema
@endsection

@section('buttons')
<x-button wire:click="editCatalogo" wire:loading.attr="disabled" class="rounded-md mr-2"><i class="fa-solid fa-plus-large mr-1"></i> Catálogo</x-button>
@endsection

@section('body')
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        @foreach ($catalogos as $catalogo )
        <x-card class="">
            <x-slot name="title">
                <button class="text-left text-base text-blue-600 hover:text-blue-400 block" wire:click='editCatalogo({{ $catalogo->id }})'>
                    {{ $catalogo->nombre }}<br><span class="text-gray-300 text-xs">[{{ $catalogo->id }}] {{ $catalogo->clave }}</span>
                </button>
            </x-slot>
            <x-slot name="buttons">
                <button class="text-blue-600 hover:text-blue-400 focus:text-blue-400 p-1" title="Agregar elemento al catálogo" wire:click='editItem({{ $catalogo->id }})'><i class="fa-solid fa-plus mr-2"></i></button>
                <button class="text-red-600 hover:text-red-400 focus:text-red-400 p-1" title="Eliminar catálogo"><i class="fa-regular fa-trash" wire:click='deleteCatalogoConfirmation({{ $catalogo }})'></i></button>
            </x-slot>
            <x-slot name="body">
                <div class="h-40 px-4 py-2 overflow-y-auto text-sm">
                @foreach ($catalogo->items as $item)
                    <div class="grid grid-cols-12">
                        <div class="form-check p-1">
                            <x-checkbox wire:model.defer="items_activos.{{ $item->id }}" wire:change='updateItemActivo({{ $item->id }})' wire:stop/>
                        </div>
                        <div class="col-span-10 p-1 text-xs">
                            <button wire:click='editItem({{ $catalogo->id }}, {{ $item->id }})' class="text-left">
                                {{ $item->nombre }}<br>
                                <span class="text-gray-400">[{{ $item->id }}] {{ $item->clave }}</span>
                            </button>
                        </div>
                        <div class="text-right p-1">
                            <button class="text-red-600 hover:text-red-400 focus:text-red-400" title="Eliminar elemento del catálogo" wire:click='deleteItemConfirmation({{ $item }})'><i class="fa-regular fa-trash "></i></button>
                        </div>
                    </div>
                @endforeach
            </div>
            </x-slot>
            <x-slot name="footer">
                <span class="text-xs text-gray-400">Elementos del catálogo : {{ count($catalogo->items) }} / {{ count($catalogo->items->where('activo', true))  }} activos</span>
            </x-slot>
        </x-card>
        @endforeach
    </div>

    @include('sys.catalogo-edit')
    @include('sys.item-edit')
    @include('layouts.delete-confirmation-modal')
@endsection
