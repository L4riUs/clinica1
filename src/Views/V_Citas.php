<!DOCTYPE html>
<html>

<head>
    <title>Citas</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/css.css">
    <link rel="stylesheet" href="assets/css/tabla.css">
    <link rel="stylesheet" href="assets/css/modal.css">
    <link rel="stylesheet" href="assets/css/botones.css">
    <script src="assets/js/get.js" defer></script>
    <script src="assets/js/post.js" defer></script>
    <script src="assets/js/js.js" defer></script>
    <script src="assets/js/citas.js" defer></script>
</head>

<body>
    <?php require_once __DIR__ . "/../Views/layout/header.html"; ?>
    <div class="contenido">
        <?php require_once __DIR__ . "/../Views/layout/cabecera.php"; ?>
        <br>
        <hr>
        <div style="display: flex; justify-content: end; margin: 10px 2.5% 10px 10px;">
            <a href="#modalcita" onclick="abrir_modal_form_create()" class="boton-crear">Crear Cita</a>
        </div>
        <table>
            <colgroup>
                <col span="1" style="width: 40px;min-width: 40px;">
            </colgroup>
            <thead>
                <th>id</th>
                <th>doctor</th>
                <th>paciente</th>
                <th>motivo</th>
                <th>Emergencia</th>
                <th>precio</th>
                <th>fecha</th>
                <th>Acciones</th>
            </thead>
            <tbody id="citas-list">
            </tbody>
        </table>
    </div>
    <div id="modalDelete" class="modalDialog">
        <div>
            <a href="#close" title="Close" class="close">X</a>
            <h2>Eliminar cita</h2>
            <p>Deseas eliminar el cita "<span id="cita-name"> </span>" numero <span id="cita-id"> </span>?</p>
            <p>Esto no se puede deshacer.</p>
            <div class="modal-footer">
                <a onclick="eliminarCita()" class="boton-aceptar" href="#">Eliminar</a>
                <a type="button" class="boton-cancelar" href=#close>Cancelar</a>
            </div>
        </div>
    </div>
    <div id="modalcita" class="modalDialog">
        <div>
            <div class="modalBody">
                <a href="#close" title="Close" class="close">X</a>
                <h2>Crear cita</h2>
                <p>Datos de la cita</p>
                <form class="form-cita" id="formCita" action="Controller/add/add_cita.php" method="POST">
                    <input type="number" name="id" id="id" hidden>
                    <br>
                    <label>Paciente</label>
                    <select id="id_paciente" name="id_paciente" required>
                        <option disabled selected>Seleccione el paciente</option>
                    </select>
                    <br>
                    <label>Doctor</label>
                    <select id="id_doctor" name="id_doctor" required>
                        <option disabled selected>Seleccione el doctor</option>
                    </select>
                    <br>
                    <label>motivo</label>
                    <input type="text" id="motivo" name="motivo" placeholder="Motivo" required>
                    <br>
                    <label>Emergencia</label>
                    <input type="checkbox" name="emergencia" id="emergencia">
                    <br>
                    <label>precio</label>
                    <input type="number" id="precio" name="precio" placeholder="Precio" min="0" required>
                    <br>
                    <label>Fecha</label>
                    <input type="date" id="fecha" name="fecha" placeholder="Fecha" required>

                    <button id="btn-enviar" type="submit" onclick="crearCita()" style="display: none;">Crear</button>
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