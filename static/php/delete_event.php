<?php
// Conexi贸n a la base de datos
$host = "localhost";
$user = "p4t5z8n7";
$password = "C@sa-658!Ux4109@-1";  // Asegúrate de que la contraseña sea correcta
$database = "p4t5z8n7_dividendoMX";

$conexion = mysqli_connect($host, $user, $password, $database);
if ($conexion->connect_error) {
    die("Conexi贸n fallida: " . $conexion->connect_error);
}

// Obtener el ID del evento a eliminar
$event_id = isset($_POST['event-id']) ? $_POST['event-id'] : null;

// Eliminar evento de la base de datos
$stmt = $conexion->prepare("DELETE FROM dividendos WHERE id=?");
$stmt->bind_param("i", $event_id);

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
?>
