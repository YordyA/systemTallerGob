<?php

//* LISTA DE TIPOS DE INVENTARIO
function inventarioTiposProductos()
{
  return conexion()->query('SELECT * FROM inventario_tipos WHERE EstadoTipoInv = 1');
}

//* VERIFICAR X CODIGO DEL PRODUCTO / SERVICIO
function inventarioVerificarXID($datos)
{
  $sql = conexion()->prepare('SELECT
  *
FROM
  inventario
  INNER JOIN inventario_tipos ON inventario.IDTipoInv = inventario_tipos.IDTipoInv
WHERE
  EstadoInv = 1
  AND IDInv = ?');
  $sql->execute($datos);
  return $sql;
}

//* VERIFICAR X CODIGO DEL PRODUCTO / SERVICIO
function inventarioVerificarXCODIGO($datos)
{
  $sql = conexion()->prepare('SELECT
  *
FROM
  inventario
  INNER JOIN inventario_tipos ON inventario.IDTipoInv = inventario_tipos.IDTipoInv
WHERE
  EstadoInv = 1
  AND inventario.IDTipoInv = ?
  AND CodigoInv = ?');
  $sql->execute($datos);
  return $sql;
}

//* REGISTRAR PRODUCTO / SERVICIO
function inventarioRegistrar($datos)
{
  $sql = conexion()->prepare('INSERT INTO
  inventario (
    IDTipoInv,
    CodigoInv,
    DescripcionInv,
    Existencia,
    PrecioInv,
    EstadoInv
  )
VALUES
  (?, ?, ?, ?, ?, 1)');
  $sql->execute($datos);
  return $sql;
}

//* LISTA DE PRODUCTO X TIPO
function inventarioListaXTIPO($datos)
{
  $sql = conexion()->prepare('SELECT
  *
FROM
  inventario
  INNER JOIN inventario_tipos ON inventario.IDTipoInv = inventario_tipos.IDTipoInv
WHERE
  EstadoInv = 1
  AND inventario.IDTipoInv = ?');
  $sql->execute($datos);
  return $sql;
}

//* ACTUALIZAR PRODUCTO / SERVICIO
function inventarioActualizar($datos)
{
  $sql = conexion()->prepare('UPDATE inventario
SET
  IDTipoInv = ?,
  CodigoInv = ?,
  DescripcionInv = ?,
  PrecioInv = ?,
  UltimaActualizacionInv = ?
WHERE
  IDInv = ?');
  $sql->execute($datos);
}

//* ACTUALIZAR ESTADO DEL PRODUCTO / SERVICIO
function inventarioActualizarEstado($datos)
{
  $sql = conexion()->prepare('UPDATE inventario
SET
  EstadoInv = ?,
  UltimaActualizacionInv = ?
WHERE
  IDInv = ?');
  $sql->execute($datos);
}

//* RELLENAR EXISTENCIA Y ACTUALIZAR EL PRECIO DE COSTO
function inventarioExistenciaRellenarYActualizarCosto($datos)
{
  $sql = conexion()->prepare('UPDATE inventario
SET
  Existencia = Existencia + ?,
  PrecioInv = ?
WHERE
  IDInv = ?');
  $sql->execute($datos);
}

//* RELLENAR EXISTENCIA 
function inventarioExistenciaRellenar($datos)
{
  $sql = conexion()->prepare('UPDATE inventario
SET
  Existencia = Existencia + ?
WHERE
  IDInv = ?');
  $sql->execute($datos);
}

//* RELLENAR EXISTENCIA Y ACTUALIZAR EL PRECIO DE COSTO
function inventarioExistenciaRetirar($datos)
{
  $sql = conexion()->prepare('UPDATE inventario
SET
  Existencia = Existencia - ?
WHERE
  IDInv = ?');
  $sql->execute($datos);
}

//* 
function inventarioMovimientoLista()
{
  return conexion()->query('SELECT * FROM inventario_movimiento_tipos WHERE EstadoMovimiento = 1');
}

//* REGISTRAR MOVIMIENTO DE INVENTARIO
function inventarioMovimientoRegistrar($datos)
{
  $sql = conexion()->prepare('INSERT INTO
  inventario_movimiento (
    FechaMov,
    IDTipoMov,
    IDInv,
    ExistenciaAnterior,
    Movimiento,
    ExistenciaActual,
    ConceptoMov,
    ResponsableMov
  )
VALUES
  (?, ?, ?, ?, ?, (SELECT Existencia FROM inventario WHERE IDInv = ?), ?, ?)');
  $sql->execute($datos);
}

//* REPORTE DE MOVIMIENTO DE INVENTARIO
function reportInventarioMovimiento($datos, $IDTipoMov)
{
  $sql = conexion()->prepare('SELECT
  *
FROM
  inventario_movimiento
  INNER JOIN inventario_movimiento_tipos ON inventario_movimiento.IDTipoMov = inventario_movimiento_tipos.IDTipoMov
  INNER JOIN inventario ON inventario_movimiento.IDInv = inventario.IDInv
  INNER JOIN inventario_tipos ON inventario.IDTipoInv = inventario_tipos.IDTipoInv
WHERE
  FechaMov BETWEEN ? AND ?' . ($IDTipoMov != '' ? 'AND inventario_movimiento.IDTipoMov = ' . $IDTipoMov : ''));
  $sql->execute($datos);
  return $sql;
}

//* BUSCADOR DE PRODUCTOS / SERVICIOS
function inventarioBuscador($datos)
{
  $sql = conexion()->prepare('SELECT
  *
FROM
  inventario
  INNER JOIN inventario_tipos ON inventario.IDTipoInv = inventario_tipos.IDTipoInv
WHERE
  EstadoInv = 1
  AND (CodigoInv LIKE ? OR DescripcionInv LIKE ?)');
  $sql->execute($datos);
  return $sql;
}