<?php
session_start();
include 'conexion_be.php';

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$contrasena = hash('sha512', $contrasena);

// Verificar los datos que estén registrados
$validar_login = mysqli_query($conexion, "SELECT nombre_completo FROM usuarios WHERE correo = '$correo' AND contrasena = '$contrasena'");

if (mysqli_num_rows($validar_login) > 0) {
  $row = mysqli_fetch_assoc($validar_login);
  $_SESSION['usuario'] = $correo;
  $_SESSION['nombre_completo'] = $row['nombre_completo'];

  if ($correo == "renanRibero2024@gmail.com") {
    header("location:../pages-admin.php");
  } else {
    header("location:../../index.php");
  }
  exit;
} else {
  echo '
    <script>
    alert("Correo o contraseña incorrectos");
    window.location = "../pages-sign-in.php";
    </script>
    ';
  exit;
}
