<?php

namespace Model;

class Materia extends ActiveRecord{
    public static $tabla = 'materias';
    public static $columnasDB = ['ma_nombre','detalle_situacion'];
    public static $idTabla = 'id_materias';

    public $id_materias;
    public $ma_nombre;
    public $detalle_situacion;

    public function __construct($args =[])
    {
        $this->id_materias = $args['id_materias'] ?? null;
        $this->ma_nombre = $args['ma_nombre'] ?? '';
        $this->detalle_situacion = $args['detalle_situacion'] ?? '1';
    }

}