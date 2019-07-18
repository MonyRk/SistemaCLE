<?php
use App\Http\Controllers\AlumnosController;
use Carbon\Traits\Rounding;
//use Illuminate\Routing\Route;
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

Route::get('/', function () {
    return view('dashboardCoordinador');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::get('/estudiantes', 'AlumnosController@index')->name('verEstudiantes');
Route::get('estudiantes/{estudiante}','AlumnosController@show')->name('verInfoEstudiante');
Route::get('/nuevoEstudiante', 'AlumnosController@create')->name('agregarEstudiante');
Route::post('/guardarEstudiante', 'AlumnosController@store')->name('guardarDatosEstudiante');
Route::get('/estudiantes/{alumno}/editar', 'AlumnosController@edit')->name('editarEstudiante');
Route::put('/estudiantes/{alumno}', 'AlumnosController@update')->name('actualizarEstudiante');
Route::delete('/estudiantes/{estudiante}','AlumnosController@destroy')->name('eliminarEstudiante');
Route::any('/search/estudiante', 'AlumnosController@search')->name('buscarEstudiante');

Route::get('/docentes', 'DocentesController@index')->name('verDocentes');
Route::get('docentes/{docente}','DocentesController@show')->name('verInfoDocente');
Route::get('/agregarDocente', 'DocentesController@create')->name('agregarDocente');
Route::post('/guardarDocente', 'DocentesController@store');
Route::get('/docentes/{docente}/editar','DocentesController@edit')->name('editarDocente');
Route::put('/docentes/{docente}', 'DocentesController@update')->name('actualizarDocente');
Route::delete('/docentes/{docente}','DocentesController@destroy')->name('eliminarDocente');
Route::any('/search/docente', 'DocentesController@search')->name('buscarDocente');

Route::get('/grupos', 'GruposController@index')->name('verGrupos');
Route::get('/agregarGrupo', 'GruposController@create')->name('crearGrupo');
Route::post('/guardarGrupo', 'GruposController@store')->name('agregarGrupo');
Route::get('/grupos/{grupo}/eliminar','GruposController@destroy');
Route::get('/aulas', 'GruposController@getaulas');

Route::get('/catalogos', function () {
	return view('catalogos.cardscatalogos');
 })->name('catalogos');

Route::get('/catalogos/niveles','NivelController@index')->name('verNiveles');
Route::get('/catalogos/niveles/crearNivel','NivelController@create')->name('crearNivel');
Route::post('/catalogos/niveles/agregarNivel', 'NivelController@store')->name('agregarNivel');
Route::get ('/catalogos/niveles/{nivel}/eliminar','NivelController@destroy')->name('eliminarNivel');

Route::get('/catalogos/aulas','AulaController@index')->name('verAulas');
// Route::get('/catalogos/aulas/crearAula', 'AulaController@create')->name('crearAula');
Route::post('/catalogos/aulas/agregarAula', 'AulaController@store')->name('agregarAula');
Route::get('/catalogos/aulas/{aula}/editar', 'AulaController@edit')->name('editarAula');
Route::put('/catalogos/aulas/{aula}', 'AulaController@update')->name('actualizarAlumno');
Route::get ('/catalogos/aulas/{aula}/eliminar','AulaController@destroy')->name('eliminarAula');
