<?php

//* TIPO DE DESPACHO DE CENTRO DE ACOPIO
$tipoDespachoArrayCentroAcopio = [
  '2' => 'CONSUMO SEMANAL',
  '3' => 'COMBOS PERSONAL',
  '4' => 'ENTREGA FRIGORIFICO',
  '5' => 'COMERCIALIZACION',
  '6' => 'CONTRIBUCION SOCIAL'
];

//* LISTA DE DESPACHOS CENTRO DE ACOPIO
function reportSystemExternosCentroAcopio($datos)
{
  $sql = conexionCompras()->prepare('SELECT
  despacho_resumen.TipoDespacho,
  despacho_resumen.IDDespachoResumen,
  despacho_resumen.FechaDespacho,
  despacho_resumen.Observacion,
  despacho_resumen.EstadoDespacho,
  SUM(despacho_detalle.SubTotalDep) AS MontoTotalUSD,
  ROUND(SUM(CASE WHEN despacho_resumen.FechaDespacho = historial_tasa_bcv.FechaTasa THEN despacho_detalle.SubTotalDep * historial_tasa_bcv.TasaRefUSD ELSE 0 END), 2) AS MontoTotalBS
FROM
  despacho_resumen
  INNER JOIN despacho_detalle ON despacho_resumen.IDDespachoResumen = despacho_detalle.IDDespachoResumen
  INNER JOIN agroflor_administracion_empresas.historial_tasa_bcv AS historial_tasa_bcv ON despacho_resumen.FechaDespacho = historial_tasa_bcv.FechaTasa
WHERE
  despacho_resumen.TipoDespacho != 1
  AND despacho_resumen.IDEmpresa IS NULL
  AND despacho_resumen.EstadoDespacho != 1
  AND despacho_resumen.IDCentroCosto = 68
  AND despacho_resumen.FechaDespacho BETWEEN ? AND ?
GROUP BY
  despacho_resumen.IDDespachoResumen');
  $sql->execute($datos);
  return $sql;
}

//* ACTUALIZAR ESTADO DE LA COMPRA
function systemExternosCentroAcopioActualizarEstado($datos)
{
  $sql = conexionCompras()->prepare('UPDATE despacho_resumen SET AceptacionResponsable = ?, EstadoDespacho = 2 WHERE IDDespachoResumen = ?');
  $sql->execute($datos);
}