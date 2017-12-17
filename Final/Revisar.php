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

      function pedirDatos()
      {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
        {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {
            document.getElementById("mostrar").innerHTML = xmlhttp.responseText;
          }
        }
        xmlhttp.open("GET","VerPreguntasAjax.php",true);
        xmlhttp.send();
      }

      function rellenarEdicion()
      {
        var c =document.getElementById("codigo").value;
        document.getElementById("borrarButton").disabled=false;

        xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
        {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {
            console.log(xmlhttp.responseText);
            result= xmlhttp.responseText;
            elementos = result.split('%*-');
            if(elementos[1]!="error")
            {
              document.getElementById("codigo").value=c;
              document.getElementById("pregunta").value=elementos[1];
              document.getElementById("correcta").value=elementos[2];
              document.getElementById("incorrecta1").value=elementos[3];
              document.getElementById("incorrecta2").value=elementos[4];
              document.getElementById("incorrecta3").value=elementos[5];
              document.getElementById("complejidad").value=elementos[6];
              document.getElementById("tema").value=elementos[7];

              document.getElementById("resto").style.visibility="visible";

              document.getElementById("editButton").value="Editar "+c;
              document.getElementById("editButton").disabled=false;

            }
            else
            {
              if(document.getElementById("resto").style.visibility!="hidden")
                document.getElementById("resto").style.visibility="hidden";

              document.getElementById("borrarButton").disabled=true;
              document.getElementById("editButton").disabled=true;
              document.getElementById("editButton").value="Editar";
            }
          }
      }
      console.log("GET","VerPreguntasAjax.php?c=" + c);
      xmlhttp.open("GET","VerPreguntasAjax.php?c=" + c,true);
      xmlhttp.send();
    }

    function editarPregunta()
    {
      xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange=function()
      {
        if(xmlhttp.readyState==4 && xmlhttp.status==200)
        {
          document.getElementById('resultado').innerHTML=xmlhttp.responseText;

          if(document.getElementById("resto").style.visibility!="hidden")
            document.getElementById("resto").style.visibility="hidden";;

          document.getElementById("borrarButton").disabled=true;
          document.getElementById("editButton").disabled=true;
          document.getElementById("editButton").value="Editar";
        }
      }
      xmlhttp.open("GET","editarPregunta.php?codigo=" + document.getElementById("codigo").value +
      "&pregunta=" + document.getElementById("pregunta").value + "&correcta=" + document.getElementById("correcta").value +
      "&incorrecta1=" +document.getElementById("incorrecta1").value + "&incorrecta2=" +document.getElementById("incorrecta2").value  +
      "&incorrecta3=" +document.getElementById("incorrecta3").value + "&complejidad=" +document.getElementById("complejidad").value +
      "&tema=" +document.getElementById("tema").value, true);
      xmlhttp.send();
    }

    function borrarPregunta()
    {
      {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function()
        {
          if(xmlhttp.readyState==4 && xmlhttp.status==200)
          {
            document.getElementById('resultado').innerHTML=xmlhttp.responseText;

            if(document.getElementById("resto").style.visibility!="hidden")
              document.getElementById("resto").style.visibility="hidden";

            document.getElementById("borrarButton").disabled=true;
            document.getElementById("editButton").disabled=true;
            document.getElementById("editButton").value="Editar";
          }
        }
        xmlhttp.open("GET","borrarPregunta.php?codigo=" + document.getElementById("codigo").value, true);
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

      <div id="preguntas" >
        <input type = "button" value = "Mostrar Preguntas" onclick = "pedirDatos()"><br>
      </div>
      <div id="mostrar" style="margin:0 auto; height:200px; overflow:auto;"></div>

      <div id="insertar pregunta">
        <form id='epreguntas'>
          <h1>EDITAR PREGUNTA</h1>

          Codigo<br>
          <input type="number" name="codigo" id= "codigo" onfocusout="rellenarEdicion()" ><br>
          <span id="resto" style="visibility:hidden">

            Enunciado de la pregunta(*):<br>
            <input type="text" name="pregunta" id="pregunta" ><br>
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
          </span>

          <input disabled id="editButton" type="button" onclick="editarPregunta()" value="Editar">
          <input disabled id="borrarButton" type="button" onclick="borrarPregunta()" value="Borrar">

          <br><div id="resultado" style="margin:10px"></div>

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
