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
	<meta charset="UTF-8">
	<title> Titulo_forum </title>
	<link rel="stylesheet" type="text/css" href="../css/formulario.css">
	<script src="../js/app.js"></script>
	<script src="../js/jquery-3.4.1.min.js"></script>
</head>

<body>
	<div class="titulo-principal">
		<h1>COMENTARIOS</h1>
	</div>

	<div class="datos_formulario">
		<form id="datos_formulario" method="post" action="formulario.php" onsubmit="return validar()">
			<input style ="padding-bottom: 0.9em" id="Nombre" name="Nombre" type="text" value="<?php echo $_SESSION['nombre_usu'];?>" class="formulario" placeholder="Tu nombre" required readonly><br>
			<input style ="padding-bottom: 0.9em" id="email" name="email" value="<?php echo $_SESSION['email'];?>" type="text" class="formulario" readonly required><br>
			<div class="checkbox">
				<label for="checkbox" style="color:white">¿Desea publicar su email?</label>
				<label for="checkbox">
					<input type="checkbox" id="checkbox" name="checkbox" />
				</label>
			</div>
			<div class="form-group">
				<select class="form-control col-md-2" style="margin-left: auto; margin-right:auto" id="tema" name="tema">
					<option value="Select car">Select car:</option>
					<option value="Subaru Impreza">Subaru Impreza</option>
					<option value="Lanzer Evo">Lanzer Evo</option>
					<option value="Toyota Supra">Toyota Supra</option>
					<option value="Silvia s15">Silvia s15</option>
					<option value="Honda S2000">Honda S2000</option>
					<option value="Datsun 370">Datsun 370</option>
				</select>
			</div>
			<textarea id="mensaje" name="mensaje" class="formulario" placeholder="Escribe sobre el tema indicado anteriormente" required></textarea><br>
			<input type="submit" class="formulario submit" value="SEND MESSAGE">
		</form>
		<form id="atras" method="post" action="../index.php">
			<input type="submit" name="boton2" class="formulario2" value="VOLVER AL INICIO">	
		</form>
	</div>
	<div>
		<?php
			if(isset($_REQUEST['Nombre']))
			{
				if(!file_exists('../xml_dtd/guardarComentarios.xml')){
                    $archivo = fopen('../xml_dtd/guardarComentarios.xml','w+') or die("No se ha podido crear el archivo");
                    $text = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?>\n<!DOCTYPE visitantes SYSTEM \"../xml_dtd/guardarComentarios.dtd\">\n<visitantes last_id=\"0\">\n</visitantes>";
                    fwrite($archivo,$text) or die("No se ha podido escribir el archivo.");
                    fclose($archivo);
                }

				// ABRIR EL XML
				$xml = simplexml_load_file("../xml_dtd/guardarComentarios.xml") or die("No se ha podido acceder a la base de datos que almacena los comentarios");

				// AÑADIR ELEMENTOS Y ATRIBUTOS AL XML
				$visitor = $xml->addChild("visitor");

				// ACTUALIZAR ID
				$id = $xml['last_id'];
				$id = $id + 1;
				$xml['last_id'] = $id;

				$visitor->addAttribute("id", $id);

				$visitor->addChild("nombre", $_REQUEST['Nombre']);
				$visitor->addChild("comentario", $_REQUEST['mensaje']);
				$visitor->addChild("tema", $_REQUEST['tema']);
				$email = $visitor->addChild("email",$_REQUEST['email']);
				if(isset($_REQUEST['checkbox']))
				{
					$email->addAttribute("mostrar","si");
				}
				else
				{
					$email->addAttribute("mostrar","no");
				}
			
				//GUARDAR EL XML
				$xml->asXML('../xml_dtd/guardarComentarios.xml') or die("No se ha podido guardar el comentario enviado");
				echo "<h3 style=\"color: green; font-weight: bold\">¡Su comentario se ha añadido correctamente!</h3>";
			}
		?> 
</div>
</body>
</html>