<?php include('./header.php'); ?>

<?php include('./conexion.php'); ?>

<?php if (isset($_GET['busqueda']) and $_GET['busqueda'] !== '') { ?>

  <h1>El Foro Interesante</h1>

  <?php

  $temas = mysqli_query($link, "SELECT * FROM tema WHERE titulo LIKE '%{$_GET['busqueda']}%'");

  if (mysqli_num_rows($temas) > 0) {
    while ($tema = mysqli_fetch_array($temas, MYSQLI_ASSOC)) {
  ?>
      <article class="tema">
        <a class="tema-link" href="./tema.php?id=<?php echo $tema['id']; ?>">
        </a>
        <h4><?php echo $tema['titulo']; ?></h4>
        <section class="info">
          Publicado el <i><?php echo date_format(date_create($tema['fecha']), "j M Y"); ?></i> a las <i><?php echo date_format(date_create($tema['hora']), "H:i"); ?></i>
          Por <b><i><?php echo $tema['autor']; ?></i></b>
        </section>
        <section class="mensaje">
          <p><?php echo $tema['tema']; ?></p>
        </section>
      </article>
    <?php
    }
  } else {
    ?>
    <h3>No se ha conseguido el tema que buscas. ¡Crealo!</h3>
  <?php
  }
} else {
  ?>
  <h3>Tu busqueda no es válida.</h3>
<?php } ?>
<?php include('./footer.php'); ?>