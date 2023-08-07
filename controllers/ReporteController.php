<?php

namespace Controllers;

use Exception;
use Model\Reporte;
use MVC\Router;


class ReporteController{
    public static function index(Router $router)
    { 
       $alumnos = static::buscarAlumnos();
       $materias = static::buscarMaterias();

        $router->render('reportes/index', [
            'alumnos' => $alumnos,
            'materias' => $materias,
      ]);

    }   

    public static function buscarAlumnos(){
        $sql= "SELECT * FROM alumnos where detalle_situacion = 1";
       try {  
      $alumnos = Reporte::fetchArray($sql);
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
      $materias = Reporte::fetchArray($sql);
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
   
    //    if($this->calif_alumno != ''){
    //        $sql .= " AND calificaciones.calif_alumno = $this->calif_alumno";
    //    }
   
    //    $resultado = self::servir($sql);
    //    return $resultado;
}
//    private function promedio(){
//        $sql = "SELECT AVG(calif_punteo) as promedio FROM calificaciones WHERE calif_alumno = $this->calif_alumno AND detalle_situacion = '1'";
       
//        $resultado = self::fetchArray($sql);
//        return $resultado;
//    }

}

