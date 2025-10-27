<?php
require_once '../main.php';
require_once '../sessionStart.php';
require_once '../dependencias.php';
require_once 'serviciosMain.php';

$html = [];
$html['tabla'] = '';
$html['montoUsd'] = '0,00';
$html['montoBs'] = '0,00';

if (isset($_SESSION['systemTaller']['servicios']['detalle']) && count($_SESSION['systemTaller']['servicios']['detalle']) > 0) {
  $montoUsd = 0;
  $montoBs = 0;
  foreach ($_SESSION['systemTaller']['servicios']['detalle'] as $indice => $row) {
    $html['tabla'] .= '<tr>';
    $html['tabla'] .= '<td>' . $row['codigo'] . '</td>';
    $html['tabla'] .= '<td>' . $row['descripcion'] . '</td>';
    $html['tabla'] .= '<td>' . $row['disponibilidad'] . '</td>';
    $html['tabla'] .= '<td>
                        <button class="btn btn-outline-danger text-bold btnCant" value="' . encriptar($indice) . '">' . number_format($row['cantidad'], 2, ',', '.') . '</button>
                      </td>';
    $html['tabla'] .= '<td>' . number_format($row['precio'], 2, ',', '.') . '</td>';
    $html['tabla'] .= '<td>' . number_format($row['precio'] * $row['cantidad'], 2, ',', '.') . '</td>';
    $html['tabla'] .= '<td>
                          <button class="btn btn-lg btnEliminar" value="' . encriptar($indice) . '">
                            <i class="lni lni-cross-circle"></i>
                          </button>
                        </td>';
    $html['tabla'] .= '</tr>';

    $montoUsd += $row['precio'] * $row['cantidad'];
    $montoBs += $row['precio'] * $row['cantidad'] * $_SESSION['systemTaller']['tasaRefUSD'];
  }

  $html['montoUsd'] = number_format($montoUsd, 2, ',', '.');
  $html['montoBs'] = number_format($montoBs, 2, ',', '.');
} else {
  $html['tabla'] = '<tr><td colspan="7">No hay Informacion</td><tr>';
}


echo json_encode($html, JSON_UNESCAPED_UNICODE);
