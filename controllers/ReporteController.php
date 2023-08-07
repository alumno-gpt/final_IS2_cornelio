<?php

namespace Controllers;

use Exception;
use Model\Calificacion;
use Model\Alumno;
use Model\Materia;
use Model\Reporte;
use MVC\Router;



class ReporteController{

    public static function index(Router $router){
        // $reportes = Reporte::all();
        $alumnos = static::buscarAlumnos();
        $router->render('reportes/index', [
            'alumnos' => $alumnos,
      ]);

    }
 

    public static function genReporte()
    {
        try {

            $reporte = new Reporte($_GET);
            $resultado = $reporte->genReporte();

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
}

