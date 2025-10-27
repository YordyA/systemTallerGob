<?php
if (!isset($_GET['id']) || $_GET['id'] == '' || !isset($_POST['cant']) || $_POST['cant'] == '') {
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
require_once '../inventario/inventarioMain.php';
require_once 'serviciosMain.php';

$IDInv = desencriptar($_GET['id']);
$cantidad = limpiarCadena($_POST['cant']);
$consulta = inventarioVerificarXID([$IDInv]);
if ($consulta->rowCount() != 1) {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "EL PRODUCTO / SERVICIO NO SE ENCUENTRA REGISTRADO",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}
$consulta = $consulta->fetch(PDO::FETCH_ASSOC);

if ($consulta['TipoExistencia'] == 1 && $consulta['Existencia'] < $cantidad) {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "EL PRODUCTO NO POSEE EXISTENCIA SUFICIENTE",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}

if (!isset($_SESSION['systemTaller']['servicios']['detalle'][$IDInv])) {
  $_SESSION['systemTaller']['servicios']['detalle'][$IDInv] = [
    'codigo'          => $consulta['CodigoInv'],
    'descripcion'     => $consulta['DescripcionInv'],
    'disponibilidad'  => ($consulta['TipoExistencia'] == 2) ? 'DESACTIVADO' : $consulta['Existencia'],
    'cantidad'        => $cantidad,
    'precio'          => $consulta['PrecioInv']
  ];
} else {
  $_SESSION['systemTaller']['servicios']['detalle'][$IDInv]['disponibilidad'] = ($consulta['TipoExistencia'] == 2) ? 'DESACTIVADO' : $consulta['Existencia'];
  $_SESSION['systemTaller']['servicios']['detalle'][$IDInv]['cantidad'] = $cantidad;
  $_SESSION['systemTaller']['servicios']['detalle'][$IDInv]['precio'] =  $consulta['PrecioInv'];
}

$alerta = [
  "alerta"  => "simple",
  "titulo"  => "¡AGREGADO!",
  "texto"   => "EL PRODUCTO / SERVICIO HA SIDO AGREGADO",
  "tipo"    => "success"
];
echo json_encode($alerta);
exit();