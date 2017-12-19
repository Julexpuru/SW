<?php

  if (preg_match("/(^[a-z]+)([0-9]{3})\@(ikasle\.)?(ehu)\.(es|eus)/", $_POST['email']))
  {
    $link = mysqli_connect("localhost", "root", "", "quiz");
    $sql= "SELECT * FROM usuarios WHERE Email='".$_POST['email']."'";

    if (!mysqli_query($link ,$sql))
    {
      die('Error: error al intentar enviar los datos ' . mysqli_error($link));
    }
    else
    {

    }

    $res= mysqli_query($link ,$sql);
    $con= mysqli_num_rows($res);

    $mensaje='<html>'.'<head><title>Recuperar Password</title></head>'.'<body><h2>Recuperar la contraseña</h2>'.'Si quieres recuperar tu contraseña, haz click <a href="recuperacion.php">aqui</a>	.</body>'.'</html>';

    if ($con==1)
    {
      /*$bool = mail($_POST['email'], "Recuperacion de Contraseña", $mensaje, 'Content-type: text/html; charset=utf-8');
			if ($bool)
      {
				echo "Se ha enviado un correo con su contraseña al email: ".$_POST['email']."!";
			}
      else
      {
				echo 'Ha habido algun error al intentar enviarte tu contraseña, por favor prueba de nuevo';
			}*/
      echo '<script type="text/javascript">window.location.assign("restablecer.php?email='.$_POST['email'].'");</script>';
    }
    else
    {
      echo "El correo introducido no pertenece a ningun alumno en la base de datos";;
    }

    mysqli_close($link);

  }
  else
  {
    echo 'Error al verificar el email en el servidor, por favor, compruebe que es valido';
  }

?>
