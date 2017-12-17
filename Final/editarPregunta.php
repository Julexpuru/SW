<?php

	if (isset($_GET['codigo']) && ($_GET['pregunta']!="") && ($_GET['correcta']!="") && ($_GET['incorrecta1']!="")
	&& ($_GET['incorrecta2']!="")&& ($_GET['incorrecta3']!="") && ($_GET['complejidad']>=1) && ($_GET['complejidad']<=5)&& ($_GET['tema']!=""))
	{
			$codigo=$_GET['codigo'];
			$pregunta=$_GET['pregunta'];
			$correcta=$_GET['correcta'];
			$incorrecta1=$_GET['incorrecta1'];
			$incorrecta2=$_GET['incorrecta2'];
			$incorrecta3=$_GET['incorrecta3'];
			$complejidad=$_GET['complejidad'];
			$tema=$_GET['tema'];

		//// HACER LA QUERY ////////

		$link = mysqli_connect("localhost", "root", "", "quiz");

		$sql= "UPDATE preguntas SET Pregunta='".$pregunta."', Correcta='".$correcta."', Incorrecta1='".$incorrecta1."', Incorrecta2='".$incorrecta2."', Incorrecta3='".$incorrecta3."', Complejidad='".$complejidad."', Tema='".$tema."' WHERE Codigo=".$codigo;

    if (!mysqli_query($link ,$sql))
		{
			die('Ha habido un error en el proceso de edicion'. mysqli_error($link));
		}
    else
		  echo "Pregunta editada correctamente";
  }
?>
