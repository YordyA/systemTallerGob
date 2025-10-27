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
require_once 'vehiculosMain.php';

$responsable = $_SESSION['systemTaller']['nombreUsuario'];
$IDVehiculo = desencriptar($_GET['id']);
$consulta = vehiculosVerificarXID([$IDVehiculo]);
if ($consulta->rowCount() != 1) {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "EL VEHICULO NO SE ENCUENTRA REGISTRADO",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}
$consulta = $consulta->fetch(PDO::FETCH_ASSOC);

$IDEmpresa = desencriptar($_POST['IDEmpresa']);
$IDCentroCosto = desencriptar($_POST['IDCentroCosto']);
$codigoVehiculo = strtoupper(limpiarCadena($_POST['codigoVehiculo']));
$yearVehiculo = strtoupper(limpiarCadena($_POST['yearVehiculo']));
$modeloVehiculo = strtoupper(limpiarCadena($_POST['modeloVehiculo']));
$colorVehiculo = strtoupper(limpiarCadena($_POST['colorVehiculo']));
$placaVehiculo = strtoupper(limpiarCadena($_POST['placaVehiculo']));
$marcaVehiculo = strtoupper(limpiarCadena($_POST['marcaVehiculo']));
$serialVehiculo = strtoupper(limpiarCadena($_POST['serialVehiculo']));
if ($IDEmpresa == '' || $IDCentroCosto == '' || $codigoVehiculo == '' || $placaVehiculo == '' || $yearVehiculo == '' || $modeloVehiculo == '' || $marcaVehiculo == '' || $serialVehiculo == '') {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}

if ($consulta['CodigoVehiculo'] != $codigoVehiculo) {
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
}

if ($consulta['PlacaVehiculo'] != $placaVehiculo) {
  if (vehiculosVerificarXPLACAVEHICULO([$placaVehiculo])->rowCount() > 0) {
    $alerta = [
      "alerta"  => "simple",
      "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
      "texto"   => "LA PLACA DEL VEHICULO YA SE ENCUENTRA REGISTRADA",
      "tipo"    => "error"
    ];
    echo json_encode($alerta);
    exit();
  }
}

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
  $urlImg = $consulta['UrlImagenVehiculo'];
}

vehiculosActualizar(
  [
    $IDEmpresa,
    $IDCentroCosto,
    $codigoVehiculo,
    $yearVehiculo,
    $marcaVehiculo,
    $modeloVehiculo,
    $placaVehiculo,
    $serialVehiculo,
    $colorVehiculo,
    $urlImg,
    ($fechaHoraModificacion . ' - ' . $responsable),
    $IDVehiculo
  ]
);
$alerta = [
  "alerta"  => "volver",
  "titulo"  => "¡ACTUALIZADO!",
  "texto"   => "EL VEHICULO HA SIDO ACTUALIZADO CON EXITO",
  "tipo"    => "success"
];
echo json_encode($alerta);
exit();