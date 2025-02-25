<div class="text-right">
    <button wire:click="$dispatch('change-user-password', {id:'{{ $value }}' })"><i class="fa-regular fa-key text-blue-600 hover:text-blue-400 focus:text-blue-400 mr-2" title="Cambiar contraseña"></i></button>
    <button wire:click="$dispatch('delete-usuario', {id:'{{ $value }}' })"><i class="fa-regular fa-trash text-red-600 hover:text-red-400 focus:text-red-400" title="Eliminar registro de usuario"></i></button>
</div>
