<?php

namespace App\Livewire\Sys;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;

class UsuarioEdit extends Component
{
    public $user, $user_id, $card_title;

    #[Validate('required', message:'El nombre de usuario es obligatorio.')]
    public $name;

    #[Validate('required', message:'Se require un email con formato válido.')]
    public $email;

    public $activo, $password, $roles, $role_list = [], $to_delete;
    public $showModalUsuario =false , $showPasswordModal = false, $deleteModal=false;

    public function render()
    {
        return view('livewire.sys.usuario-edit');
    }

    public function mount(){
        $this->roles = Role::all();
    }

    #[On('edit-user')]
    public function editUser($id=null)
    {
        if($id){
            $this->user = User::findOrFail($id);
            $this->user_id = $this->user->id;
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->activo = $this->user->activo ? True : False;
            $this->role_list = $this->getRoles();
            $this->card_title = "Modificar usuario";
        }else{
            $this->card_title = "Nuevo usuario";
            $this->password = $this->generateStrongPassword(10);
        }

        $this->showModalUsuario = True;
    }

    public function store(){
        if($this->user_id){
            $this->validate();

            $this->user->update(
                [
                    'name' => $this->name,
                    'email' => $this->email,
                    'activo' => $this->activo ? True : False,
                ]
            );

        }else{
            $this->validate();

            if($this->password){
                $this->user = User::create(
                    [
                        'name' => $this->name,
                        'email' => $this->email,
                        'activo' => True,
                        'password' => bcrypt($this->password),
                    ]
                );
            }else{
                $this->notify('Es necesario que esstablesca una contraseña', 'Contraseña no definida', 'error');
            }
        }


        if(count($this->role_list)){
            $this->assignRoles();
        }

        $this->dispatch('refreshDatatable');
        $this->closeModal();
        $this->notify('El usuario se ha creado/modificado correctamente.', 'Usuario creado/modificado', 'success');
    }

    #[On('change-user-password')]
    public function changePassword($id = null){
        if($id){
            $this->user = User::findOrFail($id);
            $this->user_id = $this->user->id;
            $this->password = $this->generateStrongPassword(10);
        }
        $this->showPasswordModal = true;
    }

    public function updatePassword(){

        if($this->user_id){
            $this->user->update([
                'password' => bcrypt($this->password),
            ]);

            $this->dispatch('refreshDatatable');
            $this->closeChangePassword();
            $this->notify('La contraseña se actualizó correctamente.', 'La contraseña cambió!', 'success');
        }else{
            $this->notify('Algo salió mal.', 'ERROR', 'error');
        }
    }

    public function closeChangePassword(){

        $this->reset(['password']);
        $this->mount();
        $this->showPasswordModal = false;
    }

    #[On('delete-usuario')]
    public function confirmDeleteUser($id = null){
        if($id){
            $this->to_delete = User::findOrFail($id);
        }

        $this->deleteModal =true;
    }

    public function delete(){
        $this->to_delete->delete();

        $this->reset();
        $this->dispatch('refreshDatatable');
        $this->deleteModal = false;
        $this->mount();
        $this->notify('El usuario se elimino de manera permanente.', 'Usuario eliminado', 'error');
    }

    public function getRoles()
    {
        $user_roles = $this->user->getRoleNames();
        $role_list = [];
        foreach ($this->roles as $role) {
            if ($user_roles->contains($role->name)) {
                $role_list[$role->id] = true;
            } else {
                $role_list[$role->id] = false;
            }
        }
        return $role_list;
    }

    public function assignRoles()
    {
        //Asignar Roles
        $roles = [];
        foreach ($this->role_list as $index => $selectedRole) {
            if ($selectedRole) {
                array_push($roles, Role::findOrFail($index)->name);
            }
        }

        $this->user->syncRoles($roles);
    }

    public function closeModal()
    {
        $this->showModalUsuario = False;
        $this->resetValidation();
        $this->reset();
        $this->mount();
    }

    function generateStrongPassword($length = 10, $add_dashes = false, $available_sets = 'luds')
    {
        $sets = array();
        if(strpos($available_sets, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        if(strpos($available_sets, 'u') !== false)
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if(strpos($available_sets, 'd') !== false)
            $sets[] = '23456789';
        if(strpos($available_sets, 's') !== false)
            $sets[] = '!@#$%&*?';

        $all = '';
        $password = '';
        foreach($sets as $set)
        {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }

        $all = str_split($all);
        for($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];

        $password = str_shuffle($password);

        if(!$add_dashes)
            return $password;

        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while(strlen($password) > $dash_len)
        {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }
}
