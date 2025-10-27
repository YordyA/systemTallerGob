<?php

//* LISTA DE PRIVILEGIOS
function usuariosPrivilegiosLista()
{
  return conexion()->query('SELECT * FROM usuarios_privilegios WHERE EstadoPrivilegio = 1');
}

//* VERIFICAR USUARIO POR ID
function usuariosVerificarXID($datos)
{
  $sql = conexion()->prepare('SELECT
  *
FROM
  usuarios
  INNER JOIN usuarios_privilegios ON usuarios.IDPrivilegio = usuarios_privilegios.IDPrivilegio
WHERE
  EstadoUsuario = 1
  AND IDUsuario = ?');
  $sql->execute($datos);
  return $sql;
}

//* VERIFICAR USUARIO POR DESCRIPCION
function usuariosVerificarXUSUARIO($datos)
{
  $sql = conexion()->prepare('SELECT
  *
FROM
  usuarios
  INNER JOIN usuarios_privilegios ON usuarios.IDPrivilegio = usuarios_privilegios.IDPrivilegio
WHERE
  EstadoUsuario = 1
  AND Usuario = ?');
  $sql->execute($datos);
  return $sql;
}

//* REGISTRAR USUARIO
function usuariosRegistrar($datos)
{
  $sql = conexion()->prepare('INSERT INTO
  usuarios (
    IDPrivilegio,
    NombreUsuario,
    Usuario,
    Clave,
    EstadoUsuario
  )
VALUES
  (?, ?, ?, ?, 1)');
  $sql->execute($datos);
  return $sql;
}

//* LISTA DE USUARIOS
function usuariosLista()
{
  return conexion()->query('SELECT
  *
FROM
  usuarios
  INNER JOIN usuarios_privilegios ON usuarios.IDPrivilegio = usuarios_privilegios.IDPrivilegio
WHERE
  EstadoUsuario = 1');
}

//* ACTUALIZAR USUARIO
function usuariosActualizar($datos)
{
  $sql = conexion()->prepare('UPDATE usuarios
SET
  IDPrivilegio = ?,
  NombreUsuario = ?,
  Usuario = ?,
  Clave = ?,
  UltimaActualizacionUsuario = ?
WHERE
  IDUsuario = ?');
  $sql->execute($datos);
}

//* ACTUALIZAR ESTADO DEL USUARIO
function usuariosActualizarEstado($datos)
{
  $sql = conexion()->prepare('UPDATE usuarios
SET
  EstadoUsuario = ?,
  UltimaActualizacionUsuario = ?
WHERE
  IDUsuario = ?');
  $sql->execute($datos);
}