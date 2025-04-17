<!DOCTYPE html>
<html>

<head>
    <title>Diagnostico</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/css.css">
    <link rel="stylesheet" href="assets/css/tabla.css">
    <link rel="stylesheet" href="assets/css/modal.css">
    <link rel="stylesheet" href="assets/css/botones.css">
    <script src="assets/js/get.js" defer></script>
    <script src="assets/js/post.js" defer></script>
    <script src="assets/js/js.js" defer></script>
    <script src="assets/js/diagnostico.js" defer></script>


</head>

<body>
    <?php require_once __DIR__ . "/../Views/layout/header.html"; ?>
    <div class="contenido">
        <?php require_once __DIR__ . "/../Views/layout/cabecera.php"; ?>
        <br>
        <hr>
        <div style="display: flex; justify-content: end; margin: 10px 2.5% 10px 10px;">
            <a href="#modaldiagnostico" onclick="abrir_modal_form_create()" class="boton-crear">Crear diagnostico</a>
        </div>
        <table>
            <colgroup>
                <col span="1" style="width: 40px;min-width: 40px;">
            </colgroup>
            <thead>
                <th>id</th>
                <th>descripcion</th>
                <th>tratamiento</th>
                <th>paciente</th>
                <th>doctor</th>
                <th>fecha</th>
                <th>Acciones</th>
            </thead>
            <tbody id="diagnosticos-list">
            </tbody>
        </table>
    </div>
    <div id="modalDelete" class="modalDialog">
        <div>
            <a href="#close" title="Close" class="close">X</a>
            <h2>Eliminar diagnostico</h2>
            <p>Deseas eliminar el diagnostico "<span id="diagnostico-name"> </span>" numero <span id="diagnostico-id"> </span>?</p>
            <p>Esto no se puede deshacer.</p>
            <div class="modal-footer">
                <a onclick="eliminarDiagnostico()" class="boton-aceptar" href="#">Eliminar</a>
                <a type="button" class="boton-cancelar" href=#close>Cancelar</a>
            </div>
        </div>
    </div>
    <div id="modaldiagnostico" class="modalDialog">
        <div>
            <div class="modalBody">
                <a href="#close" title="Close" class="close">X</a>
                <h2>Crear diagnostico</h2>
                <p>Datos del diagnostico</p>
                <form class="form-diagnostico" id="formDiagnostico" action="Controller/add/add_diagnostico.php" method="POST">
                    <input type="number" name="id" id="id" hidden>
                    <br>
                    <label>Descripcion</label>
                    <input type="text" id="descripcion" name="descripcion" placeholder="Descripcion" required>
                    <br>
                    <label>Tratamiento</label>
                    <input type="text" id="tratamiento" name="tratamiento" placeholder="Tratamiento" required>
                    <br>
                    <label>codigo de cita</label>
                    <select id="codigo_cita" name="codigo_cita" required>
                        <option disabled selected>Seleccione el codigo de cita</option>
                    </select>
                    <br>
                    <label>Fecha</label>
                    <input type="date" id="fecha" name="fecha" placeholder="Fecha" required>

                    <button id="btn-enviar" type="submit" onclick="crearDiagnostico()" style="display: none;">Crear</button>
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