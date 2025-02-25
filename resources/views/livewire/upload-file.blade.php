<div>
    <x-label value="Acta de calificaciones"></x-label>
    <div x-data="{fileName: null, fileData: null}" class="text-left">
        <!-- File Input -->
        <div>{{ $message }}</div>
        <input type="file" class="hidden"
                    wire:model="file"
                    wire:change='fileUpload'
                    x-ref="filedata"
                    x-on:change="
                        fileName = $refs.filedata.files[0].name;
                    " />

        <div wire:loading wire:target="filedata" wire:key="filedata" class="text-center text-xl m-auto"><i class="fa fa-spinner fa-spin mt-2 mx-auto"></i></div>

        <div class="flex justify-between">
            <div class="flex items-center">
                <button class="link-primary mr-4" type="button" x-on:click.prevent="$refs.filedata.click()" title="Seleccionar archivo">
                    <i class="fa-regular fa-cloud-arrow-up fa-xl"></i>
                </button>

                <div class="" x-show="!fileName" style="display: none;" class="">
                    <span class="inline text-sm text-gray-600">
                        Selecciona un archivo
                    </span>
                </div>
                <div class="" x-show="fileName" style="display: none;">
                    <span class="text-xs text-blue-600"
                        x-text="fileName">
                    </span>
                </div>
            </div>
            @if($file)
            <div class="justify-self-end">
                <button type="button" class="link-danger mt-2 justify-self-end" wire:click="deletefile" title="Eliminar archivo">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
            @endif
        </div>





        <x-input-error for="filedata" class="mt-2" />
    </div>
</div>
