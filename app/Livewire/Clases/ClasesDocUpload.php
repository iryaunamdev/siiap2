<?php

namespace App\Livewire\Clases;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ClaseDocumento;
use Illuminate\Support\Facades\Storage;

class ClasesDocUpload extends Component
{
    use WithFileUploads;

    public $clase, $file, $filename, $message;
    public $deleteModal=false;

    public function render()
    {
        return view('livewire.clases.clases-doc-upload');
    }

    public function mount(){
        if($this->clase->id){
            $this->filename = ClaseDocumento::where('clase_id', $this->clase->id)->first() ?
                              ClaseDocumento::where('clase_id', $this->clase->id)->first()->filename :
                              null ;
        }
    }

    public function store(){
        $this->validate([
            'file'=>'required|file',
        ]);

        if(!$this->filename){
            $this->filename = isset($this->clase->semestre) ? $this->clase->semestre->nombre : '0000-0' ;
            $this->filename .= isset($this->clase->id) ? '_'.str_pad($this->clase->id, 5, '0', STR_PAD_LEFT) : '_00000';
            $this->filename .= '_acta-calificaciones';
        }

        $path = $this->file->storeAs('public/clases', $this->filename);

        $documento = ClaseDocumento::updateOrCreate(
            [
                'clase_id'=>$this->clase->id,
            ],
            [
                'clase_id'=>$this->clase->id,
                'filename'=>$this->filename,
            ]
        );

        if ($documento->wasRecentlyCreated) {
            $this->notify('Documento guardado ['.$path.']', 'Registro creado', 'success');
        } else {
            $this->notify('Documento guardado ['.$path.']', 'Registro actualizado', 'info');
        }

        $this->reset([
            'file',
            'filename'
        ]);
        $this->mount();
    }

    public function deleteFile($filename=null){
        if($this->filename){
            $this->deleteModal = true;
        }else{
            $this->notify('Recargue la página y vuelva a intentar', 'Datos de archivo no disponibles', 'warning');
        }
    }

    public function delete(){
        if (Storage::exists('public/clases/'.$this->filename)) {
            $documento = ClaseDocumento::where('clase_id', $this->clase->id)->first();
            $documento->delete();

            Storage::delete('public/clases/'.$this->filename);

            $this->reset(['filename']);
            $this->notify('Registro eliminado correctamente', 'Registro eliminado', 'error');
        } else {
            $this->notify('', 'El archivo no existe', 'warning');
        }

        $this->deleteModal=false;
        $this->mount();
    }
}
