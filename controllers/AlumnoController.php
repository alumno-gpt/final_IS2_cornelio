<?php

namespace Controllers;

use Exception;
use Model\Alumno;
use MVC\Router;

class AlumnoController{
    public static function index(Router $router){
        $alumnos = Alumno::all();
        $router->render('alumnos/index', [
            'alumnos' => $alumnos,
      ]);

    }

    public static function guardarAPI(){
        try {
            $alumno = new Alumno($_POST);
            $resultado = $alumno->crear();

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


    // public function buscar()
    // {
    //     $sql = "SELECT * FROM alumnos where detalle_situacion = 1 ";
    //     if($this->alu_nombre != '') {
    //         $sql.= " and alu_nombre like '%$this->alu_nombre%' ";
    //     }
    //     if($this->alu_apellido != '') {
    //         $sql.= " and alu_apellido like  '%$this->alu_apellido%' ";
    //     }
    //     if($this->alu_grado != '') {
    //         $sql.= " and alu_grado like '%$this->alu_grado%' ";
    //     }
    //     if($this->alu_arma != '') {
    //         $sql.= " and alu_arma like '%$this->alu_arma%' ";
    //     }
    //     if($this->alu_nac != '') {
    //         $sql.= " and alu_nac like '%$this->alu_nac%' ";
    //     }

                
    //     return self::fetchArray($sql);


    // }
    public static function buscarAPI(){ 
             
        try {

            $alumnos = new Alumno($_GET);
            $resultado = $alumnos->buscar();   
            echo json_encode($resultado);
           

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
            $alumno = new Alumno($_POST);
            $resultado = $alumno->actualizar();

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
            $id_alumnos = $_POST['id_alumnos'];
            $alumno = Alumno::find($id_alumnos);
            $alumno-> detalle_situacion= 0;
            $resultado = $alumno->actualizar();

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
}