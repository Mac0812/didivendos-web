<?php
session_start();
include 'conexion_be.php';

// Verificar si la sesión está iniciada y la variable $_SESSION['usuario'] está definida
if (isset($_SESSION['usuario'])) {
    $id_usuario = $_SESSION['usuario'];

    // Consulta para obtener las notificaciones (sin filtrar por usuario)
    $sqlNotificaciones = "
        SELECT mensaje 
        FROM notificaciones
    ";
    $stmtNotificaciones = $conexion->prepare($sqlNotificaciones);
    if (!$stmtNotificaciones) {
        echo "Error al preparar la consulta: " . $conexion->error;
        exit();
    }
    $stmtNotificaciones->execute();
    $resultNotificaciones = $stmtNotificaciones->get_result();

    $notificaciones = array();
    while ($row = $resultNotificaciones->fetch_assoc()) {
        $notificaciones[] = array(
            "mensaje" => $row['mensaje'],
        );
    }

    $response = array(
        "notificaciones" => $notificaciones,
    );

    echo json_encode($response);
} else {
    echo json_encode(array("error" => "No hay sesión iniciada."));
}

$conexion->close();
