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
        if($this->clase and $this->clase->id){
            $this->filename = ClaseDocumento::where('clase_id', $this->clase->id)->first() ?
                              ClaseDocumento::where('clase_id', $this->clase->id)->first()->filename :
                              null ;
        }
    }

    public function store(){
        $this->validate([
            'file'=>'required|file',
        ]);

        $n_actas = ClaseDocumento::where('clase_id', $this->clase->id)->count() + 1;

        $filename = isset($this->clase->semestre) ? $this->clase->semestre->nombre : '0000-0' ;
        $filename .= isset($this->clase->id) ? '_AC'.str_pad($this->clase->id, 12, '0', STR_PAD_LEFT) : '_AC000000000000';
        $filename .= '_'.str_pad($n_actas, 2, '0', STR_PAD_LEFT).'.'.$this->file->extension();

       #$this->file->storeAs('clases', $filename)
        if($this->file->storeAs('clases', $filename, 'public')){
            $documento = ClaseDocumento::create(
                [
                    'clase_id'=>$this->clase->id,
                    'filename'=>$filename,
                ]
            );

            if ($documento->wasRecentlyCreated) {
                $this->notify('Documento guardado ['.$filename.']', 'Registro creado', 'success');
            }

            $this->reset([
                'file',
                'filename'
            ]);
            $this->mount();
        }
        else{
            $this->notify('Error al guardar el archivo', 'Error', 'error');
        }
    }

    public function deleteFile($filename=null){
        if($this->filename){
            $this->deleteModal = true;
        }else{
            $this->notify('Recargue la página y vuelva a intentar', 'Datos de archivo no disponibles', 'warning');
        }
    }

    public function delete(){
        if (Storage::exists('clases/'.$this->filename)) {
            $documento = ClaseDocumento::where('clase_id', $this->clase->id)->first();
            $documento->delete();

            Storage::delete('clases/'.$this->filename);

            $this->reset(['filename']);
            $this->notify('Registro eliminado correctamente', 'Registro eliminado', 'error');
        } else {
            $this->notify('', 'El archivo no existe', 'warning');
        }

        $this->deleteModal=false;
        $this->mount();
    }
}
