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

	<link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/starter-template/">

    <!-- Bootstrap -->
      <link href="/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
<meta name="theme-color" content="#563d7c">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
	<div class="titulo-principal">
		<h1>COMENTARIOS</h1>
	</div>

	<div class="datos_formulario">
		<form id="datos_formulario" method="post" action="formulario.php" onsubmit="return validar()">
			<input id="Nombre" name="Nombre" type="text" class="formulario" placeholder="Tu nombre" requiered><br>
			<input id="email" name="email" value="<?php echo $_SESSION['email'];?>" type="text" class="formulario" readonly requiered><br>
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
			<textarea id="mensaje" name="mensaje" class="formulario"
				placeholder="Escribe sobre el tema indicado anteriormente" row="10" requiered></textarea><br>
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
				if(!file_exists('../xml_dtd/guardarComentarios.xml')){
                    $archivo = fopen('../xml_dtd/guardarRespuestas.xml','w+') or die("No se ha podido crear el archivo");
                    $text = "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?>\n<respuestas xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="guardarRespuestas.xsd">";
                    fwrite($archivo,$text) or die("No se ha podido escribir el archivo.");
                    fclose($archivo);
                }

				// Abrir xml
				$xml = simplexml_load_file("../xml_dtd/guardarRespuestas.xml");

				// Actualizar id
				$id = $xml['ult_id'];
				$id = $id + 1;
				$xml['ult_id'] = $id;

				// Añadir datos al xml
				$visita = $xml->addChild("visita");
				$visita->addAttribute("id", $id);

				$visita->addChild("nombre", $_REQUEST['Nombre']);
				$visita->addChild("comentario", $_REQUEST['mensaje']);
				$visita->addChild("tema", $_REQUEST['tema']);


				if(isset($_REQUEST['email']))
				{
					$email = $visita->addChild("email",$_REQUEST['email']);
					if(isset($_REQUEST['public']))
					{
						$email->addAttribute("mostrar","si");
					}
					else
					{
						$email->addAttribute("mostrar","no");
					}
				}
				$xml->asXML('../xml_dtd/guardarComentarios.xml');
				echo "<h3 style=\"color: green; font-weight: bold\">¡Comentario añadido satisfactoriamente!</h3>";
			}
		?> 
</div>
</html>