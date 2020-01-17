<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/registro.css">
    <title>Registro</title>
</head>
<body>
    <form action="registro.php" class="formulario_registro" method="post" id="registro" name="registro">
       <p>Nombre de usuario</p>
       <input type="text" id="username" name="username" required>
       <p>email</p>
       <input type="email" id="email" name="email" required>
       <p>Contraseña</p>
       <input type="password" id="pass" name="pass" required>
       <p>Repetir contraseña</p>
       <input type="password" id="passRP" name="passRP" required>
       <p></p>
       <input type="submit" id="boton_registrar" name="submit" value="Resgistrar">
       <input type="button" id="boton_registrar" name="submit" value="Volver atras" onclick="location.href='../index.html'">
    </form>

<?php

    if(isset($_REQUEST['username'])){

        if($_REQUEST['pass']==$_REQUEST['passRP']){

            if(!existeEmailIguales($_REQUEST['email'])){
                if(!existeUsuarioIguales($_REQUEST['username'])){
                    //ABRIR EL XML
                    $XML = simplexml_load_file("../xml_dtd/usuarios.xml") or die("No se ha podido acceder a la base de datos que almacena los usuarios");
                    //AÑADIR ELEMENTOS Y ATRIBUTOS AL XML
                    $user = $XML->addChild("user");
                    $user->addChild("nombre", $_REQUEST['username']);
                    $user->addChild("email", $_REQUEST['email']);
                    $user->addChild("pass", password_hash($_REQUEST['pass'],PASSWORD_DEFAULT));
                    //GUARDAR EL XML
                    $XML->asXML('../xml_dtd/usuarios.xml') or die("No se ha podido el usurio que deseas registrar");
                    echo "<h3 style=\"color: green; font-weight: bold\">¡Se ha registrado satisfactoriamente!</h3>";
                    echo "<script>alert('Pulsa aceptar para acceder a la pantalla principal.');window.location.href='../index.html';</script>";
                }else{
                    echo "<script>alert('Ese nombre de usuario ya está registrado.');</script>";
                }
            }else{
                echo "<script>alert('Ese email ya está registrado.');</script>";
            }
        }else{
            echo "<script>alert('Las contraseñas no coinciden.');</script>";
        }
    }


?>

<?php

    function existeEmailIguales($email){

        $XML=simplexml_load_file("../xml_dtd/usuarios.xml") or die("No se ha podido acceder a la base de datos que almacena los usuarios");
        foreach($XML->user as $user){
            if ($email == $user->email){
                return true;
            }
        }
        return false;
    }

    function existeUsuarioIguales($usuario){

        $XML=simplexml_load_file("../xml_dtd/usuarios.xml") or die("No se ha podido acceder a la base de datos que almacena los usuarios");
        foreach($XML->user as $user){
            if ($usuario == $user->nombre){
                return true;
            }
        }
        return false;
    }
?>
</body>
</html>
