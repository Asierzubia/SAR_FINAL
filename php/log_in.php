<?php 
        session_start(); 
?> 
<!DOCTYPE html>
<html>
<head>
        <link rel="stylesheet" type="text/css" href="../css/log_in.css">
        <title>Página log_in</title>
</head>
<body>
    <div>
     <h2>Inicio de sesión.</h2>
      <div>
         <form action="log_in.php" class="login" name="login" id="login" method="post">
            <p>Introduce tu dirección de correo</p>
            <input type="email" size="60" id="email" name="email" class="log_in" required >
            <p>Contraseña</p>
            <input type="password" size="60" id="pass" name="pass" class="log_in" required>
            <p> <input type="submit" id="submit" value="Enviar"> <input type="reset" value="Limpiar"></p>
            <input type="button" id="boton_registrar" name="submit" value="Volver atras" onclick="location.href='../index.html'">

        </form>
      </div>
    </div>
<?php      
            if(isset($_REQUEST['email'])){ /*Aquí tengo que hacer el código si el correo que ha introducido el usuario está dentro de .xml creado, y en ese caso mirar a ver si la contraseña es la correcta*/
                // ABRIR EL XML
                $XML = simplexml_load_file('../xml_dtd/usuarios.xml') or die("No se ha podido acceder a la base de datos que almacena los usuarios registrados");
                ini_set("session.use_only_cookies","1"); /*Llamando a esta función con esos parámetros conseguimos que la sesión actual se cierre al cerrar el navegador */
                ini_set("session.use_trans_sid","0"); /*Llamando a esta función con esos parámetros conseguimos que la sesión actual se cierre al cerrar el navegador */
                //RECORRER LOS USUARIOS
                foreach($XML->xpath("//user") as $user){

                        if(($user->email==$_REQUEST['email'])){
                                
                                $pass=$_REQUEST['pass'];
                                $user_pass=$user->pass;
                                $nombre = $user->nombre;
                                if(hash_equals((string)$user_pass,crypt($pass,(string)$user_pass))){
                                        session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0); 
                                        $_SESSION['identificado']="SI"; /* creo mis propias variables de sesión */
                                        $_SESSION['email'] = $_REQUEST['email'];
                                        $_SESSION['nombre_usu'] = (string)$nombre;
                                        echo "<script>alert('Has iniciado sesión correctamenete. Redirigiendo a la página principal');window.location.href='../index.php';</script>";
                                }else{
                                        $_SESSION['identificado'] = "NO";
                                        echo "Usuario o contraseña incorrectos. <br>";
                                        echo "<a href=\"javascript:history.back()\">Volver a atras</a>";
                                }
                        }    
                }
            }
    ?>
</body>
</html>
