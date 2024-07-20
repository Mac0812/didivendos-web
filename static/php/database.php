<?php

header('Content-Type: application/json');
include 'conexion_be.php';

$sql = "SELECT * FROM dividendos";
$result = $conexion->query($sql);

$dividendos = array();

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dividendos[] = $row;
        }
    }
} else {
    $response = array("error" => "Error al ejecutar la consulta: " . $conexion->error);
    echo json_encode($response);
    exit;
}

$conexion->close();

echo json_encode($dividendos);
?>
