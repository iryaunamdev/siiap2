@props([
    'disabled' => false,
    'error'=> false
    ])

@if($error)
    <select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'peer m-0 block h-[55px] w-full rounded border border-solid  border-danger-600 bg-white bg-clip-padding py-4 px-3 text-base font-normal leading-tight text-neutral-700 ease-in-out placeholder:text-transparent focus:border-primary focus:bg-white focus:pt-[1.625rem] focus:pb-[0.625rem] focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:bg-neutral-800 dark:text-neutral-200 [&:not(:placeholder-shown)]:pt-[1.625rem] [&:not(:placeholder-shown)]:pb-[0.625rem]']) !!}>
@elseif($disabled)
    <select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'peer m-0 block h-[55px] w-full rounded border border-solid  border-gray-300 bg-gray-100 bg-clip-padding py-4 px-3 text-base font-normal leading-tight text-neutral-700 ease-in-out placeholder:text-transparent focus:border-primary focus:bg-white focus:pt-[1.625rem] focus:pb-[0.625rem] focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:bg-neutral-800 dark:text-neutral-200 [&:not(:placeholder-shown)]:pt-[1.625rem] [&:not(:placeholder-shown)]:pb-[0.625rem]']) !!}>
@else
    <select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'peer m-0 block h-[55px] w-full rounded border border-solid  border-neutral-300 bg-white bg-clip-padding py-4 px-3 text-base font-normal leading-tight text-neutral-700 ease-in-out placeholder:text-transparent focus:border-primary focus:bg-white focus:pt-[1.625rem] focus:pb-[0.625rem] focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:bg-neutral-800 dark:text-neutral-200 [&:not(:placeholder-shown)]:pt-[1.625rem] [&:not(:placeholder-shown)]:pb-[0.625rem]']) !!}>
@endif
        {{ $slot }}
    </select>
