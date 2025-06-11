<form>
    <div class="grid grid-cols-12 gap-4 px-4 pt-4">
        <div class="relative col-span-4">
            <x-input-float type="text" required autofocus
                placeholder="Nombre" wire:model='nombre' :error="$errors->first('nombre')" />
            <x-label-float value="Nombre" />
        </div>
        <div class="relative col-span-4">
            <x-input-float type="text" required autofocus
                placeholder="Apellido paterno" wire:model='apellidop' :error="$errors->first('apellidop')" />
            <x-label-float value="Apellido paterno" />
        </div>
        <div class="relative col-span-4">
            <x-input-float type="text"
                placeholder="Apellido materno" wire:model='apellidom' :error="$errors->first('apellidom')" />
            <x-label-float value="Apellido materno" />
        </div>
    </div>

    <div class="grid grid-cols-12 gap-4 px-4 pt-4">
        {{-- <div class="relative col-span-3">
            <x-input-float type="text" required autofocus
                placeholder="Clave de trabajador" wire:model='clave' :error="$errors->first('clave')" />
            <x-label-float value="Clave de trabajador" class="text-sm"/>
        </div>--}}
        <div class="relative col-span-3">
            <x-select-float wire:model='sexo_id' class="text-sm">
                <option value="" hidden selected></option>
                @foreach($c_sexos as $item)
                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                @endforeach
            </x-select-float>
            <x-label-float value="Sexo" class="text-sm"/>
        </div>
        <div class="relative col-span-3">
            <x-select-float wire:model='grado_id' class="text-sm">
                <option value="" hidden selected></option>
                @foreach($c_grados as $item)
                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                @endforeach
            </x-select-float>
            <x-label-float value="Grado" class="text-sm"/>
        </div>

        @if($tutor)
        <div class="form-check col-span-3">
            <x-checkbox wire:model.defer="activo" wire:change='activateT({{ $tutor }})' class="text-lg"/>
            <x-label value="{{ $activo ? 'Activo' : 'Inactivo' }}" class="inline-block uppercase ml-4" />
        </div>
        @endif
    </div>

    <div class="grid grid-cols-12 gap-4 px-4 pt-4">
        <div class="relative col-span-6">
            <x-input-float type="text"
                placeholder="Correo electrónico" wire:model='email' :error="$errors->first('email')" class="text-sm " />
            <x-label-float value="Correo electrónico" class="text-sm"/>
        </div>
        <div class="relative col-span-6">
            <x-input-float type="text"
                placeholder="Área de estudio" wire:model='area' :error="$errors->first('area')" class="text-sm" />
            <x-label-float value="Área de estudio" class="text-sm"/>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-4 px-4 pt-4 pb-4">
        <div class="relative col-span-4">
            <x-input-float type="text"
                placeholder="CURP" wire:model='curp' :error="$errors->first('curp')" class="text-sm" />
            <x-label-float value="CURP" class="text-xs"/>
        </div>
        <div class="relative col-span-4">
            <x-input-float type="text"
                placeholder="RFC" wire:model='rfc' :error="$errors->first('rfc')" class="text-sm" />
            <x-label-float value="RFC" class="text-xs"/>
        </div>
        <div class="relative col-span-4">
            <x-input-float type="text"
                placeholder="ORCID" wire:model='orcid' :error="$errors->first('orcid')" class="text-sm" />
            <x-label-float value="ORCID" class="text-xs"/>
        </div>
    </div>
    <hr>
    <div class="grid grid-cols-12 gap-4 px-4 pt-4 pb-4">
        <div class="relative col-span-full">
            <x-select-float wire:model='adscripcion_id' :error="$errors->first('adscripcion_id')" class="text-sm">
                <option value="" hidden selected></option>
                @foreach ($c_adscripciones as $item)
                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                @endforeach
            </x-select-float>
            <x-label-float value="Adscripción" />
        </div>
        <div class="relative col-span-6">
            <x-select-float wire:model='contrato_id' class="text-sm">
                <option value="" hidden selected></option>
                @foreach($c_contratos as $item)
                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                @endforeach
            </x-select-float>
            <x-label-float value="Contrato" class="text-sm"/>
        </div>
        <div class="relative col-span-3">
            <x-select-float wire:model='sni_id' class="text-sm">
                <option value="" hidden selected></option>
                @foreach($c_sni as $item)
                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                @endforeach
            </x-select-float>
            <x-label-float value="Nivel SNI" class="text-sm"/>
        </div>
        <div class="relative col-span-3">
            <x-select-float wire:model='pride_id' class="text-sm">
                <option value="" hidden selected></option>
                @foreach($c_pride as $item)
                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                @endforeach
            </x-select-float>
            <x-label-float value="Nivel PRIDE" class="text-sm"/>
        </div>
    </div>
</form>
