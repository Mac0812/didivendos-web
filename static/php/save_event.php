<?php
include 'conexion_be.php';

$event_id = isset($_POST['event-id']) ? $_POST['event-id'] : null;
$empresa = mysqli_real_escape_string($conexion, $_POST['event-empresa']);
$ticker = mysqli_real_escape_string($conexion, $_POST['event-ticker']);
$monto = mysqli_real_escape_string($conexion, $_POST['event-costo']);
$comentario = mysqli_real_escape_string($conexion, $_POST['event-comentario']);
$fecha_pago = mysqli_real_escape_string($conexion, $_POST['event-date']);
$fecha_ex_derecho = mysqli_real_escape_string($conexion, $_POST['event-ex-derecho']);
$link_aviso = mysqli_real_escape_string($conexion, $_POST['event-aviso']);

$fecha_pago = $fecha_pago ? date("Y-m-d", strtotime($fecha_pago)) : null;
$fecha_ex_derecho = $fecha_ex_derecho ? date("Y-m-d", strtotime($fecha_ex_derecho)) : null;

$response = array();

if ($event_id) {
    $stmt = $conexion->prepare("UPDATE dividendos SET empresa=?, ticker=?, monto=?, comentario=?, fecha_pago=?, fecha_ex_derecho=?, link_aviso=? WHERE id=?");
    $stmt->bind_param("sssssssi", $empresa, $ticker, $monto, $comentario, $fecha_pago, $fecha_ex_derecho, $link_aviso, $event_id);
} else {
    $stmt = $conexion->prepare("INSERT INTO dividendos (empresa, ticker, monto, comentario, fecha_pago, fecha_ex_derecho, link_aviso) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $empresa, $ticker, $monto, $comentario, $fecha_pago, $fecha_ex_derecho, $link_aviso);
}

if ($stmt->execute()) {
    $last_id = $conexion->insert_id;
    $response['success'] = true;

    // Insertar notificación
    $titulo = "Nuevo Dividendo Publicado";
    $message = "Se ha publicado un nuevo dividendo:\n\nEmpresa: $empresa\nTicker: $ticker\nMonto: $monto\nFecha de Pago: $fecha_pago";

    $sqlNotificacion = "INSERT INTO notificaciones (titulo, mensaje) VALUES (?, ?)";
    $stmtNotificacion = $conexion->prepare($sqlNotificacion);

    if ($stmtNotificacion) {
        $stmtNotificacion->bind_param("ss", $titulo, $message);

        if ($stmtNotificacion->execute()) {
            $response['notificacion'] = 'Notificación insertada correctamente.';
        } else {
            $response['notificacion_error'] = 'Error al insertar la notificación: ' . $stmtNotificacion->error;
        }
        $stmtNotificacion->close();
    } else {
        $response['notificacion_error'] = 'Error al preparar la consulta: ' . $conexion->error;
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Error al guardar el evento: ' . $stmt->error;
}

$stmt->close();
$conexion->close();

echo json_encode($response);
