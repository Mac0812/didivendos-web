<?php
header('Content-Type: application/json');

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "dividendosMX");
if ($conexion->connect_error) {
    die(json_encode(array("success" => false, "message" => "Conexión fallida: " . $conexion->connect_error)));
}

// Obtener y sanitizar los datos enviados por POST
$event_id = isset($_POST['event-id']) ? $_POST['event-id'] : null;
$empresa = isset($_POST['event-empresa']) ? mysqli_real_escape_string($conexion, $_POST['event-empresa']) : '';
$ticker = isset($_POST['event-ticker']) ? mysqli_real_escape_string($conexion, $_POST['event-ticker']) : '';
$monto = isset($_POST['event-costo']) ? mysqli_real_escape_string($conexion, $_POST['event-costo']) : '';
$comentario = isset($_POST['event-comentario']) ? mysqli_real_escape_string($conexion, $_POST['event-comentario']) : '';
$exento_impuesto = isset($_POST['event-exento']) ? mysqli_real_escape_string($conexion, $_POST['event-exento']) : '';
$fecha_pago = isset($_POST['event-date']) ? mysqli_real_escape_string($conexion, $_POST['event-date']) : '';
$fecha_ex_derecho = isset($_POST['event-ex-derecho']) ? mysqli_real_escape_string($conexion, $_POST['event-ex-derecho']) : '';
$link_aviso = isset($_POST['event-aviso']) ? mysqli_real_escape_string($conexion, $_POST['event-aviso']) : '';

// Formatear las fechas para MySQL
$fecha_pago = $fecha_pago ? date("Y-m-d", strtotime($fecha_pago)) : null;
$fecha_ex_derecho = $fecha_ex_derecho ? date("Y-m-d", strtotime($fecha_ex_derecho)) : null;

$response = array();

if ($event_id) {
    // Actualizar evento existente
    $stmt = $conexion->prepare("UPDATE dividendos SET empresa=?, ticker=?, monto=?, comentario=?, exento_impuesto=?, fecha_pago=?, fecha_ex_derecho=?, link_aviso=? WHERE id=?");
    $stmt->bind_param("ssssssssi", $empresa, $ticker, $monto, $comentario, $exento_impuesto, $fecha_pago, $fecha_ex_derecho, $link_aviso, $event_id);
} else {
    // Insertar nuevo evento
    $stmt = $conexion->prepare("INSERT INTO dividendos (empresa, ticker, monto, comentario, exento_impuesto, fecha_pago, fecha_ex_derecho, link_aviso) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $empresa, $ticker, $monto, $comentario, $exento_impuesto, $fecha_pago, $fecha_ex_derecho, $link_aviso);
}

if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['message'] = $stmt->error;
}

$stmt->close();
$conexion->close();

echo json_encode($response);
?>
