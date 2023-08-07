import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion} from "../funciones";

const formulario = document.querySelector('#formularioReportes')
const btnBuscar = document.getElementById('btnBuscar');
const btnCancelar = document.getElementById('btnCancelar');


btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';

const buscar = async () => {

    let calif_alumno = formulario.calif_alumno.value;
    const url = `/final_IS2_cornelio/reportes/buscar?calif_alumno=${calif_alumno}`;
    const config = {
        method : 'GET'
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        console.log(data);
        tablacalificaciones.tBodies[0].innerHTML = ''
        const fragment = document.createDocumentFragment();
        
        if(data.length > 0){
            let contador = 1;
            data.forEach( calificaciones => {
                // CREAMOS ELEMENTOS
                const tr = document.createElement('tr');
                const td1 = document.createElement('td')
                const td2 = document.createElement('td')
                const td3 = document.createElement('td')
                const td4 = document.createElement('td')
                const td5 = document.createElement('td')
                const td6 = document.createElement('td')
                const td7 = document.createElement('td')
                const buttonModificar = document.createElement('button')
                const buttonEliminar = document.createElement('button')

                // CARACTERISTICAS A LOS ELEMENTOS
                buttonModificar.classList.add('btn', 'btn-warning')
                buttonEliminar.classList.add('btn', 'btn-danger')
                buttonModificar.textContent = 'Modificar'
                buttonEliminar.textContent = 'Eliminar'

                buttonModificar.addEventListener('click', () => colocarDatos(calificaciones))
                buttonEliminar.addEventListener('click', () => eliminar(calificaciones.id_calificaciones))

                td1.innerText = contador;
                td2.innerText = calificaciones.calif_alumno;
                td3.innerText = calificaciones.calif_materia;
                td4.innerText = calificaciones.calif_punteo;
                td5.innerText = calificaciones.calif_resultado;
                
                
                // ESTRUCTURANDO DOM
                td6.appendChild(buttonModificar)
                td7.appendChild(buttonEliminar)
                tr.appendChild(td1)
                tr.appendChild(td2)
                tr.appendChild(td3)
                tr.appendChild(td4)
                tr.appendChild(td5)
                tr.appendChild(td6)
                tr.appendChild(td7)


                fragment.appendChild(tr);

                contador++;
            })
        }else{
            const tr = document.createElement('tr');
            const td = document.createElement('td')
            td.innerText = 'No existen registros'
            td.colSpan = 4
            tr.appendChild(td)
            fragment.appendChild(tr);
        }

        tablacalificaciones.tBodies[0].appendChild(fragment)
    } catch (error) {
        console.log(error);
    }
}

const colocarDatos = (datos) => {
    formulario.calif_alumno.value = datos.calif_alumno
    formulario.id_calificaciones.value = datos.id_calificaciones

    btnGuardar.disabled = true
    btnGuardar.parentElement.style.display = 'none'
    btnBuscar.disabled = true
    btnBuscar.parentElement.style.display = 'none'
    btnModificar.disabled = false
    btnModificar.parentElement.style.display = ''
    btnCancelar.disabled = false
    btnCancelar.parentElement.style.display = ''
    divTabla.style.display = 'none'

    // modalEjemploBS.show();
}

const cancelarAccion = () => {
    btnBuscar.disabled = false
    btnBuscar.parentElement.style.display = ''
    btnCancelar.disabled = true
    btnCancelar.parentElement.style.display = 'none'
    divTabla.style.display = ''
}

buscar();

btnBuscar.addEventListener('click', buscar)
btnCancelar.addEventListener('click', cancelarAccion)