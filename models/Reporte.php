<?php

namespace Model;


class Reporte extends ActiveRecord
{
    public $id_calificaciones;
    public $calif_alumno;
    public $calif_materia;
    public $calif_punteo;
    public $calif_resultado;
    public $detalle_situacion;

    public function __construct($args = [])
    {
        $this->id_calificaciones = $args['id_calificaciones'] ?? null;
        $this->calif_alumno = $args['calif_alumno'] ?? '';
        $this->calif_materia = $args['calif_materia'] ?? '';
        $this->calif_punteo = $args['calif_punteo'] ?? '';
        $this->calif_resultado = $args['calif_resultado'] ?? '';
        $this->detalle_situacion = $args['detalle_situacion'] ?? '1';
    }

    public function average()
    {
        $sql = "SELECT AVG(calif_punteo) as promedio FROM calificaciones WHERE calif_alumno = '$this->calif_alumno' AND detalle_situacion = '1'";

        return self::fetchArray($sql);
    }

    public function dataAlumno()
    {
        $sql = "SELECT * FROM alumnos WHERE id_alumnos = '$this->calif_alumno' AND detalle_situacion = '1'";

        return self::fetchArray($sql);
    }

    public function calificaciones()
    {
        $sql = "SELECT id_calificaciones, calif_resultado, calif_punteo, 
        alu_nombre ||' '|| alu_apellido as calif_alumno, 
        ma_nombre AS calif_materia
        FROM calificaciones INNER JOIN materias ON calif_materia = id_materias 
        INNER JOIN alumnos ON calif_alumno = id_alumnos
        WHERE calificaciones.detalle_situacion = 1 and calif_alumno = '$this->calif_alumno'";

        return self::fetchArray($sql);
    }

    public function genReporte()
    {
        $alumno = self::dataAlumno();

        $calificaciones = self::calificaciones();

        $promedio = self::average();

        $data['alumno'] = $alumno;
        $data['calificaciones'] = $calificaciones;
        $data['promedio'] = $promedio;

        return $data;

    }
}