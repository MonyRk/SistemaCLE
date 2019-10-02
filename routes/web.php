<?php
use App\Http\Controllers\AlumnosController;
use App\Inscripcion;
use Carbon\Traits\Rounding;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboardCoordinador');
})->name('inicio');
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
Route::get('/grupos/{grupo}','GruposController@show')->name('verInfoGrupo');
Route::get('/agregarGrupo', 'GruposController@create')->name('crearGrupo');
Route::post('/guardarGrupo', 'GruposController@store')->name('agregarGrupo');
Route::delete('/grupos/{grupo}','GruposController@destroy')->name('eliminarGrupo');
Route::get('/grupos/{grupo}/editar','GruposController@edit')->name('editarGrupo');
Route::post('/grupos/guardarGrupo/{grupo}','GruposController@update')->name('guardarGrupo');
Route::get('/aulas', 'GruposController@getaulas');
Route::any('/search/grupo', 'GruposController@search')->name('buscarGrupo');

Route::get('/pagos','InscripcionesController@indexPago')->name('indexpagos');
Route::post('/agregarPago', 'InscripcionesController@agregarPago')->name('agregarPago');
Route::get('/verificarpagos', function(){return view('pagos.verificarpagos');})->name('verificarPagos');
Route::get('/verificar', 'InscripcionesController@buscarPago')->name('buscarPago');
Route::post('/guardarVerificados', 'InscripcionesController@guardarVerificados')->name('guardarVerificados');

Route::get('/catalogos', function () {return view('catalogos.cardscatalogos');})->name('catalogos');
Route::get('/catalogos/niveles','NivelController@index')->name('verNiveles');
Route::get('/catalogos/niveles/crearNivel','NivelController@create')->name('crearNivel');
Route::post('/catalogos/niveles/agregarNivel', 'NivelController@store')->name('agregarNivel');
Route::delete('/catalogos/niveles/{nivel}','NivelController@destroy')->name('eliminarNivel');

Route::get('/catalogos/aulas','AulaController@index')->name('verAulas');
Route::post('/catalogos/aulas/agregarAula', 'AulaController@store')->name('agregarAula');
Route::get('/catalogos/aulas/{aula}/editar', 'AulaController@edit')->name('editarAula');
Route::put('/catalogos/aulas/{aula}','AulaController@update')->name('actualizarAula');
Route::delete('/catalogos/aulas/{aula}','AulaController@destroy')->name('eliminarAula');

Route::get('/catalogos/periodos','PeriodoController@index')->name('periodos');
Route::post('/catalogos/periodos/agregarPeriodo','PeriodoController@store')->name('agregarPeriodo');

Route::get('/periodoinscripciones','InscripcionesController@index')->name('periodoinscripciones');
Route::get('/inscripciones','InscripcionesController@show')->name('inscripciones');
Route::get('/inscripciones/grupo/{grupo}','InscripcionesController@create')->name('inscribirEstudiantes');
Route::post('/inscripciones/grupo','InscripcionesController@store')->name('guardarLista');
Route::any('/search/grupos', 'InscripcionesController@search')->name('buscarGrupoInscripcion');
Route::any('/search/estudiantes', 'InscripcionesController@searchE')->name('buscarAlumnoInscribir');

Route::get('/boleta','BoletaController@index')->name('boletas');
Route::get('/boletaGrupo/{grupo}','BoletaController@show')->name('verBoleta');
Route::post('/boletaGrupo/calificar','BoletaController@update')->name('guardarCalificaciones');
Route::get('/boletaGrupo', 'BoletaController@getGrupos');
Route::post('unaprueba', 'BoletaController@pruebaDatos')->name('prueba');

Route::get('/cursos','InscripcionesController@getCursos')->name('cursos');
Route::get('/cursos/avance','InscripcionesController@avance')->name('avance');

Route::get('/catalogos/respuestas','RespuestaController@index')->name('respuestas');
Route::post('/catalogos/respuestas/agregar','RespuestaController@store')->name('agregarRespuesta');
Route::get('/catalogos/respuestas/editar/{respuesta}','RespuestaController@edit')->name('editarRespuesta');
Route::patch('/catalogos/respuestas/{respuesta}','RespuestaController@update')->name('guardarRespuesta');
Route::delete('/catalogos/respuestas/eliminar/{respuesta}','RespuestaController@destroy')->name('eliminarRespuesta');

Route::post('/catalogos/respuestas/grupo_respuestas/agregar','GrupoRespuestaController@store')->name('agregargrupoR');

Route::post('/pregunta/agregar','PreguntaController@store')->name('agregarPregunta');
Route::patch('pregunta/guardar/{pregunta}','PreguntaController@update')->name('guardarPregunta');
Route::delete('/pregunta/eliminar/{pregunta}','PreguntaController@destroy')->name('eliminarPregunta');

Route::get('/evaluacionDocente','EvaluacionDocenteController@index')->name('evaluacion');

Route::get('/inscripciones/lista/{grupo}','InscripcionesController@getLista')->name('descargarLista');

Route::get('/reportes',function () {return view('reportes.cardsreportes');})->name('reportes');
Route::get('/reportes/datosEstadisticos','ReportesController@index')->name('estadisticas');

