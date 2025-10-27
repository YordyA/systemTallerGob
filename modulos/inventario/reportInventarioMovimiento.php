<?php
require_once '../main.php';
require_once '../sessionStart.php';
require_once '../dependencias.php';
require_once 'inventarioMain.php';

$del = limpiarCadena($_GET['d']);
$hasta = limpiarCadena($_GET['h']);
$IDTipoMov = desencriptar($_GET['id']);

$html = '';
foreach (reportInventarioMovimiento([$del, $hasta], $IDTipoMov) as $row) {
  $html .= '<tr>';
  $html .= '<td>' . $row['FechaMov'] . '</td>';
  $html .= '<td>' . $row['DescripcionMovimiento'] . '</td>';
  $html .= '<td>' . $row['CodigoInv'] . '</td>';
  $html .= '<td>' . $row['DescripcionInv'] . '</td>';
  $html .= '<td>' . number_format($row['ExistenciaAnterior'], 2) . '</td>';
  $html .= '<td>' . number_format($row['Movimiento'], 2) . '</td>';
  $html .= '<td>' . number_format($row['ExistenciaActual'], 2) . '</td>';
  $html .= '<td><i>' . $row['ConceptoMov'] . '</i></td>';
  $html .= '<td>' . $row['ResponsableMov'] . '</td>';
  $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);