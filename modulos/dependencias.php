<?php
date_default_timezone_set('America/Caracas');
setlocale(LC_TIME, 'spanish');
const METHOD = 'AES-256-CBC';
const SECRET_KEY = '$TSU33218034@';
const SECRET_IV = '925642';

//* LIMPIAR CADENA DE TEXTO
function limpiarCadena($cadena)
{
  $cadena = trim($cadena);
  $cadena = stripslashes($cadena);
  $cadena = str_ireplace("<script>", "", $cadena);
  $cadena = str_ireplace("</script>", "", $cadena);
  $cadena = str_ireplace("<script src>", "", $cadena);
  $cadena = str_ireplace("<script type=>", "", $cadena);
  $cadena = str_ireplace("SELECT * FROM", "", $cadena);
  $cadena = str_ireplace("DELETE FROM", "", $cadena);
  $cadena = str_ireplace("INSERT INTO", "", $cadena);
  $cadena = str_ireplace("DROP TABLE", "", $cadena);
  $cadena = str_ireplace("DROP DATABASE", "", $cadena);
  $cadena = str_ireplace("SHOW DATABASES", "", $cadena);
  $cadena = str_ireplace("<?php", "", $cadena);
  $cadena = str_ireplace("--", "", $cadena);
  $cadena = str_ireplace("^", "", $cadena);
  $cadena = str_ireplace("<", "", $cadena);
  $cadena = str_ireplace("[", "", $cadena);
  $cadena = str_ireplace("]>", "", $cadena);
  $cadena = str_ireplace("==", "", $cadena);
  $cadena = str_ireplace(";", "", $cadena);
  $cadena = str_ireplace("::", "", $cadena);
  $cadena = trim($cadena);
  $cadena = stripslashes($cadena);
  return $cadena;
}

//* ENCRIPTAR CADENAS DE TEXTO
function encriptar($string)
{
  $output = false;
  $key = hash('sha256', SECRET_KEY);
  $iv = substr(hash('sha256', SECRET_IV), 0, 16);
  $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
  $output = base64_encode($output);
  return $output;
}

//* DESENCRIPTAR CADEDAS DE TEXTO
function desencriptar($string)
{
  $key = hash('sha256', SECRET_KEY);
  $iv = substr(hash('sha256', SECRET_IV), 0, 16);
  $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
  return $output;
}

//* RENDERIZAR INPUT
function renderInput($label, $name, $type, $value, $required = true, $rows = 1, $attr = '')
{
  $requiredAttr = $required ? 'required' : '';
  $fieldHtml = "<div class=\"mb-3\">
                  <label class=\"form-label text-dark\">$label</label>";
  if ($type == 'textarea') {
    $fieldHtml .= "<textarea class=\"form-control\" rows=\"$rows\" name=\"$name\" $requiredAttr $attr>$value</textarea>";
  } else {
    $fieldHtml .= "<input type=\"$type\" class=\"form-control form-control-lg\" name=\"$name\" value=\"$value\" $requiredAttr $attr>";
  }
  $fieldHtml .= "</div>";
  return $fieldHtml;
}

//* PROMEDIAR PRECIO DE COSTO
function promediarPrecioCosto($cantIngreso, $costoIngreso, $costoAnterior, $cantAnterior)
{
  $subTotalIngreso = round($cantIngreso * $costoIngreso, 2);
  $subTotalAnterior = round($costoAnterior * $cantAnterior, 2);
  return round(($subTotalIngreso + $subTotalAnterior) / ($cantIngreso + $cantIngreso), 2);
}

//* GENERAR CEROS A LA IZQUIERDA
function generarCeros($numero, $decimales, $longitud)
{
  return str_pad(number_format($numero, $decimales, '', ''), $longitud, '0', STR_PAD_LEFT);
}

//* FECHA HORA
$fechaHoraModificacion = date('Y-m-d h:i:s A');

//* TIPO DE GASTOS
$tipoGastoArray = [
  '1' => 'GASTO DE COMPRAS',
  '2' => 'COMBUSTIBLE',
  '3' => 'CAJA CHICA',
  '4' => 'CONSUMO',
  '5' => 'TRANSFERENCIA GANADO HATOS',
  '6' => 'VIATICOS',
  '7' => 'COSTO MATADERO',
  '8' => 'COSTO PLANTA LACTEOS',
  '9' => 'COSTO TERCEROS',
  '10' => 'AYUDAS MEDICA',
  '11' => 'MAQUINARIA (UTM)',
  '12' => 'FLETES (UTM)',
  '13' => 'CONTRATISTAS',
  '14' => 'AYUDAS MEDICAS TRASLADO',
  '15' => 'PLANTA ALIMENTOS',
  '16' => 'ACTIVOS (DEPRECIACIONES)',
  '17' => 'PERDIDA (ACTIVO)',
  '18' => 'FLETES TERCEROS',
  '19' => 'MATERIA PRIMA',
  '20' => 'PRODUCTO PARA LA VENTA',
  '21' => 'LIQUIDACIONES',
  '22' => 'UTILIDADES',
  '23' => 'BONOS',
  '24' => 'COMPRAS CAJA FRIGORIFICO CAJA',
  '25' => 'ARRIENDO',
  '27' => 'NOMINA',
  '29' => 'COMISIONES BANCARIAS',
];