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
require_once '../sessionStart.php';
require_once '../dependencias.php';
require_once 'inventarioMain.php';

$IDInv = desencriptar($_GET['id']);
$responsable = $_SESSION['systemTaller']['nombreUsuario'];
$consulta = inventarioVerificarXID([$IDInv]);
if ($consulta->rowCount() != 1) {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "EL PRODUCTO NO SE ENCUENTRA REGISTRADO",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}
$consulta = $consulta->fetch(PDO::FETCH_ASSOC);

$cantidadEgresar = limpiarCadena($_POST['cant']);
$concepto = strtoupper(limpiarCadena($_POST['concepto']));
if ($cantidadEgresar == '' || $concepto == '') {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}

inventarioExistenciaRetirar([$cantidadEgresar, $IDInv]);
inventarioMovimientoRegistrar([date('Y-m-d'), 2, $IDInv, $consulta['Existencia'], $cantidadEgresar, $IDInv, $concepto, $responsable]);
$alerta = [
  "alerta"  => "actualizacion",
  "titulo"  => "¡ACTUALIZADO!",
  "texto"   => "LLA CANTIDAD HA SIDO EGRESADA CON EXITO",
  "tipo"    => "success"
];
echo json_encode($alerta);
exit();