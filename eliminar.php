<?php
include_once 'conexion.php';

$id = $_GET['id'];

$sql_eliminar = 'DELETE FROM productos WHERE id=?';
$sentencia_eliminar = $pdo->prepare($sql_eliminar);
$sentencia_eliminar->execute(array($id));

//CERRAMOS LA CONEXION DE LA BD Y LA SENTENCIA PARA BORRAR LO INTRODUCIDO
$pdo = null;
$sentencia_eliminar = null;

header('location:index.php');

 ?>
