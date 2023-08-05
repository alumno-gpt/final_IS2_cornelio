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
    // public static function buscarAPI(){
    //     // $alumnos = Alumno::all();
    //     $alu_nombre = $_GET['alu_nombre'];
    //     $alu_apellido = $_GET['alu_apellido'];
    //     $alu_grado = $_GET['alu_grado'];
    //     $alu_arma = $_GET['alu_arma'];
    //     $alu_nac = $_GET['alu_nac'];

    //     $sql = "SELECT * FROM alumnos where detalle_situacion = 1 ";
    //     if($alu_nombre != '') {
    //         $sql.= " and alu_nombre like '%$alu_nombre%' ";
    //     }
    //     if($alu_apellido != '') {
    //         $sql.= " and alu_apellido = $alu_apellido ";
    //     }
    //     if($alu_grado != '') {
    //         $sql.= " and alu_grado = $alu_grado ";
    //     }
    //     if($alu_arma != '') {
    //         $sql.= " and alu_arma = $alu_arma ";
    //     }
    //     if($alu_nac != '') {
    //         $sql.= " and alu_nac = $alu_nac ";
    //     }

    //     try {
            
    //         $alumnos = Alumno::fetchArray($sql);
    
    //         echo json_encode($alumnos);
    //     } catch (Exception $e) {
    //         echo json_encode([
    //             'detalle' => $e->getMessage(),
    //             'mensaje' => 'Ocurrió un error',
    //             'codigo' => 0
    //         ]);
    //     }
    // }



     public static function buscarAPI(){
        // $alumnos = Alumno::all();
      
        try {
            
            $sql= "SELECT * FROM alumnos where detalle_situacion = 1";
            $alumnos = Alumno::fetchArray($sql);
    
            echo json_encode($alumnos);
            
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }




   
}