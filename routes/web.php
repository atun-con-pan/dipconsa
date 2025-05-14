<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\CarpetasController;
use App\Http\Controllers\FileExplorerController;
use App\Http\Controllers\ArchivoController;

Route::get('/', [HomeController::class, "index"])->name('home');

Route::get('/trabajadores', [TrabajadorController::class, 'index'])->name('trabajadores.index');
Route::get('/trabajadores/create', [TrabajadorController::class, 'create'])->name('trabajadores.create');
Route::get('trabajadores/{id}/edit', [TrabajadorController::class, 'edit'])->name('trabajadores.edit');
Route::put('trabajadores/{id}', [TrabajadorController::class, 'update'])->name('trabajadores.update');
Route::get('/trabajadores/{trabajador}', [TrabajadorController::class, 'show'])->name('trabajadores.show');
Route::resource('trabajadores', TrabajadorController::class);

Route::post('/trabajadores/{trabajador}/documentos', [DocumentoController::class, 'store'])->name('documentos.store');
Route::delete('/documentos/{documento}', [DocumentoController::class, 'destroy'])->name('documentos.destroy');
Route::get('/documentos/{documento}/ver', [DocumentoController::class, 'ver'])->name('documentos.ver');



Route::get('/documentos', [CarpetasController::class, 'index'])->name('documentos.index');
Route::post('/documentos/crear-carpeta', [CarpetasController::class, 'crearCarpeta'])->name('documentos.crear-carpeta');



Route::post('/documentos/subir-archivo', [ArchivoController::class, 'subirArchivo'])->name('documentos.subir-archivo');