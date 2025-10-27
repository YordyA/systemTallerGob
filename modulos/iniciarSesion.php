<?php
$usuario = limpiarCadena($_POST['usuario']);
$clave = limpiarCadena($_POST['clave']);

if ($usuario == '' || $clave == '') {
  echo "<script>
          swal.fire({
            icon: 'error',
            title: '¡OCURRIO UN ERROR INESPERADO!',
            text: 'TODOS LOS CAMPOS QUE SON OBLIGATORIOS'
              })
        </script>";
}

$consultarUsuario = usuariosVerificarXUSUARIO([$usuario]);
if ($consultarUsuario->rowCount() != 1) {
  echo "<script>
          swal.fire({
            icon: 'error',
            title: '¡OCURRIO UN ERROR INESPERADO!',
            text: 'USUARIO O CLAVE INCORRECTOS'
              })
        </script>";
  exit();
}

$consultarUsuario = $consultarUsuario->fetch(PDO::FETCH_ASSOC);
if (!password_verify($clave, $consultarUsuario['Clave'])) {
  echo "<script>
          swal.fire({
            icon: 'error',
            title: '¡OCURRIO UN ERROR INESPERADO!',
            text: 'USUARIO O CLAVE INCORRECTOS'
              })
        </script>";
  exit();
}

$consultaTasa = tasaRefConsultarXFecha([date('Y-m-d')]);
if ($consultaTasa->rowCount() != 1) {
  echo "<script>
          swal.fire({
            icon: 'error',
            title: '¡OCURRIO UN ERROR INESPERADO!',
            text: 'NO HAY TASA DE REFERENCIA PARA LA FECHA ACTUAL'
              })
        </script>";
  exit();
}
$consultaTasa = $consultaTasa->fetch(PDO::FETCH_ASSOC);

$_SESSION['systemTaller'] = [
  'IDUsuario'      => $consultarUsuario['IDUsuario'],
  'IDPrivilegio'   => $consultarUsuario['IDPrivilegio'],
  'nombreUsuario'  => $consultarUsuario['NombreUsuario'],
  'usuario'        => $consultarUsuario['Usuario'],
  'privilegio'     => $consultarUsuario['DescripcionPrivilegio'],
  'tasaRefUSD'     => $consultaTasa['TasaRefUSD'] ?? 0
];

if (headers_sent()) {
  echo "<script> window.location.href='bienvenidos'; </script>";
} else {
  header("Location: bienvenidos");
}
