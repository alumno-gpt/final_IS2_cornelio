import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion} from "../funciones";

const formulario = document.querySelector('#formularioReportes')
const btnBuscar = document.getElementById('btnBuscar');

const buscar = async () => {

    let calif_alumno = formulario.calif_alumno.value;
    const url = `/final_IS2_cornelio/API/reportes/buscar?calif_alumno=${calif_alumno}`;
    const config = {
        method : 'GET'
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();

        //datos de usuario
        document.getElementById('id_alumnos').innerHTML = data.alumno[0].id_alumnos; 
        document.getElementById('nombre').innerHTML = data.alumno[0].alu_nombre +' '+ data.alumno[0].alu_apellido;
        document.getElementById('grado').innerHTML = data.alumno[0].alu_grado +' / '+ data.alumno[0].alu_arma; 
        document.getElementById('nacionalidad').innerHTML = data.alumno[0].alu_nac; 

        //Calificaciones
        let calificaciones = document.querySelector('#calificaciones');
        let conteo = 1;

        data.calificaciones.forEach(e => {

           calificaciones.innerHTML +=   `<tr class="text-center">
                                            <td>${conteo}</td>  
                                            <td>${e.calif_materia}</td>  
                                            <td>${e.calif_punteo}</td>  
                                            <td>${e.calif_resultado}</td>                
                                        </tr>`  
            conteo += 1;          
        });
        
        //Promedio
        document.getElementById('promedio').innerHTML = data.promedio[0].promedio;
    } catch (error) {
        console.log(error);
    }
}

btnBuscar.addEventListener('click', buscar)