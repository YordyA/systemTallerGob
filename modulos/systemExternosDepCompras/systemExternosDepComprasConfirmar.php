<?php
if (!isset($_GET['id']) || $_GET['id'] == '' || !isset($_GET['tipo']) || $_GET['tipo'] == '' || !isset($_POST['clave']) || $_POST['clave'] == '') {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "TODOS LOS CAMPOS QUE SON OBLIGATORIO",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}

require_once '../main.php';
require_once '../dependencias.php';
require_once '../sessionStart.php';
require_once '../usuarios/usuariosMain.php';
require_once 'systemExternosDepComprasMain.php';

$IDCompra = desencriptar($_GET['id']);
$tipo = desencriptar($_GET['tipo']);
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
$consultaUsuario = $consultaUsuario->fetch(pdo::FETCH_ASSOC);

if (!password_verify($clave, $consultaUsuario['Clave'])) {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "LA CLAVE INGRESADA ES INCORRECTA",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}

systemExternosDepComprasActualizarEstado($tipo, [$fechaHoraModificacion . ' - ' . $consultaUsuario['NombreUsuario'], $IDCompra]);
$alerta = [
  "alerta"  => "volver",
  "titulo"  => "¡CONFIRMADO!",
  "texto"   => "LA COMPRA HA SIDO CONFIRMADA CON EXITO",
  "tipo"    => "success"
];
echo json_encode($alerta);
exit();