<?php

namespace Controllers;

use Exception;
use Model\Calificacion;
use MVC\Router;

class CalificacionController{
    public static function index(Router $router){
        $calificaciones = Calificacion::all();
        $router->render('calificaciones/index', [
            'calificaciones' => $calificaciones,
      ]);

    }

    public static function guardarAPI(){
        try {
            $calificacion = new Calificacion($_POST);
            $resultado = $calificacion->crear();

            if($resultado['resultado'] == 1){
                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente',
                    'codigo' => 1
                ]);
            }else{
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
            // echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function modificarAPI(){
        try {
            $calificacion = new Calificacion($_POST);
            $resultado = $calificacion->actualizar();

            if($resultado['resultado'] == 1){
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
                    'codigo' => 1
                ]);
            }else{
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
            // echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function eliminarAPI(){
        try {
            $id_calificaciones = $_POST['id_calificaciones'];
            $calificacion = Calificacion::find($id_calificaciones);
            $calificacion-> detalle_situacion= 0;
            $resultado = $calificacion->actualizar();

            if($resultado['resultado'] == 1){
                echo json_encode([
                    'mensaje' => 'Registro eliminado correctamente',
                    'codigo' => 1
                ]);
            }else{
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
            // echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function buscarAPI(){
        $calif_alumno = $_GET['calif_alumno'];

        $sql = "SELECT * FROM calificaciones where detalle_situacion = 1 ";
        if($calif_alumno != '') {
            $sql.= " and calif_alumno like '%$calif_alumno%' ";
        }
        try {
            
            $calificaciones = Calificacion::fetchArray($sql);
    
            echo json_encode($calificaciones);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}