import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion} from "../funciones";
import DataTable from "datatables.net-bs5";

const formulario = document.querySelector('#formularioCalificaciones')
const tablacalificaciones = document.getElementById('tablacalificaciones');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');
const divTabla = document.getElementById('divTabla');

btnModificar.disabled = true
btnModificar.parentElement.style.display = 'none'
btnCancelar.disabled = true
btnCancelar.parentElement.style.display = 'none'

const guardar = async (evento) => {
    evento.preventDefault();
    if(!validarFormulario(formulario, ['id_calificaciones'])){
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        })
        return 
    }

    const body = new FormData(formulario)
    body.delete('id_calificaciones')
    const url = '/final_IS2_cornelio/API/calificaciones/guardar';
    const config = {
        method : 'POST',
        body
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();

        // console.log(data);
        // return
        
        const {codigo, mensaje,detalle} = data;
        let icon = 'info'
        switch (codigo) {
            case 1:
                formulario.reset();
                icon = 'success'
                buscar();
                break;
        
            case 0:
                icon = 'error'
                console.log(detalle)
                break;
        
            default:
                break;
        }

        Toast.fire({
            icon,
            text: mensaje
        })

    } catch (error) {
        console.log(error);
    }
}


const buscar = async () => {

    let calif_alumno = formulario.calif_alumno.value;
    let calif_materia = formulario.calif_materia.value;
    const url = `/final_IS2_cornelio/API/calificaciones/buscar?calif_alumno=${calif_alumno}&calif_materia=${calif_materia}`;
    const config = {
        method : 'GET'
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        // console.log(data);
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
    btnGuardar.disabled = false
    btnGuardar.parentElement.style.display = ''
    btnBuscar.disabled = false
    btnBuscar.parentElement.style.display = ''
    btnModificar.disabled = true
    btnModificar.parentElement.style.display = 'none'
    btnCancelar.disabled = true
    btnCancelar.parentElement.style.display = 'none'
    divTabla.style.display = ''
}


const modificar = async () => {
    if(!validarFormulario(formulario)){
        alert('Debe llenar todos los campos');
        return 
    }

    const body = new FormData(formulario)
    const url = '/final_IS2_cornelio/API/calificaciones/modificar';
    const config = {
        method : 'POST',
        body
    }

    try {
        // fetch(url, config).then( (respuesta) => respuesta.json() ).then(d => data = d)
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        
        const {codigo, mensaje,detalle} = data;
        let icon = 'info'
        switch (codigo) {
            case 1:
                formulario.reset();
                icon = 'success'
                buscar();
                cancelarAccion();
                break;
        
            case 0:
                icon = 'error'
                console.log(detalle)
                break;
        
            default:
                break;
        }

        Toast.fire({
            icon,
            text: mensaje
        })

    } catch (error) {
        console.log(error);
    }
}

const eliminar = async (id_calificaciones) => {
    if(await confirmacion('warning','¿Desea eliminar este registro?')){
        const body = new FormData()
        body.append('id_calificaciones', id)
        const url = '/final_IS2_cornelio/API/calificaciones/eliminar';
        const config = {
            method : 'POST',
            body
        }
        try {
            const respuesta = await fetch(url, config)
            const data = await respuesta.json();
            // console.log(data)
            const {codigo, mensaje,detalle} = data;
    
            let icon = 'info'
            switch (codigo) {
                case 1:
                    icon = 'success'
                    buscar();
                    break;
            
                case 0:
                    icon = 'error'
                    console.log(detalle)
                    break;
            
                default:
                    break;
            }
    
            Toast.fire({
                icon,
                text: mensaje
            })
    
        } catch (error) {
            console.log(error);
        }
    }
}
buscar();

formulario.addEventListener('submit', guardar )
btnBuscar.addEventListener('click', buscar)
btnCancelar.addEventListener('click', cancelarAccion)
btnModificar.addEventListener('click', modificar)