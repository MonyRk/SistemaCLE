<?php
use App\Http\Controllers\AlumnosController;
use App\Inscripcion;
use Carbon\Traits\Rounding;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/accesoDenegado', function(){return view('accesoDenegado');})->name('sinAcceso');

// Route::group(['middleware' => 'guest'], function () {
Route::get('/nuevoEstudiante', 'AlumnosController@create')->name('agregarEstudiante');
Route::post('/guardarEstudiante', 'AlumnosController@store')->name('guardarDatosEstudiante');
// });

Route::group(['middleware' => 'auth'], function () {
	//rutas compartidas en general
	Route::get('/', 'HomeController@index')->name('inicio');
	Route::get('/home', 'HomeController@index')->name('home');
	
	Route::get('/boleta','BoletaController@index')->name('boletas');
	Route::get('/boletaGrupo/{grupo}','BoletaController@show')->name('verBoleta');
	Route::post('/boletaGrupo/calificar','BoletaController@update')->name('guardarCalificaciones');
	Route::get('/boletaGrupo', 'BoletaController@getGrupos');
	Route::get('/boletaGrupos', 'BoletaController@getGruposDocente');
	Route::get('/boleta/actaCalificaciones/{grupo}','BoletaController@generarActa')->name('actaCalificaciones');
	Route::get('/boleta/descargar/{grupo}/{alumno}', 'BoletaController@descargarBoleta')->name('boletaIndividual');

	
	//rutas compartidas para ESTUDIANTES Y COORDINADOR
	Route::get('/inscripciones/estudiante/','InscripcionesController@periodoAlumno')->name('periodoAlumno');
	Route::get('/inscripciones/estudiante/{alumno}', 'InscripcionesController@inscripcionAlumno')->name('inscribirAlumno');
	Route::post('/inscripciones/estudiante/agregar', 'InscripcionesController@agregarAlumno')->name('inscribirEnGrupo');

	Route::get('/estudiantes/{alumno}/editar', 'AlumnosController@edit')->name('editarEstudiante');
	Route::put('/estudiantes/{alumno}', 'AlumnosController@update')->name('actualizarEstudiante');

	Route::get('/cursos/avance','InscripcionesController@avance')->name('avance');

	Route::get('/periodoinscripciones','InscripcionesController@index')->name('periodoinscripciones');
		
	Route::get('/evaluacionDocente','EvaluacionDocenteController@show')->name('evaluacion');
	Route::post('/evaluacionDocente', 'EvaluacionDocenteController@store')->name('guardarEvaluacion');

	Route::get('/pagos','InscripcionesController@indexPago')->name('indexpagos');
	Route::post('/agregarPago', 'InscripcionesController@agregarPago')->name('agregarPago');
	Route::get('/verificar', 'InscripcionesController@buscarPago')->name('buscarPago');


	// DOCENTE Y COORDINADOR
	Route::get('/docentes/{docente}/editar','DocentesController@edit')->name('editarDocente');
	Route::put('/docentes/{docente}', 'DocentesController@update')->name('actualizarDocente');

	Route::get('/inscripciones','InscripcionesController@show')->name('inscripciones');
	Route::get('/inscripciones/lista/{grupo}','InscripcionesController@getLista')->name('descargarLista');

	Route::get('/evaluacionDocente/descargarResultados','EvaluacionDocenteController@descargarResultados')->name('descargarResultados');

	Route::get('/evaluacionDocente/periodo', 'EvaluacionDocenteController@periodoResultados')->name('periodoResultados');
	Route::get('/evaluacionDocente/resultados', 'EvaluacionDocenteController@resultados')->name('verResultados');

	});
	
Route::group(['middleware' => ['usuarioEscolares']], function () {
	Route::get('/agregarUsuario', function () {return view('users.create');})->name('agregarCoordinador');
	Route::post('/guardarUsuario', 'UserController@store')->name('guardarUsuario');
	Route::get('/verUsuarios','UserController@show')->name('verUsuarios');
	Route::get('/editarUsuario/{user}', 'UserController@edit')->name('editarUsuario');
	Route::put('/actualizarUsuario', 'UserController@update')->name('actualizarUsuario');
});

