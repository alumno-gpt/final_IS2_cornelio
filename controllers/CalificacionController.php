<?php

namespace Controllers;

use Exception;
use Model\Calificacion;
use MVC\Router;


class CalificacionController{
    public static function index(Router $router)
    { 
       $alumnos = static::buscarAlumnos();
       $materias = static::buscarMaterias();

        $router->render('calificaciones/index', [
            'alumnos' => $alumnos,
            'materias' => $materias,
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

    public static function buscarTodos(){
        try{
            $calificaciones = new Calificacion($_GET);
            $resultados = $calificaciones->general();

            echo json_encode($resultados);
            
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
            $calificacion = new Calificacion($_POST);
            $calificacion->detalle_situacion = 0;
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
    public static function buscarAlumnos(){
        $sql= "SELECT * FROM alumnos where detalle_situacion = 1";
    
       try {
           
      $alumnos = Calificacion::fetchArray($sql);
           if ($alumnos){
            return $alumnos;

           }else{
            return 0;
           }

       } catch (Exception $e) {

       }
   }
    public static function buscarMaterias(){
        $sql= "SELECT * FROM materias where detalle_situacion = 1";
    
       try {
           
      $materias = Calificacion::fetchArray($sql);
           if ($materias){
            return $materias;

           }else{
            return 0;
           }

       } catch (Exception $e) {

       }
   }


}

