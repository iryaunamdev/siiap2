<form>
    <div class="grid grid-cols-12 gap-4 px-4 pt-4">
        <div class="relative col-span-4">
            <x-input-float type="text" required autofocus
                placeholder="Cuenta UNAM" wire:model='cuenta' :error="$errors->first('cuenta')" />
            <x-label-float value="Cuenta UNAM" />
        </div>
        <div class="relative col-span-4 start-9">

        </div>
    </div>
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
        <div class="relative col-span-2">
            <x-select-float wire:model='sexo_id' class="text-xs">
                <option value="" hidden selected></option>
                @foreach($c_sexos as $item)
                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                @endforeach
            </x-select-float>
            <x-label-float value="Sexo" />
        </div>
        <div class="relative col-span-3">
            <x-input-float type="date"
                placeholder="F. Nacimiento" wire:model='fecha_nacimiento' :error="$errors->first('fecha_nacimiento')" class="text-sm" />
            <x-label-float value="F. Nacimiento" class="text-sm"/>
        </div>
        <div class="relative col-span-3">
            <x-select-float wire:model='nacionalidad_id' class="text-sm">
                <option value="" hidden selected></option>
                @foreach($c_paises as $item)
                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                @endforeach
            </x-select-float>
            <x-label-float value="Nacionalidad" class="text-sm"/>
        </div>
        <div class="relative col-span-4">
            <x-input-float type="text"
                placeholder="Lugar de nacimiento" wire:model='lugar_nacimiento' :error="$errors->first('lugar_nacimiento')" class="text-sm" />
            <x-label-float value="Lugar de nacimiento" class="text-sm"/>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-4 px-4 pt-4 pb-4">
        <div class="relative col-span-4">
            <x-input-float type="text"
                placeholder="CURP" wire:model='curp' :error="$errors->first('curp')" class="text-sm" />
            <x-label-float value="CURP" class="text-sm"/>
        </div>
        {{--
        <div class="relative col-span-4">
            <x-input-float type="text"
                placeholder="RFC" wire:model='rfc' :error="$errors->first('rfc')" class="text-sm" />
            <x-label-float value="RFC" />
        </div>
        --}}
        <div class="relative col-span-4">
            <x-input-float type="text"
                placeholder="ORCID" wire:model='orcid' :error="$errors->first('orcid')" class="text-sm" />
            <x-label-float value="ORCID" class="text-sm"/>
        </div>
        <div class="relative col-span-6">
            <x-input-float type="text"
                placeholder="Correo electrónico (institucional)" wire:model='email' :error="$errors->first('email')" class="text-sm" />
            <x-label-float value="Correo electrónico (institucional)" class="text-sm"/>
        </div>
        <div class="relative col-span-6">
            <x-input-float type="text"
                placeholder="Correo electrónico (alternativo)" wire:model='email_alt' :error="$errors->first('email_alt')" class="text-sm" />
            <x-label-float value="Correo electrónico (alternativo)" class="text-sm"/>
        </div>
    </div>
</form>
