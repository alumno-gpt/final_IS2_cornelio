import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion } from "../funciones";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";

const formulario = document.querySelector("form");
const tablaAlumnos = document.getElementById("tablaAlumnos");
const btnBuscar = document.getElementById("btnBuscar");
const formularioAlumno = document.getElementById("formularioAlumno");
const btnModificar = document.getElementById("btnModificar");
const btnGuardar = document.getElementById("btnGuardar");
const btnCancelar = document.getElementById("btnCancelar");
const divTabla = document.getElementById("divTabla");

btnModificar.disabled = true;
btnModificar.parentElement.style.display = "none";
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = "none";

const guardar = async (evento) => {
  evento.preventDefault();
  if (!validarFormulario(formulario, ["id_alumnos"])) {
    Toast.fire({
      icon: "info",
      text: "Debe llenar todos los datos",
    });
    return;
  }

  const body = new FormData(formulario);
  body.delete("id_alumnos");
  const url = "/final_IS2_cornelio/API/alumnos/guardar";
  const config = {
    method: "POST",
    body,
  };

  try {
    const respuesta = await fetch(url, config);
    const data = await respuesta.json();
    // return

    const { codigo, mensaje, detalle } = data;
    let icon = "info";
    console.log(data);
    if (codigo == 1) {
      Toast.fire({
        icon: "success",
        title: "Registro guardado",
      });

      formularioAlumno.reset();
      buscarNuevo();
    } else {
      Toast.fire({
        icon: "error",
        title: "Ocurrió un error",
      });
    }
  } catch (error) {
    console.log(error);
  }
};

const buscar = async () => {
  let alu_nombre = formulario.alu_nombre.value;
  let alu_apellido = formulario.alu_apellido.value;
  let alu_grado = formulario.alu_grado.value;
  let alu_arma = formulario.alu_arma.value;
  let alu_nac = formulario.alu_nac.value;
  const url = `/final_IS2_cornelio/API/alumnos/buscar?alu_nombre=${alu_nombre}&alu_apellido=${alu_apellido}&alu_grado=${alu_grado}&alu_arma=${alu_arma}&alu_nac=${alu_nac}`;
  const config = {
    method: "GET",
  };

  try {
    const respuesta = await fetch(url, config);
    const data = await respuesta.json();
    console.log(data);
    tablaAlumnos.tBodies[0].innerHTML = "";
    const fragment = document.createDocumentFragment();

    if (data.length > 0) {
      let contador = 1;
      data.forEach((alumno) => {
        // CREAMOS ELEMENTOS
        const tr = document.createElement("tr");
        const td1 = document.createElement("td");
        const td2 = document.createElement("td");
        const td3 = document.createElement("td");
        const td4 = document.createElement("td");
        const td5 = document.createElement("td");
        const td6 = document.createElement("td");
        const td7 = document.createElement("td");
        const td8 = document.createElement("td");
        const buttonModificar = document.createElement("button");
        const buttonEliminar = document.createElement("button");

        // CARACTERISTICAS A LOS ELEMENTOS
        buttonModificar.classList.add("btn", "btn-warning");
        buttonEliminar.classList.add("btn", "btn-danger");
        buttonModificar.textContent = "Modificar";
        buttonEliminar.textContent = "Eliminar";

        buttonModificar.addEventListener("click", () => colocarDatos(alumno));
        buttonEliminar.addEventListener("click", () =>
          eliminar(alumno.id_alumnos)
        );

        td1.innerText = contador;
        td2.innerText = alumno.alu_nombre;
        td3.innerText = alumno.alu_apellido;
        td4.innerText = alumno.alu_grado;
        td5.innerText = alumno.alu_arma;
        td6.innerText = alumno.alu_nac;

        // ESTRUCTURANDO DOM
        td7.appendChild(buttonModificar);
        td8.appendChild(buttonEliminar);
        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td3);
        tr.appendChild(td4);
        tr.appendChild(td5);
        tr.appendChild(td6);
        tr.appendChild(td7);
        tr.appendChild(td8);

        fragment.appendChild(tr);

        contador++;
      });
    } else {
      const tr = document.createElement("tr");
      const td = document.createElement("td");
      td.innerText = "No existen registros";
      td.colSpan = 8;
      tr.appendChild(td);
      fragment.appendChild(tr);
    }

    tablaAlumnos.tBodies[0].appendChild(fragment);
  } catch (error) {
    console.log(error);
  }
};

