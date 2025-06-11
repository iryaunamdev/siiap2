<x-container-card class="w-3/5">
    <x-slot name="title">
        Registro de clase
        @if($clase)
        <br><span class="text-base text-gray-400 font-light">{{ $clase->materia ? $clase->materia->nombre : '' }}</span>
        @endif
    </x-slot>

    <x-slot name="buttons">
        <x-button wire:click='store' class="rounded-s-lg self-start">Guardar</x-button>
        <a href="{{ route('clases') }}" class="button-secondary rounded-e-lg self-start">Cerrar</a>
    </x-slot>

    <x-slot name="body">
        <form>
            <div class="grid grid-cols-12 gap-4 mb-8">
                <div class="relative col-span-2">
                    <x-select-float wire:model='semestre_id' :error="$errors->first('semestre_id')">
                        <option value="" hidden selected></option>
                        @foreach ($c_semestres as $item)
                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </x-select-float>
                    <x-label-float value="Semestre" />
                </div>
                <div class="relative col-span-3">
                    <x-select-float wire:model='grado_id' :error="$errors->first('grado_id')" class="text-sm">
                        <option value="" hidden selected></option>
                        @foreach ($c_grados as $item)
                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </x-select-float>
                    <x-label-float value="Grado" />
                </div>
                <div class="relative col-span-3">
                    <x-select-float wire:model='tipo_id' :error="$errors->first('tipo_id')" class="text-sm" wire:change="selectTipo($event.target.value)">
                        <option value="" hidden selected></option>
                        @foreach ($c_tipos as $item)
                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </x-select-float>
                    <x-label-float value="T. Materia" />
                </div>

                <div class="relative col-span-4">
                    <x-select-float wire:model='programa_id' :error="$errors->first('programa_id')" class="text-sm">
                        <option value="" hidden selected></option>
                        @foreach ($c_programas as $item)
                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </x-select-float>
                    <x-label-float value="Programa" />
                </div>

                <div class="relative col-span-12">
                    <x-select-float wire:model='materia_id' :error="$errors->first('materia_id')">
                        <option value="" hidden selected></option>
                        @foreach ($c_materias as $item)
                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </x-select-float>
                    <x-label-float value="Materia" />
                </div>
                <div class="relative col-span-12">
                    <x-input-float type="text"  autofocus :error="$errors->first('titulo_alt')"
                                    placeholder="Título alterno" wire:model='titulo_alt' class="text-sm"
                                    />
                    <x-label-float value="Título alterno" class="text-sm"/>
                </div>

                <div class="col-span-full">
                    <x-select-float wire:model='adscripcion_id' :error="$errors->first('adscripcion_id')" class="text-sm">
                        <option value="" hidden selected></option>
                        @foreach ($c_adscripciones as $item)
                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </x-select-float>
                    <x-label-float value="Adscripción" />
                </div>

                <div class="relative col-span-2">
                    <x-input-float type="number"  autofocus :error="$errors->first('horas')"
                                    placeholder="Horas" wire:model='horas' min=0 class="text-sm"
                                    />
                    <x-label-float value="Horas" class="text-sm"/>
                </div>
                <div class="relative col-span-2">
                    <x-input-float type="number"  autofocus :error="$errors->first('grupo')"
                                    placeholder="Grupo" wire:model='grupo' min=0 class="text-sm"
                                    />
                    <x-label-float value="Grupo" class="text-sm"/>
                </div>
                <div class="relative col-span-2">
                    <x-input-float type="number"  autofocus :error="$errors->first('creditos')"
                                    placeholder="creditos" wire:model='creditos' min=0 class="text-sm"
                                    />

                </div>

                <div class="relative col-span-6">
                    <livewire:clases.clases-doc-upload :clase="$clase">
                </div>
            </div>
        </form>


        @if($clase)
            <livewire:clases.clases-tutores :clase="$clase">
            <livewire:clases.clases-estudiantes :clase="$clase">
        @endif
    </x-slot>
