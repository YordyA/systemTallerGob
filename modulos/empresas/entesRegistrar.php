<?php
require_once '../main.php';
require_once '../sessionStart.php';
require_once '../dependencias.php';
require_once './empresasMain.php';


$ente = strtoupper(limpiarCadena($_POST['ente']));

if ($ente == '') {
  $alerta = [
    "alerta"  => "simple",
    "titulo"  => "¡OCURRIO UN ERROR INESPERADO!",
    "texto"   => "TODOS LOS CAMPOS QUE SON OBLIGATORIOS",
    "tipo"    => "error"
  ];
  echo json_encode($alerta);
  exit();
}

empresastegistrar(
  [
    $ente
  ]
);

$alerta = [
  "alerta"  => "limpiar",
  "titulo"  => "¡REGISTRADO!",
  "texto"   => "EL CENTRO DE COSTO HA SIDO REGISTRADO CON EXITO",
  "tipo"    => "success"
];
echo json_encode($alerta);
exit();
