const diagnosticos_list = document.querySelector('#diagnosticos-list');
const codigo_cita_list = document.querySelector('#codigo_cita');

var diagnostico_id = 0


function abrir_modal_form_create() {
    document.getElementById('descripcion').value = ''
    document.getElementById('tratamiento').value = ''
    document.getElementById('codigo_cita').value = ''
    document.getElementById('fecha').value = ''
    document.getElementById('formDiagnostico').attributes.action.value = 'Controller/add/add_diagnostico.php';
    document.getElementById('btn-enviar-label').textContent = 'Crear';
    window.location = '#modaldiagnostico';
}

function abrir_modal_delete(id, name) {
    diagnostico_id = id;
    document.getElementById('diagnostico-name').innerHTML = name
    document.getElementById('diagnostico-id').textContent = diagnostico_id
    window.location = '#modalDelete';
}

function abrir_modal_form_edit(id) {
    get('Controller/get/get_diagnosticos.php?id=' + id, (data) => {
        data = data[0];
        document.getElementById('id').value = data['id']
        document.getElementById('descripcion').value = data['descripcion']
        document.getElementById('tratamiento').value = data['tratamiento']
        document.getElementById('codigo_cita').value = data['codigo_cita']
        document.getElementById('fecha').value = data['fecha']
        document.getElementById('formDiagnostico').attributes.action.value = 'Controller/edit/edit_diagnostico.php?id=' + id;
        document.getElementById('btn-enviar-label').textContent = 'Editar';
        window.location = '#modaldiagnostico';
    }, 'GET');
}

function imprimirTabla(data) {
    console.log("imprimiendo diagnosticos");
    diagnosticos_list.innerHTML = '';
    if (data == null || data.length === undefined || data.length === 0) {
        diagnosticos_list.innerHTML = `<td colspan="10"><h1>No hay Diagnosticos</h1></td>`;
        return;
    }
    data.forEach(row => {
        diagnosticos_list.innerHTML += `
        <tr>
            <td>${row['id']}</td>
            <td>${row['descripcion']}</td>
            <td>${row['tratamiento']}</td>
            <td>${row['paciente']}</td>
            <td>${row['doctor']}</td>
            <td>${row['fecha']}</td>
            <td>
            <p onclick="abrir_modal_delete('${row['id']}','${row['descripcion']}')" class="boton-cancelar">Eliminar</p>
            <p onclick="abrir_modal_form_edit('${row['id']}')" class="boton-aceptar">Editar</p>
            </td>
        </tr>
        `;
    });
}

function cargarCodigosCita() {
    get('Controller/get/get_citas.php', (data) => {
        codigo_cita_list.innerHTML = '<option disabled selected>Seleccione el codigo de cita</option>';
        data.forEach(row => {
            codigo_cita_list.innerHTML += `
            <option value="${row['id']}">${row['id']} ${row['paciente']} ${row['doctor']}</option>
            `;
        });
    }, 'GET');
}

function getDiagnosticos() {
    console.log("obteniendo diagnosticos");
    get('?c=Diagnostico&a=BuscarDiagnosticos', imprimirTabla, 'GET');
}

function eliminarDiagnostico() {
    post('Controller/del/del_diagnostico.php', getDiagnosticos, 'POST', 'id=' + diagnostico_id);
}

function crearDiagnostico() {
    post('Controller/post/add_diagnostico.php', getDiagnosticos, 'POST', 'descripcion=' + document.getElementById('descripcion').value + '&tratamiento=' + document.getElementById('tratamiento').value + '&codigo_cita=' + document.getElementById('codigo_cita').value + '&fecha=' + document.getElementById('fecha').value);
}


cargarCodigosCita();
getDiagnosticos();
