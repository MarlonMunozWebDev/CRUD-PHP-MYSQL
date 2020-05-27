<?php
  //CAMBIANDO DATOS MANUALMENTE
  //echo 'editar.php?id=1&producto=nuevo&descripcion=Soy nuevo';
  //echo '<br>';

  //GUARDAR EN VARIABLES LOS DATOS CAPTADOS POR EL METODO GET DE LA URL
  $id = $_GET['id'];
  $producto = $_GET['producto'];
  $descripcion = $_GET['descripcion'];

  //echo $id;
  //echo '<br>';
  //echo $producto;
  //echo '<br>';
  //echo $descripcion;

  //INCLUIMOS EL ARCHIVO DE LA CONEXION A LA BD
  include_once 'conexion.php';

  //EDITAR
  $sql_editar = 'UPDATE productos SET producto=?, descripcion=? WHERE id=?';
  $sentencia_editar = $pdo->prepare($sql_editar);
  $sentencia_editar->execute(array($producto,$descripcion,$id));

  //CERRAMOS LA CONEXION DE LA BD Y LA SENTENCIA PARA BORRAR LO INTRODUCIDO
  $pdo = null;
  $sentencia_editar = null;
  header('location:index.php');
 ?>
