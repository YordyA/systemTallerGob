<?php
require_once '../main.php';
require_once '../sessionStart.php';
require_once '../dependencias.php';
require_once 'vehiculosMain.php';

$IDCentroCosto = desencriptar($_POST['IDCentroCosto']);
$codigoVehiculo = strtoupper(limpiarCadena($_POST['codigoVehiculo']));
$yearVehiculo = strtoupper(limpiarCadena($_POST['yearVehiculo']));
$modeloVehiculo = strtoupper(limpiarCadena($_POST['modeloVehiculo']));
$colorVehiculo = strtoupper(limpiarCadena($_POST['colorVehiculo']));
$placaVehiculo = strtoupper(limpiarCadena($_POST['placaVehiculo']));
$marcaVehiculo = strtoupper(limpiarCadena($_POST['marcaVehiculo']));
$serialVehiculo = strtoupper(limpiarCadena($_POST['serialVehiculo']));
if ($IDCentroCosto == '' || $codigoVehiculo == '' || $placaVehiculo == '' || $yearVehiculo == '' || $modeloVehiculo == '' || $marcaVehiculo == '' || $serialVehiculo == '') {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}

if (vehiculosVerificarXCODIGO([$codigoVehiculo])->rowCount() > 0) {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "EL CODIGO DEL VEHICULO YA SE ENCUENTRA REGISTRADO",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}

// if (vehiculosVerificarXPLACAVEHICULO([$placaVehiculo])->rowCount() > 0) {
//   $alerta = [
//     "alerta"  => "simple",
//     "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
//     "texto"   => "LA PLACA DEL VEHICULO YA SE ENCUENTRA REGISTRADO",
//     "tipo"    => "error"
//   ];
//   echo json_encode($alerta);
//   exit();
// }

if (isset($_FILES['fotoVehiculo']) && $_FILES['fotoVehiculo']['name'] != '') {
  if ($_FILES['fotoVehiculo']['error'] !== 0) {
    $alerta = [
      "alerta"  => "simple",
      "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
      "texto"   => "HUBO UN ERROR AL INTENTAR SUBIR LA IMAGEN",
      "tipo"    => "error"
    ];
    echo json_encode($alerta);
    exit();
  }

  $urlImg = 'img/' . uniqid() . '-' . basename($_FILES['fotoVehiculo']['name']);
  if (!move_uploaded_file($_FILES['fotoVehiculo']['tmp_name'], $urlImg)) {
    $alerta = [
      "alerta"  => "simple",
      "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
      "texto"   => "HUBO UN ERROR AL INTENTAR SUBIR LA IMAGEN",
      "tipo"    => "error"
    ];
    echo json_encode($alerta);
    exit();
  }
} else {
  $urlImg = null;
}

vehiculosRegistrar(
  [
    1,
    $IDCentroCosto,
    $codigoVehiculo,
    $yearVehiculo,
    $marcaVehiculo,
    $modeloVehiculo,
    $placaVehiculo,
    $serialVehiculo,
    $colorVehiculo,
    $urlImg
  ]
);

$alerta = [
  "alerta"  => "limpiar",
  "titulo"  => "¡REGISTRADO!",
  "texto"   => "EL VEHICULO HA SIDO REGISTRADO CON EXITO",
  "tipo"    => "success"
];
echo json_encode($alerta);
exit();