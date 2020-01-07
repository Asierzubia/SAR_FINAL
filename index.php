<?php
	session_start();
	if (isset($_SESSION['identificado'])){ /* La variable identificado solo se crea si ha intentado inicar sesión */
		if($_SESSION['identificado']!="SI"){ /* Si la variable vale si, entoces es que ha inicado la sesión correctamente, sino es que no */
			echo "<script>alert('Tienes que inicar sesión para poder acceder aquí.');window.location.href='index.html';</script>";
			exit();
		}
	}else{

		echo "<script>alert('Tienes que inicar sesión para poder acceder aquí.');window.location.href='index.html';</script>";
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title> Titulo_forum </title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/app.js"></script>
</head>

<body>
	<div class="titulo-principal">
		<h1>Bienvenido</h1>
		<h2>Adentrate en el mundo de los coches</h2>
		<input type="button" name="boton" class="botones" value="Formulario" onclick="location.href='php/formulario.php'">
		<input type="button" class="botones" name="boton2" value="Comentarios" onclick="location.href='php/comentarios.php'">
		<input type="button" class="botones" name="boton3" value="Galeria" onclick="location.href='php/galeriaCoches.php'"><br/>
		<input type="button" class="botones" name="boton3" value="LOG OUT" onclick="location.href='php/logout.php'">
	</div>
</body>
	
