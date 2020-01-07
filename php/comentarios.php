<?php
	session_start();
	if (isset($_SESSION['identificado'])){ /* La variable identificado solo se crea si ha intentado inicar sesión */
		if($_SESSION['identificado']!="SI"){ /* Si la variable vale si, entoces es que ha inicado la sesión correctamente, sino es que no */
			echo "<script>alert('Tienes que inicar sesión para poder acceder aquí.');window.location.href='../index.html';</script>";
			exit();
		}
	}else{

		echo "<script>alert('Tienes que inicar sesión para poder acceder aquí.');window.location.href='../index.html';</script>";
		exit();
	}
?>
<!DOCTYPE html>
<html>
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
            $xml = simplexml_load_file("../xml_dtd/guardarComentarios.xml");
            $respuestas = simplexml_load_file("../xml_dtd/guardarRespuestas.xml");
			foreach($xml->xpath("//visita") as $visita){
                
                    echo'<div class="box"><table border=1>';
                        if(isset($visita->email))
                        {	
                            $email = $visita->email;
                            if($email["mostrar"]=="si"){
                                echo"<th>{$visita->nombre}</th>";
                                echo"<th>{$visita->tema}</th>";
                                echo"<th>{$visita->email}</th>";
                                
                            }else{
                                echo"<th>{$visita->nombre}</th>";
                                echo"<th>{$visita->tema}</th>";
                            }
                        }
                        echo"</tr>";
                        echo"<tr>";
                        echo"<td colspan=\"3\">{$visita->comentario}</td>";
                        echo"</tr>";
                        $id = $visita['id'];
                        echo"<tr> <td colspan=\"3\"> Respuestas <form action=\"respuestas.php\" method=\"post\"><input type=\"hidden\" name=\"id_respuesta_comentario\" value=\"$id\"><input type=\"hidden\" name=\"vienedelform\" value=\"si\"/><input type=\"submit\" class=\"boton_respuesta\" value=\"Responder\" ></form></td> </tr>";
                        $i=1;
                        foreach($respuestas->xpath("//respuesta") as $respuesta) {
                            
                            if(strcmp($respuesta['id_respuesta'],$visita['id'])===0){

                                echo'<tr style="display: none" class="'.$respuesta['id_respuesta'].'">';
                                echo"<th>{$respuesta->nombre}</th>";
                                echo"<th>{$respuesta->comentario}</th>";
                                echo"<th>{$respuesta->fecha}</th>";
                                echo"</tr>";
                                 $i = $i + 1;
                            }
                        }
                    echo"<tr> <td colspan=\"3\"> <input type=\"submit\" id=\"boton\" value=\"Mostrar\" onclick=\"mostrar('".$visita['id']."')\"> <input type=\"submit\" id=\"boton\" value=\"Ocultar\" onclick=\"ocultar('".$visita['id']."')\"> </td></tr>";
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