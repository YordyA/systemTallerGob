<?php
require_once '../main.php';
require_once '../dependencias.php';
require_once 'inventarioMain.php';

$IDTipoInv = desencriptar($_GET['id']);
$html = '';
foreach (inventarioListaXTIPO([$IDTipoInv]) as $row) {
  $html .= '<tr>';
  $html .= '<td>' . $row['CodigoInv'] . '</td>';
  $html .= '<td>' . $row['DescripcionInv'] . '</td>';
  $html .= '<td>' . number_format($row['PrecioInv'], 2) . '</td>';
  if ($IDTipoInv == 2) {
    $html .= '<td>' . number_format($row['Existencia'], 2) . '</td>';
    $html .= '<td>
                <button class="btn btn-lg btnRellenar" value="' . encriptar($row['IDInv']) . '">
                  <i class="lni lni-circle-plus"></i>
                </button>
              </td>';
    $html .= '<td>
                <button class="btn btn-lg btnRetirar" value="' . encriptar($row['IDInv']) . '">
                  <i class="lni lni-circle-minus"></i>
                </button>
              </td>';
  }
  $html .= '<td>
              <a class="btn btn-lg" href="index.php?vista=inventarioActualizar&id=' . encriptar($row['IDInv']) . '">
                <i class="lni lni-pencil"></i>
              </a>
            </td>';
  $html .= '<td>
              <button class="btn btn-lg btnEliminar" value="' . encriptar($row['IDInv']) . '">
                <i class="lni lni-cross-circle"></i>
              </button>
            </td>';
  $html .= '</tr>';
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);