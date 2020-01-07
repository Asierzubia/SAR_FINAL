<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/registro.css">
    <title>Registro</title>
</head>
<body>
    <form action="registro.php" class="formulario_registro" method="post" id="registro" name="registro">
       <p>Usuario</p>
       <input type="text" id="username" name="username" required>
       <p>email</p>
       <input type="email" id="email" name="email" required>
       <p>Contraseña</p>
       <input type="password" id="pass" name="pass" required>
       <p>Repetir contraseña</p>
       <input type="password" id="passRP" name="passRP" required>
       <p></p>
       <input type="submit" id="boton_registrar" name="submit" value="Resgistrar">
    </form>

<?php

    if(isset($_REQUEST['username'])){

        if($_REQUEST['pass']===$_REQUEST['passRP']){

            if(!existeEmailIguales($_REQUEST['email'])){

                $XML = simplexml_load_file("../xml_dtd/usuarios.xml");

                $user = $XML->addChild("user");

				$user->addChild("nombre", $_REQUEST['username']);
				$user->addChild("email", $_REQUEST['email']);
                $user->addChild("pass", password_hash($_REQUEST['pass'],PASSWORD_DEFAULT));
                
                $XML->asXML('../xml_dtd/usuarios.xml');
				echo "<h3 style=\"color: green; font-weight: bold\">¡Se ha registrado satisfactoriamente!</h3>";

            }
        }
    }


?>

<?php

    function existeEmailIguales($email){

        $XML=simplexml_load_file("../xml_dtd/usuarios.xml");
        foreach($XML->user as $user){
            if ($email === $user->email){
                return true;
            }
        }
        return false;
    }
?>
</body>

</html>