<div>
    @if($clase)
        @include('layouts.delete-confirmation-modal')

        <div x-data="{ fileName: null, fileData: null }" class="text-left">
            <!-- File Input -->
            <div>{{ $message }}</div>
            <input type="file" class="hidden" wire:model="file" x-ref="filedata"
                x-on:change="
                            fileName = $refs.filedata.files[0].name;
                        " />



                <x-button class="rounded rounded-md" x-on:click.prevent="$refs.filedata.click()"
                        title="Seleccionar archivo">
                        <i class="fa-regular fa-cloud-arrow-up fa-xl mr-1"></i> Seleccionar archivo
                </x-button>

                <div class="flex justify-between items-start text-xs pt-2 pb-2 mb-1 max-h-7">
                    <div>
                        @if($file)
                        <span class="text-blue-600" x-text="$refs.filedata.files[0].name"></span>
                        @endif
                    </div>
                    <button type="button" class="link-success rounded-md mt-2 self-center {{ !$file ? 'hidden' : ''  }}"
                            wire:click="store" title="Guardar archivo">
                            <i class="fa-solid fa-check fa-xl"></i>
                    </button>
                </div>

            <x-input-error for="filedata" class="mt-2" />
        </div>

        @foreach ($clase->documentos as $doc )
            <div class="flex justify-between text-sm pl-2 py-1">
                <a href="{{ Storage::disk('public')->url('clases/' . $doc->filename) }}" class="link-primary text-xs" target="_blank">
                    {{ $doc->filename }}
                </a>

                <button type="button" class="link-danger justify-self-end" wire:click='deleteFile'
                            title="Eliminar archivo">
                            <i class="fa-solid fa-trash"></i>
                        </button>
            </div>
        @endforeach
    @endif
</div>
