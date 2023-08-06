<?php

namespace Model;

class Calificacion extends ActiveRecord{
    public static $tabla = 'calificaciones';
    public static $columnasDB = ['calif_alumno','calif_materia','calif_punteo','calif_resultado','detalle_situacion'];
    public static $idTabla = 'id_calificaciones';

    public $id_calificaciones;
    public $calif_alumno;
    public $calif_materia;
    public $calif_punteo;
    public $calif_resultado;
    public $detalle_situacion;

    public function __construct($args = [] )
    {
        $this->id_calificaciones = $args['id_calificaciones'] ?? null;
        $this->calif_alumno = $args['calif_alumno'] ?? '';
        $this->calif_materia = $args['calif_materia'] ?? '';
        $this->calif_punteo = $args['calif_punteo'] ?? '';
        $this->calif_resultado = $args['calif_resultado'] ?? '';
        $this->detalle_situacion = $args['detalle_situacion'] ?? '1';
    }

    public function general(){
        $sql = "select id_calificaciones as id_calificaciones, 
        calif_resultado as calif_resultado, 
        calif_punteo as calif_punteo,
        ma_nombre as calif_materia
        from calificaciones INNER JOIN materias ON calif_materia = id_materias 
        WHERE calificaciones.detalle_situacion = 1";

        return self::consultarSQL($sql);

    }

}
