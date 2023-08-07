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
    //    $calif_alumno= static::buscarInfo();

        $router->render('calificaciones/index', [
            'alumnos' => $alumnos,
            'materias' => $materias,
            // 'calif_alumno' => $calif_alumno,
      ]);

    }

    // public static function guardarAPI(){
    //     try {
    //         $calificacion = new Calificacion($_POST);
    //         $resultado = $calificacion->crear();

    //         if($resultado['resultado'] == 1){
    //             echo json_encode([
    //                 'mensaje' => 'Registro guardado correctamente', 
    //                 'codigo' => 1
    //             ]);
    //         }else{
    //             echo json_encode([
    //                 'mensaje' => 'Ocurrió un error',
    //                 'codigo' => 0
    //             ]);
    //         }
    //         // echo json_encode($resultado);
    //     } catch (Exception $e) {
    //         echo json_encode([
    //             'detalle' => $e->getMessage(),
    //             'mensaje' => 'Ocurrió un error',
    //             'codigo' => 0
    //         ]);
    //     }
    // }



    function nota_literal($nota){
        if($nota >= 70){
            return "Gano";
        }else{
            return "Perdio";
        }
    }
    function guardarAPI(){
        try {
            $calificacion = new Calificacion($_POST);
            $resultado = $calificacion->crear();
    
            if($resultado['resultado'] == 1){
                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente', 
                    'codigo' => 1,
                    'nota_literal' => nota_literal($calificacion->nota)
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

    // public function buscarInfo()
    // {
    //     $sql = "SELECT id_calificaciones, calif_resultado, calif_punteo, 
    //     alu_nombre ||' '|| alu_apellido as calif_alumno, 
    //     ma_nombre AS calif_materia
    //     FROM calificaciones INNER JOIN materias ON calif_materia = id_materias 
    //     INNER JOIN alumnos ON calif_alumno = id_alumnos
    //     WHERE calificaciones.detalle_situacion = 1 ";

    //     if($this->calif_alumno != '') {
    //         $sql.= " and calif_alumno = '$this->calif_alumno' ";
    //     }
    //     if($this->calif_materia != '') {
    //         $sql.= " and calif_materia = '$this->calif_materia' ";
    //     }
 
    //     return self::fetchArray($sql);
    // }

    
    
    //funcion para buscar en la API
    public static function buscarAPI(){ 

        $calificaciones = new Calificacion($_GET);

        try {
            
            $resultado = $calificaciones->buscarInfo();
    
            echo json_encode($resultado);

        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    
    //funcion para buscar el nombre del alumno
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
   
   //funcion para buscar el nombre de la materia
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

