<?php

//* REPORTE DE SERVICIOS REALIZADOS UTM
function reportSystemExternosUtmLista($datos)
{
  $sql = conexionUtm()->prepare('SELECT
  servicios_resumen.IDServicioResumen,
  servicios_resumen.FechaServicio,
  servicios_resumen.UnidadUtilizada,
  servicios_resumen.Chofer,
  servicios_resumen.ResponsableServicio,
  servicios_resumen.NroNota,
  servicios_tipos.IDTipoServicio,
  servicios_tipos.DescripcionTipoServicio,
  servicios_tipos_trabajo.DescripcionTipoTrabajo,
  SUM(servicios_detalles.PrecioServicioUSD) AS MontoTotalUSD,
  SUM(servicios_detalles.PrecioServicioBS) AS MontoTotalBS,
  clientes.RifCedulaCliente,
  clientes.RazonSocialCliente,
  centros_costo.DescripcionCentroCosto,
  centros_costo_empresa.RifEmpresa,
  centros_costo_empresa.RazonSocialEmpresa,
  servicios_resumen.EstadoServicio
FROM
  servicios_detalles
  INNER JOIN servicios_resumen ON servicios_detalles.IDServicioResumen = servicios_resumen.IDServicioResumen
  INNER JOIN servicios_tipos ON servicios_resumen.IDTipoServicio = servicios_tipos.IDTipoServicio
  INNER JOIN servicios_tipos_trabajo ON servicios_resumen.IDTipoTrabajo = servicios_tipos_trabajo.IDTipoTrabajao
  LEFT JOIN clientes ON servicios_resumen.IDCliente = clientes.IDCliente
  LEFT JOIN agroflor_administracion_empresas.centros_costo AS centros_costo ON servicios_resumen.IDCentroCosto = centros_costo.IDCentroCosto
  LEFT JOIN agroflor_administracion_empresas.centros_costo_empresa AS centros_costo_empresa ON centros_costo.IDEmpresa = centros_costo_empresa.IDCentroCostoEmpresa
WHERE
  servicios_resumen.EstadoServicio != 1
  AND servicios_resumen.IDCentroCosto = 15
  AND servicios_resumen.FechaServicio BETWEEN ? AND ?
GROUP BY servicios_resumen.IDServicioResumen');
  $sql->execute($datos);
  return $sql;
}

//* ACTUALIZAR ESTADO DE SERVICIO UTM
function systemExternosActualizarEstado($datos)
{
  $sql = conexionUtm()->prepare('UPDATE servicios_resumen SET EstadoServicio = 3 WHERE IDServicioResumen = ?');
  $sql->execute($datos);
}