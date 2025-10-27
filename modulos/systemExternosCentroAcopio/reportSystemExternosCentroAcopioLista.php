<?php
require_once '../main.php';
require_once '../dependencias.php';
require_once '../sessionStart.php';
require_once 'systemExternosCentroAcopioMain.php';

$del = limpiarCadena($_GET['d']);
$hasta = limpiarCadena($_GET['h']);

$html = '';
foreach (reportSystemExternosCentroAcopio([$del, $hasta]) as $row) {
  $html .= '<tr>';
  $html .= '<td>' . $tipoDespachoArrayCentroAcopio[$row['TipoDespacho']] . '</td>';
  $html .= '<td>' . $row['FechaDespacho'] . '</td>';
  $html .= '<td><i>' . $row['Observacion'] . '</i></td>';
  $html .= '<td>' . number_format($row['MontoTotalBS'], 2) . '</td>';
  $html .= '<td>' . number_format($row['MontoTotalUSD'], 2) . '</td>';
  $html .= '<td>
              <a class="btn btn-lg" href="https://agrofloracorpogaba.org.ve/systemCentroAcopio/modulos/pdf/PDFNotaEntrega.php?id=' . encriptar($row['IDDespachoResumen']) . '" target="_blank">
                <i class="lni lni-printer"></i>
              </a>
            </td>';
  if ($row['EstadoDespacho'] == 3) {
    $html .= '<td>
              <a class="btn btn-lg" href="index.php?vista=systemExternosCentroAcopioConfirmar&id=' . encriptar($row['IDDespachoResumen']) . '">
                <i class="lni lni-checkmark-circle"></i>
              </a>
            </td>';
  } else {
    $html .= '<td><span class="status-btn success-btn">CONFIRMADO</span></td>';
  }
  $html .= '</tr>';
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);