<?php
//* CONEXION BASE DE DATOS
function conexion()
{
  $host = 'localhost';
  $dbname = 'sistema4_sistema4_taller';
  $username = 'sistema4_administrador';
  $password = 'sistemas2025*';

  $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  //$conexion = new PDO("mysql:host=localhost;dbname=sistema4_taller", 'root', '');
  $conexion->exec('SET CHARACTER SET utf8');
  return $conexion;
}


//* CONEXIÓN BASE DE DATOS LOCAL
function conexionTasa()
{
  // Datos de conexión a la base de datos
  $host = 'localhost';
  $dbname = 'sistema4_apure_gas_operaciones';
  $username = 'sistema4_administrador';
  $password = 'sistemas2025*';

  $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  //$conexion = new PDO('mysql:host=localhost;dbname=sistema4_planta_gas', 'root', '');
  $conexion->exec('SET CHARACTER SET utf8');
  return $conexion;
}


function obtenerTasaRefUSD($datos)
{
  // Consulta SQL para obtener TasaRefUSD
  $sql = "SELECT TasaRefUSD FROM historial_tasa_bcv WHERE FechaTasa = ? ORDER BY FechaTasa DESC LIMIT 1";
  // Preparar y ejecutar la consulta
  $stmt = conexionTasa()->prepare($sql);
  $stmt->execute($datos);

  // Retornar el valor si la consulta es exitosa
  return $stmt->fetchColumn();
}
