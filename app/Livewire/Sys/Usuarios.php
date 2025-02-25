<?php

namespace App\Livewire\Sys;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;


class Usuarios extends Component
{
    protected $authorizedRoles = [
        'admin'
    ];

    public function render()
    {
        if(Auth::user()->hasanyrole($this->authorizedRoles)){
            return view('livewire.sys.usuarios');
        }else{
            return abort('403', 'Usuario no autorizado');
        }

    }
}
