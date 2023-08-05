import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import { validarFormulario, Toast, confirmacion} from "../funciones";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";


const formulario = document.querySelector('form')
const tablaAlumnos = new DataTable("#tablaAlumnos");
const btnBuscar = document.getElementById('btnBuscar');
const formularioAlumno = document.getElementById('formularioAlumno');
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
    if(!validarFormulario(formulario, ['id_alumnos'])){
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        })
        return 
    }

    const body = new FormData(formulario)
    body.delete('id_alumnos')
    const url = '/final_IS2_cornelio/API/alumnos/guardar';
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
                
                break;
        
            case 0:
                icon = 'error'
                console.log(detalle)
                break;
        
            default:
                break;
        }
        buscar();
        Toast.fire({
            icon,
            text: mensaje
        })

    } catch (error) {
        console.log(error);
    }
}




const buscar = async () => {
    // e && e.preventDefault();
    
    try {
      const url = "/final_IS2_cornelio/API/alumnos/buscar";
      const headers = new Headers();
      headers.append("X-requested-With", "fetch");
  
      const config = {
        method: "GET",
      };
  
      const respuesta = await fetch(url, config);
      const data = await respuesta.json();
  
    //   console.log(data);
    //   return;
  
    tablaAlumnos.destroy();
      let contador = 1;
      tablaAlumnos = new DataTable("#tablaAlumnos", {
        language: lenguaje,
        data: data,
        columns: [
          {
            data: "id_alumnos",
            render: () => {
              return contador++;
            },
          },

          { data: "alu_grado" },
          { data: "alu_arma" },

          {
                data: "id",
                render: (data, type, row, meta) => {
                  return `${row.alu_nombre} ${" "} ${row.alu_apellido} `;
                },
              }, 

          { data: "alu_nac" },
       
          {
            data: "id_alumnos",
            render: (data, type, row, meta) => {
              return `<a type="button" class="btn btn-warning" onclick="asignarValores('${row.id_alumnos}', 
              '${row.alu_nombre}',
               '${row.alu_apellido}','${row.alu_grado}','${row.alu_arma}','${row.alu_nac}')">MODIFICAR</a>`;
            },
          },
          {
            data: "id_alumnos",
            render: (data, type, row, meta) => {
              return `<a type="button" class="btn btn-danger" onclick="eliminar('${row.id_alumnos}')">ELIMINAR</a>`;
            },
          },
        ],
      });
    } catch (error) {
      console.log(error);
    }
  };


  window.asignarValores = (id_alumnos, alu_nombre, alu_apellido, alu_grado, alu_arma,  alu_nac) => {
    formularioAlumno.id_alumnos.value = id_alumnos;
    formularioAlumno.alu_nombre.value = alu_nombre;
    formularioAlumno.alu_apellido.value = alu_apellido;
    formularioAlumno.alu_grado.value = alu_grado;
    formularioAlumno.alu_arma.value = alu_arma;
    formularioAlumno.alu_nac.value = alu_nac;

 
    btnGuardar.disabled = true
    btnGuardar.parentElement.style.display = 'none'
    btnBuscar.disabled = true
    btnBuscar.parentElement.style.display = 'none'
    btnModificar.disabled = false
    btnModificar.parentElement.style.display = ''
    btnCancelar.disabled = false
    btnCancelar.parentElement.style.display = ''
    divTabla.style.display = 'none'
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

const modificar = async (evento) => {

    evento.preventDefault();
    if(!validarFormulario(formulario, ['id_alumnos'])){
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        })
        return 
    }

    const body = new FormData(formulario)
    const url = '/final_IS2_cornelio/API/alumnos/modificar';
    const config = {
        method : 'POST',
        body
    }

    try {
        // fetch(url, config).then( (respuesta) => respuesta.json() ).then(d => data = d)
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        

        // console.log(data);
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

window.eliminar = async (id_alumnos) => {
    alert(id_alumnos);
    if(await confirmacion('warning','¿Desea eliminar este registro?')){
        const body = new FormData()
        body.append('id_alumnos', id_alumnos)
        const url = '/final_IS2_cornelio/API/alumnos/eliminar';
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