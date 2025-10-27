<?php

//* LISTA DE TIPO DE GASTO 
function administracionListaTipoGasto()
{
  return conexionAdministracion()->query('SELECT * FROM gastos_administrativo WHERE EstadoGasto = 2 AND IDCentroCosto = 68 GROUP BY IDTipoGasto');
}

//* REPORTE DE GASTO ADMINISTRATIVO Y OPERATIVO
function reportAdministracionGastosLista($datos, $IDTipoGasto)
{
  $sql = conexionAdministracion()->prepare('SELECT
  *
FROM
  gastos_administrativo
  INNER JOIN historial_tasa_bcv ON gastos_administrativo.FechaGasto = historial_tasa_bcv.FechaTasa
WHERE
  EstadoGasto = 2
  AND IDCentroCosto = 68
  AND FechaGasto BETWEEN ? AND ?' . ($IDTipoGasto != '' ? 'AND IDTipoGasto = ' . $IDTipoGasto : ''));
  $sql->execute($datos);
  return $sql;
}

//* REPORTE DE GASTO DE COMBUSTIBLE
function reportAdministracionGastoCombustible($datos, $tipoCombustible)
{
  $sql = conexionAdministracion()->prepare('SELECT
    *
FROM
    combustible_salidas
INNER JOIN combustible_estaciones_servicio ON combustible_salidas.IDCombustibleInventario = combustible_estaciones_servicio.IDCombustibleInventario
INNER JOIN historial_tasa_bcv ON combustible_salidas.FechaSalida = historial_tasa_bcv.FechaTasa
WHERE
  EstadoCombustibleSalida = 2
  AND IDCentroCosto = 68
  AND combustible_salidas.FechaSalida BETWEEN ? AND ?' . ($tipoCombustible != '' ? 'AND combustible_estaciones_servicio.TipoCombustible = "' . $tipoCombustible . '" ' : ''));
  $sql->execute($datos);
  return $sql;
}