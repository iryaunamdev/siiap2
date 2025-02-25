<?php

namespace App\Livewire\Sys;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\sys\Catalogo;
use App\Models\sys\CatalogoItem;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class Catalogos extends Component
{
    protected $authorizedRoles = [
        'admin'
    ];

    public $catalogos, $items_activos, $card_title, $to_delete, $delete_message, $is_delete_catalogo;
    public $catalogo, $catalogo_id, $item, $item_id, $activo;

    #validation
    #[Validate('required', message:'El nombre es obligatorio.')]
    public $nombre;
    #[Validate('required', message:'La clave obligatoria. ')]
    public $clave;

    #Modales
    public $showModalCatalogo = false, $showModalItem=false, $deleteModal=false;

    public function render()
    {
        if(Auth::user()->hasanyrole($this->authorizedRoles)){
            return view('livewire.sys.catalogos');
        }else{
            return abort('403', 'Usuario no autorizado');
        }
    }

    public function mount(){
        $this->catalogos = Catalogo::all()->sortBy('nombre', SORT_LOCALE_STRING);
        $this->items_activos = $this->getActivos();
    }

    #[On('edit-catalogo')]
    public function editCatalogo($id=null){
        if($id){
            $this->catalogo = Catalogo::findOrFail($id);
            $this->catalogo_id = $this->catalogo->id;
            $this->nombre = $this->catalogo->nombre;
            $this->clave = $this->catalogo->clave;
            $this->activo = $this->catalogo->activo ? True : False;
            $this->card_title = "Modificar catálogo";
        }else{
            $this->card_title = "Nuevo catálogo";
        }

        $this->showModalCatalogo = true;
    }


    public function storeCatalogo(){
        $this->validate();

        Catalogo::updateOrCreate(
            ['id' => $this->catalogo_id],
            [
                'clave' => $this->clave,
                'nombre' => $this->nombre,
            ]
        );
        $this->closeModal();
        $this->notify("el catalogo se creó/modifico correctamente", "", "success");
    }

    public function editItem($catalogo_id, $id = null){
        $this->catalogo_id = $catalogo_id;
        if($id){
            $this->item = CatalogoItem::findOrFail($id);
            $this->item_id = $this->item->id;
            $this->nombre = $this->item->nombre;
            $this->clave = $this->item->clave;
            $this->activo = $this->item->activo ? True : False;
            $this->card_title = "Modificar elemento del catálogo";
        }else{
            $this->card_title = "Agregar elemento al catálogo";
            $this->activo = True;
        }

        $this->showModalItem = true;
    }

    public function storeItem(){
        $this->validate();

        CatalogoItem::updateOrCreate(
            ['id' => $this->item_id],
            [
                'catalogo_id' => $this->catalogo_id,
                'clave' => $this->clave,
                'nombre' => $this->nombre,
                'activo' => $this->activo,
            ]
        );

        $this->closeModal();
        $this->notify("el elemento del catálogo se creó/modifico correctamente", "", "success");
    }

    public function closeModal(){
        $this->showModalCatalogo = False;
        $this->showModalItem = False;
        $this->resetValidation();
        $this->reset();
        $this->mount();

    }

    public function getActivos(){
        $items = CatalogoItem::all();
        $items_activos = [];
        foreach($items as $item){
            $items_activos[$item->id] = $item->activo ? true : false;
        }

        return $items_activos;
    }

    public function updateItemActivo($item_id){
        $item = CatalogoItem::findOrFail($item_id);
        $item->activo = $this->items_activos[$item_id] ? true : false;
        $item->save();

        if($item->activo){
            $this->notify('El elemento del catálogo cambió su estado a activo.', 'Elemento activo', 'info');
        }else{
            $this->notify('El elemento del catálogo cambió su estado a inactivo.', 'Elemento inactivo', 'info');
        }

        $this->items_activos = $this->getActivos();
    }

    public function deleteCatalogoConfirmation(Catalogo $catalogo){
        $this->deleteModal = true;

        $this->to_delete = $catalogo;
        $this->is_delete_catalogo = true;
        $this->delete_message = "El catálogo y sus elementos se eliminará de manera permanente.";
    }

    public function deleteItemConfirmation(CatalogoItem $item){
        $this->deleteModal = true;

        $this->to_delete = $item;
        $this->is_delete_catalogo = false;
        $this->delete_message = "El elemento del catálogo se eliminará de manera permanente.";
    }

    public function delete(){
        if($this->is_delete_catalogo){
            if(count($this->to_delete->items)){
                foreach($this->to_delete->items as $item){
                    $item->delete();
                }
            }
            $this->to_delete->delete();

            $this->notify("El catálogo y sus elementos se eliminaron permanentemente.", "Catalogo eliminado", "error" );
        }else{
            $this->to_delete->delete();
            $this->notify("El elemento del catálogo se eliminó permanentemente.", "Elemento eliminado", "error" );
        }

        $this->reset();
        $this->mount();
        $this->deleteModal = false;
    }
}
