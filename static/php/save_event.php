<?php
header('Content-Type: application/json');

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "dividendosMX");
if ($conexion->connect_error) {
    die(json_encode(array("success" => false, "message" => "Conexión fallida: " . $conexion->connect_error)));
}

// Obtener y sanitizar los datos enviados por POST
$event_id = isset($_POST['event-id']) ? $_POST['event-id'] : null;
$empresa = mysqli_real_escape_string($conexion, $_POST['event-empresa']);
$ticker = mysqli_real_escape_string($conexion, $_POST['event-ticker']);
$monto = mysqli_real_escape_string($conexion, $_POST['event-costo']);
$moneda = mysqli_real_escape_string($conexion, $_POST['event-moneda']);
$comentario = mysqli_real_escape_string($conexion, $_POST['event-comentario']);
$exento_impuesto = mysqli_real_escape_string($conexion, $_POST['event-exento']);
$fecha_pago = mysqli_real_escape_string($conexion, $_POST['event-date']);
$fecha_ex_derecho = mysqli_real_escape_string($conexion, $_POST['event-ex-derecho']);
$link_aviso = mysqli_real_escape_string($conexion, $_POST['event-aviso']);

// Formatear las fechas para MySQL
$fecha_pago = $fecha_pago ? date("Y-m-d", strtotime($fecha_pago)) : null;
$fecha_ex_derecho = $fecha_ex_derecho ? date("Y-m-d", strtotime($fecha_ex_derecho)) : null;

$response = array();

// Mensajes de depuración antes de preparar la consulta
error_log("event_id: " . $event_id);
error_log("empresa: " . $empresa);
error_log("ticker: " . $ticker);
error_log("monto: " . $monto);
error_log("moneda: " . $moneda);
error_log("comentario: " . $comentario);
error_log("exento_impuesto: " . $exento_impuesto);
error_log("fecha_pago: " . $fecha_pago);
error_log("fecha_ex_derecho: " . $fecha_ex_derecho);
error_log("link_aviso: " . $link_aviso);

if ($event_id) {
    // Actualizar evento existente
    $stmt = $conexion->prepare("UPDATE dividendos SET empresa=?, ticker=?, monto=?, moneda=?, comentario=?, exento_impuesto=?, fecha_pago=?, fecha_ex_derecho=?, link_aviso=? WHERE id=?");
    $stmt->bind_param("sssssssssi", $empresa, $ticker, $monto, $moneda, $comentario, $exento_impuesto, $fecha_pago, $fecha_ex_derecho, $link_aviso, $event_id);
} else {
    // Insertar nuevo evento
    $stmt = $conexion->prepare("INSERT INTO dividendos (empresa, ticker, monto, moneda, comentario, exento_impuesto, fecha_pago, fecha_ex_derecho, link_aviso) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $empresa, $ticker, $monto, $moneda, $comentario, $exento_impuesto, $fecha_pago, $fecha_ex_derecho, $link_aviso);
}

// Mensaje de depuración después de preparar la consulta
error_log("Consulta preparada: " . ($stmt ? "true" : "false"));

if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['message'] = $stmt->error;
    
    // Mensaje de depuración para errores en la ejecución de la consulta
    error_log("Error en la ejecución de la consulta: " . $stmt->error);
}

$stmt->close();
$conexion->close();

echo json_encode($response);
?>
