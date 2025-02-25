<div class="px-2 py-2 truncate dark:text-white text-sm">
    @if($value === null)
        <span class="opacity-25">&mdash;</span>
    @elseif($column->isRaw())
        {!! $value !!}
    @else
        {{ $value }}
    @endif
</div>
