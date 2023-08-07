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

    public function buscarInfo()
    {
        $sql = "SELECT id_calificaciones, calif_resultado, calif_punteo, 
        alu_nombre ||' '|| alu_apellido as calif_alumno, 
        ma_nombre AS calif_materia
        FROM calificaciones INNER JOIN materias ON calif_materia = id_materias 
        INNER JOIN alumnos ON calif_alumno = id_alumnos
        WHERE calificaciones.detalle_situacion = 1 ";

        if($this->calif_alumno != '') {
            $sql.= " and calif_alumno = '$this->calif_alumno' ";
        }
        if($this->calif_materia != '') {
            $sql.= " and calif_materia = '$this->calif_materia' ";
        }
 
        return self::fetchArray($sql);
    }

    public function eliminarCalificacion() {
        $query = "UPDATE "  . static::$tabla . " SET detalle_situacion = 0 WHERE id_calificaciones = " . self::$db->quote($this->id_calificaciones);
        $resultado = self::$db->exec($query);
        return [
            'resultado' => $resultado,
        ];
    }
}
