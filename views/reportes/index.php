<h1 class="text-center">Reporte de calificaciones</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioReportes">
        <div class="col m-3">
            <label for="#">NOMBRE DEL ALUMNO</label>
            <select class="form-control" name="calif_alumno" id="calif_alumno">
                <option value="">Seleccione alumno...</option>
                <?php foreach ($alumnos as $alumno): ?>
                    <option value="<?= $alumno['id_alumnos'] ?>"><?= $alumno['alu_nombre'] . ' ' . $alumno['alu_apellido'] ?>
                    <?php endforeach ?>
            </select>
        </div>
        <div class="col mb-3">
            <button type="button" id="btnBuscar" class="btn btn-info w-100">Ver reporte</button>
        </div>
    </form>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <table class="table table-bordered table-hover">
                <h2 class="text-center">REPORTE DEL ALUMNO</h2>
                </thead>
                <tr>
                    <th>NOMBRE ALUMNO</th>
                    <td id="nombre"></td>
                </tr>
                <tr>
                    <th>GRADO Y ARMA</th>
                    <td id="grado"></td>
                </tr>
                <tr>
                    <th>NACIONALIDAD</th>
                    <td id="nacionalidad"></td>
                </tr>
            </table>
        </div>
    </div>

    <tr>
        <h3 class="text-center">NOTAS OBTENIDAS</h3>
    </tr>
    <div class="row justify-content-center mt-4">
        <div class="col-lg-8">
            <table class="table table-bordered table-hover" id="tCalificacion">
                <thead class="table-dark">
                    <tr>
                        <th>NO. </th>
                        <th>MATERIA</th>
                        <th>PUNTEO</th>
                    </tr>
                </thead>
                <tbody id="calificaciones">

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
                        <td id="promedio"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="<?= asset('./build/js/reportes/index.js') ?>"></script>