</x-container-card>
{{-- @extends('layouts.container_card_nav')

@section('title')
    Registro de clase
    @if($clase)
    <br><span class="text-base text-gray-400 font-light">{{ $clase->materia ? $clase->materia->nombre : '' }}</span>
    @endif
@endsection

@section('buttons')
    <x-button wire:click='store' class="rounded-s-lg self-start">Guardar</x-button>
    <a href="{{ route('clases') }}" class="button-secondary rounded-e-lg self-start">Cerrar</a>
@endsection

@section('body')
<form>
    <div class="grid grid-cols-12 gap-4 mb-8">
        <div class="relative col-span-2">
            <x-select-search-float :data="$c_semestres" wire:model.live="semestre_id" placeholder="Semestre"
                                    stylelabel="text-sm" class="text-sm"/>
        </div>
        <div class="relative col-span-3">
            <x-select-float wire:model='grado_id' :error="$errors->first('grado_id')" class="text-sm">
                <option value="" hidden selected></option>
                @foreach ($c_grados as $item)
                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                @endforeach
            </x-select-float>
            <x-label-float value="Grado" />
        </div>
        <div class="relative col-span-4">
            <x-select-float wire:model='tipo_id' :error="$errors->first('tipo_id')" class="text-sm">
                <option value="" hidden selected></option>
                @foreach ($c_tipos as $item)
                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                @endforeach
            </x-select-float>
            <x-label-float value="T. Materia" />
        </div>

        <div class="relative col-span-12">
            <x-select-float wire:model='materia_id' :error="$errors->first('materia_id')">
                <option value="" hidden selected></option>
                @foreach ($c_materias as $item)
                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                @endforeach
            </x-select-float>
            <x-label-float value="Materia" />
        </div>
        <div class="relative col-span-12">
            <x-input-float type="text"  autofocus :error="$errors->first('titulo_alt')"
                            placeholder="Título alterno" wire:model='titulo_alt' class="text-sm"
                            />
            <x-label-float value="Título alterno" class="text-sm"/>
        </div>

        <div class="relative col-span-7">
            <x-select-float wire:model='adscripcion_id' :error="$errors->first('adscripcion_id')" class="text-sm">
                <option value="" hidden selected></option>
                @foreach ($c_adscripciones as $item)
                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                @endforeach
            </x-select-float>
            <x-label-float value="Adscripción" />
        </div>
        <div class="relative col-span-5">
            <x-select-float wire:model='programa_id' :error="$errors->first('programa_id')" class="text-sm">
                <option value="" hidden selected></option>
                @foreach ($c_programas as $item)
                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                @endforeach
            </x-select-float>
            <x-label-float value="Programa" />
        </div>

        <div class="relative col-span-2">
            <x-input-float type="number"  autofocus :error="$errors->first('horas')"
                            placeholder="Horas" wire:model='horas' min=0 class="text-sm"
                            />
            <x-label-float value="Horas" class="text-sm"/>
        </div>
        <div class="relative col-span-2">
            <x-input-float type="number"  autofocus :error="$errors->first('grupo')"
                            placeholder="Grupo" wire:model='grupo' min=0 class="text-sm"
                            />
            <x-label-float value="Grupo" class="text-sm"/>
        </div>
        <div class="relative col-span-2">
            <x-input-float type="number"  autofocus :error="$errors->first('creditos')"
                            placeholder="creditos" wire:model='creditos' min=0 class="text-sm"
                            />

        </div>

        <div class="relative col-span-6">
            <livewire:clases.clases-doc-upload :clase="$clase">
        </div>
    </div>
</form>


@if($clase)
    <livewire:clases.clases-tutores :clase="$clase">
    <livewire:clases.clases-estudiantes :clase="$clase">
@endif
@endsection


{{--
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

@endsection>
--}}
