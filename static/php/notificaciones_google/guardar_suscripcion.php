<?php
// guardar_suscripcion.php
$data = json_decode(file_get_contents('php://input'), true);
$subscription = $data['subscription'];

// Guarda la suscripción en la base de datos
// ...

echo 'Suscripción guardada exitosamente';
?>
