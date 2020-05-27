<?php

include_once 'conexion.php';
//echo 'Desde mi compañero';

//FETCHALL
//LEER Y MOSTRAR UNA TABLA
$sql_leer = 'SELECT * FROM productos';

//VARIABLE QUE GUARDARA TODA LA CONEXION PDO Y LA SENTECIA SQL
$gsent = $pdo->prepare($sql_leer);
//LE PONEMOS LA FUNCION PARA QUE SE EJECUTE
$gsent->execute();

//GUARDAMOS EN RESULTADO EL FETCHALL CON EL QUE NOS DEVOLVERA UN ARRAY
$resultado = $gsent->fetchAll();

//IMPRIMIMOS EL RESULTADO
//var_dump($resultado);

//AGREGAR
//SI LOS DATOS SE ESTAN ENVIANDO POR POST
if($_POST) {
  //GUARDAMOS EN VARIABLES LOS DATOS INTRODUCIDOS POR EL USUARIO
  $producto = $_POST['producto'];
  $descripcion = $_POST['descripcion'];

  //GUARDAMOS EN UNA VARIABLE LA SENTENCIA SQL CON SEGURIDAD - SIN (:producto, :descripcion)
  $sql_agregar = 'INSERT INTO productos (producto,descripcion) VALUES (?,?)';
  $sentencia_agregar = $pdo->prepare($sql_agregar);

  //LE DECIMOS QUE LOS SIGNOS DE INTERROGACION ES IGUAL A NUESTRAS VARIABLES QUE MANDO EL USUARIO EN EL ORDEN DE LAS COLUMNAS
  $sentencia_agregar->execute(array($producto,$descripcion));

  //CERRAMOS LA CONEXION DE LA BD Y LA SENTENCIA PARA BORRAR LO INTRODUCIDO
  $sentencia_agregar = null;
  $pdo = null;

  //AL TERMINAR LO ANTERIOR MANDAME A ESTE ARCHIVO
  header('location:index.php');
}

//SOLO MODIFCA LOS VALORES CON EL ID OBTENIDO
if($_GET) {
  $id = $_GET['id'];
  $sql_unico = 'SELECT * FROM productos WHERE id=?';
  $sentencia_unico = $pdo->prepare($sql_unico);
  $sentencia_unico->execute(array($id));

  //SOLO REGRESA UN RESULTADO
  $resultado_unico = $sentencia_unico->fetch();
}

  //var_dump($resultado_unico);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>PRODUCTOS</title>
  </head>
  <body style="font-family: 'Poppins',sans-serif">
    <div class="container mt-5 tabla">
      <h2 class="bg-success text-white p-3 rounded">CRUD</h2> <br>
      <div class="row">
        <div class="col-md-8">

          <table class="table table-striped">
            <thead class="bg-primary text-white">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Producto</th>
                <th scope="col">Precio</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php  foreach($resultado as $dato): ?>
              <tr>
                <th scope="row"></th>
                <td><?php echo $dato['producto']?></td>
                <td><?php echo $dato['descripcion']?></td>
                <td>
                <a href="eliminar.php?id=<?php echo $dato['id'] ?>" class="float-right ml-2"><img src="img/eliminar.png" alt="" style="height:1.5rem; border-radius: 4px"></a>
                <a href="index.php?id=<?php echo $dato['id'] ?>" class="float-right"> <img src="img/editar.png" alt="" style="height:1.5rem; border-radius: 4px"> </a>
              </td>
              </tr>
              <?php  endforeach ?>
            </tbody>
          </table>
          <!--SECTION QUITADO-->
        </div>

        <?php
        //CERRAMOS LA CONEXION DE LA BD Y LA SENTENCIA PARA BORRAR LO INTRODUCIDO
        $pdo = null;
        $gsent = null;
         ?>

        <div class="col-md-4 bg-success text-white p-3 rounded">

          <!--CONDICIONAL CUANDO HALLA UN METODO CONTRARIO A GET MUESTRAME ESTE APARTADO-->
          <?php if(!$_GET): ?>
          <h2>AGREGAR</h2>
          <form method="POST">
            <input type="text" class="form-control" name="producto" placeholder="Nombre">
            <input type="text" class="form-control mt-4" name="descripcion" placeholder="Precio">
            <button class="btn btn-primary mt-3">Agregar</button>
          </form>
        <?php endif ?>

        <?php if($_GET): ?>
        <h2>EDITAR</h2>
        <!--TENDRA EL METODO GET Y LA ACCION SERA EL ARCHIVO EDITAR.PHP-->
        <form method="GET" action="editar.php">
          <!--INPUT ID OCULTO-->
          <input type="hidden" class="form-control mt-4" name="id"
          value="<?php echo $resultado_unico['id'] ?>">

          <input type="text" class="form-control" name="producto"
          value="<?php echo $resultado_unico['producto'] ?>">
          <input type="text" class="form-control mt-4" name="descripcion"
          value="<?php echo $resultado_unico['descripcion'] ?>">
          <button class="btn btn-primary mt-3">Guardar</button>
        </form>
      <?php endif ?>

        </div>
      </div>
    </div>
  </body>
</html>
