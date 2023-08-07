import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion} from "../funciones";

const formulario = document.querySelector('#formularioReportes')
const btnBuscar = document.getElementById('btnBuscar');
const btnCancelar = document.getElementById('btnCancelar');
const tCalificacion = document.getElementById('tCalificacion');


btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';

const buscar = async () => {

    let calif_alumno = formulario.calif_alumno.value;
    const url = `/final_IS2_cornelio/reportes/buscarReporte?calif_alumno=${calif_alumno}`;
    const config = {
        method : 'GET'
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        console.log(data);
        tCalificacion.tBodies[0].innerHTML = ''
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



                td1.innerText = contador;
                td2.innerText = calificaciones.calif_materia;
                td3.innerText = calificaciones.calif_punteo;
                td4.innerText = calificaciones.calif_resultado;

                
                
                // ESTRUCTURANDO DOM
                tr.appendChild(td1)
                tr.appendChild(td2)
                tr.appendChild(td3)
                tr.appendChild(td4)
  


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

        tCalificacion.tBodies[0].appendChild(fragment)
    } catch (error) {
        console.log(error);
    }
}

const colocarDatos = (datos) => {
    formulario.calif_materia.value = datos.calif_materia
    formulario.calif_punteo.value = datos.calif_punteo
    formulario.calif_resultado.value = datos.calif_resultado
    formulario.id_calificaciones.value = datos.id_calificaciones
    
    btnBuscar.disabled = true
    btnBuscar.parentElement.style.display = 'none'
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