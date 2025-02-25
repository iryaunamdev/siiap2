@props([
    'user'
])

@foreach ($user->getRoleNames() as $role )
    @if($role == "admin")
        <span class="bg-slate-600 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded uppercase">{{ $role }}</span>
    @else
        <span class="bg-blue-400 text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded uppercase">{{ $role }}</span>
    @endif
@endforeach
