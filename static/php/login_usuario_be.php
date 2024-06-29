<?php
session_start();
include 'conexion_be.php';
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$contrasena = hash('sha512', $contrasena);

//verificar los datos que esten registrados
$validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo ='$correo' 
and contrasena='$contrasena'");



if (mysqli_num_rows($validar_login) > 0) {
  $_SESSION['usuario'] = $correo;

  if ($correo == "renanRibero2024@gmail.com") {
    header("location:../pages-admin.php");
  } else {
    header("location:../index.php");
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
