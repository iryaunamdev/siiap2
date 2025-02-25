@props([
    'disabled' => false,
    'error'=> false
    ])

@if($error)
    <select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'peer m-0 block w-full rounded border border-solid  border-danger-600 bg-white bg-clip-padding p-2.5 text-base font-normal leading-tight text-neutral-700 ease-in-out placeholder:text-transparent focus:border-primary focus:bg-white focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:bg-neutral-800 dark:text-neutral-200']) !!}>
@elseif($disabled)
    <select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'peer m-0 block w-full rounded border border-solid  border-gray-300 bg-gray-100 bg-clip-padding p-2.5 text-base font-normal leading-tight text-neutral-700 ease-in-out placeholder:text-transparent focus:border-primary focus:bg-white focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:bg-neutral-800 dark:text-neutral-200'])!!}>
@else
    <select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'peer m-0 block w-full rounded border border-solid  border-neutral-300 bg-white bg-clip-padding p-2.5 text-base font-normal leading-tight text-neutral-700 ease-in-out placeholder:text-transparent focus:border-primary focus:bg-white focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:bg-neutral-800 dark:text-neutral-200']) !!}>
@endif
    {{ $slot }}
</select>


{{--
<select {{ $attributes->merge(['class'=>'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}>
    {{ $slot }}
</select>
--}}