Route::group(['middleware' => ['usuarioEstudiante']], function () {
	// Route::get('/inscripciones/estudiante/','InscripcionesController@periodoAlumno')->name('periodoAlumno');
	// Route::get('/inscripciones/estudiante/{alumno}', 'InscripcionesController@inscripcionAlumno')->name('inscribirAlumno');
	// Route::post('/inscripciones/estudiante/agregar', 'InscripcionesController@agregarAlumno')->name('inscribirEnGrupo');

	// // Route::get('/pagos/{alumno}',function(){return view('pagos.indexpagoEstudiantea');})->name('indexpagosEstudiantes');

	// Route::get('/cursos/avance','InscripcionesController@avance')->name('avance');

	// Route::get('/periodoinscripciones','InscripcionesController@index')->name('periodoinscripciones');
		
	// Route::get('/evaluacionDocente','EvaluacionDocenteController@show')->name('evaluacion');
	// Route::post('/evaluacionDocente', 'EvaluacionDocenteController@store')->name('guardarEvaluacion');

	// Route::get('/pagos','InscripcionesController@indexPago')->name('indexpagos');
	// Route::post('/agregarPago', 'InscripcionesController@agregarPago')->name('agregarPago');
	// Route::get('/verificar', 'InscripcionesController@buscarPago')->name('buscarPago');

});

Route::group(['middleware' => ['usuarioDocente']], function () {
	//rutas compartidas para DOCENTES Y COORDINADOR
	
});

