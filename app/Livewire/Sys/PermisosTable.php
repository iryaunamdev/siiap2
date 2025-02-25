<?php

namespace App\Livewire\Sys;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class PermisosTable extends DataTableComponent
{
    protected $model = Role::class;

    public function configure(): void
    {
        $this->setPrimaryKey('name');
        $this->setColumnSelectStatus(false);
        $this->setPerPageVisibilityDisabled();
        $this->setSearchDisabled();
        $this->setTheadAttributes([
            'default'=> True,
            'class' => 'text-xs',
        ]);
        $this->setThAttributes(function(Column $column) {
            return [
                'default' => False,
                'class' => 'px-2 py-2 text-left text-xs font-medium whitespace-nowrap text-gray-500 uppercase tracking-wider dark:bg-gray-800 dark:text-gray-400',
            ];
        });

        $this->setTdAttributes(function(Column $column, $row, $columnIndex, $rowIndex) {
            return [
                'default' => False,
                'class' => 'px-2 py-2 whitespace-nowrap',
            ];
        });
    }

    public function columns(): array
    {
        return [
            Column::make('Roles (permisos)', 'name')
                ->view('components.table.usuarios.permiso-name'),
            Column::make('', 'id')
                ->view('components.table.usuarios.delete-permiso')
        ];


    }
}
