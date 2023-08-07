<h1 class="text-center">Formulario de calificaciones</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioMaterias">
        <input type="hidden" name="id_calificaciones" id="id_calificaciones">
        <div class="row mb-3">
        <select name="calif_alumno" id="calif_alumno" class="form-control">
            <option value="">SELECCIONE...</option>
                <?php foreach ($alumnos as $key => $alumno) : ?>
                <option value="<?= $alumno['ID_ALUMNOS'] ?>"><?= $alumno['ALU_NOMBRE'] . ' ' . $alumno['ALU_APELLIDO'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-lg-8">
            <label for="materia1">Materia</label>
            <select name="calif_materia" id="materia1" class="form-control">
                <option value="">SELECCIONE...</option>
                <?php foreach ($materias as $key => $materia) : ?>
                <option value="<?= $materia['ID_MATERIAS'] ?>"><?= $materia['MA_NOMBRE'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-lg-4">
            <label for="calificacion1">Punteo</label>
            <input type="number" step="any" name="calif_punteo" id="calificacion1" class="form-control" placeholder="ejemplo: 75.50">
        </div>
        
        <div class="row mb-3">
            <div class="col">
                <button type="submit" form="formularioMaterias" id="btnGuardar" data-saludo= "hola" data-saludo2="hola2" class="btn btn-primary w-100">Guardar</button>
            </div>
            <div class="col">
                <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
            </div>
            <div class="col">
                <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
            </div>
            <div class="col">
                <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
            </div>
        </div>
    </form>
</div>
<div class="row justify-content-center" id="divTabla">
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
</div>

<script src="<?= asset('./build/js/materias/index.js') ?>"></script>