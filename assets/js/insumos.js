const insumos_list = document.querySelector('#insumos-list');

var insumo_id = 0


function abrir_modal_form_create(){
    document.getElementById('nombre').value = ''
    document.getElementById('stock').value = ''
    document.getElementById('formInsumo').attributes.action.value = 'Controller/add/add_insumo.php';
    document.getElementById('btn-enviar-label').textContent = 'Crear';
    window.location = '#modalinsumo';
}

function abrir_modal_delete(id,name){
    insumo_id = id;
    document.getElementById('insumo-name').innerHTML = name
    document.getElementById('insumo-id').textContent = insumo_id
    window.location = '#modalDelete';
}

function abrir_modal_form_edit(id){
    get('Controller/get/get_insumos.php?id='+id, (data) => {
        data = data[0];
        document.getElementById('id').value = data['id']
        document.getElementById('nombre').value = data['nombre']
        document.getElementById('stock').value = data['stock']
        document.getElementById('formInsumo').attributes.action.value = 'Controller/edit/edit_insumo.php?id='+id;
        document.getElementById('btn-enviar-label').textContent = 'Editar';
        window.location = '#modalinsumo';
    },'GET');
}

function imprimirTabla(data) {
    console.log("imprimiendo insumos");
    insumos_list.innerHTML = '';
    if (data == null || data.length === undefined || data.length === 0) {
        insumos_list.innerHTML = `<td colspan="9"><h1>No hay Insumos</h1></td>`;
        return;
    }
    data.forEach(row => {
        insumos_list.innerHTML += `
        <tr>
            <td>${row['id']}</td>
            <td>${row['nombre']}</td>
            <td>${row['stock']}</td>
            <td>
            <p onclick="abrir_modal_delete('${row['id']}','${row['nombre']}')" class="boton-cancelar">Eliminar</p>
            <p onclick="abrir_modal_form_edit('${row['id']}')" class="boton-aceptar">Editar</p>
            </td>
        </tr>
        `;
    });
}

function getInsumos(){
    console.log("obteniendo insumos");
    get('?c=Insumos&a=BuscarInsumos', imprimirTabla,'GET');
}

function eliminarInsumo(){
    post('Controller/del/del_insumo.php', getInsumos, 'POST', 'id='+insumo_id);
}

function crearInsumo(){
    post('Controller/post/crear_insumo.php', getInsumos, 'POST', 'nombre='+document.getElementById('nombre').value+'&stock='+document.getElementById('stock').value);
}
getInsumos();
