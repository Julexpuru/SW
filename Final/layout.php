<?php
  session_start();
?>

<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quiz</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet'
		   type='text/css'
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet'
		   type='text/css'
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
    <header class='main' id='h1'>
      <?php
        if(isset($_SESSION['usuario']))
          echo '<span> Usuario actual= '. $_SESSION['usuario']. '</span><br>';

        if(isset($_SESSION['autentificado']))
          echo '<span class="right"><a href="Logout.php" onclick="alert(\'Cerrando sesion. ¡Vuelve pronto!\')">Logout</a></span>';
        else
        {
          echo '<span class="right"><a href="registro.html">Registrarse</a></span>';
          echo '<span class="right"><a href="Login.php">Login</a></span>';
        }
      ?>
      <br>

      <h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Inicio</a></span>
    <?php
      if((isset($_SESSION['usuario'])) && ($_SESSION['usuario']=="web000@ehu.es"))
        echo '<a href="Revisar.php"">Revisar Preguntas</a>';
      else if (isset($_SESSION['usuario']))
        echo '<a href="GestionarPreguntas.php">GestionarPreguntas</a>';
    ?>
		<span><a href='creditos.php'>Creditos</a></span>
	</nav>
  <section class="main" id="s1">
  	<div>

  	Pagina principal. Utilice los menus para navegar.

  	</div>
  </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a><br>
		<br>
		<a href="layout.php"> Inicio</a> <br>
		<a href="creditos.php"> Creditos </a>
	</footer>
</div>
</body>
</html>
