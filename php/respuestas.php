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
	<title> Titulo_forum </title>
	<link rel="stylesheet" type="text/css" href="../css/formulario.css">
	<script src="../js/app.js"></script>
	<script src="../js/jquery-3.4.1.min.js"></script>
</head>

<body>
	<div class="titulo-principal">
		<h1>Respuestas</h1>
	</div>

	<div class="datos_formulario">
		<form id="datos_formulario" method="post" action="respuestas.php" onsubmit="return validar()">
			<input id="Nombre" name="Nombre" type="text" class="formulario" placeholder="Tu nombre" requiered><br>
			<input type="hidden" name="id_respuesta_comentario" value="<?php echo $_POST['id_respuesta_comentario']?>">
			<input id="email" name="email" value="<?php echo $_SESSION['email'];?>" type="text" class="formulario" readonly requiered><br>
			<textarea id="mensaje" name="mensaje" class="formulario"
				placeholder="Escribe sobre comentario seleccionado" row="10" requiered></textarea><br>
			<input type="submit" class="formulario submit" value="SEND MESSAGE">
		</form>
		<form id="atras" method="post" action="../index.php">
			<input type="submit" name="boton2" class="formulario2" value="VOLER AL INICIO">	
		</form>
	</div>

</body>
<div>
		<?php
			if(isset($_REQUEST['Nombre']))
			{
				if(!file_exists('../xml_dtd/guardarRespuestas.xml')){
                    $archivo = fopen('../xml_dtd/guardarRespuestas.xml','w+') or die("No se ha podido crear el archivo");
                    $text = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?>\n<respuestas xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"guardarRespuestas.xsd\">";
                    fwrite($archivo,$text) or die("No se ha podido escribir el archivo.");
                    fclose($archivo);
                }else{

					// Abrir xml
					if(simplexml_load_file("../xml_dtd/guardarRespuestas.xml")){ //Control de errores, pongo los tres iguales porque puede que devuelva un valor que se evalua a FALSE
						$xml = simplexml_load_file("../xml_dtd/guardarRespuestas.xml") or die("Erro al abrir el xml");
						echo"listajajaj";
						// Añadir datos al xml
						$respuesta = $xml->addChild("respuesta");
						$respuesta->addAttribute("id_respuesta",$_REQUEST['id_respuesta_comentario']);
						$respuesta->addChild("nombre", $_REQUEST['Nombre']);
						$respuesta->addChild("comentario", $_REQUEST['mensaje']);
						$respuesta->addChild("fecha", date("y-m-d"));


						if(isset($_REQUEST['email']))
						{
							$email = $respuesta->addChild("email",$_REQUEST['email']);
							if(isset($_REQUEST['public']))
							{
								$email->addAttribute("mostrar","si");
							}
							else
							{
								$email->addAttribute("mostrar","no");
							}
						}

							//Control de errores, pongo los tres iguales porque puede que devuelva un valor que se evalua a FALSE
							$xml->asXML('../xml_dtd/guardarRespuestas.xml') or die("Error al guardar el xml");
							echo"<script>alert('Su respuesta no ha podido ser enviada.');window.location.href='../index.html';</script>";
						
						echo "<h3 style=\"color: green; font-weight: bold\">¡Comentario añadido satisfactoriamente!</h3>";
					}
				}
			}
		?> 
</div>
</html>