@php
    use App\Models\User;

    $user = User::findOrFail($row->id);
@endphp
<div>
    {{-- <button class="link-primary" wire:click="$dispatchTo('sys.usuario-edit', 'edit-user', {id:{{ $user->id }}})">{{ $value }}</button><br> --}}
    <button class="link-primary" wire:click="$dispatch('edit-user', {id:{{ $user->id }}})">{{ $value }}</button><br>
    <span class="text-gray-400 italic text-xs">{{ $user->email}}</span>
</div>
