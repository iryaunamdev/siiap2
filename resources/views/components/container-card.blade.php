@props([
    'width'=> 'w-3/5',
])

<div {{ $attributes->merge(['class' => 'bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700']) }} >
    <div class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800">
        <div class="w-full grid grid-cols-3 py-2 px-4">
            <h2 class="col-span-2 text-xl text-left font-semibold tracking-tight text-blue-800 dark:text-white">
                {{ $title ?? '' }}
            </h2>
            <div class="flex items-stretch justify-end" role="group">
                {{ $buttons ?? '' }}
            </div>
        </div>
    </div>

    <div class="px-4 py-4 bg-white rounded-lg dark:bg-gray-800">
        {{ $body ?? '' }}
    </div>
</div>
