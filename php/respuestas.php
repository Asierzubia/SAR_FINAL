<?php
	session_start();
	if (isset($_SESSION['identificado'])){ /* La variable identificado solo se crea si ha intentado inicar sesión */
		if($_SESSION['identificado']!="SI"){ /* Si la variable vale si, entoces es que ha inicado la sesión correctamente, sino es que no */

			echo "<script>alert('Debes inicar sesión primero.');window.location.href='../index.html';</script>";
			exit();
		}
	}else{

		echo "<script>alert('Debes inicar sesión primero.');window.location.href='../index.html';</script>";
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
			<input id="Nombre" name="Nombre" type="text" class="formulario" placeholder="Tu nombre" required><br>
			<input type="hidden" name="id_respuesta_comentario" value="<?php echo $_POST['id_respuesta_comentario']?>">
			<input id="email" name="email" value="<?php echo $_SESSION['email'];?>" type="text" class="formulario" readonly required><br>
			<textarea id="mensaje" name="mensaje" class="formulario" placeholder="Escribe sobre comentario seleccionado" required></textarea><br>
			<input type="submit" class="formulario submit" value="SEND MESSAGE">
		</form>
		<form id="atras" method="post" action="../index.php">
			<input type="submit" name="boton2" class="formulario2" value="VOLER AL INICIO">	
		</form>
	</div>
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

					// ABRIR EL XML
					if(simplexml_load_file("../xml_dtd/guardarRespuestas.xml")){ //Control de errores, pongo los tres iguales porque puede que devuelva un valor que se evalua a FALSE
						$xml = simplexml_load_file("../xml_dtd/guardarRespuestas.xml") or die("No se ha podido acceder a la base de datos que almacena las respuestas");
						// ANADIR ELEMENTOS Y ATRIBUTOS AL XML
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
							//GUARDAR EL XML
							//Control de errores, pongo los tres iguales porque puede que devuelva un valor que se evalua a FALSE
							$xml->asXML('../xml_dtd/guardarRespuestas.xml') or die("No se ha podido guardar la respuesta que desead publicar");
							echo"<script>alert('Su respuesta se ha enviado correctamente.');window.location.href='../index.php';</script>";
						
						echo "<h3 style=\"color: green; font-weight: bold\">¡Su comentario añadido correctamente!</h3>";
					}
				}
			}
		?> 
	</div>
</body>
</html>