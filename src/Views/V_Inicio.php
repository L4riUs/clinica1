<!DOCTYPE html>
<html>
    <head>
        <title>Clinica</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="assets/css/css.css">
        <link rel="stylesheet" href="assets/css/inicio.css">
        <link rel="stylesheet" href="assets/css/modal.css">
        <script src="assets/js/js.js" defer></script>
    </head>
    <body>
        <?php require_once __DIR__ . "/../Views/layout/header.html"; ?>
        <div class="contenido">
            <?php require_once __DIR__ . "/../Views/layout/cabecera.php"; ?>
            <hr>
            <div class="card-container">
                <!-- Pacientes -->
                <div class="card">
                    <div class="card-header">
                        <h3>Pacientes</h3>
                    </div>
                    <div class="card-body">
                        <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <hr>
                    <div class="card-footer">
                        <a href="Pacientes">Pacientes</a>
                    </div>
                </div>
                <!-- Doctores -->
                <div class="card">
                    <div class="card-header">
                        <h3>Doctores</h3>
                    </div>
                    <div class="card-body">
                        <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <hr>
                    <div class="card-footer">
                        <a href="Doctores">Doctores</a>
                    </div>
                </div>
                <!-- Usarios -->
                <div class="card">
                    <div class="card-header">
                        <h3>Usuarios</h3>
                    </div>
                    <div class="card-body">
                        <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <hr>
                    <div class="card-footer">
                        <a href="Usuarios">Usuarios</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>