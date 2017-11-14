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
    <script language="javascript">
    	function pedirDatos()
    	{
    		xmlhttp = new XMLHttpRequest();
    		xmlhttp.onreadystatechange = function()
    		{
    			if (xmlhttp.readyState==4 && xmlhttp.status==200)
    			{
    				document.getElementById("resultado").innerHTML = xmlhttp.responseText;
    			}
    		}
    		xmlhttp.open("GET","VerPreguntasAjax.php",true); 
    		xmlhttp.send();
    	}
    	function insertarDatos()
		{
    		xmlhttp = new XMLHttpRequest();
    		xmlhttp.onreadystatechange=function(){
    			if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{
    				document.getElementById('insertado').innerHTML=xmlhttp.responseText;
    				alert(xmlhttp.responseText);
    			}
    		}
    		xmlhttp.open("GET","InsertarPregunta.php?correo=" + document.getElementById("correo").value + 
			"&pregunta=" + document.getElementById("correcta").value + "&correcta=" + document.getElementById("correcta").value + 
			"&incorrecta1=" +document.getElementById("incorrecta1").value + "&incorrecta2=" +document.getElementById("incorrecta2").value  +
			"&incorrecta3=" +document.getElementById("incorrecta3").value + "&complejidad=" +document.getElementById("complejidad").value +
			"&tema=" +document.getElementById("tema").value + "&imagen=" +document.getElementById("imagen").value , true);
    		xmlhttp.send();
    	}

      function Carga( files )
      {
        var file= files[0];
          
	    reader = new FileReader();
	    reader.onload = function(event) 
	            { var img = new Image; 
	              img.src = event.target.result;}
	    reader.readAsDataURL( file );
      }
	  function loadFile(event)
      {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
      }
	  
    </script>
    <script type="text/javascript" src="scripts/validar.js"></script>
  </head>
  <body>
  <div id='page-wrap'>
    <header class='main' id='h1'>
      <span class="right"><a href="registro">Registrarse</a></span>
            <span class="right" style="display:none;"><a href="Login.php">Login</a></span>
            <span class="right"><a href="layout.html" onclick="alert('Cerrando sesion. ¡Vuelve pronto!')">Logout</a></span>
      <h2>Quiz: el juego de las preguntas</h2>
      </header>
    <nav class='main' id='n1' role='navigation'>
      <span><a href='VerPreguntasConFoto.php'>Preguntas</a></span>
  	  <span><a href='pregunta.html'>Crear Pregunta</a></span>
    </nav>
    <section class="main" id="s1">
    	
      <div id="numPreguntas">
        <p>Aparecera el numero de preguntas</p>
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

      <div id="botones">
        <form>  
          <input type = "button" value = "Mostrar preguntas" onclick = "pedirDatos()">  
          <input type = "button" value = "Insertar pregunta" onclick = "insertarDatos()">  
        </form> 
      </div>

      <div id="insertado">  </div> 
      <div id="resultado" align="center">  <p>Apareceran las preguntas del documento XML</p> </div><br><br>

    </section>
    <footer class='main' id='f1'>
      <a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a>
    	<a href='https://github.com/Julexpuru/SW'>Link GITHUB</a><br>		
    	
    	<br>
    	<a href="VerPreguntasConFoto.php">Preguntas</a><br>
      <a href="pregunta.html"> Crear Pregunta </a><br>
    </footer>
  </div>

  <script type="text/javascript" src="scripts/validar.js"></script>

  </body>
</html>