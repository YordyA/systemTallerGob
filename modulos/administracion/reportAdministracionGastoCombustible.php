<?php
require_once '../main.php';
require_once '../dependencias.php';
require_once '../sessionStart.php';
require_once 'administracionMain.php';

$del = limpiarCadena($_GET['d']);
$hasta = limpiarCadena($_GET['h']);
$tipoCombustible = desencriptar($_GET['id']);

$html = '';
foreach (reportAdministracionGastoCombustible([$del, $hasta], $tipoCombustible) as $row) {
  $html .= '<tr>';
  $html .= '<td>' . $row['TipoCombustible'] . '</td>';
  $html .= '<td>' . $row['DescripcionEstacionServicio'] . '</td>';
  $html .= '<td>' . date('d-m-Y', strtotime($row['FechaSalida'])) . '</td>';
  $html .= '<td><i>' . $row['Observacion'] . '</i></td>';
  $html .= '<td>' . number_format($row['Movimiento'], 2) . '</td>';
  $html .= '<td>' . number_format(($row['CostoUEgreso'] * $row['Movimiento']) * $row['TasaRefUSD'], 2) . '</td>';
  $html .= '<td>' . number_format($row['CostoUEgreso'] * $row['Movimiento'], 2) . '</td>';
  $html .= '</tr>';
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);