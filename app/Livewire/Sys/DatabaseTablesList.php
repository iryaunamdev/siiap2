<?php

namespace App\Livewire\Sys;

use Illuminate\Support\Facades\DB;
use Livewire\Component;


class DatabaseTablesList extends Component
{
    public function render()
    {
        $siiap_tables = [
            0 => "estudiantes",
            1 => "estudiantes_bajas",
            2 => "estudiantes_graduaciones",
            3 => "estudiantes_ingresos",
            4 => "estudiantes_inscripciones",
            5 => "estudiantes_seguimientos",
            6 => "clases",
            7 => "clases_estudiantes",
            8 => "clases_tutores",
            9 => "estudiantes_tutores",
            10 => "estudiantes_graduaciones_tutores",
            11 => "estudiantes_seguimientos_tutores",
            12 => "tutores",
            13 => "clases_documentos",
        ];

        $siipa_tables = [
            0 => "alumnos",
            1 => "alumnos_bajas",
            2 => "alumnos_graduaciones",
            3 => "alumnos_ingresos",
            4 => "alumnos_inscripciones",
            5 => "alumnos_seguimientos",
            6 => "clases",
            7 => "clases_alumnos",
            8 => "clases_tutores",
            9 => "comite_tutor",
            10=> "graduaciones_sinodales",
            11 => "seguimientos_sinodales",
            12 => "tutores",
            13 => "uploads"
        ];

        return view('livewire.sys.database-tables-list', [
            'schemas' => [
                $this->getDatabaseSchema('siipa', $siipa_tables),
                $this->getDatabaseSchema('mysql', $siiap_tables)
            ]
        ]);
    }

    protected function getDatabaseSchema($connectionName, $tables)
    {
        $schema = [];
        $db = DB::connection($connectionName)->getSchemaBuilder();

        try {
            foreach ($tables as $table) {
                $columns = [];

                foreach ($db->getColumns($table) as $column) {
                    #dd($table, $column);
                    $columns[] = [
                        'name' => $column['name'],
                        'type' => $column['type_name'],
                        #'length' => $column->getLength(),
                        #'nullable' => !$column->getNotnull(),
                        #'default' => $column->getDefault(),
                    ];
                }

                $schema[] = [
                    'name' => $table,
                    'columns' => $columns,
                    #'rowCount' => count($tables)
                ];

                #dd($schema);
            }
        } catch (\Exception $e) {
            logger()->error("Error reading schema: " . $e->getMessage());
        }

        return $schema;
    }
}
