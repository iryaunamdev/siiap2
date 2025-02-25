<?php

namespace App\Livewire\Sys;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;

class Permisos extends Component
{
    public $role;

    #[Validate('required', message:'Se require un nombre del rol')]
    public $role_name;

    public $role_id, $card_title, $to_delete;
    public $showModalPermisos = False, $deleteModal=false;

    public function render()
    {
        return view('livewire.sys.permisos');
    }

    #[On('edit-permiso')]
    public function editPermiso($name = null){
        if($name){
            $this->role = Role::where('name', $name)->first();
            $this->role_name = $this->role->name;
            $this->role_id = $this->role->id;

            $this->card_title = "Modificar Rol";
        }else{
            $this->role_name = "";
            $this->role_id = "";
            $this->card_title = "Agregar nuevo Rol";
        }
        $this->showModalPermisos = True;
    }

    public function store()
    {
        $this->validate();

        if($this->role_id){
            $this->role->update([
                'name'=> $this->role_name
            ]);
        }else{
            Role::Create(

                [
                    'name' => strtolower($this->role_name),
                    'guard_name'=>'web',
                ]
            );
        }

        $this->closeModal();
        $this->dispatch('refreshDatatable');
        $this->notify('El rol de permisos se ha guardado correctamente.', '', 'success');
    }

    public function closeModal()
    {
        $this->showModalPermisos = False;
        $this->resetValidation();
        $this->reset();
    }

    #[On('delete-permiso')]
    public function deletePermiso($id = null){
        $this->to_delete = Role::findOrFail($id);
        $users = User::role($this->to_delete->name)->get();
        if($this->to_delete->name == 'admin'){
            $this->notify('Este rol no se puede eliminar.','Rol protegido!', 'warning');
        }elseif(count($users)){
            $this->notify('Se requiere que el rol no tenga usuarios asociados.','El rol no se puede eliminar!', 'warning');
        }else{
            $this->deleteModal= True;
        }

    }

    public function delete(){
        $this->to_delete->delete();
        $this->deleteModal = False;
        $this->dispatch('refreshDatatable');
        $this->notify('El registro se eliminó de manera permanente.','Rol/Permiso eliminado!', 'error');
    }
}
