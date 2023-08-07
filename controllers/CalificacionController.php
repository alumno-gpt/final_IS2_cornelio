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

   public function buscarReporte(){
       $sql = "SELECT materias.ma_nombre as calif_materia, calificaciones.calif_punteo as calif_punteo, calificaciones.calif_resultado as calif_resultado  
       FROM calificaciones INNER JOIN materias ON materias.id_materias = calificaciones.calif_materia 
       WHERE calificaciones.detalle_situacion = '1'";
   
       if($this->calif_alumno != ''){
           $sql .= " AND calificaciones.calif_alumno = $this->calif_alumno";
       }
   
       $resultado = self::servir($sql);
       return $resultado;
   }
   private function promedio(){
       $sql = "SELECT AVG(calif_punteo) as promedio FROM calificaciones WHERE calif_alumno = $this->calif_alumno AND detalle_situacion = '1'";
       
       $resultado = self::servir($sql);
       return $resultado;
   }

}

