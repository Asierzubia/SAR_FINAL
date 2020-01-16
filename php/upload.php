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
<html>
    <head>
        <meta charset="UTF-8">
        <title>Upload</title>
        <link rel="stylesheet" type="text/css" href="../css/upload.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"> <!--Enlace que contiene diferentes clases(iconos) para poder utilizarlos más tarde-->
        <script src="../js/jquery-3.4.1.min.js"></script>
        <script src="../js/app.js"></script>
    </head>
    <body>
        <div class="nose">
                    <p id="segundo">Gracias por su futura aportación.</p>
        </div>
        <div class="importante">
            <p>¡Importante! ¡Leer antes de subir la imagen!</p>
            <p>Pulsa el botón desplegar para leerlo.</p>
        </div>
        <div>     
            <button class="importante_boton" onclick="mostrar('texto_desplegado')">Desplegar</button>
        </div>
        <div>
        <p style="display: none" class="texto_desplegado">Por favor suba fotos de alta calidad para que más tarde no aparezcan distorsionadas en la galería, muchas gracias por su atención. <br>
        Para subir la imagen, haz click sobre el boton subir , selecciona la imagen que desear subir, selecciona el modelo y por ultimo hac click en el boton Subir archivo. </p>
        </div>
        
        
        <form enctype="multipart/form-data" action="upload.php" method="POST" class="formulario_upload"> <!-- En esta ocasión he puesto enctype debido a que necesitamos seleccionar una foto,
            por lo que para ello accedemos al explorador del ordenador en el que estemos subiendo la foto.-->
            <div>
                <select class="tema_subido" id="tema_subido" name="tema_subido" require>
                    <option value="select_car">Select car:</option>
                    <option value="impreza">Subaru Impreza</option>
                    <option value="evo">Lanzer Evo</option>
                    <option value="supra">Toyota Supra</option>
                    <option value="silvia">Silvia s15</option>
                    <option value="honda">Honda S2000</option>
                    <option value="datsun">Datsun 370</option>
                </select>
            </div>
            <input name="uploadedfile" id="boton_browse" type="file"/>
            <label for="boton_browse">
                <i class="fa fa-download"></i>Explorador</label> <!--Es una clase específica para que me muestre el icono que he escogido, para ello hace uso del css que he puesto arriba-->
            <input type="submit" value="Subir archivo" class="boton_subida" />
            <div>
            <input type="button" value="Volver atras" class = "boton_subida" onclick="location.href='galeriaCoches.php'">
            </div>
        </form>
  
        
        <?php
           if(isset($_REQUEST['tema_subido'])){
                $coche_select = $_REQUEST['tema_subido'];
                $target_path = "../galeria/".$coche_select;
                $numero_fotos = count(glob('../galeria/'.$coche_select.'/{*.jpg,*.gif,*.png}',GLOB_BRACE)); 
                $numero_fotos = $numero_fotos + 1;
                $target_path = $target_path . "/" . $coche_select . "_" . $numero_fotos . ".jpg";
                if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
                    echo "<p style='color: white' >El archivo se ha subido correctamente. Gracias por su aportación al foro</p>";
                } else{
                    echo "<script>alert('Ha ocurrido un error, vuelva a intentarlo más tarde.');window.location.href='galeriaCoches.php';</script>";
                }
           }
        ?>
        
    </body>
</html>
