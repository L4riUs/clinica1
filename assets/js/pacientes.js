/* los datos de los pacientes son
nombre
apellido
cedula
telefono
fechaNacimiento
*/
const pacientes_list = document.querySelector('#pacientes-list');

var Paciente_id = 0


function abrir_modal_form_create(){
    document.getElementById('nombre').value = ''
    document.getElementById('apellido').value = ''
    document.getElementById('cedula').value = ''
    document.getElementById('telefono').value = ''
    document.getElementById('fecha_nacimiento').value = ''

    document.getElementById('formPaciente').attributes.action.value = 'Controller/add/add_Paciente.php';
    document.getElementById('btn-enviar-label').textContent = 'Crear';
    window.location = '#modalPaciente';
}

function abrir_modal_delete(id,name){
    Paciente_id = id;
    document.getElementById('paciente-name').innerHTML = name
    document.getElementById('paciente-id').textContent = Paciente_id
    window.location = '#modalDelete';
}

function abrir_modal_form_edit(id){
    console.log(id);
    
    get('Controller/get/get_Pacientes.php?id='+id, (data) => {
        data = data[0];
        document.getElementById('id').value = data['id']
        document.getElementById('nombre').value = data['nombre']
        document.getElementById('apellido').value = data['apellido']
        document.getElementById('cedula').value = data['cedula']
        document.getElementById('telefono').value = data['telefono']
        document.getElementById('fecha_nacimiento').value = data['fecha_nacimiento']

        document.getElementById('formPaciente').attributes.action.value = 'Controller/edit/edit_Paciente.php?id='+id;
        document.getElementById('btn-enviar-label').textContent = 'Editar';
        window.location = '#modalpaciente';
    },'GET');
}

function imprimirTabla(data) {
    console.log("imprimiendo Pacientes");
    console.log(data);
    
    pacientes_list.innerHTML = '';
    if (data == null || data.length === undefined || data.length === 0) {
        pacientes_list.innerHTML = `<td colspan="9"><h1>No hay Pacientes</h1></td>`;
        return;
    }
    data.forEach(row => {
        pacientes_list.innerHTML += `
        <tr>
            <td>${row['id']}</td>
            <td>${row['nombre']}</td>
            <td>${row['apellido']}</td>
            <td>${row['cedula']}</td>
            <td>${row['telefono']}</td>
            <td>${row['fecha_nacimiento']}</td>
            <td>
                <p onclick="abrir_modal_delete('${row['id']}','${row['nombre']}')" class="boton-cancelar">Eliminar</p>
                <p onclick="abrir_modal_form_edit('${row['id']}')" class="boton-aceptar">Editar</p>
            </td>
        </tr>
        `;
    });
}

function getPacientes(){
    console.log("obteniendo Pacientes");
    get('?c=Pacientes&a=BuscarPacientes', imprimirTabla,'GET');
}

function eliminarPaciente(){
    post('Controller/del/del_paciente.php', getPacientes, 'POST', 'id='+Paciente_id);
}

function crearPaciente(){
    post('Controller/post/crear_paciente.php', getPacientes, 'POST', 'nombre='+document.getElementById('nombre').value+'&apellido='+document.getElementById('apellido').value+'&dni='+document.getElementById('dni').value+'&telefono='+document.getElementById('telefono').value+'&direccion='+document.getElementById('direccion').value+'&email='+document.getElementById('email').value);
}

getPacientes();
