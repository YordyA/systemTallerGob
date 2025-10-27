<?php

//* LISTA DE TIPOS DE SERVICIO
function serviciosListaTipos()
{
  return conexion()->query('SELECT * FROM servicios_tipos WHERE EstadoTipoServicio = 1');
}

//* GENERAR NRO DE NOTA X TIPO DE SERVICIO
function serviciosGenerarNroNota($datos)
{
  $sql = conexion()->prepare('SELECT NroNota FROM servicios_resumen WHERE IDTipoServicio = ? ORDER BY NroNota DESC LIMIT 1');
  $sql->execute($datos);
  $sql = $sql->fetch(PDO::FETCH_ASSOC);
  if ($sql === FALSE) return 1;
  return $sql['NroNota'] + 1;
}

//* REGISTRAR SERIVICIO RESUMEN
function serviciosRegistrarResumen($datos)
{
  $conexion = conexion();
  $sql = $conexion->prepare('INSERT INTO
  servicios_resumen (
    TasaRefBcv,
    FechaServicio,
    IDTipoServicio,
    IDVehiculo,
    NroNota,
    RecibeCedula,
    RecibeConforme,
    ObservacionServicio,
    ResponsableServicio,
    EstadoServicio
  )
VALUES
  (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
  $sql->execute($datos);
  return $conexion->lastInsertId();
}

//* REGISTRAR SERVICIO DETALLE 
function serviciosRegistrarDetalle($datos)
{
  $sql = conexion()->prepare('INSERT INTO
  servicios_detalles (
    IDServicioResumen,
    IDInv,
    Cantidad,
    PrecioUSD,
    PrecioBS
  )
VALUES
  (?, ?, ?, ?, ?)');
  $sql->execute($datos);
  return $sql;
}

//* ACTUALIZAR ESTADO DEL SERVICIO
function serviciosActualizarEstado($datos)
{
  $sql = conexion()->prepare('UPDATE servicios_resumen
SET
  EstadoServicio = ?,
  UltimaActualizacionServicio = ?
WHERE
  IDServicioResumen = ?');
  $sql->execute($datos);
  return $sql;
}

//* CONSULTAR SERVICIO X ID
function serviciosConsultarXID($datos)
{
  $sql = conexion()->prepare('SELECT
*
FROM
  servicios_detalles
  INNER JOIN inventario ON servicios_detalles.IDInv = inventario.IDInv
  INNER JOIN inventario_tipos ON inventario.IDTipoInv = inventario_tipos.IDTipoInv
  INNER JOIN servicios_resumen ON servicios_detalles.IDServicioResumen = servicios_resumen.IDServicioResumen
  INNER JOIN servicios_tipos ON servicios_resumen.IDTipoServicio = servicios_tipos.IDTipoServicio
  INNER JOIN servicios_vehiculos ON servicios_resumen.IDVehiculo = servicios_vehiculos.IDVehiculo
  INNER JOIN empresas_gob AS centros_costo ON servicios_vehiculos.IDCentroCosto = centros_costo.IDEmpresa
WHERE
  servicios_resumen.IDServicioResumen = ?');
  $sql->execute($datos);
  return $sql;
}

//* REPORTE DE LISTA DE SERVICIOS REALIZADOS
function reportServiciosRealizados($datos, $IDCentroCosto, $IDTipoServicio)
{
  $sql = conexion()->prepare('SELECT
  servicios_tipos.DescripcionTipoServicio,
  servicios_resumen.FechaServicio,
  servicios_resumen.TasaRefBcv,
  servicios_resumen.NroNota,
  SUM(servicios_detalles.PrecioUSD * servicios_detalles.Cantidad) AS MontoTotalUSD,
  SUM(servicios_detalles.PrecioBS * servicios_detalles.Cantidad) AS MontoTotalBS,
  centros_costo.DescripcionEmpresa,
  CONCAT (servicios_vehiculos.CodigoVehiculo," - ",servicios_vehiculos.MarcaVehiculo) AS Vehiculo,
  servicios_resumen.RecibeConforme,
  servicios_resumen.ObservacionServicio,
  servicios_resumen.ResponsableServicio,
  servicios_resumen.IDServicioResumen
FROM
  servicios_detalles
  INNER JOIN inventario ON servicios_detalles.IDInv = inventario.IDInv
  INNER JOIN inventario_tipos ON inventario.IDTipoInv = inventario_tipos.IDTipoInv
  INNER JOIN servicios_resumen ON servicios_detalles.IDServicioResumen = servicios_resumen.IDServicioResumen
  INNER JOIN servicios_tipos ON servicios_resumen.IDTipoServicio = servicios_tipos.IDTipoServicio
  INNER JOIN servicios_vehiculos ON servicios_resumen.IDVehiculo = servicios_vehiculos.IDVehiculo
  INNER JOIN empresas_gob AS centros_costo ON servicios_vehiculos.IDCentroCosto = centros_costo.IDEmpresa
WHERE
  servicios_resumen.FechaServicio BETWEEN ? AND ?
GROUP BY
  servicios_resumen.IDServicioResumen');
  $sql->execute($datos);
  return $sql;
}
