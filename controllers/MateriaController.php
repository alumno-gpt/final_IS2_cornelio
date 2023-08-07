<?php

namespace Controllers;

use Exception;
use Model\Materia;
use MVC\Router;

class MateriaController
{
    public static function index(Router $router)
    {
        $materias = Materia::all();
        $router->render('materias/index', [
            'materias' => $materias,
        ]);

    }

    public static function guardarAPI()
    {
        try {
            $materia = new Materia($_POST);
            $resultado = $materia->crear();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente',
                    'codigo' => 1
                ]);
            } else {
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

    public static function modificarAPI()
    {
        try {
            $materia = new Materia($_POST);
            $resultado = $materia->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
                    'codigo' => 1
                ]);
            } else {
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

    public static function eliminarAPI()
    {
        try {
            $id_materias = $_POST['id_materias'];
            $materia = Materia::find($id_materias);
            $materia->detalle_situacion = 0;
            $resultado = $materia->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro eliminado correctamente',
                    'codigo' => 1
                ]);
            } else {
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

    public static function buscarAPI()
    {
        $ma_nombre = $_GET['ma_nombre'];

        $sql = "SELECT * FROM materias where detalle_situacion = 1 ";
        if ($ma_nombre != '') {
            $sql .= " and ma_nombre like '%$ma_nombre%' ";
        }
        try {

            $materias = Materia::fetchArray($sql);

            echo json_encode($materias);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}