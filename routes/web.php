<?php

use Livewire\Livewire;
use App\Livewire\Sys\Usuarios;
use App\Livewire\Sys\Catalogos;
use App\Livewire\Clases\ClasesEdit;
use App\Livewire\Clases\ClasesIndex;
use App\Livewire\Tutores\TutoresEdit;
use Illuminate\Support\Facades\Route;
use App\Livewire\Tutores\TutoresIndex;
use App\Livewire\Estudiantes\EstudiantesEdit;
use App\Livewire\Estudiantes\EstudiantesIndex;
use App\Livewire\Sys\DatabaseTablesList;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group([
    'prefix' => 'sys',
    'middleware'=>[
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified'
    ]
], function(){
    Route::get('catalogos', Catalogos::class)->name('sys.catalogos');
    Route::get('usuarios', Usuarios::class)->name('sys.usuarios');
    Route::get('database-explorer', DatabaseTablesList::class)->name('database-explorer');
});

Route::group([
    'prefix' => 'estudiantes',
    'middleware'=>[
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified'
    ]
], function(){
    Route::get('/', EstudiantesIndex::class)->name('estudiantes');
    Route::get('registro/{id?}', EstudiantesEdit::class)->name('estudiantes.edit');
});

Route::group([
    'prefix' => 'tutores',
    'middleware'=>[
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified'
    ]
], function(){
    Route::get('/', TutoresIndex::class)->name('tutores');
    Route::get('registro/{id?}', TutoresEdit::class)->name('tutores.edit');
});

Route::group([
    'prefix' => 'clases',
    'middleware'=>[
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified'
    ]
], function(){
    Route::get('/', ClasesIndex::class)->name('clases');
    Route::get('registro/{id?}', ClasesEdit::class)->name('clases.edit');
});


//Corregir Bug para que livewire funcione en produccion
Livewire::setScriptRoute(function($handle) {
    $path_livewire = trim(env('LIVEWIRE_ASSET_URL'));
    return Route::get($path_livewire . '/livewire/livewire.js', $handle);
});

Livewire::setUpdateRoute(function($handle) {
    $path_livewire = trim(env('LIVEWIRE_ASSET_URL'));
    return Route::get($path_livewire . '/livewire/update', $handle);
});



