<?php
    session_start();
    if (isset($_SESSION['usuario'])) {
        header ("location:/index.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="shortcut icon" href="/static/assets/Iconos/logo.png" />
    <title>Dividendos MX</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/static/assets/css/estilos.css" />
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

            <div class="contenedor__login-register">
                <form action="/static/php/login_usuario_be.php" method="POST" class="formulario__login">
                    <h2>Iniciar Sesión</h2>
                    <input type="text" placeholder="Correo Electronico" name="correo" />
                    <div class="conter">
                        <input type="password" placeholder="Contraseña" name="contrasena" id="pass_login" />
                        <i class='bx bx-show-alt' id="toggleLoginPassword"></i>
                    </div>
                    <button>Entrar</button>
                </form>

                <form action="/static/php/registro_usuario_be.php" method="POST" class="formulario__register">
                    <h2>Regístrarse</h2>
                    <input type="text" placeholder="Nombre completo" name="nombre_completo" />
                    <input type="text" placeholder="Correo Electronico" name="correo" />
                    <div class="conter">
                        <input type="password" placeholder="Contraseña" name="contrasena" id="pass_register" />
                        <i class='bx bx-show-alt' id="toggleRegisterPassword"></i>
                    </div>
                    <button>Regístrarse</button>
                </form>
            </div>
        </div>
    </main>

    <script src="/static/assets/js/script.js"></script>
</body>
</html>
