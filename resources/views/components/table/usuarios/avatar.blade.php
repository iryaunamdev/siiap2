@props([
    'url', 'name'
])
@if($url)
    <img src="{{$url}}" alt="{{ $url }}" class="w-10">
@else
<img src="{{ Avatar::create(strtoupper($name))->toBase64(); }}" alt="{{ $name }}" class="w-10"/>
@endif
