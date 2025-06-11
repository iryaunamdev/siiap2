<?php

namespace App\Livewire;

use App\Models\sys\CatalogoItem;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadFile extends Component
{
    use WithFileUploads;

    public $file, $filename, $location="", $message, $pais_id='mx';
    public $c_paises;

    public function render()
    {
        return view('livewire.upload-file');
    }

    public function mount(){
        $this->c_paises = CatalogoItem::whereRelation('catalogo', 'clave', 'C_PAISES')
            ->where('activo', 1)
            ->orderBy('nombre')
            ->pluck('nombre', 'id')->toJson();

        $this->c_paises = str_replace('"', "'", $this->c_paises);
    }


    public function fileUpload(){
        dd($this->file);
    }
}
