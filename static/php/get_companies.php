<?php
$conexion = mysqli_connect("localhost", "root", "", "p4t5z8n7_dividendoMX");//ya se hizo la conexion
if (mysqli_connect_errno()) {
    die("Conexi��n fallida: " . mysqli_connect_error());
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
