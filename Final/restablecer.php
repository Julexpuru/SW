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

      <?php
        if((isset($_POST['pass'])) && (isset($_POST['repass'])))
        {
          if (strlen($_POST['pass'])<6)
          {
            echo "<script>alert('Introduce una contraseña valida')</script>";
          }
          else if($_POST['repass']!=$_POST['pass'])
          {
            echo "<script>alert('Las contraseñas no coinciden')</script>";
          }
          else if ((strlen($_POST['pass'])>=6) && ($_POST['repass']==$_POST['pass']))
          {
            restablecer();
          }
        }

  			function restablecer()
  			{
					$link = mysqli_connect("localhost", "root", "", "quiz");
					$sql = "UPDATE usuarios SET Password='". crypt($_POST['pass'],"cifrado") ."' WHERE Email='".$_GET['email']."'";

					if (!mysqli_query($link ,$sql))
					{
						die('Error: fallo al intentar conectarse a la BD ' . mysqli_error($link));
					}
          else
            mysqli_close();
            echo "<script>alert('Tu contraseña ha sido restablecida, prueba a iniciar sesion con ella ahora')</script>";
            sleep(4);
            echo '<script type="text/javascript">window.location.assign("Login.php");</script>';

        }

      ?>

  		<div>
  			<form id='frecuperar' method="post">
  				<h1>Restablecer Contraseña</h1>
  				<br>

          <p><strong>Contraseña nueva</strong></p>
  				<input id="pass" name="pass" type="password"/>
          <p><strong>Repetir contraseña nueva</strong></p>
  				<input id="repass" name="repass" type="password"/>
  				<br>

  				<input type="submit" value="Restablecer"><br>
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
