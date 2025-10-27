<?php
if (!isset($_GET['id']) || $_GET['id'] == '') {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}

require_once '../main.php';
require_once '../dependencias.php';
require_once '../sessionStart.php';

$indice = desencriptar($_GET['id']);
if (count($_SESSION['systemTaller']['servicios']['detalle']) > 1) {
  unset($_SESSION['systemTaller']['servicios']['detalle'][$indice]);
} else {
  unset($_SESSION['systemTaller']['servicios']['detalle']);
}

$alerta = [
  "alerta"  => "simple",
  "titulo"  => "¡ELIMINADO!",
  "texto"   => "EL PRODUCTO / SERVICIO HA SIDO ELIMINADO",
  "tipo"    => "success"
];
echo json_encode($alerta);