<?php
session_start();
include 'conexion_be.php';

// Verificar si se ha enviado el formulario para aceptar notificaciones
if (isset($_POST['aceptar_notificaciones']) && isset($_SESSION['usuario'])) {
    $correo = $_SESSION['usuario'];

    // Obtener el id del usuario a partir del correo
    $query_get_id = "SELECT id FROM usuarios WHERE correo = ?";
    $stmt_get_id = $conexion->prepare($query_get_id);
    if (!$stmt_get_id) {
        echo "Error al preparar la consulta: " . $conexion->error;
        exit();
    }
    $stmt_get_id->bind_param("s", $correo);
    $stmt_get_id->execute();
    $stmt_get_id->bind_result($id_usuario);
    $stmt_get_id->fetch();
    $stmt_get_id->close();

    if ($id_usuario) {
        $query_update = "UPDATE usuarios SET acepta_notificaciones = 1 WHERE id = ?";
        $stmt_update = $conexion->prepare($query_update);
        if (!$stmt_update) {
            echo "Error al preparar la consulta: " . $conexion->error;
            exit();
        }
        $stmt_update->bind_param("i", $id_usuario);

        if ($stmt_update->execute()) {
            echo "Se han guardado las preferencias de notificación correctamente.";
        } else {
            echo "Error al guardar las preferencias de notificación: " . $stmt_update->error;
        }

        $stmt_update->close();

        $query_check_existence = "SELECT COUNT(*) FROM usuarios_con_notificaciones WHERE id_usuario = ?";
        $stmt_check_existence = $conexion->prepare($query_check_existence);
        if (!$stmt_check_existence) {
            echo "Error al preparar la consulta: " . $conexion->error;
            exit();
        }
        $stmt_check_existence->bind_param("i", $id_usuario);
        $stmt_check_existence->execute();
        $stmt_check_existence->bind_result($count);
        $stmt_check_existence->fetch();
        $stmt_check_existence->close();

        if ($count == 0) {
            $query_insert = "INSERT INTO usuarios_con_notificaciones (id_usuario) VALUES (?)";
            $stmt_insert = $conexion->prepare($query_insert);
            if (!$stmt_insert) {
                echo "Error al preparar la consulta: " . $conexion->error;
                exit();
            }
            $stmt_insert->bind_param("i", $id_usuario);

            if ($stmt_insert->execute()) {
                echo "El usuario ha sido registrado para recibir notificaciones.";
            } else {
                echo "Error al registrar el usuario para recibir notificaciones: " . $stmt_insert->error;
            }

            $stmt_insert->close();
        } else {
            echo "El usuario ya está registrado para recibir notificaciones.";
        }
    } else {
        echo "Error: No se encontró el ID del usuario.";
    }
} else {
    echo "Error: No se ha enviado el formulario o no hay sesión iniciada.";
}

mysqli_close($conexion);
?>


