<?php
require_once '../main.php';
require_once '../sessionStart.php';
require_once '../dependencias.php';
require_once '../inventario/inventarioMain.php';
require_once '../tasaRef/tasaRefMain.php';
require_once 'serviciosMain.php';

if (!isset($_SESSION['systemTaller']['servicios']['detalle']) && count($_SESSION['systemTaller']['servicios']['detalle']) == 0) {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}

$responsable = $_SESSION['systemTaller']['nombreUsuario'];
$fechaServicio = limpiarCadena($_POST['fechaServicio']);
$IDTipoServicio = desencriptar($_POST['IDTipoServicio']);
$IDCentroCosto = desencriptar($_POST['IDCentroCosto']);
$IDVehiculo = desencriptar($_POST['IDVehiculo']);
$recibeCedula = strtoupper(limpiarCadena($_POST['recibeCedula']));
$recibeConforme = strtoupper(limpiarCadena($_POST['recibeConforme']));
$observacion = strtoupper(limpiarCadena($_POST['observacion']));
if ($fechaServicio == '' || $IDTipoServicio == '' || $IDCentroCosto == '' || $IDVehiculo == '' || $recibeCedula == '' || $recibeConforme == '' || $observacion == '') {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}

$consultaTasa = tasaRefConsultarXFecha([$fechaServicio]);
if ($consultaTasa->rowCount() == 0) {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "NO SE ENCONTRO UNA TASA DE REFERENCIA PARA LA FECHA",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}
$tasaRefUSD = $consultaTasa->fetch(PDO::FETCH_ASSOC)['TasaRefUSD'];

$nroNota = serviciosGenerarNroNota([$IDTipoServicio]);
$IDServicioResumen = serviciosRegistrarResumen(
  [
    $tasaRefUSD,
    $fechaServicio,
    $IDTipoServicio,
    $IDVehiculo,
    $nroNota,
    $recibeCedula,
    $recibeConforme,
    $observacion,
    $responsable,
    ($IDTipoServicio == 1 ? 3 : 2)
  ]
);

foreach ($_SESSION['systemTaller']['servicios']['detalle'] as $IDInv => $row) {
  $consultaInv = inventarioVerificarXID([$IDInv])->fetch(PDO::FETCH_ASSOC);
  serviciosRegistrarDetalle(
    [
      $IDServicioResumen,
      $IDInv,
      $row['cantidad'],
      $row['precio'],
      round($row['precio'] * $tasaRefUSD, 2)
    ]
  );

  if ($consultaInv['TipoExistencia'] == 1) {
    inventarioExistenciaRetirar([$row['cantidad'], $IDInv]);
    inventarioMovimientoRegistrar(
      [
        date('Y-m-d'),
        2,
        $IDInv,
        $consultaInv['Existencia'],
        $row['cantidad'],
        $IDInv,
        'SERVICIO NRO ' . generarCeros($nroNota, 0, 5),
        $responsable
      ]
    );
  }
}

unset($_SESSION['systemTaller']['servicios']);
$alerta = [
  "alerta"  => "simple",
  "url"     => "modulos/pdf/PDFNotaServicio.php",
  "titulo"  => "¡REGISTRADO!",
  "texto"   => "EL SERVICIO HA SIDO REGISTRADO CON EXITO",
  "tipo"    => "success"
];
echo json_encode($alerta);
exit();