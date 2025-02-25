@props([
    'direction' => '',
    'ordering'=> false
    ])
<button {{ !$ordering ? 'disabled' : '' }}
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-2 py-4 text-xs text-gray-500 uppercase tracking-widest focus:ring-offset-1 disabled:opacity-80 transition ease-in-out duration-150']) }}>
    {{ $slot }}
    @if($ordering)
        @if($direction=='asc')
            <i class="fa-regular fa-angle-up ml-2"></i>
        @elseif($direction=='desc')
            <i class="fa-regular fa-angle-down ml-2"></i>
        @else
            <i class="fa-solid fa-minus ml-2"></i>
        @endif
    @endif
</button>
