<?php 
include 'conexion_be.php';

$correo = $_POST['correo'];

$contrasena = $_POST['contrasena'];
$nombre_completo = $_POST ['nombre_completo'];

//se va a encriptar la contraseña
$contrasena = hash('sha512',$contrasena);

$query = "INSERT INTO usuarios (nombre_completo, correo, contrasena) 
VALUES ('$nombre_completo', '$correo', '$contrasena')";

//verificar  que el correo no se repita en la base de datos
$verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'");
if(mysqli_num_rows($verificar_correo) > 0){
    echo '
        <script>
        alert("Este correo ya esta registrado, intenta con otro correo diferente");
         window.location = "../pages-sign-in.php";
    </script>
    ';
    exit();
}

//verificar  que el nombre de usuario no se repita en la base de datos
$verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'");
if(mysqli_num_rows($verificar_usuario) > 0){
    echo '<script>
        alert("Este usuario ya esta registrado, intenta con otro correo diferente");
         window.location = "../pages-sign-in.php";
    </script>
    ';
    exit();
}



$resultado = mysqli_query($conexion, $query);

if ($resultado) {
   echo 
    '<script>
        alert("Usuario registrado");
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
