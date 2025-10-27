<?php

//* VERIFICAR VEHICULO POR ID
function vehiculosVerificarXID($datos)
{
  $sql = conexion()->prepare('SELECT
  *
FROM
  servicios_vehiculos
  INNER JOIN empresas_gob AS centros_costo ON servicios_vehiculos.IDCentroCosto = centros_costo.IDEmpresa
WHERE
  EstadoVehiculo = 1
  AND IDVehiculo = ?');
  $sql->execute($datos);
  return $sql;
}

//* VERIFICAR VEHICULO POR CODGIO
function vehiculosVerificarXCODIGO($datos)
{
  $sql = conexion()->prepare('SELECT
  *
FROM
  servicios_vehiculos
  
WHERE
  EstadoVehiculo = 1
  AND CodigoVehiculo = ?');
  $sql->execute($datos);
  return $sql;
}

//* VERIFICAR VEHICULO POR PLACA
function vehiculosVerificarXPLACAVEHICULO($datos)
{
  $sql = conexion()->prepare('SELECT
  *
FROM
  servicios_vehiculos
   INNER JOIN empresas_gob AS centros_costo ON servicios_vehiculos.IDCentroCosto = centros_costo.IDEmpresa
WHERE
  EstadoVehiculo = 1
  AND PlacaVehiculo = ?');
  $sql->execute($datos);
  return $sql;
}

//* REGISTRAR VEHICULO
function vehiculosRegistrar($datos)
{
  $sql = conexion()->prepare('INSERT INTO
  servicios_vehiculos (
    IDEmpresa,
    IDCentroCosto,
    CodigoVehiculo,
    YearVehiculo,
    MarcaVehiculo,
    ModeloVehiculo,
    PlacaVehiculo,
    SerialVehiculo,
    ColorVehiculo,
    UrlImagenVehiculo,
    EstadoVehiculo
  )
VALUES
  (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)');
  $sql->execute($datos);
  return $sql;
}

//* LISTA DE VEHICULOS
function vehiculosLista()
{
  return conexion()->query('SELECT
  *
FROM
  servicios_vehiculos
  INNER JOIN empresas_gob AS centros_costo ON servicios_vehiculos.IDCentroCosto = centros_costo.IDEmpresa
WHERE
  EstadoVehiculo = 1');
}

//* ACTUALIZAR VEHICULO
function vehiculosActualizar($datos)
{
  $sql = conexion()->prepare('UPDATE servicios_vehiculos
SET
  IDEmpresa = ?,
  IDCentroCosto = ?,
  CodigoVehiculo = ?,
  YearVehiculo = ?,
  MarcaVehiculo = ?,
  ModeloVehiculo = ?,
  PlacaVehiculo = ?,
  SerialVehiculo = ?,
  ColorVehiculo = ?,
  UrlImagenVehiculo = ?,
  UltimaActualizacionVehiculo = ?
WHERE
  IDVehiculo = ?');
  $sql->execute($datos);
  return $sql;
}

//* ACTUALIZAR ESTADO VEHICULO
function vehiculosActualizarEstado($datos)
{
  $sql = conexion()->prepare('UPDATE servicios_vehiculos
SET
  EstadoVehiculo = ?,
  UrlImagenVehiculo = ?
WHERE
  IDVehiculo = ?');
  $sql->execute($datos);
}

//* CONSULTAR VEHICULO POR CENTRO DE COSTO
function vehiculosListaXCentroCosto($datos)
{
  $sql = conexion()->prepare('SELECT
  *
FROM
  servicios_vehiculos
  INNER JOIN empresas_gob AS centros_costo ON servicios_vehiculos.IDCentroCosto = centros_costo.IDEmpresa
WHERE
  EstadoVehiculo = 1
  AND servicios_vehiculos.IDCentroCosto = ?');
  $sql->execute($datos);
  return $sql;
}