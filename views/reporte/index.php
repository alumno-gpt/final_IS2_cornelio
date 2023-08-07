<h1 class="text-center">Formulario de calificaciones</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioCalificaciones">
        <input type="hidden" name="id_calificaciones" id="id_calificaciones">
          <div class="col m-3">
            <label for="#">Alumnos</label>
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
<script src="<?= asset('./build/js/calificaciones/index.js') ?>"></script>