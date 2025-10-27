<?php
require_once '../main.php';
require_once '../dependencias.php';
require_once '../sessionStart.php';

unset($_SESSION['systemTaller']['servicios']['detalle']);
$alerta = [
  "alerta"  => "simple",
  "titulo"  => "¡CANCELADO!",
  "texto"   => "LA CARGA DE PRODUCTO / SERVICIO HA SIDO CANCELADA",
  "tipo"    => "success"
];
echo json_encode($alerta);