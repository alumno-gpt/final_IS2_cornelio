<?php 
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AppController;
use Controllers\AlumnoController;
use Controllers\CalificacionController;
use Controllers\MateriaController;
use Controllers\ReporteController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);
$router->get('/alumnos', [AlumnoController::class,'index'] );
$router->post('/API/alumnos/guardar', [AlumnoController::class,'guardarAPI'] );
$router->get('/API/alumnos/buscar', [AlumnoController::class,'buscarAPI'] );
$router->post('/API/alumnos/modificar', [AlumnoController::class,'modificarAPI'] );
$router->post('/API/alumnos/eliminar', [AlumnoController::class,'eliminarAPI'] );

$router->get('/calificaciones', [CalificacionController::class,'index'] );
$router->post('/API/calificaciones/guardar', [CalificacionController::class,'guardarAPI'] ); 
$router->get('/API/calificaciones/buscar', [CalificacionController::class,'buscarAPI'] );
$router->post('/API/calificaciones/modificar', [CalificacionController::class,'modificarAPI'] );
$router->post('/API/calificaciones/eliminar', [CalificacionController::class,'eliminarAPI'] );

$router->get('/materias', [MateriaController::class,'index'] );
$router->post('/API/materias/guardar', [MateriaController::class,'guardarAPI'] );
$router->get('/API/materias/buscar', [MateriaController::class,'buscarAPI'] );
$router->post('/API/materias/modificar', [MateriaController::class,'modificarAPI'] );
$router->post('/API/materias/eliminar', [MateriaController::class,'eliminarAPI'] );

$router->get('/reportes', [ReporteController::class,'index'] );
//$router->post('/API/reportes/buscar', [ReporteController::class,'buscarReporte'] );


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();