const colocarDatos = (datos) => {
  formulario.alu_nombre.value = datos.alu_nombre;
  formulario.alu_apellido.value = datos.alu_apellido;
  formulario.alu_grado.value = datos.alu_grado;
  formulario.alu_arma.value = datos.alu_arma;
  formulario.alu_nac.value = datos.alu_nac;
  formulario.id_alumnos.value = datos.id_alumnos;

  btnGuardar.disabled = true;
  btnGuardar.parentElement.style.display = "none";
  btnBuscar.disabled = true;
  btnBuscar.parentElement.style.display = "none";
  btnModificar.disabled = false;
  btnModificar.parentElement.style.display = "";
  btnCancelar.disabled = false;
  btnCancelar.parentElement.style.display = "";
  divTabla.style.display = "none";

  // modalEjemploBS.show();
};

const cancelarAccion = () => {
  btnGuardar.disabled = false;
  btnGuardar.parentElement.style.display = "";
  btnBuscar.disabled = false;
  btnBuscar.parentElement.style.display = "";
  btnModificar.disabled = true;
  btnModificar.parentElement.style.display = "none";
  btnCancelar.disabled = true;
  btnCancelar.parentElement.style.display = "none";
  divTabla.style.display = "";
};

const modificar = async (evento) => {
  evento.preventDefault();
  if (!validarFormulario(formulario, ["id_alumnos"])) {
    Toast.fire({
      icon: "info",
      text: "Debe llenar todos los datos",
    });
    return;
  }

  const body = new FormData(formulario);
  const url = "/final_IS2_cornelio/API/alumnos/modificar";
  const config = {
    method: "POST",
    body,
  };

  try {
    // fetch(url, config).then( (respuesta) => respuesta.json() ).then(d => data = d)
    const respuesta = await fetch(url, config);
    const data = await respuesta.json();

    // console.log(data);
    const { codigo, mensaje, detalle } = data;
    let icon = "info";
    switch (codigo) {
      case 1:
        formulario.reset();
        icon = "success";
        buscar();
        cancelarAccion();
        break;

      case 0:
        icon = "error";
        console.log(detalle);
        break;

      default:
        break;
    }

    Toast.fire({
      icon,
      text: mensaje,
    });
  } catch (error) {
    console.log(error);
  }
};

window.eliminar = async (id_alumnos) => {
  // alert(id_alumnos);
  if (await confirmacion("warning", "¿Desea eliminar este registro?")) {
    const body = new FormData();
    body.append("id_alumnos", id_alumnos);
    const url = "/final_IS2_cornelio/API/alumnos/eliminar";
    const config = {
      method: "POST",
      body,
    };
    try {
      const respuesta = await fetch(url, config);
      const data = await respuesta.json();
      // console.log(data)
      const { codigo, mensaje, detalle } = data;

      let icon = "info";
      switch (codigo) {
        case 1:
          icon = "success";
          buscar();
          break;

        case 0:
          icon = "error";
          console.log(detalle);
          break;

        default:
          break;
      }

      Toast.fire({
        icon,
        text: mensaje,
      });
    } catch (error) {
      console.log(error);
    }
  }
};

buscar();

formulario.addEventListener("submit", guardar);
btnBuscar.addEventListener("click", buscar);
btnCancelar.addEventListener("click", cancelarAccion);
btnModificar.addEventListener("click", modificar);
