<?php
if (!isset($_GET['id']) && $_GET['id'] == '') {
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
require_once 'inventarioMain.php';

$responsable = $_SESSION['systemTaller']['nombreUsuario'];
$IDInv = desencriptar($_GET['id']);
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

$IDTipoInv = desencriptar($_POST['IDTipoInv']);
$codigoInv = strtoupper(limpiarCadena($_POST['codigoInv']));
$descripcionInv = strtoupper(limpiarCadena($_POST['descripcionInv']));
$precioInv = limpiarCadena($_POST['precioInv']);
if ($IDTipoInv == '' || $codigoInv == '' || $descripcionInv == '' || $precioInv == '') {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}

if ($consulta['IDTipoInv'] != $IDTipoInv || $consulta['CodigoInv'] != $codigoInv) {
  if (inventarioVerificarXCODIGO([$IDTipoInv, $codigoInv])->rowCount() > 0) {
    $alerta = [
      "alerta"  => "simple",
      "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
      "texto"   => "EL CODGIO DEL PRODUCTO / SERVICIO YA SE ENCUENTRA REGISTRADO",
      "tipo"    => "error"
    ];
    echo json_encode($alerta);
    exit();
  }
}

inventarioActualizar(
  [
    $IDTipoInv,
    $codigoInv,
    $descripcionInv,
    $precioInv,
    ($fechaHoraModificacion . ' - ' . $responsable),
    $IDInv,
  ]
);
$alerta = [
  "alerta"  => "volver",
  "titulo"  => "¡REGISTRADO!",
  "texto"   => "EL PRODUCTO / SERVICIO HA SIDO ACTUALIZADO CON EXITO",
  "tipo"    => "success"
];
echo json_encode($alerta);
exit();
