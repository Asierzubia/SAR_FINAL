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
    <title>Freebie: 4 Bootstrap Gallery Templates</title>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/app.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/galeriaCoches.css">

</head>
<body>

<div class="container gallery-container">

    <h1>GALERIA DE MODELOS</h1>
    <div class="tz-gallery">
        <input type="button" class="boton_subir_foto" value="Subir Imagen" onclick="location.href='upload.php'">
        <div class="galeria_fotos" id="fotos" >
            <div class="fotos" id="escogido" onclick="cambiarFotos('impreza')">
                <a class="lightbox">
                    Subaru impreza sti
                    <img src="../galeria/impreza/impreza_1.jpg" class="galeria__img">
                </a>
            </div>
            <div class="fotos" id="escogido" onclick="cambiarFotos('evo')">
                <a class="lightbox">
                    Lanzer EVO
                    <img src="../galeria/evo/evo_2.jpg" value="1" class="galeria__img">
                </a>
            </div>
            <div class="fotos" id="escogido" onclick="cambiarFotos('supra')">
                <a class="lightbox">
                    Toyota Supra
                    <img src="../galeria/supra/supra_2.jpg" value="2" class="galeria__img">
                </a>
            </div>
            <div class="fotos" id="escogido" onclick="cambiarFotos('silvia')">
                <a class="lightbox">
                    Sivia s15
                    <img src="../galeria/silvia/silvia_2.jpg" value="3" class="galeria__img">
                </a>
            </div>
            <div class="fotos" id="escogido" onclick="cambiarFotos('honda')">
                <a class="lightbox">
                    Honda S2000
                    <img src="../galeria/honda/honda_2.jpg" value="4" class="galeria__img">
                </a>
            </div>
            <div class="fotos" id="escogido" onclick="cambiarFotos('datsun')">
                <a class="lightbox">
                    Datsun 240z
                    <img src="../galeria/datsun/datsun_2.jpg" value="5" class="galeria__img">
                </a>
            </div>
            <input type="button" name="boton" class="galeria" value="VOLER AL INICIO" onclick="location.href='../index.php';">	
        </div>
    </div>
</div>
</body>
</html>