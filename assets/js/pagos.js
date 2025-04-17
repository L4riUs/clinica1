const pagos_list = document.querySelector('#pagos-list');
const id_metodo_pago = document.querySelector('#id_metodo_pago');
const id_diagnostico = document.querySelector('#id_diagnostico');

var pago_id = 0

function abrir_modal_form_create(){
    document.getElementById('id_diagnostico').value = ''
    document.getElementById('monto').value = ''
    document.getElementById('id_metodo_pago').value = ''
    document.getElementById('fecha').value = ''
    document.getElementById('formPago').attributes.action.value = 'Controller/add/add_pago.php';
    document.getElementById('btn-enviar-label').textContent = 'Crear';
    window.location = '#modalpago';
}

function abrir_modal_delete(id,name){
    pago_id = id;
    document.getElementById('pago-name').innerHTML = name
    document.getElementById('pago-id').textContent = pago_id
    window.location = '#modalDelete';
}

function abrir_modal_form_edit(id){
    get('Controller/get/get_pagos.php?id='+id, (data) => {
        data = data[0];
        document.getElementById('id').value = data['id']
        document.getElementById('id_diagnostico').value = data['id_diagnostico']
        document.getElementById('monto').value = data['monto']
        document.getElementById('metodo_pago').value = data['metodo_pago']
        document.getElementById('fecha').value = data['fecha']
        document.getElementById('formPago').attributes.action.value = 'Controller/edit/edit_pago.php?id='+id;
        document.getElementById('btn-enviar-label').textContent = 'Editar';
        window.location = '#modalpago';
    },'GET');
}

function imprimirTabla(data) {
    pagos_list.innerHTML = '';
    if (data == null || data.length === undefined || data.length === 0) {
        pagos_list.innerHTML = `<td colspan="10"><h1>No hay pagos</h1></td>`;
        return;
    }
    data.forEach(row => {
        pagos_list.innerHTML += `
        <tr>
            <td>${row['id']}</td>
            <td>${row['id_diagnostico']}</td>
            <td>${row['monto']}</td>
            <td>${row['metodo_pago']}</td>
            <td>${row['fecha']}</td>
        </tr>
        `;
    });
}

function cargarMetodosPago(){
    get('Controller/get/get_metodos_pagos.php', (data) => {
        id_metodo_pago.innerHTML = '<option disabled selected>Seleccione el metodo de pago</option>';
        data.forEach(row => {
            id_metodo_pago.innerHTML += `
            <option value="${row['id']}">${row['nombre']}</option>
            `;
        });
    },'GET');
}
function cargarDiagnosticos(){
    get('Controller/get/get_diagnosticos.php', (data) => {
        id_diagnostico.innerHTML = '<option disabled selected>Seleccione el diagnostico</option>';
        data.forEach(row => {
            id_diagnostico.innerHTML += `
            <option value="${row['id']}">${row['doctor']} - ${row['paciente']}</option>
            `;
        });
        
    },'GET');
}

function getPagos(){
    get('?c=Pagos&a=BuscarPagos', imprimirTabla,'GET');
}

function eliminarPago(){
    post('Controller/del/del_pago.php', getPagos, 'POST', 'id='+pago_id);
}

function crearPago(){
    post('Controller/post/add_pago.php', getPagos, 'POST', 'id_diagnostico='+document.getElementById('id_diagnostico').value+'&monto='+document.getElementById('monto').value+'&metodo_pago='+document.getElementById('metodo_pago').value+'&fecha='+document.getElementById('fecha').value);
}

cargarDiagnosticos();
cargarMetodosPago();
getPagos();