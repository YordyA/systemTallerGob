<?php
//* LISTA DE EMPRESAS
function empresasListaCentroCosto()
{
  return conexion()->query('SELECT
  *
FROM
  empresas_gob
WHERE
  Estado = 1');
}

//* REGISTRAR EMPRESA
function empresastegistrar($datos)
{
  $sql = conexion()->prepare('INSERT INTO
  empresas_gob (
    DescripcionEmpresa,
    Estado
  )
VALUES
  (?, 1)');
  $sql->execute($datos);
  return $sql;
}
