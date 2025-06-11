<div>
    <div class="grid grid-cols-6 gap-4">
        <x-select-search wire:model.live='pais_id' :data="$c_paises" text_size="text-sm" placeholder="País" ></x-select-search>
        <x-select-search wire:model.live='pais_id' :data="$c_paises" text_size="text-sm" placeholder="País" float="true"></x-select-search>
        <div>
            <x-input />
        </div>
        <div class="relative">
            <x-input-float placeholder="Input de prueba" class="w-full"/>
            <x-label-float value="Prueba de input" />
        </div>
    </div>

    {{ $pais_id }}
</div>
