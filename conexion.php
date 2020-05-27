<?php
 /*DEFINIMOS LOS VALORES DE LA CONEXION MYSQL Y EL NOMBRE DE LA BD*/
 $link = 'mysql:host=localhost;dbname=crud';

 /*DEFINIMOS NUESTRO USUARIO Y CONTRASEÑA DEL SERVIDOR*/
 $usuario = 'root';
 $pass = '';

//CONEXION Y VERIFICANDO LOS DATOS
 try {
   $pdo = new PDO($link,$usuario,$pass);

   //echo 'Conectado Exitosamente <br>';

   /*EJEMPLO PARA OBTENER LOS DATOS DE MI BD*/
   //RECORRE EL ARREGLO ($pdo) CON EL COMANDO QUERY Y GUARDALO (as) en la variable $fila
   //foreach ($pdo->query('SELECT * FROM `productos`') as $fila) {
   //   print_r($fila);
   //}

   /*SI OCURRE UN ERROR AL COMPOROBAR LOS DATOS*/
 }catch (PDOException $e) {
   print "!Error de Conexion!: " . $e->getMessage() . "<br/>";
   die();
 }
 ?>
