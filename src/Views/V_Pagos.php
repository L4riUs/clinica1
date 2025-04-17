<!DOCTYPE html>
<html>

<head>
    <title>Facturacion</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/css.css">
    <link rel="stylesheet" href="assets/css/tabla.css">
    <link rel="stylesheet" href="assets/css/modal.css">
    <link rel="stylesheet" href="assets/css/botones.css">
    <script src="assets/js/get.js" defer></script>
    <script src="assets/js/post.js" defer></script>
    <script src="assets/js/js.js" defer></script>
    <script src="assets/js/pagos.js" defer></script>
</head>

<body>
    <?php require_once __DIR__ . "/../Views/layout/header.html"; ?>
    <div class="contenido">
        <?php require_once __DIR__ . "/../Views/layout/cabecera.php"; ?>
        <br>
        <hr>
        <div style="display: flex; justify-content: end; margin: 10px 2.5% 10px 10px;">
            <a href="#modalpago" onclick="abrir_modal_form_create()" class="boton-crear">Crear Pago</a>
        </div>
        <table>
            <colgroup>
                <col span="1" style="width: 40px;min-width: 40px;">
            </colgroup>
            <thead>
                <th>id</th>
                <th>Codigo del diagnostico</th>
                <th>monto</th>
                <th>metodo_pago</th>
                <th>fecha</th>
            </thead>
            <tbody id="pagos-list">
            </tbody>
        </table>
    </div>
    <div id="modalpago" class="modalDialog">
        <div>
            <div class="modalBody">
                <a href="#close" title="Close" class="close">X</a>
                <h2>Crear pago</h2>
                <p>Datos del pago</p>
                <form class="form-pago" id="formPago" action="Controller/add/add_pago.php" method="POST">
                    <input type="number" name="id" id="id" hidden>
                    <br>
                    <label>Diagnostico</label>
                    <select id="id_diagnostico" name="id_diagnostico" required>
                        <option disabled selected>Seleccione el diagnostico</option>
                    </select>
                    <br>
                    <label>Monto</label>
                    <input type="number" id="monto" name="monto" placeholder="Monto" required>
                    <br>
                    <label>Metodo de pago</label>
                    <select id="id_metodo_pago" name="id_metodo_pago" required>
                        <option disabled selected>Seleccione el metodo de pago</option>
                    </select>
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