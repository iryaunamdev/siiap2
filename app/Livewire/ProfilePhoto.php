<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class ProfilePhoto extends Component
{
    use WithFileUploads;

    public $persona;
    public $photo;
    public $message;

    public function photoUpdate(){
        $this->validate([
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // 2MB Max
        ]);

        $image = $this->photo;
        if($this->persona && $this->photo){
            $filename = str_pad($this->persona->id, 4, "0", STR_PAD_LEFT).'_'.Str::lower($this->persona->nombre[0 ?? '']).Str::lower($this->persona->apellidop).'.jpg';
            //$filename = $filename.'-' . substr(uniqid(rand(), true), 8, 8) . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath())->encode('jpg', 65)->fit(800, null, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });

            $img->stream(); // <-- Key point
            Storage::disk('local')->put('public/images/fotos' . '/' . $filename, $img, 'public');

            //SAVE FILE NAME TO DB
            $photoUpdate = $this->persona->update([
                'photo_url' => $filename,
            ]);

            $this->notify('succcess', 'La foto se actualizó correctamente.');
        }
    }

    public function deleteProfilePhoto()
    {
        $this->notify('warning', 'Metodo sin definir');
    }

    public function render()
    {
        return view('livewire.profile-photo');
    }
}
