<?php
		session_start();
		if (!isset($_SESSION['autentificado'])) {
            echo '<script language="javascript">alert("Acceso no autorizado, inicia sesion correctamente");</script>';
            header('Location: layout.php');
        }

    $link = mysqli_connect("localhost", "root", "", "quiz");
		$correo = trim($_SESSION['usuario']);
		$sql = "SELECT * FROM preguntas WHERE Correo='".$correo."'";
    $sql2 = "SELECT * FROM preguntas";

		if ($resul = mysqli_query($link, $sql)){
		    $var1 = mysqli_num_rows($resul);
		}else{
		    echo "Ha habido un error al acceder a la base de datos. <br>";
		    return;
		}
		if ($resul2 = mysqli_query($link, $sql2)){
		    $var2 = mysqli_num_rows($resul2);
		}else{
		    echo "Ha habido un error al acceder a la base de datos. <br>";
		    return;
		}
		echo "Preguntas tuyas/Preguntas totales: ".$var1."/".$var2."";
		mysqli_close($link);

?>
