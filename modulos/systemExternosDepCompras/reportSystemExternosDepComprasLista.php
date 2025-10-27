<?php
require_once '../main.php';
require_once '../sessionStart.php';
require_once '../dependencias.php';
require_once 'systemExternosDepComprasMain.php';

$del = limpiarCadena($_GET['d']);
$hasta = limpiarCadena($_GET['h']);

$html = '';
foreach (reportSystemExternosDepComprasLista([$del, $hasta, $del, $hasta]) as $row) {
  $html  .= '<tr>';
  $html  .= '<td>' . $tipoGastoArray[$row['TipoGasto']] . '</td>';
  $html  .= '<td>' . $row['Fecha'] . '</td>';
  $html  .= '<td><i>' . $row['Observacion'] . '</i></td>';
  $html  .= '<td>' . number_format($row['MontoTotalBS'], 2) . '</td>';
  $html  .= '<td>' . number_format($row['MontoTotalUSD'], 2) . '</td>';
  if ($row['Condicional'] == 'compra') {
    $html  .= '<td>
                <a class="btn btn-lg" href="https://agrofloracorpogaba.org.ve/systemCompras/modulos/pdf/PDFNotaRequerimiento.php?id=' . encriptar($row['IDCompraResumen']) . '" target="_blank">
                  <i class="lni lni-printer"></i>  
                </a>
              </td>';
  } else {
    $html  .= '<td>
                <a class="btn btn-lg" href="https://agrofloracorpogaba.org.ve/systemCompras/modulos/pdf/PDFNotaEntrega.php?id=' . encriptar($row['IDCompraResumen']) . '" target="_blank">
                  <i class="lni lni-printer"></i>  
                </a>
              </td>';
  }
  if (($row['EstadoCompra'] == 3 && $row['Condicional'] == 'almacen') || ($row['EstadoCompra'] == 4 && $row['Condicional'] == 'compra')) {
    $html  .= '<td>
                  <a class="btn btn-lg" href="index.php?vista=systemExternosDepComprasConfirmar&id=' . encriptar($row['IDCompraResumen']) . '&tipo=' . encriptar($row['Condicional']) . '">
                    <i class="lni lni-checkmark-circle"></i>
                  </a>
              </td>';
  } else {
    $html  .= '<td><span class="status-btn success-btn">CONFIRMADO</span></td>';
  }
  $html  .= '</tr>';
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);