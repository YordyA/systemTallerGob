<?php
require_once '../main.php';
require_once '../dependencias.php';
require_once '../sessionStart.php';
require_once 'vehiculosMain.php';

$IDCentroCosto = desencriptar($_GET['id']);
$html = '<option selected>SELECCIONE</option>';
foreach (vehiculosListaXCentroCosto([$IDCentroCosto]) as $row) {
  $html .= '<option value="' . encriptar($row['IDVehiculo']) . '">' . $row['CodigoVehiculo'] . ' - ' . $row['ModeloVehiculo'] . ' </option>';
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);