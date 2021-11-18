<?php

use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClaseController;
use App\Http\Controllers\ColegioController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

App::setLocale("es");

/*Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');*/

//Route::get('/home', [GrupoController::class, 'contarAllGrupo'])->name('home');

//Route::get('/prueba', [AsistenciaController::class, 'index'])->name('prueba');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', [LoginController::class, 'index'])->name('Login');

Route::resource('grupo', GrupoController::class);

Route::resource('estudiante', EstudianteController::class);

Route::get('EstudiantesPorGrupo/{id}/Listar', [GrupoController::class, 'viewCantEstuGrupo'])->name('grupo.estudiante');

Route::resource('colegio', ColegioController::class);

Route::resource('subject', SubjectController::class);

Route::resource('docente', DocenteController::class); 

Route::post('/clase/actualizar', [ClaseController::class, 'updatexx'])->name('clasex.update');

Route::post('/clase/eliminar', [ClaseController::class, 'destroy'])->name('clasex.destroy');

Route::resource('clase', ClaseController::class);

Route::get('/departamentos/{id}/municipios', [GrupoController::class, 'byMunicipios'])->name('grupo.municipios');

Route::resource('User', UserController::class)->except('show');

Route::get('user/profile',  [UserController::class, 'profile'])->name('user.profile');

Route::resource('roles', RoleController::class);

Route::resource('asistencia', AsistenciaController::class);
   
//Route::get('Asistencia/{ClaseAsistencia}/Tomar', [AsistenciaController::class, 'TomarAsistencia'])->name('asistencia.estudiante');

//Route::get('Asistencia/{id}/Tomar', [AsistenciaController::class, 'TomarAsistencia'])->name('asistencia.estudiante');

//Route::get('AsitenciaTomada', [AsistenciaController::class, 'UpdateStatusNoti'])->name('UpdateStatusNoti');

Route::get('Asistencias/estudiante/{estudiante_id}', [AsistenciaController::class, 'Asistencias_Estudiante']);

Route::get('Asistencia/Tomar/{grupo_id}/{clase_id}', [AsistenciaController::class, 'TomarAsistencia']);

Route::post('/evidencia', [AsistenciaController::class, 'subirArchivo'])->name('asistencia.evidencia');

Route::get('Ver/evidencia/{grupo_id}/{clase_id}', [AsistenciaController::class, 'MostrarEvidencia'])->name('evidencia.mostrar');

Route::get('EstudiantesGeam/{id}/pdf', [GrupoController::class, 'generarPdf'])->name('g.pdf');

Route::get('editar_una_evidencia/{Evidencia}', [AsistenciaController::class, 'editarEvidencia'])->name('evidencia.editar');

Route::delete('evidencia_elimnar/{Evidencia}', [AsistenciaController::class, 'eliminarEvidencia'])->name('evidencia.eliminar');

//php artisan storage:linkp 
// la siguiente ruta es para crear un acceso directo a la carpeta storage para acceder a la carpera storage donde esstan guardadas las evidencias

Route::get('storage-link', function(){
Artisan::call('storage:link');


});