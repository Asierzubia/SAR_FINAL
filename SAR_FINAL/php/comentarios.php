<?php
	session_start();
	if (isset($_SESSION['identificado'])){ /* La variable identificado solo se crea si ha intentado iniciar sesión */
		if($_SESSION['identificado']!="SI"){ /* Si la variable vale si, entonces es que ha iniciado la sesión correctamente, sino es que no */
			echo "<script>alert('Debes inicar sesión primero.');window.location.href='../index.html';</script>";
			exit();
		}
	}else{

        echo "<script>alert('Debes inicar sesión primero.');window.location.href='../index.html';</script>";
		exit();
	}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Comentarios</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/comentarios.css">
        <script src="../js/jquery-3.4.1.min.js"></script>
        <script src="../js/app.js"></script>
	</head>
	<body>
		<h1>FORUM</h1>
		<h2>Comentarios</h2>
        <div class="form-group">
			<select onchange="cambiarTema()" class="form-control col-md-2" style="margin-left: auto; margin-right:auto" id="tema" name="tema">
                <option value="Select car">Select car:</option>
				<option value="Subaru Impreza">Subaru Impreza</option>
				<option value="Lanzer Evo">Lanzer Evo</option>
				<option value="Toyota Supra">Toyota Supra</option>
				<option value="Silvia s15">Silvia s15</option>
				<option value="Honda S2000">Honda S2000</option>
				<option value="Datsun 370">Datsun 370</option>
            </select>
		</div>
        <div class="tabla" id="comentarios">
		<?php
         //ABRIR LOS XML
            $xml = simplexml_load_file("../xml_dtd/guardarComentarios.xml") or die("No se ha podido acceder a la base de datos que almacena los comentarios");
            $respuestas = simplexml_load_file("../xml_dtd/guardarRespuestas.xml") or die("No se ha podido acceder a la base de datos que almacena las respuestas");
            //RECORRER CADA COMENTARIO
			foreach($xml->xpath("//visitor") as $visitor){
                
                    echo'<div class="box"><table border=1>';
                        if(isset($visitor->email))
                        {	
                            $email = $visitor->email;
                            if($email["mostrar"]=="si"){
                                echo"<th>{$visitor->nombre}</th>";
                                echo"<th>{$visitor->tema}</th>";
                                echo"<th>{$visitor->email}</th>";
                                
                            }else{
                                echo"<th>{$visitor->nombre}</th>";
                                echo"<th colspan=\"2\">{$visitor->tema}</th>";
                            }
                        }
                        echo"</tr>";
                        echo"<tr>";
                        echo"<td colspan=\"3\">{$visitor->comentario}</td>";
                        echo"</tr>";
                        $id = $visitor['id'];
                        echo"<tr> <td colspan=\"3\"> Respuestas <form action=\"respuestas.php\" method=\"post\"><input type=\"hidden\" name=\"id_respuesta_comentario\" value=\"$id\"><input type=\"hidden\" name=\"vienedelform\" value=\"si\"/><input type=\"submit\" class=\"boton_respuesta\" value=\"Responder\" ></form></td> </tr>";
                        $i=1;
                        //RECORRER CADA RESPUESTA
                        foreach($respuestas->xpath("//respuesta") as $respuesta) {
                            
                            if(strcmp($respuesta['id_respuesta'],$visitor['id'])===0){

                                echo'<tr style="display: none" class="'.$respuesta['id_respuesta'].'">';
                                echo"<th>{$respuesta->nombre}</th>";
                                echo"<th>{$respuesta->comentario}</th>";
                                echo"<th>{$respuesta->fecha}</th>";
                                echo"</tr>";
                                 $i = $i + 1;
                            }
                        }
                    echo"<tr> <td colspan=\"3\"> <input type=\"submit\" id=\"boton\" value=\"Mostrar\" onclick=\"mostrar('".$visitor['id']."')\"> <input type=\"submit\" id=\"boton\" value=\"Ocultar\" onclick=\"ocultar('".$visitor['id']."')\"> </td></tr>";
                    echo"</table></div>";
					echo"<br>";
		    }
		?>
        </div>
		<div class="tabla">	
            <input type="button" class="button" value="Enviar otro comentario" onclick="location.href='formulario.php'">
            <input type="button" class="button" value="Volver a inicio" onclick="location.href='../index.php'">
        </div>
    </body>
</html>
