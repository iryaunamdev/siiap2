@extends('layouts.container_card_nav')

@section('title')
    Usuarios y permisos
@endsection

@section('buttons')
    <x-button class="rounded-s-lg" wire:click="$dispatch('edit-user')"><i class="fa-solid fa-plus-large mr-1"></i> Agregar usuario</x-button>
    <x-button-info class="rounded-e-lg" wire:click="$dispatch('edit-permiso')"><i class="fa-solid fa-plus-large mr-1"></i> Agregar Roles (permisos)</x-button-info>
@endsection

@section('body')
    <div class="grid grid-cols-4 gap-2">
        <div class="col-span-3">
            <livewire:sys.users-table />
        </div>
        <div class="mt-10">
            <livewire:sys.permisos-table />
        </div>
    </div>

    <livewire:sys.usuario-edit />
    <livewire:sys.permisos />
@endsection

@push('scripts')
    <script>
        console.log("Usuarios");
    </script>
@endpush
