<?php
require_once '../main.php';
require_once '../sessionStart.php';
require_once '../dependencias.php';
require_once '../servicios/serviciosMain.php';
require_once 'fpdf/fpdf.php';

$IDServicioResumen = desencriptar($_GET['id']);
$consulta = serviciosConsultarXID([$IDServicioResumen])->fetchAll(PDO::FETCH_ASSOC);

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
function generarNotaEntrega($pdf, $xOffset, $datos)
{
  $pdf->Image('img/fondoAgroflora.png', $xOffset, 30, 130, 0);
  // if ($consulta[0]['EstadoDespacho'] === 1) {
  //   $pdf->Image('img/anualdo.png', $xOffset, 30, 130, 0);
  // }
  //* Encabezado
  $pdf->SetFont('Courier', 'B', 14);
  $pdf->setY(10);
  $pdf->setX($xOffset);
  $pdf->MultiCell(125, 6, utf8_decode('AGROPECUARIA FLORA AGROFLORA, C.A'), 0, 'C');
  $pdf->SetFont('Courier', 'b', 7);
  $pdf->setX($xOffset);
  $pdf->MultiCell(125, 6, utf8_decode('Carretera Nacional, Calle Principal, Diagonal Auto lavado el Grande, Local s/n, Sector Pueblo Nuevo, Mantecal, Municipio Muñoz, Estado Apure'), 0, 'C');
  $pdf->SetFont('Courier', 'B', 10);
  $pdf->setX($xOffset);
  $pdf->Cell(125, 6, 'R.I.F: ' . utf8_decode('J-07553470-0'), 0, 1, 'C');
  $pdf->Ln(5);

  //*  Detalles de la Nota de Entrega
  $pdf->SetFont('Courier', 'B', 12);
  $pdf->setX($xOffset);
  $pdf->Cell(45, 6, 'NOTA DE SERVICIO:', 0, 0, 'L');
  $pdf->Cell(75, 6, generarCeros($datos[0]['NroNota'], 0, 5), 0, 1, 'L');
  $pdf->setX($xOffset);
  $pdf->Cell(45, 6, 'FECHA: ', 0, 0, 'L');
  $pdf->Cell(75, 6, $datos[0]['FechaServicio'], 0, 1, 'L');
  $pdf->setX($xOffset);
  $pdf->Cell(45, 6, 'DESTINO:', 0, 0, 'L');
  $pdf->Cell(75, 6, $datos[0]['DescripcionCentroCosto'], 0, 1, 'L');
  $pdf->Ln(5);

  $pdf->setX($xOffset);
  $pdf->Cell(120, 6, 'DATOS DEL VEHICULO', 0, 1, 'L');
  $pdf->setX($xOffset);
  $pdf->Cell(45, 6, 'MARCA:', 0, 0, 'L');
  $pdf->Cell(75, 6, $datos[0]['MarcaVehiculo'], 0, 1, 'L');
  $pdf->setX($xOffset);
  $pdf->Cell(45, 6, 'MODELO:', 0, 0, 'L');
  $pdf->Cell(75, 6, $datos[0]['ModeloVehiculo'], 0, 1, 'L');
  $pdf->setX($xOffset);
  $pdf->Cell(45, 6, 'PLACA:', 0, 0, 'L');
  $pdf->Cell(75, 6, $datos[0]['SerialVehiculo'], 0, 1, 'L');
  $pdf->Ln(5);

  //* Observaciones
  $pdf->SetFont('Arial', 'B', 8);
  $pdf->setX($xOffset);
  $pdf->Cell(35, 6, 'OBSERVACIONES 1:', 0, 0, 'L');
  $pdf->MultiCell(90, 6, utf8_decode($datos[0]['ObservacionServicio']), 0, 'L');
  $pdf->setX($xOffset);
  $pdf->setX($xOffset);
  $pdf->Cell(35, 6, 'OBSERVACIONES 2:', 0, 0, 'L');
  $pdf->MultiCell(90, 6, 'LOS PRECIOS SON UTILIZADOS PARA CONTROLES INTERNOS', 0, 'L');
  $pdf->Ln(6);

  //* Tabla de productos
  $pdf->SetFont('Arial', 'B', 7);
  $pdf->setX($xOffset);
  $pdf->Cell(60, 6, 'PRODUCTOS / DESCRIPCION', 1, 0, 'C');
  $pdf->Cell(25, 6, 'CANTIDAD / PESO', 1, 0, 'C');
  $pdf->Cell(20, 6, 'PRECIO', 1, 0, 'C');
  $pdf->Cell(20, 6, 'TOTAL', 1, 1, 'C');

  $montoTotal = 0;
  $pdf->SetFont('Arial', 'b', 6);
  foreach ($datos as $row) {
    $montoTotal += round($row['PrecioUSD'] * $row['Cantidad'], 2);

    $pdf->setX($xOffset);
    $yInicio = $pdf->GetY();
    $pdf->MultiCell(60, 5, utf8_decode($row['DescripcionInv']), 1, 'L');
    $yFin = $pdf->GetY();
    $alturaFila = $yFin - $yInicio;
    $pdf->SetY($yInicio);
    $pdf->SetX($xOffset + 60);
    $pdf->Cell(25, $alturaFila, number_format($row['Cantidad'], 2, ',', '.'), 1, 0, 'C');
    $pdf->Cell(20, $alturaFila, number_format($row['PrecioUSD'], 2, ',', '.'), 1, 0, 'C');
    $pdf->Cell(20, $alturaFila, number_format($row['PrecioUSD'] * $row['Cantidad'], 2, ',', '.'), 1, 1, 'C');
  }

  //* Total
  $pdf->SetFont('Arial', 'B', 7);
  $pdf->setX($xOffset);
  $pdf->Cell(105, 5, 'TOTAL', 1, 0, 'C');
  $pdf->Cell(20, 5, number_format($montoTotal, 2, ',', '.'), 1, 1, 'C');
  $pdf->Ln(8);

  //* Firma
  $pdf->SetFont('Arial', 'B', 8);
  $pdf->setX($xOffset);
  $pdf->Cell(50, 6, 'ENTREGA CONFORME:', 0, 0, 'C');
  $pdf->Cell(25, 6, '', 0, 0, 'C');
  $pdf->Cell(50, 6, 'RECIBE CONFORME:', 0, 1, 'C');
  $pdf->Ln(5);

  $pdf->setX($xOffset);
  $pdf->Cell(50, 6, '', 'B', 0, 'C');
  $pdf->Cell(25, 6, '', 0, 0, 'C');
  $pdf->Cell(50, 6, '', 'B', 1, 'C');

  $pdf->setX($xOffset);
  $pdf->Cell(50, 6, utf8_decode($datos[0]['ResponsableServicio']), 0, 0, 'C');
  $pdf->Cell(25, 6, '', 0, 0, 'C');
  $pdf->Cell(50, 6, utf8_decode($datos[0]['RecibeCedula']), 0, 1, 'C');

  $pdf->setX($xOffset);
  $pdf->Cell(50, 6, '', 0, 0, 'C');
  $pdf->Cell(25, 6, '', 0, 0, 'C');
  $pdf->Cell(50, 6, utf8_decode($datos[0]['RecibeConforme']), 0, 1, 'C');
}

generarNotaEntrega($pdf, 10, $consulta);
generarNotaEntrega($pdf, 165, $consulta);
$pdf->Output();