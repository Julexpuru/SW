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
      function Validar()
      {
        var email = document.getElementById('email').value;		
		var pass = document.getElementById('password').value;
		
		if (!( /(^[a-z]+)([0-9]{3})\@ikasle\.ehu\.(es|eus)/.test(email)) || email=="" || pass.length <6)	
		{
			alert("Debe introducir unos datos validos \n");
			return false;
		}
		return true;
	
      }
    </script>
		   
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<span class="right"><a href="registro.html">Registrarse</a></span>
      		<span class="right"><a href="Login.php">Login</a></span>
      		<span class="right" style="display:none;"><a href="/logout">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.html'>Inicio</a></span>
		<span><a href='creditos.html'>Creditos</a></span>
	</nav>
    <section class="main" id="s1">
	
		<?php
			////// Gestion del login ///////
			function ValidarYEnviar()
			{	
				if ((preg_match("/(^[a-zA-Z]+)([0-9]{3})\@ikasle\.ehu\.(es|eus)/", $_POST['email']))  
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
						header('Location: logueado.html');
					}

					mysqli_close($link);
				}
				else
				{
					die('Error: fallo al validar los datos ' . mysqli_error($link));
				}
			}

			if (isset($_POST['email']) && isset($_POST['password'])) 
			{
				ValidarYEnviar();
			}
			
		?>
	
		<div>
		
			<form id='flogin' name='flogin' onsubmit="return Validar();" method="post">
				<h1>LOGIN</h1>
				<br>
				<p><strong>Email</strong></p>
				<input id="email" name="email" type="text" value="jelexpuru002@ikasle.ehu.es"/>
				<br>
				<p><strong>Password</strong></p>
				<input id="password" name="password" type="password" value="contrasena" />
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
		<a href="layout.html"> Inicio</a> <br>
		<a href="creditos.html"> Creditos </a>
	</footer>
</div>
</body>
</html>

