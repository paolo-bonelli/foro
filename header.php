<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Foro - Vincenzo Bonelli PHP 2</title>
  <link rel="stylesheet" href="css/principal.css">
</head>

<body>
  <header id="cabecera-principal">
    <div class="marca">
      <a href="./">El Foro Interesante</a>
    </div>
    <form id="barra-busqueda" action="./buscar.php" method="get">
      <input type="submit" id="busca" value="">
      <input type="search" name="busqueda" id="busqueda" required value="<?php if (isset($_GET['busqueda'])) {
                                                                            echo $_GET['busqueda'];
                                                                          } ?>">
      <label for="busca">
        <img src="./imagenes/lupa.png" alt="Busca mascota">
      </label>
    </form>
    <nav id="nav-principal">
      <ul>
        <li>
          <a href="./">Foro</a>
        </li>
        <li>
          <a href="./agregar-tema.php">Nuevo tema</a>
        </li>
      </ul>
    </nav>
  </header>
  <section class="contenido">