<?php

namespace Model;

class Asingacalificacion extends ActiveRecord{
    public static $tabla = 'relacion_mat_alum';
    public static $columnasDB = ['ma_alumno','ma_materia'];
    public static $idTabla = 'id_mat_alum';
    public $id_mat_alum;
    public $ma_alumno;
    public $ma_materia;

    public function __construct($args = [] ){
        $this->id_mat_alum = $args['id_mat_alum'] ?? null;
        $this->ma_alumno = $args['ma_alumno'] ?? '';
        $this->ma_materia = $args['ma_materia'] ?? '';
    }
}
?>