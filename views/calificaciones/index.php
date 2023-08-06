<h1 class="text-center">Formulario de calificaciones</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioCalificaciones">
        <input type="hidden" name="id_calificaciones" id="id_calificaciones">
          <div class="col">
            <label for="#">Alumnos</label>
            <select class="form-control" name="calif_alumno" id="calif_alumno" >
                <option value="">Seleccione alumno...</option>
                <?php foreach ($alumnos as $alumno) : ?>
                <option value="<?= $alumno['id_alumnos'] ?>"><?= $alumno['alu_nombre']?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-lg-8">
            <label for="#">Materia</label>
            <select name="calif_materia" id="calif_materia" class="form-control">
                <option value="">Selecciones materia...</option>
                <?php foreach ($materias as $materia) : ?>
                <option value="<?= $materia['id_materias'] ?>"><?= $materia['ma_nombre'] ?></option>
                <?php endforeach ?> 
            </select>
        </div>
        <div class="col-lg-4">
            <label for="#">Calificacion</label>
            <input type="number" step="any" name="calif_punteo" id="calif_punteo" class="form-control" placeholder="ejemplo: 75.50">
        </div>
        
        <div class="row mb-3">
            <div class="col">
                <button type="submit" form="formularioCalificaciones" id="btnGuardar" data-saludo= "hola" data-saludo2="hola2" class="btn btn-primary w-100">Guardar</button>
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
        <h2>Listado de las calificaciones</h2>
        <table class="table table-bordered table-hover" id="tablaCalificaciones">
            <thead class="table-dark">
                <tr>
                    <th>NO. </th>
                    <th>ID_ALUMNO</th>
                    <th>ID_MATERIA</th>
                    <th>CALIFICACION</th>
                    <th>RESULTADO</th>
                    <th>MODIFICAR</th>
                    <th>ELIMINAR</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<script src="<?= asset('./build/js/materias/index.js') ?>"></script>