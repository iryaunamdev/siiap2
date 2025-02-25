<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadFile extends Component
{
    use WithFileUploads;

    public $file, $filename, $location="", $message;

    public function render()
    {
        return view('livewire.upload-file');
    }

    public function fileUpload(){
        dd($this->file);
    }
}
