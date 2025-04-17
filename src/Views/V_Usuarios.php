<!DOCTYPE html>
<html>
    <head>
        <title>Clinica</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="assets/css/css.css">
        <link rel="stylesheet" href="assets/css/tabla.css">
        <link rel="stylesheet" href="assets/css/modal.css">
        <link rel="stylesheet" href="assets/css/botones.css">
        <script src="assets/js/get.js" defer></script>
        <script src="assets/js/post.js" defer></script>
        <script src="assets/js/usuarios.js" defer></script>
        <script src="assets/js/js.js" defer></script>
        

    </head>
    <body>
            <?php require_once __DIR__ . "/../Views/layout/header.html"; ?>
        <div class="contenido">
                    <?php require_once __DIR__ . "/../Views/layout/cabecera.php"; ?>
            <br>
            <hr>
            <div style="display: flex; justify-content: end; margin: 10px 2.5% 10px 10px;">
                <a href="#modalusuario" onclick="abrir_modal_form_create()" class="boton-crear">Crear usuario</a>
            </div>
            <table>
                <colgroup>
                    <col span="1" style="width: 10%;">
                </colgroup>
                <thead>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>acciones</th>
                </thead>
                <tbody id="usuario-list">
                </tbody>
            </table>
        </div>
        <div id="modalDelete" class="modalDialog">
            <div>
                <a href="#close" title="Close" class="close">X</a>
                <h2>Eliminar usuario</h2>
                <p>Deseas eliminar el usuario "<span id="usuario-name"> </span>" numero <span id="usuario-id"> </span>?</p>
                <p>Esto no se puede deshacer.</p>
                <div class="modal-footer">
                    <a onclick="eliminarUsuario()" class="boton-cancelar" href="#">Eliminar</a>
                    <a type="button" class="boton-cancelar" href=#close>Cancelar</a>
                </div>
            </div>
        </div>
        <div id="modalusuario" class="modalDialog">
            <div>
                <div class="modalBody">
                    <a href="#close" title="Close" class="close">X</a>
                    <h2>Crear usuario</h2>
                    <p>Datos del usuario</p>
                    <form class="formUsuario" id="formUsuario" action="Controller/add/add_usuario.php" method="POST">
                        <input type="number" name="id" id="id" hidden>
                        <label>Nombre</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
                        <br>
                        <label>Clave</label>
                        <input type="text" id="clave" name="clave" placeholder="Clave" required>
                        <br>
                        <button id="btn-enviar" type="submit" onclick="crearUsuario()" style="display: none;">Crear</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <label for="btn-enviar" id="btn-enviar-label" class="boton-aceptar">Crear</label>
                    <a type="button" class="boton-cancelar" href=#close>Cancelar</a>
                </div>
            </div>
        </div>
    </body>
</html>