<?php
$host = "localhost";
$user = "p4t5z8n7";
$password = "C@sa-658!Ux4109@-1";  // Aseg��rate de que la contrase�0�9a sea correcta
$database = "p4t5z8n7_dividendoMX";

$conexion = mysqli_connect($host, $user, $password, $database);

if (mysqli_connect_errno()) {
    die("Conexi��n fallida: " . mysqli_connect_error());
}
?>