Route::group(['middleware' => ['usuarioCoordinador']], function () {
	//rutas compartidas para ESTUDIANTES Y COORDINADOR
	// Route::get('/estudiantes/{alumno}/editar', 'AlumnosController@edit')->name('editarEstudiante');
	// Route::put('/estudiantes/{alumno}', 'AlumnosController@update')->name('actualizarEstudiante');


	//rutas compartidas para DOCENTES Y COORDINADOR
	// Route::get('/docentes/{docente}/editar','DocentesController@edit')->name('editarDocente');
	// Route::put('/docentes/{docente}', 'DocentesController@update')->name('actualizarDocente');

	// Route::get('/inscripciones','InscripcionesController@show')->name('inscripciones');
	// Route::get('/inscripciones/lista/{grupo}','InscripcionesController@getLista')->name('descargarLista');

	// Route::get('/evaluacionDocente/descargarResultados','EvaluacionDocenteController@descargarResultados')->name('descargarResultados');

	// Route::get('/evaluacionDocente/periodo', 'EvaluacionDocenteController@periodoResultados')->name('periodoResultados');
	// Route::get('/evaluacionDocente/resultados', 'EvaluacionDocenteController@resultados')->name('verResultados');

	//RUTAS DE COORDINADOR

	Route::get('/estudiantes', 'AlumnosController@index')->name('verEstudiantes');
	Route::get('estudiantes/{estudiante}','AlumnosController@show')->name('verInfoEstudiante');
	Route::delete('/estudiantes/{estudiante}','AlumnosController@destroy')->name('eliminarEstudiante');
	Route::any('/search/estudiante', 'AlumnosController@search')->name('buscarEstudiante');
	Route::get('/estudiantes/recuperar/deshabilitados','AlumnosController@recuperarEstudiantes')->name('recuperarEstudiantes');
	Route::get('/estudiantes/recuperar/{estudiante}','AlumnosController@recuperar')->name('recuperar');

	Route::get('/docentes', 'DocentesController@index')->name('verDocentes');
	Route::get('docentes/{docente}','DocentesController@show')->name('verInfoDocente');
	Route::get('/agregarDocente', 'DocentesController@create')->name('agregarDocente');
	Route::post('/guardarDocente', 'DocentesController@store');
	Route::delete('/docentes/{docente}','DocentesController@destroy')->name('eliminarDocente');
	Route::any('/search/docente', 'DocentesController@search')->name('buscarDocente');
	Route::get('/docente/titulo/{prefijo}/{titulo}', 'DocentesController@titulo')->name('verTitulo');
	Route::get('/docente/cedula/{prefijo}/{cedula}', 'DocentesController@cedula')->name('verCedula');
	Route::get('/docente/rfc/{prefijo}/{rfc}', 'DocentesController@rfc')->name('verRfc');
	Route::get('/docente/{prefijo}/certificaciones/{documento}', 'DocentesController@certificaciones')->name('verCertificaciones');

	Route::get('/evaluacionDocente/inicio', function(){return view('evaluacionDocente.inicioEvaluacion');})->name('inicioEvaluacion');

	Route::get('/indexGrupos', function () {return view('grupos.periodoGrupos');})->name('indexGrupos');
	Route::get('/grupos', 'GruposController@index')->name('verGrupos');
	Route::get('/grupos/{grupo}','GruposController@show')->name('verInfoGrupo');
	Route::get('/agregarGrupo', 'GruposController@create')->name('crearGrupo');
	Route::get('/agregarGrupos', 'GruposController@creat')->name('creaGrupo');
	Route::post('/guardarGrupo', 'GruposController@store')->name('agregarGrupo');
	Route::delete('/grupos/{grupo}','GruposController@destroy')->name('eliminarGrupo');
	Route::get('/grupos/{grupo}/editar','GruposController@edit')->name('editarGrupo');
	Route::post('/grupos/guardarGrupo/{grupo}','GruposController@update')->name('guardarGrupo');
	Route::get('/aulas', 'GruposController@getaulas');
	Route::any('/search/grupo', 'GruposController@search')->name('buscarGrupo');

	// Route::get('/pagos','InscripcionesController@indexPago')->name('indexpagos');
	// Route::post('/agregarPago', 'InscripcionesController@agregarPago')->name('agregarPago');
	Route::get('/verificarpagos', function(){return view('pagos.verificarpagos');})->name('verificarPagos');
	// Route::get('/verificar', 'InscripcionesController@buscarPago')->name('buscarPago');
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
	Route::post('/catalogos/periodos/actualizarPeriodo', 'PeriodoController@actualizar')->name('actualizarPeriodo');
	
	Route::post('/inscripciones/guardarFechas','InscripcionesController@fechas')->name('fechaInscripciones');
	Route::get('/inscripciones/grupo/{grupo}','InscripcionesController@create')->name('inscribirEstudiantes');
	Route::post('/inscripciones/grupo','InscripcionesController@store')->name('guardarLista');
	Route::any('/search/grupos', 'InscripcionesController@search')->name('buscarGrupoInscripcion');
	Route::any('/search/estudiantes', 'InscripcionesController@searchE')->name('buscarAlumnoInscribir');
	Route::get('/inscripciones/modificar/{grupo}','InscripcionesController@quitarEstudiante')->name('quitarEstudiante');
	Route::post('/inscripciones/modificar','InscripcionesController@modificar')->name('modificarLista');

	Route::get('/cursos',function () {return view('cursos.indexCursos');})->name('cursos');
	Route::get('/cursos/estudiante','InscripcionesController@getCursos')->name('buscarCurso');
	Route::get('/cursos/verificarExamen', 'InscripcionesController@mostrarExamenes')->name('mostrarExamen');
	Route::post('/cursos/guardarExamenesVerificados', 'InscripcionesController@verificarExamenes')->name('verificarExamenes');

	Route::get('/catalogos/clasificacion','ClasificacionesController@index')->name('clasificacion');
	Route::post('/catalogos/clasificacion/agregar','ClasificacionesController@store')->name('agregarClasificacion');
	// Route::get('/catalogos/clasificacion/editar/{clasificacion}','ClasificacionesController@edit')->name('editarClasificacion');
	Route::patch('/catalogos/clasificacion/{clasificacion}','ClasificacionesController@update')->name('guardarClasificacion');
	Route::delete('/catalogos/clasificacion/eliminar/{clasificacion}','clasificacionController@destroy')->name('eliminarClasificacion');

	Route::post('/catalogos/clasificacion/grupo_respuestas/agregar','GrupoRespuestaController@store')->name('agregargrupoR');

	Route::get('/catalogos/plantillaDocentes', 'DocentesController@plantilla')->name('plantillaDocentes');
	
	Route::post('/pregunta/agregar','PreguntaController@store')->name('agregarPregunta');
	Route::patch('pregunta/guardar/{pregunta}','PreguntaController@update')->name('guardarPregunta');
	Route::delete('/pregunta/eliminar/{pregunta}','PreguntaController@destroy')->name('eliminarPregunta');

	Route::get('/reportes',function () {return view('reportes.cardsreportes');})->name('reportes');
	Route::get('/reportes/datosEstadisticos','ReportesController@index')->name('indexestadisticas');
	Route::get('/reportes/datosEstadisticos/periodo','ReportesController@graficas')->name('estadisticas');
	Route::get('/reportes/datosEstadisticos/generar', 'ReportesController@generarEstadisticas')->name('descargarEstadisticas');

	Route::get('/reportes/liberaciones','ReportesController@liberaciones')->name('liberaciones');
	Route::get('/reportes/liberaciones/cle','ReportesController@liberacionCle')->name('generarLiberacionCle');
	Route::get('/reportes/liberaciones/certificacion','ReportesController@liberacionCertificacion')->name('generarLiberacionCertificacion');
	Route::get('/reportes/liberaciones/4habilidades','ReportesController@liberacion4')->name('generarLiberacion4');

	Route::get('/reportes/adendum', 'ReportesController@docenteAdendum')->name('adendum');
	Route::get('/reportes/adendum/generar', 'ReportesController@generarAdendum')->name('contratos');

Route::post('/reportes/pdf', function () {
	return view('pdf.estadisticaspdf',compact('nombre_carreras','periodo','data','carreras','generos','niveles','nombre_niveles','modulos','aprobados','reprobados','ingresos'));
})->name('pdfprueba');

	Route::get('/respaldo','ReportesController@backup')->name('respaldo');

	Route::post('/evaluacionDocente/guardarFechas','EvaluacionDocenteController@fechas')->name('fechasEvaluacion');
	Route::get('/evaluacionDocente/periodos', 'EvaluacionDocenteController@index')->name('periodoEvaluacion');

});
