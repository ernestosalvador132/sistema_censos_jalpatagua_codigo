<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CensoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\InformacionController;
use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\DpiController;
use App\Http\Controllers\DpiPdfController;
// INICIO DE SESIÓN
Route::get('/', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
// RUTAS PARA USUARIOS AUTENTICADOS
Route::middleware('auth')->group(function () {
    // INICIO
    Route::get('/inicio', function () {
        return view('inicio.index');
    })->name('inicio');
    // REGISTRO CENSAL
    Route::get('/censos', function () {
        return view('censos.index');
    })->name('censos.index');
    Route::post('/censos', [CensoController::class, 'store'])->name('censos.store');
    // INFORMACIÓN DE COCODES
    Route::get('/informacion', [InformacionController::class, 'index'])->name('informacion.index');
    // RUTAS EXCLUSIVAS PARA ADMINISTRADORES
    Route::middleware('can:administrar-sistema')->group(function () {
        // REPORTES CENSALES
        Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
        // EXPORTAR REPORTE A PDF
        Route::get('/reportes/exportar/pdf', [ReporteController::class, 'exportarPdf'])->name('reportes.exportar.pdf');
        // EXPORTAR REPORTE A EXCEL
        Route::get('/reportes/exportar/excel', [ReporteController::class, 'exportarExcel'])->name('reportes.exportar.excel');
        // VER DETALLES DE UN CENSO
        Route::get('/reportes/{id}', [ReporteController::class, 'show'])->whereNumber('id')->name('reportes.show');
        // VER FOTOGRAFÍAS DEL DPI
        Route::get('/reportes/{id}/dpi', [DpiController::class, 'index'])->whereNumber('id')->name('reportes.dpi');
        // DESCARGAR DPI DEL ESPOSO O ESPOSA EN PDF
Route::get('/reportes/{id}/dpi/descargar/{persona}', [DpiPdfController::class, 'descargar'])
    ->whereNumber('id')
    ->where('persona', 'esposo|esposa')
    ->name('reportes.dpi.descargar');
        // MOSTRAR IMAGEN DEL DPI DESDE ALMACENAMIENTO PRIVADO
        Route::get('/reportes/{id}/dpi/{campo}', [DpiController::class, 'imagen'])
            ->whereNumber('id')
            ->where('campo', 'dpi_frente_esposo|dpi_reverso_esposo|dpi_frente_esposa|dpi_reverso_esposa')
            ->name('reportes.dpi.imagen');
        // EDITAR REGISTRO CENSAL
        Route::get('/censos/{id}/editar', [CensoController::class, 'edit'])->whereNumber('id')->name('censos.edit');
        // GUARDAR CAMBIOS DEL REGISTRO CENSAL
        Route::put('/censos/{id}', [CensoController::class, 'update'])->whereNumber('id')->name('censos.update');
        // ELIMINAR REGISTRO CENSAL
        Route::delete('/reportes/{id}', [ReporteController::class, 'destroy'])->whereNumber('id')->name('reportes.destroy');
        // ADMINISTRACIÓN DE USUARIOS
        Route::get('/administracion', [AdministracionController::class, 'index'])->name('administracion.index');
        Route::post('/administracion', [AdministracionController::class, 'store'])->name('administracion.store');
        Route::put('/administracion/{usuario}', [AdministracionController::class, 'update'])->name('administracion.update');
        Route::patch('/administracion/{usuario}/estado', [AdministracionController::class, 'cambiarEstado'])->name('administracion.estado');
        Route::delete('/administracion/{usuario}', [AdministracionController::class, 'destroy'])->name('administracion.destroy');
    });
    // CERRAR SESIÓN
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
