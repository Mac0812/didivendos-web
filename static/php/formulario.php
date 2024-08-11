<?php
include 'conexion_be.php';
require 'send_mail.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Insertar en la base de datos
    $sql = "INSERT INTO formulario (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conexion->error);
    }

    // Vincular los parámetros
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        // Enviar el correo
        $to = "masdividendosmx@gmail.com"; // Reemplaza esto con tu correo personal
        $subject = "Tienes un nuevo mensaje de $name";
        $body = "Recibiste un nuevo mensaje.\n\n".
                "Nombre: $name\n".
                "Correo: $email\n".
                "Mensaje:\n$message";

        $mailResult = sendMail($to, $subject, $body, $email);

        if ($mailResult === true) {
            echo 
         '<script>
     
         window.location = "/index.php";
    </script>';

           
        } else {
            echo $mailResult;
        }
    } else {
        echo
        '<script>
        alert("Menssaje no enviado!");
         window.location = "/index.php";
    </script>'. $stmt->error;
    }

    $stmt->close();
}

$conexion->close();
?>
