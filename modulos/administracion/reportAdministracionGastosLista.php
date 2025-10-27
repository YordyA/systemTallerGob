<?php
require_once '../main.php';
require_once '../dependencias.php';
require_once 'administracionMain.php';

$del = limpiarCadena($_GET['d']);
$hasta = limpiarCadena($_GET['h']);
$IDTipoGasto = desencriptar($_GET['id']);

$html = '';
foreach (reportAdministracionGastosLista([$del, $hasta], $IDTipoGasto) as $row) {
  $html .= '<tr>';
  $html .= '<td>' . $tipoGastoArray[$row['IDTipoGasto']] . '</td>';
  $html .= '<td>' . $row['FechaGasto'] . '</td>';
  $html .= '<td><i>' . $row['ConceptoGasto'] . '</i></td>';
  $html .= '<td>' . number_format($row['MontoTotalGastoUSD'] * $row['TasaRefUSD'], 2) . '</td>';
  $html .= '<td>' . number_format($row['MontoTotalGastoUSD'], 2) . '</td>';
  $html .= '<td>' . $row['Responsable'] . '</td>';
  $html .= '</tr>';
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);