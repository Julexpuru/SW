<?php

	if (isset($_GET['codigo']))
	{
			$codigo=$_GET['codigo'];

		//// HACER LA QUERY ////////

		$link = mysqli_connect("localhost", "root", "", "quiz");

		$sql= "DELETE FROM preguntas WHERE Codigo=".$codigo;

    if (!mysqli_query($link ,$sql))
		{
			die(mysqli_error($link));
		}
    else
		  echo "Pregunta borrada correctamente";
  }

?>
