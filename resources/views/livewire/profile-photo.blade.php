<div x-data="{photoName: null, photoPreview: null}" class="text-center">
    <!-- Profile Photo File Input -->
    <div>{{ $message }}</div>
    <input type="file" class="hidden"
                wire:model="photo"
                x-ref="photo"
                x-on:change="
                        photoName = $refs.photo.files[0].name;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            photoPreview = e.target.result;
                        };
                        reader.readAsDataURL($refs.photo.files[0]);
                " />

    <div wire:loading wire:target="photo" wire:key="photo" class="text-center text-xl m-auto"><i class="fa fa-spinner fa-spin mt-2 mx-auto"></i></div>

    <!-- Current Profile Photo -->
    <div class="" x-show="!photoPreview">
        @if($this->persona)
            @if($this->persona->photo_url)
                    <img src="{{ Storage::url("images/fotos/".$this->persona->photo_url) }}" class="rounded h-40 w-36 object-cover m-auto"/>
            @else
            <img src="{{ Avatar::create($this->persona?$this->persona->fullname:'')->toBase64() }}"  class="rounded-full h-36 w-36 object-cover m-auto"/>
            @endif
        @else
            <img src="{{ Avatar::create($this->persona?$this->persona->fullname:'')->toBase64() }}"  class="rounded-full h-368 w-36 object-cover m-auto"/>
        @endif
    </div>

    <!-- New Profile Photo Preview -->
    <div class="" x-show="photoPreview" style="display: none;">
        <span class="block rounded-full w-36 h-36 bg-cover bg-no-repeat bg-center bg-slate-400 m-auto"
              x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
        </span>
    </div>

    <x-secondary-button class="m-auto mt-2" type="button" x-on:click.prevent="$refs.photo.click()" title="Seleccionar foto">
        <i class="fa-solid fa-camera"></i>
    </x-secondary-button>

    @if($this->persona)
        @if ($this->persona->photo_url)
            <x-danger-button type="button" class="mt-2" wire:click="deleteProfilePhoto" title="Eliminar foto">
                <i class="fa-solid fa-trash"></i>
            </x-danger-button>
        @endif
    @endif

    <x-input-error for="photo" class="mt-2" />
</div>

