<?php
$conexion = mysqli_connect("localhost", "root", "", "login_register_bd");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$sql = "SELECT * FROM dividendos";
$result = $conexion->query($sql);

$dividendos = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dividendos[] = $row;
    }
}

$conexion->close();

echo json_encode($dividendos);
