<?php

//* CONSULTAR TASA REFERENCIA
function tasaRefConsultarXFecha($datos)
{
  $sql = conexionTasa()->prepare('SELECT * FROM historial_tasa_bcv WHERE FechaTasa = ?');
  $sql->execute($datos);
  return $sql;
}