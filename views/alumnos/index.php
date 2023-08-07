<h1 class="text-center">Formulario de alumnos</h1>
<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioAlumno">
        <input type="hidden" name="id_alumnos" id="id_alumnos">
        <div class="row mb-3">
            <div class="col">
                <label for="alu_nombre">Nombre del alumno</label>
                <input type="text" name="alu_nombre" id="alu_nombre" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="alu_apellido">Apellido del alumno</label>
                <input type="text" step="0.01" min="0" name="alu_apellido" id="alu_apellido" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="alu_grado">Grado</label>
                <input type="text" step="0.01" min="0" name="alu_grado" id="alu_grado" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="alu_arma">Arma</label>
                <input type="text" step="0.01" min="0" name="alu_arma" id="alu_arma" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="alu_nac">Nacionalidad del alumno</label>
                <input type="text" step="0.01" min="0" name="alu_nac" id="alu_nac" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="submit" form="formularioAlumno" id="btnGuardar" data-saludo="hola" data-saludo2="hola2"
                    class="btn btn-primary w-100">Guardar</button>
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
        <h2>Listado de los alumnos</h2>
        <table class="table table-bordered table-hover table-responsive" id="tablaAlumnos">
            <thead class="table-dark">
                <tr>
                    <th>NO. </th>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>GRADO</th>
                    <th>ARMA</th>
                    <th>NACIONALIDAD</th>
                    <th>MODIFICAR</th>
                    <th>ELIMMINAR</th>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script src="<?= asset('./build/js/alumnos/index.js') ?>"></script>