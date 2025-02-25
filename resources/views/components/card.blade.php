@props(['id', 'bgColor'])

<div {{ $attributes->merge(['class'=>'w-full bg-white border border-gray-200 rounded-lg shadow'])}}>
    <div class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800 {{ $bgColor ?? 'bg-gray-50'}}">
        <div class="w-full grid grid-cols-4 py-2 px-4">
            <div class="col-span-3">
                {{ $title }}
            </div>
            <div class="inline-flex justify-end" role="group">
                {{ $buttons ?? '' }}
            </div>
        </div>
    </div>

    <div>
        {{ $body }}
    </div>

    <div class="flex flex-row justify-end px-4 py-2 border-t border-gray-200 text-end {{ !isset($footer) ? 'hidden' : ''}}">
        {{ $footer ?? ''}}
    </div>
</div>
