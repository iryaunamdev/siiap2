@extends('layouts.container_card_nav')

@section('title')
    Registro de clases
@endsection

@section('buttons')
    <a class="button-primary rounded-md" href="{{ route('clases.edit') }}"><i class="fa-solid fa-plus-large mr-1"></i> Registrar clase</a>
@endsection

@section('body')
    <livewire:clases.clases-table/>
    @include('layouts.delete-confirmation-modal')
@endsection

