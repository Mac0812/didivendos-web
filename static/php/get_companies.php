<?php
include 'conexion_be.php';


$sql = "SELECT * FROM empresas";
$result = $conexion->query($sql);

$companies = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $companies[] = $row;
    }
}

$conexion->close();

echo json_encode($companies);
