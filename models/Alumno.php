<?php

namespace Model;

class Alumno extends ActiveRecord{
    public static $tabla = 'alumnos';
    public static $columnasDB = ['alu_nombre','alu_apellido','alu_grado','alu_arma','alu_nac','detalle_situacion'];
    public static $idTabla = 'id_alumnos';

    public $id_alumnos;
    public $alu_nombre;
    public $alu_apellido;
    public $alu_grado;
    public $alu_arma;
    public $alu_nac;
    public $detalle_situacion;

    public function __construct($args =[])
    {
        $this->id_alumnos = $args['id_alumnos'] ?? null;
        $this->alu_nombre = $args['alu_nombre'] ?? '';
        $this->alu_apellido = $args['alu_apellido'] ?? '';
        $this->alu_grado = $args['alu_grado'] ?? '';
        $this->alu_arma = $args['alu_arma'] ?? '';
        $this->alu_nac = $args['alu_nac'] ?? '';
        $this->detalle_situacion = $args['detalle_situacion'] ?? '1';
    }

}