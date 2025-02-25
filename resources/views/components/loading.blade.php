@props(['attributes'])
<div {{ $attributes }}>
    <div class="fixed inset-0 transform transition-all z-[99]">
        <div class="absolute inset-0 bg-gray-500 opacity-75">
            <div x-show="show" class="flex justify-center bg-transparent transform transition-all w-full h-screen">
                <div class="m-auto">
                    <i class="fa-duotone fa-spinner-third fa-spin fa-2x text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>
