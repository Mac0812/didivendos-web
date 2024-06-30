<?php
    session_start();
    if (isset($_SESSION['usuario'])) {
        header ("location:../static/index.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="/static/assets/Iconos/logo png-08.png" />
    <title>Dividendos MX</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet"
    />

    <link rel="stylesheet" href="assets/css/estilos.css" />
</head>
<body>
    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__registrarse">Regístrarse</button>
                </div>
            </div>

            <!--Formulario de Login y registro-->
            <div class="contenedor__login-register">
                <!--Login-->
                <form action="/static/php/login_usuario_be.php" method="POST" class="formulario__login">
                    <h2>Iniciar Sesión</h2>
                    <input type="text" placeholder="Correo Electronico" name="correo" />
                    <!-- Se agrega un id al campo de contraseña -->
                    <input type="password" placeholder="Contraseña" name="contrasena" id="contrasena_login" />
                    <!-- Se agrega la casilla de verificación para mostrar/ocultar la contraseña -->
                    <!-- INICIO DEL CÓDIGO AGREGADO -->
                    <div>
                        <input type="checkbox" id="mostrar_contrasena_login" onclick="togglePassword('contrasena_login')">
                        <label for="mostrar_contrasena_login">Mostrar Contraseña</label>
                    </div>
                    <!-- FIN DEL CÓDIGO AGREGADO -->
                    <button>Entrar</button>
                </form>

                <!--Register-->
                <form action="/static/php/registro_usuario_be.php" method="POST" class="formulario__register">
                    <h2>Regístrarse</h2>
                    <input type="text" placeholder="Nombre completo" name="nombre_completo" />
                    <input type="text" placeholder="Correo Electronico" name="correo" />
                    <input type="text" placeholder="Usuario" name="usuario" />
                    <!-- Se agrega un id al campo de contraseña -->
                    <input type="password" placeholder="Contraseña" name="contrasena" id="contrasena_register" />
                    <!-- Se agrega la casilla de verificación para mostrar/ocultar la contraseña -->
                    <!-- INICIO DEL CÓDIGO AGREGADO -->
                    <div>
                        <input type="checkbox" id="mostrar_contrasena_register" onclick="togglePassword('contrasena_register')">
                        <label for="mostrar_contrasena_register">Mostrar Contraseña</label>
                    </div>
                    <!-- FIN DEL CÓDIGO AGREGADO -->
                    <button>Regístrarse</button>
                </form>
            </div>
        </div>
    </main>

    <script src="assets/js/script.js"></script>
</body>
</html>
