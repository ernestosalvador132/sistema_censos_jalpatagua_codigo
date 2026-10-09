<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CensoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\InformacionController;
use App\Http\Controllers\UsuarioController;

Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', [AuthController::class,'show'])->name('login');
Route::post('/login', [AuthController::class,'login'])->name('login.post');
Route::post('/logout', [AuthController::class,'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::view('/inicio','inicio.index')->name('inicio');
    Route::get('/registro-censal',[CensoController::class,'create'])->name('censos.create');
    Route::post('/registro-censal',[CensoController::class,'store'])->name('censos.store');
    Route::get('/reportes',[ReporteController::class,'index'])->name('reportes.index');
    Route::get('/reportes/exportar',[ReporteController::class,'exportar'])->name('reportes.exportar');
    Route::get('/informacion',[InformacionController::class,'index'])->name('informacion.index');
    Route::get('/informacion/{comunidad}',[InformacionController::class,'show'])->name('informacion.show');
    Route::get('/administracion/usuarios',[UsuarioController::class,'index'])->name('usuarios.index');
    Route::post('/administracion/usuarios',[UsuarioController::class,'store'])->name('usuarios.store');
});
