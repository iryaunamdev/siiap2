    @if($value == "admin")
    <button class="bg-slate-600 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded uppercase" wire:click="$dispatch('edit-permiso', {name:'{{ $value }}' })">{{ $value }}</button>
    @else
    <button class="bg-blue-400 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded uppercase" wire:click="$dispatch('edit-permiso', {name:'{{ $value }}' })">{{ $value }}</button>
    @endif
