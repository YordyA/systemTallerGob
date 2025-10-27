<?php
require_once '../main.php';
require_once '../sessionStart.php';
require_once '../dependencias.php';
require_once '../inventario/inventarioMain.php';

$buscador = strtoupper(limpiarCadena($_GET['buscador']));
$html = [];
foreach (inventarioBuscador(['%' . $buscador . '%', '%' . $buscador . '%']) as $row) {
  if ($row['TipoExistencia'] == 1 && $row['Existencia'] == 0) {
    continue;
  }
  $html[] = [
    'value' => encriptar($row['IDInv']),
    'label' => $row['CodigoInv'] . ' - ' . $row['DescripcionInv'],
  ];
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);
