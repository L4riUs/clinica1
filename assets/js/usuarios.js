const usuarios_list = document.querySelector('#usuario-list');

var usuario_id = 0

function imprimirUsuarios(data) {
    usuarios_list.innerHTML = '';
    if (data == null || data.length === undefined || data.length === 0) {
        usuarios_list.innerHTML = `<h1>No hay usuarios</h1>`;
        return;
    }
    data.forEach(usuario => {
        usuarios_list.innerHTML += `
        <tr>
            <td>${usuario['id']}</td>
            <td>${usuario['nombre']}</td>
            <td>
            <p onclick="abrir_modal_delete('${usuario['id']}','${usuario['nombre']}')" class="boton-cancelar">Eliminar</p>
            <p onclick="abrir_modal_form_edit('${usuario['id']}','${usuario['nombre']}','${usuario['clave']}')" class="boton-aceptar">Editar</p>
            </td>
        </tr>
        `;
    });
}

function abrir_modal_form_create(){
    document.getElementById('nombre').value = ''
    document.getElementById('clave').value = ''
    document.getElementById('btn-enviar-label').innerHTML = 'Crear'

    window.location = '#modalusuario';
}

function abrir_modal_delete(id,name){
    usuario_id = id;
    document.getElementById('usuario-name').innerHTML = name
    document.getElementById('usuario-id').textContent = usuario_id
    window.location = '#modalDelete';
}

function abrir_modal_form_edit(id,name){
    usuario_id = id;
    document.getElementById('id').value = usuario_id
    document.getElementById('nombre').value = name
    document.getElementById('clave').value = ''
    document.getElementById('btn-enviar-label').innerHTML = 'Editar'
    document.getElementById('formUsuario').attributes.action.value = 'Controller/edit/edit_usuario.php?id='+usuario_id;
    window.location = '#modalusuario';
}


function getUsuarios(){
    get('?c=Usuarios&a=BuscarUsuarios', imprimirUsuarios,'GET');
}

function eliminarUsuario(){
    post('Controller/del/del_usuario.php', getUsuarios, 'POST', 'id='+usuario_id);
}

getUsuarios();