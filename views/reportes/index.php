<h1 class="text-center">Reporte de calificaciones</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioReportes">
        <input type="hidden" name="id_calificaciones" id="id_calificaciones">
          <div class="col m-3">
            <label for="#">NOMBRE DEL ALUMNO</label>
            <select class="form-control" name="calif_alumno" id="calif_alumno" >
                <option value="">Seleccione alumno...</option>
                <?php foreach ($alumnos as $alumno) : ?>
                    <option value="<?= $alumno['id_alumnos'] ?>"><?= $alumno['alu_nombre'] . ' ' . $alumno['alu_apellido'] ?>
                <?php endforeach ?>
            </select>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="button" id="btnBuscar" class="btn btn-info w-100">Ver reporte</button>
            </div>
            <div class="col">
                <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
            </div>
        </div>
    </form>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
            <div class="col-lg-8">
                <table class="table table-bordered table-hover">
                            <h2  class="text-center">REPORTE DEL ALUMNO</h2>
                    </thead>
                    <?php if(count($alumnos) > 0):?>
                        <?php foreach($alumnos as $key => $alumno) : ?>
                        <tr class="text-center">
                        <tr>
                            <th>ALUMNO</th>
                            <td><?= $alumno['alu_nombre'] . ' ' . $alumno['alu_apellido']?></td>
                        </tr>  
                        <tr>
                        <th>GRADO Y ARMA</th>
                            <td><?= $alumno['alu_grado'] . ' ' . 'de' . ' ' . $alumno['alu_arma']?></td>
                        </tr> 
                        <tr>
                        <th>NACIONALIDAD</th>
                        <td><?= $alumno['alu_nac']?></td>
                        </tr>
                     <tbody>
                           
                        </tr>
                        <?php endforeach ?>
                        <?php else :?>
                            <tr>
                                <td colspan="4">NO EXISTEN REGISTROS</td>
                            </tr>
                        <?php endif?>
                    </tbody>
                </table>
            </div>
        </div>

        <tr>
            <h3 class="text-center">NOTAS OBTENIDAS</h3>
        </tr>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-8">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>NO. </th>
                            <th>MATERIA</th>
                            <th>PUNTEO</th>
                            <th>RESULTADO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($calificaciones) > 0):?>
                        <?php foreach($calificaciones as $key => $calificacion) : ?>
                        <tr class="text-center">
                            <td><?= $key + 1 ?></td>
                            <td><?= $calificacion['calif_materia']?></td>
                            <td><?= $calificacion['calif_punteo']?> PUNTOS</td>
                            <td><?= $calificacion['calif_resultado']?></td>
                        </tr>
                        <?php endforeach ?>
                        <?php else :?>
                            <tr>
                                <td colspan="4">NO EXISTEN REGISTROS</td>
                            </tr>
                        <?php endif?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-8">
                <table class="table table-bordered table-hover">
                    <tbody class="text-center">
                        <tr>
                            <td>PROMEDIO</td>
                            <td><?= number_format($promedio[0]['PROMEDIO'], 2, '.', ',')?> PUNTOS</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<script src="<?= asset('./build/js/reportes/index.js') ?>"></script>