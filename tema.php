<?php include('./header.php'); ?>

<?php include('./conexion.php'); ?>

<?php

if (isset($_GET['id']) and (int)$_GET['id'] !== 0) {
  $id = (int)$_GET['id'];
  $temas = mysqli_query($link, "SELECT * FROM tema WHERE id={$id}");

  if (mysqli_num_rows($temas) > 0) {
    $tema = mysqli_fetch_array($temas, MYSQLI_ASSOC) ?>
    <article id="unico" class="tema">
      <h4><?php echo $tema['titulo']; ?></h4>
      <section class="info">
        Publicado el <i><?php echo date_format(date_create($tema['fecha']), "j M Y"); ?></i> a las <i><?php echo date_format(date_create($tema['hora']), "H:i"); ?></i>
        Por <b><i><?php echo $tema['autor']; ?></i></b>
      </section>
      <section class="mensaje">
        <p><?php echo $tema['tema']; ?></p>
      </section>
      <?php include('./respuestas.php'); ?>
    </article>
  <?php } else { ?>
    <h3>No existe el tema solicitado</h3>
  <?php }
} else { ?>
  <meta http-equiv="refresh" content="0;URL=./" />
<?php } ?>

<?php include('./footer.php'); ?>