<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/css.css">
    <link rel="stylesheet" href="assets/css/modal.css">
    <link rel="stylesheet" href="assets/css/botones.css">
    <link rel="stylesheet" href="assets/css/tabla.css">
    <link rel="stylesheet" href="assets/css/doctores.css">
    <script src="assets/js/get.js" defer></script>
    <script src="assets/js/post.js" defer></script>
    <script src="assets/js/js.js" defer></script>
    <script src="assets/js/doctores.js" defer></script>

    <title>Doctores</title>
</head>

<body>
    <?php require_once __DIR__ . "/../Views/layout/header.html"; ?>
    <div class="contenido">
        <?php require_once __DIR__ . "/../Views/layout/cabecera.php"; ?>
        <br>
        <hr>
        <div style="display: flex; justify-content: end; margin: 10px 2.5% 10px 10px;">
            <a href="#modaldoctor" onclick="abrir_modal_form_create()" class="boton-crear">Crear doctor</a>
        </div>
        <div class="tarjetas">
        </div>
    </div>
    <div id="modalDelete" class="modalDialog">
        <div>
            <a href="#close" title="Close" class="close">X</a>
            <h2>Eliminar doctor</h2>
            <p>Deseas eliminar el doctor "<span id="doctor-name"> </span>" numero "<span id="doctor-id"> </span>"?</p>
            <p>Esto no se puede deshacer.</p>
            <div class="modal-footer">
                <a onclick="eliminarDoctor()" class="boton-aceptar" href="#">Eliminar</a>
                <a type="button" class="boton-cancelar" href=#close>Cancelar</a>
            </div>
        </div>
    </div>

    <div id="modaldoctor" class="modalDialog">
        <div>
            <div class="modalBody">
                <a href="#close" title="Close" class="close">X</a>
                <h2>Crear doctor</h2>
                <p>Datos del doctor</p>
                <form class="form-doctor" id="formDoctor" action="Controller/add/add_doctor.php" method="POST">
                    <input type="number" name="id" id="id" hidden>
                    <label>Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
                    <br>
                    <label>Apellido</label>
                    <input type="text" id="apellido" name="apellido" placeholder="Apellido" required>
                    <br>
                    <label>Cedula</label>
                    <input type="text" id="cedula" name="cedula" placeholder="Cedula" required>
                    <br>
                    <label>Telefono</label>
                    <input type="text" id="telefono" name="telefono" placeholder="Telefono" required>
                    <br>
                    <label>Fecha Nacimiento</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="Fecha Nacimiento" required>
                    <br>
                    <label>Especialidad</label>
                    <select id="especialidad" name="especialidad" required>
                        <option disabled selected>Seleccione la especialidad</option>
                    </select>
                    <br>
                    <button id="btn-enviar" type="submit" onclick="crearDoctor()" style="display: none;">Crear</button>
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