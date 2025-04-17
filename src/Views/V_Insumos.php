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
    <script src="assets/js/js.js" defer></script>
    <script src="assets/js/insumos.js" defer></script>


</head>

<body>
    <?php require_once __DIR__ . "/../Views/layout/header.html"; ?>
    <div class="contenido">
        <?php require_once __DIR__ . "/../Views/layout/cabecera.php"; ?>
        <br>
        <hr>
        <div style="display: flex; justify-content: end; margin: 10px 2.5% 10px 10px;">
            <a href="#modalinsumo" onclick="abrir_modal_form_create()" class="boton-crear">Crear insumo</a>
        </div>
        <table>
            <colgroup>
                <col span="1" style="width: 40px;min-width: 40px;">
            </colgroup>
            <thead>
                <th>id</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Accion</th>
            </thead>
            <tbody id="insumos-list">
            </tbody>
        </table>
    </div>
    <div id="modalDelete" class="modalDialog">
        <div>
            <a href="#close" title="Close" class="close">X</a>
            <h2>Eliminar insumo</h2>
            <p>Deseas eliminar el insumo "<span id="insumo-name"> </span>" numero <span id="insumo-id"> </span>?</p>
            <p>Esto no se puede deshacer.</p>
            <div class="modal-footer">
                <a onclick="eliminarInsumo()" class="boton-aceptar" href="#">Eliminar</a>
                <a type="button" class="boton-cancelar" href=#close>Cancelar</a>
            </div>
        </div>
    </div>
    <div id="modalinsumo" class="modalDialog">
        <div>
            <div class="modalBody">
                <a href="#close" title="Close" class="close">X</a>
                <h2>Crear insumo</h2>
                <p>Datos del insumo</p>
                <form class="form-insumo" id="formInsumo" action="Controller/add/add_insumo.php" method="POST">
                    <input type="number" name="id" id="id" hidden>
                    <label>Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
                    <br>

                    <label>Stock</label>
                    <input type="number" id="stock" name="stock" placeholder="Stock" value="0" min="0" required>

                    <button id="btn-enviar" type="submit" onclick="crearInsumo()" style="display: none;">Crear</button>
                </form>
            </div>
            <div class="modal-footer">
                <label for="btn-enviar" id="btn-enviar-label" class="boton-aceptar">Crear</label>
                <a type="button" href=#close class="boton-cancelar">Cancelar</a>
            </div>
        </div>
    </div>
</body>

</html>