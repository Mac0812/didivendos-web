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
