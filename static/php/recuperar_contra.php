<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "p4t5z8n7_dividendomx");
if (mysqli_connect_errno()) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    
    // Verificar si el correo existe en la base de datos
    $query = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) > 0) {
        // Si el correo existe, generar un token único
        $token = bin2hex(random_bytes(50));
        
        // Guardar el token en la base de datos para su uso posterior
        $updateQuery = "UPDATE usuarios SET token_recuperacion = '$token' WHERE correo = '$correo'";
        mysqli_query($conexion, $updateQuery);
        
        // Enviar el enlace de recuperación de contraseña por correo
        $enlace = "/static/restablecer_contrasena.php?token=" . $token;
        $asunto = "Recupera tu contraseña";
        $mensaje = "Haz clic en el siguiente enlace para recuperar tu contraseña: " . $enlace;
        
        // Asegúrate de configurar correctamente la función mail() en tu servidor
        if (mail($correo, $asunto, $mensaje)) {
            echo "Se ha enviado un enlace de recuperación a tu correo.";
        } else {
            echo "Error al enviar el correo de recuperación.";
        }
    } else {
        echo "El correo proporcionado no está registrado.";
    }
}

mysqli_close($conexion);
?>
