<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "dividendosMX");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener y sanitizar los datos enviados por POST
$event_id = isset($_POST['event-id']) ? $_POST['event-id'] : null;
$empresa = mysqli_real_escape_string($conexion, $_POST['event-empresa']);
$ticker = mysqli_real_escape_string($conexion, $_POST['event-ticker']);
$monto = mysqli_real_escape_string($conexion, $_POST['event-costo']);
$moneda =mysqli_real_escape_string($conexion, $_POST['event-moneda']);
$comentario = mysqli_real_escape_string($conexion, $_POST['event-comentario']);
$exento_impuesto = mysqli_real_escape_string($conexion, $_POST['event-exento']);
$fecha_pago = mysqli_real_escape_string($conexion, $_POST['event-date']);
$fecha_ex_derecho = mysqli_real_escape_string($conexion, $_POST['event-ex-derecho']);
$fecha_limite = mysqli_real_escape_string($conexion, $_POST['event-limite']);
$precio_titulo = mysqli_real_escape_string($conexion, $_POST['event-precio']);
$rendimiento = mysqli_real_escape_string($conexion, $_POST['event-rendimiento']);
$link_aviso = mysqli_real_escape_string($conexion, $_POST['event-aviso']);

// Formatear las fechas para MySQL
$fecha_pago = $fecha_pago ? date("Y-m-d", strtotime($fecha_pago)) : null;
$fecha_ex_derecho = $fecha_ex_derecho ? date("Y-m-d", strtotime($fecha_ex_derecho)) : null;
$fecha_limite = $fecha_limite ? date("Y-m-d", strtotime($fecha_limite)) : null;

if ($event_id) {
    // Actualizar evento existente
    $stmt = $conexion->prepare("UPDATE dividendos SET empresa=?, ticker=?, monto=?,moneda=?, comentario=?, exento_impuesto=?, fecha_pago=?, fecha_ex_derecho=?, fecha_limite=?, precio_titulo=?, rendimiento=?, link_aviso=? WHERE id=?");
    $stmt->bind_param("sssssssssssi", $empresa, $ticker, $monto,$moneda, $comentario, $exento_impuesto, $fecha_pago, $fecha_ex_derecho, $fecha_limite, $precio_titulo, $rendimiento, $link_aviso, $event_id);
} else {
    // Insertar nuevo evento
    $stmt = $conexion->prepare("INSERT INTO dividendos (empresa, ticker, monto, moneda, comentario, exento_impuesto, fecha_pago, fecha_ex_derecho, fecha_limite, precio_titulo, rendimiento, link_aviso) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $empresa, $ticker, $monto,$moneda, $comentario, $exento_impuesto, $fecha_pago, $fecha_ex_derecho, $fecha_limite, $precio_titulo, $rendimiento, $link_aviso);
}

$response = array();
if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['message'] = $stmt->error;
}

$stmt->close();
$conexion->close();

header('Content-Type: application/json');
echo json_encode($response);
