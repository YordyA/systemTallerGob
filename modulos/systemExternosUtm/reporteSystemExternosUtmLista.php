<?php
require_once '../main.php';
require_once '../dependencias.php';
require_once 'systemExternosUtmMain.php';

$del = limpiarCadena($_GET['d']);
$hasta = limpiarCadena($_GET['h']);

$html = '';
foreach (reportSystemExternosUtmLista([$del, $hasta]) as $row) {
  $html .= '<tr>';
  $html .= '<td>' . $row['DescripcionTipoTrabajo'] . '</td>';
  $html .= '<td>' . $row['FechaServicio'] . '</td>';
  $html .= '<td>' . generarCeros($row['NroNota'], 0, 5) . '</td>';
  $html .= '<td>' . number_format($row['MontoTotalBS'], 2) . '</td>';
  $html .= '<td>' . number_format($row['MontoTotalUSD'], 2) . '</td>';
  $html .= '<td>
              <a class="btn btn-lg" href="https://agrofloracorpogaba.org.ve/systemUtm/modulos/pdf/PDFAvisoServicio.php?id=' . encriptar($row['IDServicioResumen']) . '" target="_blank">
                <i class="lni lni-printer"></i>
              </a>
            </td>';
  if ($row['EstadoServicio'] == 4) {
    $html .= '<td>
              <a class="btn btn-lg" href="index.php?vista=systemExternosUtmConfirmar&id=' . encriptar($row['IDServicioResumen']) . '">
                <i class="lni lni-checkmark-circle"></i>
              </a>
            </td>';
  } else {
    $html .= '<td><span class="status-btn success-btn">CONFIRMADO</span></td>';
  }
  $html .= '</tr>';
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);