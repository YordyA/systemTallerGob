<?php
require_once '../main.php';
require_once '../dependencias.php';
require_once '../sessionStart.php';
require_once 'inventarioMain.php';

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

inventarioRegistrar(
  [
    $IDTipoInv,
    $codigoInv,
    $descripcionInv,
    0, //* Existencia inicial
    $precioInv
  ]
);
$alerta = [
  "alerta"  => "limpiar",
  "titulo"  => "¡REGISTRADO!",
  "texto"   => "EL PRODUCTO / SERVICIO HA SIDO REGISTRADO CON EXITO",
  "tipo"    => "success"
];
echo json_encode($alerta);
exit();