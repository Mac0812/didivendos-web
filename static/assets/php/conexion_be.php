<?php
$conexion = mysqli_connect("localhost","root","Loki.18180199","login_register_db");
if (!$conexion) {
    echo 'conectado exitosamente a la Base de Datos';
} else{
    echo 'No se ha podido conectar a la base de datos';
    }
?>