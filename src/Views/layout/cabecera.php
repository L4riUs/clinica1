<div class="titulo-cabezera" style="display: flex; justify-content: space-between;">
    <!-- Creamos un svg que va a ser nuestro botón de colapso que seran 3 barras verticales -->
    <div style="display: flex; justify-content: center;">
        <svg width="50px" height="50px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="header-collapse" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" xml:space="preserve">
            <style type="text/css">
                .st0 {
                    fill: #231F20;
                }
            </style>
            <g>
                <g>
                    <path class="st0" d="M381,190.9H131c-11,0-20-9-20-20s9-20,20-20h250c11,0,20,9,20,20S392,190.9,381,190.9z" />
                </g>
                <g>
                    <path class="st0" d="M381,361.1H131c-11,0-20-9-20-20s9-20,20-20h250c11,0,20,9,20,20S392,361.1,381,361.1z" />
                </g>
                <g>
                    <path class="st0" d="M381,276H131c-11,0-20-9-20-20s9-20,20-20h250c11,0,20,9,20,20S392,276,381,276z" />
                </g>
            </g>
        </svg>
        <div>
            <h2><?php echo $titulo; ?></h2>
            <p><?php echo $descripcion; ?></p>
        </div>
    </div>
    <div style="display: flex; justify-content: center; flex-wrap: wrap; align-items: center;">
        <a href="?c=Login&a=Logout" style="text-decoration: none; color: black; margin-right: 10px;">
            <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
            <svg fill="#000000" height="30px" width="30px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 384.971 384.971" xml:space="preserve">
                <g>
                    <g id="Sign_Out">
                        <path d="M180.455,360.91H24.061V24.061h156.394c6.641,0,12.03-5.39,12.03-12.03s-5.39-12.03-12.03-12.03H12.03
                            C5.39,0.001,0,5.39,0,12.031V372.94c0,6.641,5.39,12.03,12.03,12.03h168.424c6.641,0,12.03-5.39,12.03-12.03
                            C192.485,366.299,187.095,360.91,180.455,360.91z" />
                        <path d="M381.481,184.088l-83.009-84.2c-4.704-4.752-12.319-4.74-17.011,0c-4.704,4.74-4.704,12.439,0,17.179l62.558,63.46H96.279
                            c-6.641,0-12.03,5.438-12.03,12.151c0,6.713,5.39,12.151,12.03,12.151h247.74l-62.558,63.46c-4.704,4.752-4.704,12.439,0,17.179
                            c4.704,4.752,12.319,4.752,17.011,0l82.997-84.2C386.113,196.588,386.161,188.756,381.481,184.088z" />
                    </g>
                </g>
            </svg>
        </a>
    </div>
</div>