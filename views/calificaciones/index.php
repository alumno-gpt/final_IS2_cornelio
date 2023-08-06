<h1 class="text-center">Formulario de calificaciones</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioCalificaciones">
        <input type="hidden" name="id_calificaciones" id="id_calificaciones">
        <div class="row mb-3">
        <select name="alumnoCalificacion" id="alumnoCalificacion" class="form-control">
            <option value="">SELECCIONE...</option>
                <?php foreach ($alumnos as $key => $alumno) : ?>
                <option value="<?= $alumno['id_alumno'] ?>"><?= $alumno['alu_nombre'] . ' ' . $alumno['alu_apellido'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-lg-8">
            <label for="materiaCalificaion">Materia</label>
            <select name="calif_materia" id="materiaCalificaion" class="form-control">
                <option value="">SELECCIONE...</option>
                <?php foreach ($materias as $key => $materia) : ?>
                <option value="<?= $materia['id_materias'] ?>"><?= $materia['ma_nombre'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-lg-4">
            <label for="puntosCalificacion">Punteo</label>
            <input type="number" step="any" name="calif_punteo" id="puntosCalificacion" class="form-control" placeholder="ejemplo: 75.50">
        </div>
        
        <div class="row mb-3">
            <div class="col">
                <button type="submit" form="formularioMaterias" id="btnGuardar" data-saludo= "hola" data-saludo2="hola2" class="btn btn-primary w-100">Guardar</button>
            </div>
            <!-- <div class="col">
                <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
            </div>
            <div class="col">
                <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
            </div>
            <div class="col">
                <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
            </div> -->
        </div>
    </form>
</div>
<!-- <div class="row justify-content-center" id="divTabla">
    <div class="col-lg-8">
        <h2>Listado de las materias</h2>
        <table class="table table-bordered table-hover" id="tablaMaterias">
            <thead class="table-dark">
                <tr>
                    <th>NO. </th>
                    <th>MATERIA</th>
                    <th>MODIFICAR</th>
                    <th>ELIMMINAR</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div> -->

<script src="<?= asset('./build/js/materias/index.js') ?>"></script>