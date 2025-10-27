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

$cantidadIngresar = limpiarCadena($_POST['cant']);
$costoUnitario = limpiarCadena($_POST['costoU']);
$concepto = strtoupper(limpiarCadena($_POST['concepto']));
if ($cantidadIngresar == '' || $costoUnitario == '' || $concepto == '') {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}

$costoPromedio = promediarPrecioCosto($cantidadIngresar, $costoUnitario, $consulta['PrecioInv'], $consulta['Existencia']);
inventarioExistenciaRellenarYActualizarCosto([$cantidadIngresar, $costoPromedio, $IDInv]);
inventarioMovimientoRegistrar([date('Y-m-d'), 1, $IDInv, $consulta['Existencia'], $cantidadIngresar, $IDInv, $concepto, $responsable]);
$alerta = [
  "alerta"  => "actualizacion",
  "titulo"  => "¡ACTUALIZADO!",
  "texto"   => "LLA CANTIDAD HA SIDO INGRESADA CON EXITO",
  "tipo"    => "success"
];
echo json_encode($alerta);
exit();