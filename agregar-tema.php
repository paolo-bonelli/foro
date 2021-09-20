<?php include('./header.php'); ?>

<?php include('./conexion.php'); ?>

<?php
$titulo = $mensaje = $autor = '';
$errores = array();

if ($_SERVER['REQUEST_METHOD'] ===  'POST') {
  if (isset($_POST['titulo'])) {
    $titulo = limpia_entrada($_POST['titulo']);
    if (strlen($titulo) > 30) {
      array_push($errores, 'El título debe tener máximo treinta (30) caracteres.');
    }
  } else {
    array_push($errores, 'No se introdujo un título del tema.');
  }


  if (isset($_POST['autor'])) {
    $autor = limpia_entrada($_POST['autor']);
    if (strlen($autor) > 30) {
      array_push($errores, 'El autor debe tener máximo treinta (30) caracteres.');
    }
  } else {
    array_push($errores, 'No introdujo el autor del tema.');
  }

  if (isset($_POST['mensaje'])) {
    $mensaje = limpia_entrada($_POST['mensaje']);
    if (strlen($mensaje) > 30) {
      array_push($errores, 'El mesaje debe tener máximo cien (100) caracteres.');
    }
  } else {
    array_push($errores, 'No introdujo el mensaje del tema.');
  }

  if (sizeof($errores) === 0) {
    $sql = "INSERT INTO tema(titulo,autor,tema) VALUES ('{$titulo}','{$autor}','{$mensaje}')";
    if ($resultado = mysqli_query($link, $sql)) {
?>
      <meta http-equiv="refresh" content="0;URL=./" />
<?php
    }
  }
}
?>

<?php foreach ($errores as $error) { ?>
  <div class="error"><small><?php echo $error ?></small></div>
<?php } ?>

<h2>Crea un Tema nuevo</h2>

<hr>


<form class="insertar" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
  <label for="titulo">Título</label>
  <input type="text" name="titulo" id="titulo" maxlength="30" value="<?php echo $titulo; ?>" required>

  <label for="autor">Autor</label>
  <input type="text" name="autor" id="autor" maxlength="30" value="<?php echo $autor; ?>" required>

  <label for="mensaje">Mensaje</label>
  <textarea name="mensaje" id="mensaje" cols="30" rows="3" maxlength="100" required><?php echo $mensaje; ?></textarea>

  <input type="reset" value="Limpiar">
  <input type="submit" value="Agregar">

</form>


<?php include('./footer.php'); ?>