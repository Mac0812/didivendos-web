<?php
include 'conexion_be.php';


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
