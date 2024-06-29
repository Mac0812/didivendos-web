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
$comentario = mysqli_real_escape_string($conexion, $_POST['event-comentario']);
$exento_impuesto = mysqli_real_escape_string($conexion, $_POST['event-exento']);
$fecha_pago = mysqli_real_escape_string($conexion, $_POST['event-date']);
$fecha_ex_derecho = mysqli_real_escape_string($conexion, $_POST['event-ex-derecho']);
$fecha_limite = mysqli_real_escape_string($conexion, $_POST['event-limite']);
$precio_titulo = mysqli_real_escape_string($conexion, $_POST['event-precio']);
$rendimiento = mysqli_real_escape_string($conexion, $_POST['event-rendimiento']);
$link_aviso = mysqli_real_escape_string($conexion, $_POST['event-aviso']);

// Formatear las fechas para MySQL
$fecha_pago = date("Y-m-d", strtotime($fecha_pago));
$fecha_ex_derecho = date("Y-m-d", strtotime($fecha_ex_derecho));
$fecha_limite = date("Y-m-d", strtotime($fecha_limite));

if ($event_id) {
    // Actualizar evento existente
    $stmt = $conexion->prepare("UPDATE dividendos SET empresa=?, ticker=?, monto=?, comentario=?, exento_impuesto=?, fecha_pago=?, fecha_ex_derecho=?, fecha_limite=?, precio_titulo=?, rendimiento=?, link_aviso=? WHERE id=?");
    $stmt->bind_param("sssssssssssi", $empresa, $ticker, $monto, $comentario, $exento_impuesto, $fecha_pago, $fecha_ex_derecho, $fecha_limite, $precio_titulo, $rendimiento, $link_aviso, $event_id);
} else {
    // Insertar nuevo evento
    $stmt = $conexion->prepare("INSERT INTO dividendos (empresa, ticker, monto, comentario, exento_impuesto, fecha_pago, fecha_ex_derecho, fecha_limite, precio_titulo, rendimiento, link_aviso) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $empresa, $ticker, $monto, $comentario, $exento_impuesto, $fecha_pago, $fecha_ex_derecho, $fecha_limite, $precio_titulo, $rendimiento, $link_aviso);
}

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}

$stmt->close();
$conexion->close();
