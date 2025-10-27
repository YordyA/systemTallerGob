<?php
require_once '../main.php';
require_once '../dependencias.php';
require_once '../sessionStart.php';
require_once 'vehiculosMain.php';

$html = '';
foreach (vehiculosLista() as $row) {
  $html .= '<tr>';
  $html .= '<td>' . $row['DescripcionEmpresa'] . '</td>';
  $html .= '<td>' . $row['CodigoVehiculo'] . '</td>';
  $html .= '<td>' . $row['YearVehiculo'] . '</td>';
  $html .= '<td>' . $row['MarcaVehiculo'] . '</td>';
  $html .= '<td>' . $row['ModeloVehiculo'] . '</td>';
  $html .= '<td>' . $row['SerialVehiculo'] . '</td>';
  $html .= '<td>' . $row['PlacaVehiculo'] . '</td>';
  $html .= '<td>' . $row['ColorVehiculo'] . '</td>';
  $html .= '<td>
              ' . ($row['UrlImagenVehiculo'] != null ? '<img src="modulos/vehiculos/' . $row['UrlImagenVehiculo'] . '" alt="Foto del vehículo" class="img-fluid" style="width: 100px; height: auto; border-radius: 30px;">' : 'SIN IMAGEN') . '
            </td>';
  $html .= '<td>
              <a class="btn btn-lg" href="index.php?vista=vehiculosActualizar&id=' . encriptar($row['IDVehiculo']) . '">
                <i class="lni lni-pencil"></i>
              </a>
            </td>';
  $html .= '<td>
              <button class="btn btn-lg btnEliminar" value="' . encriptar($row['IDVehiculo']) . '">
                <i class="lni lni-cross-circle"></i>
              </button>
            </td>';
  $html .= '</tr>';
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);