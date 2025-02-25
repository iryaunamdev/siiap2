@extends('layouts.container_card_nav')

@section('title')
    Registro de Tutor
    @if($tutor)
    <br><span class="text-base text-gray-400 font-light">{{ $tutor->fullname }}</span>
    @endif
@endsection

@section('buttons')
    <a href="{{ route('tutores') }}" class="button-secondary rounded-md self-start">Cerrar</a>
@endsection

@section('body')
<div class="grid grid-cols-2 gap-4">
    <x-card bgColor='bg-white'>
        <x-slot name="title">
            <h3 class="text-base text-blue-800 font-semibold text-left">Datos generales</h3>
        </x-slot>
        <x-slot name='buttons'>
            <x-button class="rounded-md self-start" wire:click='store'>Guardar</x-button>
        </x-slot>
        <x-slot name="body">
            @include('livewire.tutores.tutores-edit-form')
        </x-slot>
    </x-card>
    <div>
        @include('livewire.tutores.tutores-card')
    </div>
</div>
@endsection
