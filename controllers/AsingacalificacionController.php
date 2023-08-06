<?php

namespace Controllers;

use Exception;
use Model\Asingacalificacion;
use MVC\Router;

class AsignacalificacionController{
    public static function index(Router $router){ $calificaciones = Asingacalificacion::all();
       $alumnos = static::buscarAlumnos();
       $materias = static::buscarMaterias();

        $router->render('calificaciones/index', [
            'alumnos' => $alumnos,
            'materias' => $materias,
      ]);

    }



    public function guardar(){
        $sql = "INSERT INTO relacion_mat_alum(ma_alumno, ma_materia) VALUES ($this->ma_alumno, $this->ma_materia)";
        $resultado = self::ejecutar($sql);
        return $resultado;
    }
    
    public function buscar(){
        $sql = "SELECT * FROM relacion_mat_alum WHERE 1=1";
    
        if($this->id_mat_alum != null){
            $sql .= " AND id_mat_alum = $this->id_mat_alum";
        }
    
        if($this->ma_alumno != ''){
            $sql .= " AND ma_alumno = $this->ma_alumno";
        }
    
        if($this->ma_materia != ''){
            $sql .= " AND ma_materia = $this->ma_materia";
        }
    
        $resultado = self::servir($sql);
        return $resultado;
    }






    public static function guardarAPI(){
        try {
            $calificacion = new Asingacalificacion($_POST);
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
            $calificacion = new Asingacalificacion($_POST);
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
            $calificacion = Asingacalificacion::find($id_calificaciones);
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
            
            $calificaciones = Asingacalificacion::fetchArray($sql);
    
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
           
      $alumnos = Asingacalificacion::fetchArray($sql);
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
           
      $materias = Asingacalificacion::fetchArray($sql);
           if ($materias){
            return $materias;

           }else{
            return 0;
           }

       } catch (Exception $e) {

       }
   }


}
