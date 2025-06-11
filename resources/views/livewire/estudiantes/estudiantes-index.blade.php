@extends('layouts.container_card_nav')

@section('title')
    Registro de estudiantes
@endsection

@section('buttons')
    <a class="button-primary rounded-md" href="{{ route('estudiantes.edit') }}"><i class="fa-solid fa-plus-large mr-1"></i> Registrar estudiante</a>
@endsection

@section('body')
    <livewire:estudiantes.estudiantes-table/>
    @include('layouts.delete-confirmation-modal')
@endsection
