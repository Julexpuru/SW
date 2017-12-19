<?php
  session_start();
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

	   <script language="javascript">
      function validar()
      {
        email=document.getElementById("email").value;
        if (!( /(^[a-z]+)([0-9]{3})\@ikasle\.ehu\.(es|eus)/.test(email)))
        {
          alert("Introduzca un correo valido")
        }
        else
        {
          document.getElementById("recu").disabled=false;
        }

      }
     </script>
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
  		<span><a href='creditos.php'>Creditos</a></span>
  	</nav>
    <section class="main" id="s1">
  		<div>
  			<form id='frecuperar' action="funcionRecuperar.php" method="post">
  				<h1>Recuperar Contraseña</h1>
  				<br>

          <p><strong>Email</strong></p>
  				<input id="email" name="email" onchange="validar()" type="text"/>
  				<br>

  				<input disabled id="recu" type="submit" value="Recuperar"><br>
  			</form>
  		</div>

  		<div>
  			<br>
  				<strong>¿Aún no tienes cuenta? <a href="registro.html" class="date">Registrarse</a>.</Strong>
  			<br>
  		</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com/Julexpuru/SW'>Link GITHUB</a><br>

		<br>
		<a href="layout.php"> Inicio</a> <br>
		<a href="creditos.php"> Creditos </a>
	</footer>
</div>
</body>
</html>
