<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "p4t5z8n7_dividendomx");
if (mysqli_connect_errno()) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$mensaje = "";
$token = $_GET['token'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nueva_contrasena = $_POST['contrasena'];
    
    // Verificar el token en la base de datos
    $query = "SELECT * FROM usuarios WHERE token_recuperacion = '$token'";
    $resultado = mysqli_query($conexion, $query);
    
    if (mysqli_num_rows($resultado) > 0) {
        // Si el token es válido, actualizar la contraseña
        $nueva_contrasena_hash = password_hash($nueva_contrasena, PASSWORD_BCRYPT);
        $updateQuery = "UPDATE usuarios SET contrasena = '$nueva_contrasena_hash', token_recuperacion = NULL WHERE token_recuperacion = '$token'";
        mysqli_query($conexion, $updateQuery);
        
        $mensaje = "Tu contraseña ha sido actualizada exitosamente.";
    } else {
        $mensaje = "Token inválido o expirado.";
    }
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="/static/assets/Iconos/logo.png" />
    <title>Dividendos MX - Restablecer Contraseña</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/static/assets/css/estilos.css" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .contenedor__restablecer {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .contenedor__restablecer h2 {
            margin: 0 0 20px;
        }
        .contenedor__restablecer input {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .contenedor__restablecer button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .contenedor__restablecer button:hover {
            background-color: #0056b3;
        }
        .mensaje {
            margin: 10px 0;
            color: #d9534f;
        }
    </style>
</head>
<body>
    <div class="contenedor__restablecer">
        <h2>Restablecer Contraseña</h2>
        <?php if ($mensaje): ?>
            <p class="mensaje"><?php echo $mensaje; ?></p>
        <?php endif; ?>
        <?php if (!$mensaje || $mensaje === "Tu contraseña ha sido actualizada exitosamente."): ?>
            <form action="restablecer_contrasena.php?token=<?php echo htmlspecialchars($token); ?>" method="POST">
                <input type="password" placeholder="Nueva Contraseña" name="contrasena" required />
                <button type="submit">Actualizar Contraseña</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
