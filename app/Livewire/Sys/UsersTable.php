<?php

namespace App\Livewire\Sys;

use App\Models\User;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ViewComponentColumn;


class UsersTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        $this->setPerPageVisibilityDisabled();
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
            if ($column->isField('activo')) {
                return [
                    'default' => False,
                    'class' => 'px-2 py-2 whitespace-nowrap text-center',
                ];
            }

            if ($column->isField('email')) {
                return [
                    'default' => False,
                    'class' => 'px-2 py-2 whitespace-nowrap text-blue-600 italic',
                ];
              }

            return [
                'default' => False,
                'class' => 'px-2 py-2 whitespace-nowrap',
            ];
        });
    }

    public function columns(): array
    {
        return [
            ViewComponentColumn::make('', 'profile_photo_path')
                ->component('components.table.usuarios.avatar')
                ->attributes(fn($value, $row, Column $column) => [
                    'url' => $value,
                    'name' => $row->name,
                ]),
            Column::make('Usuario', 'name')
                ->view('components.table.usuarios.user-name')
                ->searchable()
                ->sortable(),
            BooleanColumn::make('Activo', 'activo')
                ->setView('components.table.usuarios.active'),
            ViewComponentColumn::make('Grupos y Permisos', 'id')
                ->component('components.table.usuarios.permisos')
                ->attributes(fn($value, $row, Column $column) => [
                    'user' => User::findOrFail($value),
                ])->sortable(),
            ViewComponentColumn::make('Datos de conexión', 'id')
                ->component('components.table.usuarios.user-conexion')
                ->attributes(fn($value, $row, Column $column) => [
                    'user' => User::findOrFail($value),
                ]),
            Column::make('', 'id')
                ->view('components.table.usuarios.user-actions')
        ];
    }
}
