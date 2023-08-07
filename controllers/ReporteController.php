<?php

namespace Controllers;

use Exception;
use Model\Calificacion;
use Model\Alumno;
use Model\Materia;
// use Model\Reporte;
use MVC\Router;



class ReporteController{

    public static function index(Router $router){
        // $reportes = Reporte::all();
        $alumnos = static::buscarAlumnos();
        $router->render('reportes/index', [
            'alumnos' => $alumnos,
            // 'reportes' => $reportes,
      ]);

    }

    
    public function buscar2(){
        $sql = "SELECT materias.ma_nombre as calif_materia, calificaciones.calif_punteo as calif_punteo, calificaciones.calif_resultado as calif_resultado  
        FROM calificaciones INNER JOIN materias ON materias.id_materias = calificaciones.calif_materia 
        WHERE calificaciones.detalle_situacion = '1'";

        if($this->calif_alumno != ''){
            $sql .= " AND calificaciones.calif_alumno = $this->calif_alumno";
        }

        $resultado = self::servir($sql);
        return $resultado;
    }
    public function promedio(){
        $sql = "SELECT AVG(calif_punteo) as promedio FROM calificaciones WHERE calif_alumno = $this->calif_alumno AND detalle_situacion = '1'";
        
        $resultado = self::servir($sql);
        return $resultado;
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

