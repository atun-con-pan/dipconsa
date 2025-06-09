<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\CarpetasController;
use App\Http\Controllers\FileExplorerController;
use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AyudaController;
use App\Http\Middleware\AdminMiddleware;


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [HomeController::class, "index"])->name('home')->middleware('auth');

Route::get('/trabajadores', [TrabajadorController::class, 'index'])->name('trabajadores.index')->middleware('auth');
Route::get('/trabajadores/create', [TrabajadorController::class, 'create'])->name('trabajadores.create')->middleware('auth');
Route::get('trabajadores/{id}/edit', [TrabajadorController::class, 'edit'])->name('trabajadores.edit')->middleware('auth');
Route::put('/trabajadores/{trabajador}', [TrabajadorController::class, 'update'])->name('trabajadores.update')->middleware('auth');
Route::get('/trabajadores/{trabajador}', [TrabajadorController::class, 'show'])->name('trabajadores.show')->middleware('auth');
Route::resource('trabajadores', TrabajadorController::class)->middleware('auth');

Route::post('/trabajadores/{trabajador}/documentos', [DocumentoController::class, 'store'])->name('documentos.store')->middleware('auth');
Route::delete('/documentos/{documento}', [DocumentoController::class, 'destroy'])->name('documentos.destroy')->middleware('auth');
Route::get('/documentos/{documento}', [DocumentoController::class, 'ver'])->name('documentos.ver')->middleware('auth');



Route::get('/documentos', [CarpetasController::class, 'index'])->name('documentos.index')->middleware('auth');
Route::post('/documentos/crear-carpeta', [CarpetasController::class, 'crearCarpeta'])->name('documentos.crear-carpeta')->middleware('auth');
Route::post('/carpeta/{id}/rename', [CarpetasController::class, 'rename'])->name('carpetas.rename')->middleware('auth');
Route::delete('/carpeta/{id}', [CarpetasController::class, 'destroy'])->name('carpeta.destroy')->middleware('auth');



Route::post('/documentos/subir-archivo', [ArchivoController::class, 'subirArchivo'])->name('documentos.subir-archivo')->middleware('auth');
Route::put('/documentos/{archivo}', [ArchivoController::class, 'update'])->name('documentos.update')->middleware('auth');
Route::delete('/archivos/{archivo}', [ArchivoController::class, 'destroy'])->name('archivos.destroy')->middleware('auth');
Route::get('/archivos/{nombre_archivo}', [ArchivoController::class, 'ver'])->name('archivos.ver')->middleware('auth');

Route::middleware(['auth', AdminMiddleware::class])->get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::middleware(['auth', AdminMiddleware::class])->post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
//Route::middleware(['auth', AdminMiddleware::class])->post('/usuarios/{usuario}/update', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::middleware(['auth', AdminMiddleware::class])->resource('usuarios', UsuarioController::class);

Route::get('/ayuda', [AyudaController::class, 'index'])->name('ayuda.index')->middleware('auth');
