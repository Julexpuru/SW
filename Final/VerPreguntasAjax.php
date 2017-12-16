<!DOCTYPE html>
<html>
		<?php
			$link = mysqli_connect("localhost", "root", "", "quiz");

			if ($link->connect_error) {
				die("La conexion ha fallado: " . $link->connect_error);
			}

      if(!(isset($_GET["c"])))  //comprobar si le ha llamado el GestionarPreguntas o Revisar
      {
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
      }
      else
      {
        $sql = "SELECT * FROM Preguntas WHERE Codigo=".$_GET["c"];
        if (!mysqli_query($link,$sql))
          echo "";  //si la pregunta no esta en la base de datos, no modifica el formulario anterior
        else
        {
          $result = mysqli_query($link, $sql);
          $row = mysqli_fetch_array($result);

          if (mysqli_num_rows($result)==1)
          {
    				$row = $row['pregunta'].'%*-'.$row['respuestaok']
    				.'%*-'.$row['respuestamal1'].'%*-'.$row['respuestamal2'].'%*-'.$row['respuestamal3']
    				.'%*-'.$row['complejidad'].'%*-'.$row['tema'];
    			}
          else if (mysqli_num_rows($result)==0){
    				$respuesta = "";

  			echo $respuesta;
        }
      }
		?>
	</section>
	</div>
</body>
