<?php
  session_start();

  if((!(isset($_SESSION['autentificado']))) || ($_SESSION["autentificado"]!= "profesor"))
  {
    echo '<script> alert("Has realizado un acceso no valido, por favor vuelve a iniciar sesion correctamente") </script>';
    echo '<script type="text/javascript">window.location.assign("layout.php");</script>';
  }
?>

<!DOCTYPE html>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="scripts/validar.js"></script>
  </head>
  <body>
  <div id='page-wrap'>
    <header class='main' id='h1'>
      <?php
        if(isset($_SESSION['usuario']))
          echo '<span> Usuario actual= '. $_SESSION['usuario']. '</span><br>';

        if((isset($_SESSION['autentificado'])) && ($_SESSION['autentificado']== "si"))
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
      <span><a href='Revisar.php'>Revisar Preguntas</a></span>
      <span><a href='creditos.php'>Creditos</a></span>
    </nav>
    <section class="main" id="s1">


    </section>
    <footer class='main' id='f1'>
      <a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a>
    	<a href='https://github.com/Julexpuru/SW'>Link GITHUB</a><br>

    	<br>
      <a href='layout.php'>Inicio</a>
      <a href='Revisar.php'>Revisar Preguntas</a>
      <a href='creditos.php'>Creditos</a>
    </footer>
  </div>
  </body>
</html>
