<?php
require_once '../main.php';
require_once '../dependencias.php';
require_once '../servicios/serviciosMain.php';

$del = limpiarCadena($_GET['d']);
$hasta = limpiarCadena($_GET['h']);
$IDCentroCosto = encriptar($_GET['IDCentroCosto']);
$IDTipoServicio = encriptar($_GET['IDTipoServicio']);

$html = '';
foreach (reportServiciosRealizados([$del, $hasta], $IDCentroCosto, $IDTipoServicio) as $row) {
  $html .= '<tr>';
  $html .= '<td>' . $row['DescripcionTipoServicio'] . '</td>';
  $html .= '<td>' . $row['FechaServicio'] . '</td>';
  $html .= '<td>' . number_format($row['TasaRefBcv'], 4) . '</td>';
  $html .= '<td>' . generarCeros($row['TasaRefBcv'], 0, 5) . '</td>';
  $html .= '<td>' . number_format($row['MontoTotalUSD'], 2) . '</td>';
  $html .= '<td>' . number_format($row['MontoTotalBS'], 2) . '</td>';
  $html .= '<td>' . $row['RazonSocialEmpresa'] . '</td>';
  $html .= '<td>' . $row['DescripcionCentroCosto'] . '</td>';
  $html .= '<td>' . $row['Vehiculo'] . '</td>';
  $html .= '<td>' . $row['RecibeConforme'] . '</td>';
  $html .= '<td><i>' . $row['ObservacionServicio'] . '</i></td>';
  $html .= '<td>' . $row['ResponsableServicio'] . '</td>';
  $html .= '<td>
              <a class="btn btn-lg" href="modulos/pdf/PDFNotaServicio.php?id=' . encriptar($row['IDServicioResumen']) . '" target="_blank">
                <i class="lni lni-printer"></i>
              </a>
            </td>';
  $html .= '<td>
              <a class="btn btn-lg" href="index.php?vista=serviciosAnular&id=' . encriptar($row['IDServicioResumen']) . '">
                <i class="lni lni-cross-circle"></i>
              </a>
            </td>';
  $html .= '</tr>';
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);
