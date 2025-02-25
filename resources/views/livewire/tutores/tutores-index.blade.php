@extends('layouts.container_card_nav')

@section('title')
    Registro de Tutores
@endsection

@section('buttons')
    <a class="button-primary rounded-md" href="{{ route('tutores.edit') }}"><i class="fa-solid fa-plus-large mr-1"></i> Registrar tutor</a>
@endsection

@section('body')
    <livewire:tutores.tutores-table/>
    @include('layouts.delete-confirmation-modal')
@endsection
