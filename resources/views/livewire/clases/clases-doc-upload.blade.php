<div>
    @include('layouts.delete-confirmation-modal')
    <x-label value="Acta de calificaciones"></x-label>
    <div x-data="{ fileName: null, fileData: null }" class="text-left">
        <!-- File Input -->
        <div>{{ $message }}</div>
        <input type="file" class="hidden" wire:model="file" x-ref="filedata"
            x-on:change="
                        fileName = $refs.filedata.files[0].name;
                    " />

        <div wire:loading wire:target="filedata" wire:key="filedata" class="text-center text-xl m-auto"><i
                class="fa fa-spinner fa-spin mt-2 mx-auto"></i></div>

        <div class="flex justify-between">
            <div class="flex items-center">
                <button class="link-primary mr-4" type="button" x-on:click.prevent="$refs.filedata.click()"
                    title="Seleccionar archivo">
                    <i class="fa-regular fa-cloud-arrow-up fa-xl"></i>
                </button>

                @if (!$file and $filename)
                    <a href="{{ Storage::url('public/clases/' . $filename) }}" class="link-primary text-xs"
                        target="_blank">
                        {{ $filename }}
                    </a>
                @elseif($file)
                    <span class="text-xs text-blue-600" x-text="$refs.filedata.files[0].name">
                    </span>
                @else
                    <span class="inline text-sm text-gray-600">
                        Selecciona un archivo
                    </span>
                @endif
            </div>

            <div class="justify-self-end">
                @if ($file)
                    <x-button type="button" class="link-primary rounded-md mt-2 justify-self-end mr-4"
                        wire:click="store" title="Guardar archivo">
                        Guardar
                    </x-button>
                @endif

                @if (!$file and $filename)
                    <button type="button" class="link-danger mt-2 justify-self-end" wire:click='deleteFile'
                        title="Eliminar archivo">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                @endif
            </div>

        </div>





        <x-input-error for="filedata" class="mt-2" />
    </div>
</div>
