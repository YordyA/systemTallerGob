<?php
if (!isset($_GET['id']) && $_GET['id'] == '' || !isset($_POST['clave']) && $_POST['clave'] == '') {
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
require_once '../inventario/inventarioMain.php';
require_once '../usuarios/usuariosMain.php';
require_once 'serviciosMain.php';

$IDServicioResumen = desencriptar($_GET['id']);
$clave = limpiarCadena($_POST['clave']);

$consultaUsuario = usuariosVerificarXID([$_SESSION['systemTaller']['IDUsuario']]);
if ($consultaUsuario->rowCount() != 1) {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "EL USUARIO NO SE ENCUENTRA REGISTRADO",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}
$consultaUsuario = $consultaUsuario->fetch(PDO::FETCH_ASSOC);
if (!password_verify($clave, $consultaUsuario['Clave'])) {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "LA CONTRASEÑA INGRESADA ES INCORRECTA",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}

$consultaServicio = serviciosConsultarXID([$IDServicioResumen]);
if ($consultaServicio->rowCount() == 0) {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "EL SERVICIO NO SE ENCUENTRA REGISTRADO",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}
$consultaServicio = $consultaServicio->fetchAll(PDO::FETCH_ASSOC);

foreach ($consultaServicio as $row) {
  if ($row['TipoExistencia'] == 2) {
    continue;
  }

  inventarioExistenciaRellenar([$row['Cantidad'], $row['IDInv']]);
  inventarioMovimientoRegistrar(
    [
      date('Y-m-d'),
      1,
      $row['IDInv'],
      $row['Existencia'],
      $row['Cantidad'],
      $row['IDInv'],
      'ANULACION DE SERVICIO NRO ' . generarCeros($row['NroNota'], 0, 5),
      $consultaUsuario['NombreUsuario']
    ]
  );
}
serviciosActualizarEstado([1, ($fechaHoraModificacion . ' - ' . $consultaUsuario['NombreUsuario']), $IDServicioResumen]);
$alerta = [
  "alerta"  => "volver",
  "titulo"  => "¡ANULADO!",
  "texto"   => "EL SERVICIO HA SIDO ANULADO CON EXITO",
  "tipo"    => "success"
];
echo json_encode($alerta);
exit();