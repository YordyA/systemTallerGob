<?php
require_once '../main.php';
require_once '../dependencias.php';
require_once '../sessionStart.php';
require_once 'usuariosMain.php';

$nombreUsuario = strtoupper(limpiarCadena($_POST['nombreUsuario']));
$usuario = limpiarCadena($_POST['usuario']);
$IDPrivilegio = desencriptar($_POST['IDPrivilegio']);
$clave1 = limpiarCadena($_POST['clave1']);
$clave2 = limpiarCadena($_POST['clave2']);
if ($nombreUsuario == '' || $usuario == '' || $IDPrivilegio == '' || $clave1 == '' || $clave2 == '') {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}

if (usuariosVerificarXUSUARIO([$usuario])->rowCount() > 0) {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "EL USUARIO INGRESADO YA SE ENCUENTRA REGISTRADO",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}
if ($clave1 != $clave2) {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "LAS CLAVE INGRESADAS NO COINCIDEN",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
} else {
  $clave = password_hash($clave1, PASSWORD_BCRYPT, ['cost' => 10]);
}

usuariosRegistrar([$IDPrivilegio, $nombreUsuario, $usuario, $clave]);
$alerta = [
  "alerta"  => "limpiar",
  "titulo"  => "¡REGISTRADO!",
  "texto"   => "EL USUARIO HA SIDO REGISTRADO CON EXITO",
  "tipo"    => "success"
];
echo json_encode($alerta);
exit();
