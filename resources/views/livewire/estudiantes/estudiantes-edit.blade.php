@extends('layouts.container_card_nav')

@section('title')
    Registro de estudiante
    @if($estudiante)
    <br><span class="text-base text-gray-400 font-light">{{ $estudiante->fullname }}</span>
    @endif
@endsection

@section('buttons')
    <a href="{{ route('estudiantes') }}" class="button-secondary rounded-md self-start">Cerrar</a>
@endsection

@section('body')
<div class="grid grid-cols-2 gap-4">
    <x-card bgColor='bg-white'>
        <x-slot name="title">
            <h3 class="text-base text-blue-800 font-semibold text-left">Datos generales</h3>
        </x-slot>
        <x-slot name='buttons'>
            <x-button class="rounded-md self-start" wire:click='storeEstudiante'>Guardar</x-button>
        </x-slot>
        <x-slot name="body">
            @include('livewire.estudiantes.estudiantes-edit-form')
        </x-slot>
    </x-card>
    <div>
        @include('livewire.estudiantes.estudiantes-card')
    </div>
</div>
@endsection
