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
require_once 'vehiculosMain.php';

$responsable = $_SESSION['systemTaller']['nombreUsuario'];
$IDVehiculo = desencriptar($_GET['id']);
$consulta = vehiculosVerificarXID([$IDVehiculo]);
if ($consulta->rowCount() != 1) {
  $alerta = [
    "alerta"  => "simple",
    "titulo"   => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "EL VEHICULO NO SE ENCUENTRA REGISTRADO",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}
$consulta = $consulta->fetch(PDO::FETCH_ASSOC);

vehiculosActualizarEstado([0, ($fechaHoraModificacion . ' - ' . $responsable), $IDVehiculo]);
$alerta = [
  "alerta"  => "actualizacion",
  "titulo"  => "!ELIMINADO!",
  "texto"   => "EL VEHICULO HA SIDO ELIMINADO CON EXITO",
  "tipo"    => "success"
];
echo json_encode($alerta);
