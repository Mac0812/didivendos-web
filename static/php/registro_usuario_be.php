<?php 
include 'conexion_be.php';

$nombre_completo = $_POST['nombre_completo'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$query = "INSERT INTO usuarios (nombre_completo, correo, usuario, contrasena) 
VALUES ('$nombre_completo', '$correo', '$usuario', '$contrasena')";

$resultado = mysqli_query($conexion, $query);

if ($resultado) {
   echo 
    '<script>
        alert("Usuario almacenado");
         window.location = "../pages-sign-in.php";
    </script>'
   ;
}else{
    echo 
    '<script>
        alert("Intentalo de nuevo");
         window.location = "../pages-sign-in.php";
    </script>';
}
?>
