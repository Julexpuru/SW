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

      <div id="tablaPreguntas">
        <?php
          $link = mysqli_connect("localhost", "root", "", "quiz");
          
          if ($link->connect_error) {
            die("La conexion ha fallado: " . $link->connect_error);
          }

          $sql = "SELECT * FROM Preguntas";
          $result = mysqli_query($link, $sql);
          
          echo "
            <table border=1> 
              <tr> 
                <th> Codigo </th> <th> Correo </th> <th> Pregunta </th> 
                <th> Correcta </th> <th> Incorrecta1 </th>
                <th> Incorrecta2 </th> <th> Incorrecta3 </th>
                <th> Complejidad </th> <th> Tema </th> <th>Imagen</th>
              </tr>
            ";
          
          while ($row = mysqli_fetch_array($result)) 
          {
            echo "
              <tr>
                <td> ". $row['Codigo'] ."</td> <td> ". $row['Correo'] ."</td> 
                <td> ". $row['Pregunta'] ."</td> <td> ". $row['Correcta'] ."</td> 
                <td> ". $row['Incorrecta1'] ."</td> <td> ". $row['Incorrecta2'] ."</td> 
                <td> ". $row['Incorrecta3'] ."</td> <td> ". $row['Complejidad'] ."</td> 
                <td> ". $row['Tema'] ."</td>
                <td><img src=".$row['Imagen']." width='"."20%"."' height='"."auto"."'></td>
              </tr>";
          }
          echo "</table>";
          
          mysqli_close($link);
        ?>
      </div>  

      <div id="insertar pregunta">
        <form id='fpreguntas'>
          <h1>CREAR PREGUNTA</h1>

          Dirección de correo del autor de la pregunta(*):<br>
          <input type="text" name="correo" id="correo" value="jelexpuru002@ikasle.ehu.es"><br>
          Enunciado de la pregunta(*):<br>
          <input type="text" name="pregunta" id="pregunta" value="Never gonna give you up"><br>
          Respuesta correcta(*):<br>
          <input type="text" name="correcta" id="correcta" value="Rick Astley"><br>
          Respuesta incorrecta1(*):<br>
          <input type="text" name="incorrecta1" id="incorrecta1" value="Bono"><br>
          Respuesta incorrecta2(*):<br>
          <input type="text" name="incorrecta2" id="incorrecta2" value="Bruce Springsteen"><br>
          Respuesta incorrecta3(*):<br>
          <input type="text" name="incorrecta3" id="incorrecta3" value="Paquirrin"><br>
          Complejidad de la pregunta entre 1 y 5(*):<br>
          <input type="number" name="complejidad" id="complejidad" value="2"><br>
          Tema de la pregunta(*):<br>
          <input type="text" name="tema" id="tema" value="Autor"><br>
          Imagen relacionada con la pregunta<b>(opcional)</b>:<br>
          <input type="file" name="imagen" id="imagen" onchange="loadFile(event);Carga(this.files);"><br>
          <p>Vista previa de la imagen:</p>
            <img id="output" width="150px" height="auto"/><br>
        </form>
      </div>

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
