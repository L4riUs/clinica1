const citas_list = document.querySelector('#citas-list');
const doctores_list = document.querySelector('#id_doctor');
const pacientes_list = document.querySelector('#id_paciente');

var cita_id = 0

function abrir_modal_form_create(){
    document.getElementById('id_paciente').value = ''
    document.getElementById('id_doctor').value = ''
    document.getElementById('motivo').value = ''
    document.getElementById('precio').value = ''
    document.getElementById('fecha').value = ''
    document.getElementById('emergencia').value = "false"
    document.getElementById('formCita').attributes.action.value = 'Controller/add/add_cita.php';
    document.getElementById('btn-enviar-label').textContent = 'Crear';
    window.location = '#modalcita';
}

function abrir_modal_delete(id,name){
    cita_id = id;
    document.getElementById('cita-name').innerHTML = name
    document.getElementById('cita-id').textContent = cita_id
    window.location = '#modalDelete';
}

function abrir_modal_form_edit(id){
    get('Controller/get/get_citas.php?id='+id, (data) => {
        data = data[0];
        document.getElementById('id').value = data['id']
        document.getElementById('id_paciente').value = data['id_paciente']
        document.getElementById('id_doctor').value = data['id_doctor']
        document.getElementById('motivo').value = data['motivo']
        document.getElementById('precio').value = data['precio']
        document.getElementById('fecha').value = data['fecha']
        document.getElementById('emergencia').value = "false"
        document.getElementById('formCita').attributes.action.value = 'Controller/edit/edit_cita.php?id='+id;
        document.getElementById('btn-enviar-label').textContent = 'Editar';
        window.location = '#modalcita';
    },'GET');
}

function imprimirTabla(data) {
    console.log("imprimiendo citas");
    citas_list.innerHTML = '';
    if (data == null || data.length === undefined || data.length === 0) {
        citas_list.innerHTML = `<td colspan="10"><h1>No hay citas</h1></td>`;
        return;
    }
    data.forEach(row => {
        if (row['emergencia'] == "0"){
            return
        }
        citas_list.innerHTML += `
        <tr>
            <td>${row['id']}</td>
            <td>${row['doctor']}</td>
            <td>${row['paciente']}</td>
            <td>${row['emergencia']}</td>
            <td>${row['motivo']}</td>
            <td>${row['precio']}</td>
            <td>${row['fecha']}</td>
            <td>
            <p onclick="abrir_modal_delete('${row['id']}','${row['motivo']}')" class="boton-cancelar">Eliminar</p>
            <p onclick="abrir_modal_form_edit('${row['id']}')" class="boton-aceptar">Editar</p>
            </td>
        </tr>
        `;
    });
}

function cargarDoctores(){
    get('Controller/get/get_doctores.php', (data) => {
        doctores_list.innerHTML = '<option disabled selected>Seleccione el doctor</option>';
        data.forEach(row => {
            doctores_list.innerHTML += `
            <option value="${row['id']}">${row['nombre']}</option>
            `;
        });
    },'GET');
}
function cargarPacientes(){
    get('Controller/get/get_pacientes.php', (data) => {
        pacientes_list.innerHTML = '<option disabled selected>Seleccione el paciente</option>';
        data.forEach(row => {
            pacientes_list.innerHTML += `
            <option value="${row['id']}">${row['nombre']}</option>
            `;
        });
    },'GET');
}

function getCitas(){
    console.log("obteniendo citas");
    get('?c=Citas&a=BuscarCitas', imprimirTabla,'GET');
}

function eliminarCita(){
    post('Controller/del/del_cita.php', getCitas, 'POST', 'id='+cita_id);
}

function crearCita(){
    post('Controller/post/add_cita.php', getCitas, 'POST', 'id_paciente='+document.getElementById('id_paciente').value+'&id_doctor='+document.getElementById('id_doctor').value+'&motivo='+document.getElementById('motivo').value+'&precio='+document.getElementById('precio').value+'&fecha='+document.getElementById('fecha').value);
}

cargarDoctores();
cargarPacientes();
getCitas();