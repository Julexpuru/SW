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
    <script language="javascript">
      function Carga( files )
      {
        var file= files[0];

  	    reader = new FileReader();
  	    reader.onload = function(event)
  	            { var img = new Image;
  	              img.src = event.target.result;  }
  	    reader.readAsDataURL( file );
      }
	    function loadFile(event)
      {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
      }
    </script>
	  <script language="javascript">

      function rellenarEdicion()
      {
        var c =document.getElementById("codigo").value;

        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
        {
          alert(xmlhttp.readyState);
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {

            if(xmlhttp.responseText!="")
            {
              console.log(xmlhttp.responseText);
              elementos = result.split('%*-');
              $("#pregunta").val(elementos[0]);
              $("#correcta").val(elementos[1]);
              $("#incorrecta1").val(elementos[2]);
              $("#incorrecta2").val(elementos[3]);
              $("#incorrecta3").val(elementos[4]);
              $("#complejidad").val(elementos[5]);
              $("#tema").val(elementos[6]);

              $("#fid").val(paramid);
              $("#editButton").removeAttr("disabled");
              $("#editButton").html("Editar ID " + c);
            }
          }
          console.log("GET","VerPreguntasAjax.php?c=" + c);
          xmlhttp.open("GET","VerPreguntasAjax.php?c=" + c,true);
          xmlhttp.send();
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
      <span><a href='Revisar.php'>Revisar Preguntas</a></span>
      <span><a href='creditos.php'>Creditos</a></span>
    </nav>
    <section class="main" id="s1">

      <div id="tablaPreguntas" style="height:200px; overflow:auto; ">
        <?php
          $link = mysqli_connect("localhost", "root", "", "quiz");

          if ($link->connect_error) {
            die("La conexion ha fallado: " . $link->connect_error);
          }

          $sql = "SELECT * FROM Preguntas";
          $result = mysqli_query($link, $sql);

          echo "
            <table border=1 style=\"margin-left:10%; margin-right:10%;\">
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
                <td><img src=" .'"'.$row['Imagen'].'"'." width='"."20%"."' height='"."auto"."'></td>
              </tr>";
          }
          echo "</table>";

          mysqli_close($link);
        ?>
      </div>

      <div id="insertar pregunta">
        <form id='epreguntas'>
          <h1>EDITAR PREGUNTA</h1>

          Codigo<br>
          <input type="text" name="codigo" id= "codigo" onchange="rellenarEdicion()" ><br>
          Enunciado de la pregunta(*):<br>
          <input type="text" name="pregunta" id="pregunta"><br>
          Respuesta correcta(*):<br>
          <input type="text" name="correcta" id="correcta"><br>
          Respuesta incorrecta1(*):<br>
          <input type="text" name="incorrecta1" id="incorrecta1"><br>
          Respuesta incorrecta2(*):<br>
          <input type="text" name="incorrecta2" id="incorrecta2"><br>
          Respuesta incorrecta3(*):<br>
          <input type="text" name="incorrecta3" id="incorrecta3"><br>
          Complejidad de la pregunta entre 1 y 5(*):<br>
          <input type="number" name="complejidad" id="complejidad"><br>
          Tema de la pregunta(*):<br>
          <input type="text" name="tema" id="tema"><br>
          Imagen relacionada con la pregunta<b>(opcional)</b>:<br>
          <input type="file" name="imagen" id="imagen" onchange="loadFile(event);Carga(this.files);"><br>
          <p>Vista previa de la imagen:</p>
            <img id="output" width="150px" height="auto"/><br>

          <input disabled id="editButton" type="submit" value="Editar">
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
