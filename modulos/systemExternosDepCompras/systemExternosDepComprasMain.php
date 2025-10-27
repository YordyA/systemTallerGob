<?php

//* LISTA DE COMPRAS
function reportSystemExternosDepComprasLista($datos)
{
  $sql = conexionCompras()->prepare('SELECT 
        compras_resumen.FechaCompra AS Fecha, 
        compras_resumen.Observacion, 
        compras_resumen.IDCompraResumen, 
        compras_resumen.TipoGasto, 
        compras_resumen.EstadoCompra,
        ROUND(SUM(compras_detalle.SubTotal), 2) AS MontoTotalUSD,
        ROUND(SUM(CASE WHEN compras_resumen.FechaCompra = historial_tasa_bcv.FechaTasa THEN compras_detalle.SubTotal * historial_tasa_bcv.TasaRefUSD ELSE 0 END), 2) AS MontoTotalBS,
        "compra" as Condicional
    FROM compras_resumen
      INNER JOIN compras_detalle ON compras_resumen.IDCompraResumen = compras_detalle.IDCompraResumen
      INNER JOIN agroflor_administracion_empresas.historial_tasa_bcv AS historial_tasa_bcv ON compras_resumen.FechaCompra = historial_tasa_bcv.FechaTasa
    WHERE 
      compras_resumen.EstadoCompra NOT IN (1,5)
      AND compras_resumen.IDCentroCosto = 68
      AND compras_resumen.FechaCompra BETWEEN ? AND ?
    GROUP BY compras_resumen.IDCompraResumen

    UNION

    SELECT 
        despacho_resumen.FechaDespacho, 
        despacho_resumen.Observacion, 
        despacho_resumen.IDDespachoResumen AS IDCompraResumen,
        1 AS TipoGasto,
        despacho_resumen.EstadoDespacho AS EstadoCompra,
        ROUND(SUM(despacho_detalle.SubTotalDep), 2) AS MontoTotalUSD,
        ROUND(SUM(CASE WHEN despacho_resumen.FechaDespacho = historial_tasa_bcv.FechaTasa THEN despacho_detalle.SubTotalDep * historial_tasa_bcv.TasaRefUSD ELSE 0 END), 2) AS MontoTotalBS,
        "almacen" as Condicional
    FROM despacho_resumen
      INNER JOIN despacho_detalle ON despacho_resumen.IDDespachoResumen = despacho_detalle.IDDespachoResumen
      INNER JOIN agroflor_administracion_empresas.historial_tasa_bcv AS historial_tasa_bcv ON despacho_resumen.FechaDespacho = historial_tasa_bcv.FechaTasa
    WHERE
      despacho_resumen.TipoDespacho = 1 
      AND despacho_resumen.EstadoDespacho != 1
      AND despacho_resumen.IDCentroCosto = 68
      AND despacho_resumen.FechaDespacho BETWEEN ? AND ?
    GROUP BY despacho_resumen.IDDespachoResumen');
  $sql->execute($datos);
  return $sql;
}

//* ACTUALIZAR ESTADO DE LA COMPRA
function systemExternosDepComprasActualizarEstado($tipoCompra, $datos)
{
  if ($tipoCompra == 'compra') {
    $sql = conexionCompras()->prepare('UPDATE compras_resumen SET ResponsableAceptacion = ?, EstadoCompra = 3 WHERE IDCompraResumen = ?');
    $sql->execute($datos);
  } else {
    $sql = conexionCompras()->prepare('UPDATE despacho_resumen SET AceptacionResponsable = ?, EstadoDespacho = 2 WHERE IDDespachoResumen = ?');
    $sql->execute($datos);
  }
}