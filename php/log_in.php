<?php /* Esto lo hago para que alguien que ya haya inicado sesion no pueda iniciar sesion con otra cuenta de manera que la anterior se quede abierta
. Porque de ser así, si el usuario decidiera no hacer el log out, se mantendria abierta hasta el cierre de la página*/

        session_start();
	if (isset($_SESSION['identificado'])){ /* La variable identificado solo se crea si ha intentado inicar sesión */
		if($_SESSION['identificado']=="SI"){ /* Si la variable vale si, entoces es que ha inicado la sesión correctamente, sino es que no */
			echo "<script>alert('Ya has hecho el LOG IN anteriormente. Para acceder con otra cuenta debes hacer LOG OUT de tu cuenta primero.');window.location.href='../index.php';</script>";
			exit();
		}
	}else{

	}
?> <!--Al poner ya puedo trabajar con la variable $sesion, abre una sesión de php-->
<!DOCTYPE html>
<html>
<head>

        <link rel="stylesheet" type="text/css" href="../css/log_in.css">
        <title>Página log_in</title>
</head>
<body>
    <div>
     <h2>Inicio de sesion.</h2>
      <div>
         <form action="log_in.php" class="login" name="login" id="login" method="post">
            <p>Introduce tu dirección de correo</p>
            <input type="email" size="60" id="email" name="email" class="log_in" required >
            <p>Contraseña</p>
            <input type="password" size="60" id="pass" name="pass" class="log_in" required>
            <p> <input type="submit" id="submit" value="Enviar"> <input type="reset" value="Limpiar"></p>
        </form>
      </div>
    </div>
<?php
        
            if(isset($_REQUEST['email'])){ /*Aqui tengo que hacer el codigo si el correo que ha introducido el usuraio esta dentro de .xml creado, y en ese caso mirar a ver si la contraseña es la correcta*/

                $XML = simplexml_load_file('../xml_dtd/usuarios.xml') or die("No se ha podido acceder a la base de datos que almacena los usuarios registrados");
                $encontrado=false;
                ini_set("session.use_only_cookies","1");
                ini_set("session.use_trans_sid","0"); 
                foreach($XML->xpath("//user") as $user){

                        if(($user->email==$_REQUEST['email'])){
                                
                                $pass=$_REQUEST['pass'];
                                $user_pass=$user->pass;
                                if(hash_equals((string)$user_pass,crypt($pass,(string)$user_pass))){
                                        session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0); 
                                        $_SESSION['identificado']="SI"; /* creo mis propias variables de sesión */
                                        $_SESSION['email'] = $_REQUEST['email'];
                                        
                                }else{
                                        $_SESSION['identificado'] = "NO";
                                        echo "Usuario o contraseña incorrectos, prueba de nuevo. <br>";
                                        echo "<a href=\"javascript:history.back()\">Volver a atras</a>";
                                }
                        }
                        
                }
                echo "Usuario o contraseña incorrectos. <br>";
                echo "<a href=\"javascript:history.back()\">Volver a atras</a>";
     
            }
    ?>

</body>
</html>