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

	   <script language="javascript" href="scripts/validar.js"></script>
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
  		<span><a href='creditos.php'>Creditos</a></span>
  	</nav>
    <section class="main" id="s1">

      <?php
  			////// Gestion del login ///////
  			function ValidarYEnviar()
  			{
  				if ((preg_match("/(^[a-z]+)([0-9]{3})\@(ikasle\.)?(ehu)\.(es|eus)/", $_POST['email']))
  				and (preg_match("/^|a-zA-Z0-9]*$/", $_POST['password'])))
  				{
  					$link = mysqli_connect("localhost", "root", "", "usuarios");
  					$sql = "SELECT Password FROM usuarios WHERE Email = '" . $_POST['email'] . "' and Password = '" . $_POST['password'] . "'";

  					if (!mysqli_query($link ,$sql))
  					{
  						die('Error: fallo al intentar conectarse a la BD ' . mysqli_error($link));
  					}

  					$res= mysqli_query($link ,$sql);
  					$con= mysqli_num_rows($res);

  					if($con==1)
  					{
                session_start();
                $_SESSION["autentificado"]= "si";
                $_SESSION["usuario"]= $_POST['email'];

                $sql="SELECT Foto FROM usuarios WHERE Email='" .$_POST['email'] ."'";
                $res= mysqli_query($link ,$sql);
                $_SESSION["foto"]= mysqli_fetch_array($res)['Foto'];

                mysqli_close($link);

                if($_SESSION["usuario"]=="web000@ehu.es")
                  echo '<script type="text/javascript">window.location.assign("Revisar.php");</script>';
                else
                  echo '<script type="text/javascript">window.location.assign("GestionarPreguntas.php");</script>';
            }
    				else
    				{
    					echo "<script>alert('Error al validar los datos, por favor pruebe de nuevo')</script>";
    				}
         }
      }

			if (isset($_POST['email']) && isset($_POST['password']))
			{
				ValidarYEnviar();
			}

    ?>

		<div>

			<form id='flogin' name='flogin' onsubmit="return checkEmail();" method="post">
				<h1>LOGIN</h1>
				<br>
				<p><strong>Email</strong></p>
				<input id="email" name="email" type="text"/>
				<br>
				<p><strong>Password</strong></p>
				<input id="password" name="password" type="password" />
				<br>
				<br>

				<input type="submit" value="Entrar"><br>
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
