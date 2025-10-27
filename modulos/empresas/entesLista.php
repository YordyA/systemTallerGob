<?php
require_once '../main.php';
require_once '../dependencias.php';
require_once '../sessionStart.php';
require_once './empresasMain.php';

$html = '';
foreach (empresasListaCentroCosto() as $row) {
  $html .= '<tr>';
  $html .= '<td>' . $row['DescripcionEmpresa'] . '</td>';
  $html .= '</tr>';
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);