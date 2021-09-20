<?php
$autor = $respuesta = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $errores = array();
  if (isset($_POST['id_tema'])) {
    $id_tema = $_POST['id_tema'];
    if (filter_var($id_tema, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1)))) {
      $sql = "SELECT id FROM tema WHERE id={$id_tema}";

      $tema = mysqli_query($link, $sql);

      if (mysqli_num_rows($tema) === 0) {
        array_push($errores, 'El tema que quiere comentar no es válido');
      }
    }
  }

  if (isset($_POST['autor'])) {
    $autor = filter_var($_POST['autor'], FILTER_SANITIZE_STRING);
    if (strlen($autor) > 30) {
      array_push($errores, 'El autor debe tener máximo treinta (30) caracteres.');
    }
  } else {
    array_push($errores, 'No introdujo el autor del tema.');
  }

  if (isset($_POST['respuesta'])) {
    $respuesta = filter_var($_POST['respuesta'], FILTER_SANITIZE_STRING);
    if (strlen($respuesta) > 30) {
      array_push($errores, 'La respuesta debe tener máximo cien (100) caracteres.');
    }
  } else {
    array_push($errores, 'No introdujo el contenido de la respuesta.');
  }

  if (sizeof($errores) === 0) {
    $sql = "INSERT INTO respuesta(autor,respuesta,id_tema) VALUES ('{$autor}','{$respuesta}','{$id_tema}')";
    if ($resultado = mysqli_query($link, $sql)) { ?>
      <meta http-equiv="refresh" content="0;URL=<?php echo $_SERVER['PHP_SELF'] . "?id={$_GET['id']}"; ?>" />
<?php
    }
  }
} ?>
<section id="respuestas">

  <?php foreach ($errores as $error) { ?>
    <div class="error"><small><?php echo $error ?></small></div>
  <?php } ?>

  <h4>Respuestas</h4>

  <form class="insertar" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id={$_GET['id']}"; ?>" method="post">
    <label for="autor">Autor</label>
    <input type="text" name="autor" id="autor" maxlength="10" required value="<?php echo $autor; ?>">
    <label for="respuesta">Respuesta</label>
    <textarea name="respuesta" id="respuesta" cols="30" rows="3"><?php echo $respuesta; ?></textarea>
    <input type="hidden" name="id_tema" value="<?php echo $_GET['id']; ?>">
    <input type="reset" value="Limpia">
    <input type="submit" value="Comentar">
  </form>

  <?php
  $sql = "SELECT autor,respuesta FROM respuesta WHERE id_tema={$_GET['id']}";
  $respuestas = mysqli_query($link, $sql);

  if (mysqli_num_rows($respuestas) > 0) {
    while ($respuesta = mysqli_fetch_array($respuestas, MYSQLI_ASSOC)) {
  ?>
      <article class="respuesta">
        <section class="info">
          Publicado el <i><?php echo date_format(date_create($respuesta['fecha']), "j M Y"); ?></i> a las <i><?php echo date_format(date_create($respuesta['hora']), "H:i"); ?></i>
          Por <b><i><?php echo $respuesta['autor']; ?></i></b>:
        </section>
        <section class="mensaje">
          <?php echo $respuesta['respuesta']; ?>
        </section>
      </article>
    <?php
    }
  } else { ?>
    <h2>Sé el primero en comentar!</h2>
  <?php } ?>
</section>