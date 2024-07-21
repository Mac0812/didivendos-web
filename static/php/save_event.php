<?php
include 'conexion_be.php';

// Obtener y sanitizar los datos enviados por POST
$event_id = isset($_POST['event-id']) ? $_POST['event-id'] : null;
$empresa = mysqli_real_escape_string($conexion, $_POST['event-empresa']);
$ticker = mysqli_real_escape_string($conexion, $_POST['event-ticker']);
$monto = mysqli_real_escape_string($conexion, $_POST['event-costo']);
$comentario = mysqli_real_escape_string($conexion, $_POST['event-comentario']);
$fecha_pago = mysqli_real_escape_string($conexion, $_POST['event-date']);
$fecha_ex_derecho = mysqli_real_escape_string($conexion, $_POST['event-ex-derecho']);
$link_aviso = mysqli_real_escape_string($conexion, $_POST['event-aviso']);

// Formatear las fechas para MySQL
$fecha_pago = $fecha_pago ? date("Y-m-d", strtotime($fecha_pago)) : null;
$fecha_ex_derecho = $fecha_ex_derecho ? date("Y-m-d", strtotime($fecha_ex_derecho)) : null;

$response = array();

// Mensajes de depuraci�1�7�1�7n antes de preparar la consulta
error_log("event_id: " . $event_id);
error_log("empresa: " . $empresa);
error_log("ticker: " . $ticker);
error_log("monto: " . $monto);
error_log("comentario: " . $comentario);
error_log("fecha_pago: " . $fecha_pago);
error_log("fecha_ex_derecho: " . $fecha_ex_derecho);
error_log("link_aviso: " . $link_aviso);

if ($event_id) {
    // Actualizar evento existente
    $stmt = $conexion->prepare("UPDATE dividendos SET empresa=?, ticker=?, monto=?, comentario=?, fecha_pago=?, fecha_ex_derecho=?, link_aviso=? WHERE id=?");
    $stmt->bind_param("sssssssi", $empresa, $ticker, $monto, $comentario, $fecha_pago, $fecha_ex_derecho, $link_aviso, $event_id);
} else {
    // Insertar nuevo evento
    $stmt = $conexion->prepare("INSERT INTO dividendos (empresa, ticker, monto, comentario,  fecha_pago, fecha_ex_derecho, link_aviso) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $empresa, $ticker, $monto, $comentario,  $fecha_pago, $fecha_ex_derecho, $link_aviso);
}

// Mensaje de depuraci�1�7�1�7n despu�1�7�1�7s de preparar la consulta
error_log("Consulta preparada: " . ($stmt ? "true" : "false"));

if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['message'] = $stmt->error;
    
    // Mensaje de depuraci�1�7�1�7n para errores en la ejecuci�1�7�1�7n de la consulta
    error_log("Error en la ejecucion en la consulta: " . $stmt->error);
}

$stmt->close();
$conexion->close();

echo json_encode($response);
?>

