<?php
// enviar_notificaciones.php

function enviarNotificacion($suscripcion) {
  $url = 'https://fcm.googleapis.com/fcm/send';
  $fields = [
    'to' => $suscripcion['endpoint'],
    'notification' => [
      'title' => 'Notificación de Dividendo',
      'body' => 'SE AGREGO UN NUEVO DIVIDENDO',
      'icon' => 'icon.png' // Cambia esto a la ruta de tu icono
    ]
  ];

  $headers = [
    'Authorization: key=TU_FCM_SERVER_KEY',
    'Content-Type: application/json'
  ];

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
  $result = curl_exec($ch);
  curl_close($ch);

  return $result;
}

