const doctores_list = document.querySelector('.tarjetas');
const especialidades_list = document.querySelector('#especialidad');

var doctor_id = 0


function abrir_modal_form_create(){
    cargarEspecialidades();
    document.getElementById('nombre').value = ''
    document.getElementById('apellido').value = ''
    document.getElementById('cedula').value = ''
    document.getElementById('telefono').value = ''
    document.getElementById('fecha_nacimiento').value = ''
    document.getElementById('especialidad').value = ''
    document.getElementById('formDoctor').attributes.action.value = 'Controller/add/add_doctor.php';
    document.getElementById('btn-enviar-label').textContent = 'Crear';
    window.location = '#modaldoctor';
}

function abrir_modal_delete(id,name){
    doctor_id = id;
    document.getElementById('doctor-name').innerHTML = name
    document.getElementById('doctor-id').textContent = doctor_id
    window.location = '#modalDelete';
}

function abrir_modal_form_edit(id){
    cargarEspecialidades();
    get('Controller/get/get_doctores.php?id='+id, (data) => {
        data = data[0];
        document.getElementById('id').value = data['id']
        document.getElementById('nombre').value = data['nombre']
        document.getElementById('apellido').value = data['apellido']
        document.getElementById('cedula').value = data['cedula']
        document.getElementById('telefono').value = data['telefono']
        document.getElementById('fecha_nacimiento').value = data['fecha_nacimiento']
        document.getElementById('especialidad').value = data['especialidad']
        document.getElementById('formDoctor').attributes.action.value = 'Controller/edit/edit_doctor.php?id='+id;
        document.getElementById('btn-enviar-label').textContent = 'Editar';
        window.location = '#modaldoctor';
    },'GET');
}

function imprimirTarjetas(data) {
    console.log("imprimiendo doctores");
    doctores_list.innerHTML = '';
    if (data == null || data.length === undefined || data.length === 0) {
        doctores_list.innerHTML = `<h1>No hay doctores</h1>`;
        return;
    }
    data.forEach(row => {
        doctores_list.innerHTML += `
            <div class="tarjeta">
                <div class="card-img"></div>
                <h3>${row['nombre']} <br>${row['apellido']}</h3>
                <p>Especialidad: <br>${row['especialidad']}</p>
                <p>C.I: ${row['cedula']}</p>
                <div class="card-botones">
                    <a onclick="abrir_modal_form_edit('${row['id']}')">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" title="Editar"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"></path>
                        </svg>
                    </a>
                    <a onclick="abrir_modal_delete('${row['id']}','${row['nombre']}')">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" title="Eliminar"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                        </svg>
                    </a>
                </div>
            </div>
        
        `;
    });
}

function cargarEspecialidades(){
    
    get('Controller/get/get_especialidades.php', (data) => {
        especialidades_list.innerHTML = '';
        data.forEach(row => {
            especialidades_list.innerHTML += `
            <option value="${row['id']}">${row['nombre']}</option>
            `;
        });
    },'GET');
}

function getDoctores(){
    console.log("obteniendo doctores");
    get('?c=Doctores&a=BuscarDoctores', imprimirTarjetas,'GET');
}

function eliminarDoctor(){
    post('Controller/del/del_doctor.php', getDoctores, 'POST', 'id='+doctor_id);
}

function crearDoctor(){
    post('Controller/post/crear_doctor.php', getDoctores, 'POST', 'nombre='+document.getElementById('nombre').value+'&apellido='+document.getElementById('apellido').value+'&cedula='+document.getElementById('cedula').value+'&telefono='+document.getElementById('telefono').value+'&fecha_nacimiento='+document.getElementById('fecha_nacimiento').value+'&especialidad='+document.getElementById('especialidad').value);
}

// !(function () {
//     [1,2,3].forEach(row => {
//         especialidades_list.innerHTML += `
//             <option value="${row['idespecialidad']}">${row['nombre']}</option>
//         `;
//     });
//     console.log(especialidades_list);
    
// })();

cargarEspecialidades();
getDoctores();