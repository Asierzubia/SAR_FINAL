<?php

    echo'<input type="button" class="galeria" value="Volver a Galeria" onclick="volverGaleria()">';
    echo'<input type="button" class="galeria2" value="Volver al inicio" onclick="location.href=\'../index.php\';">';
    $nombre_coche = $_REQUEST['coche'];
    $numero_fotos = count(glob('../galeria/'.$nombre_coche.'/{*.jpg,*.gif,*.png}',GLOB_BRACE)); /* Para saber cuantas imagenes tengo que mostar
    tengo que saber primero cuantas imagenes hay en la carpeta de ese modelo de coche en especifico.
    Por que si han subido mas imágenes no va a haber solo las originiales que yo había puesto.*/
    if(isset($_REQUEST['coche'])){
        $nombre=$_REQUEST['coche'];
        $i=1;
        while($i<=$numero_fotos){
            echo'<div class="fotos">
            <a class="lightbox" href="../galeria/'.$_REQUEST["coche"].'/'.$_REQUEST["coche"].'_'.$i.'.jpg">
                <img class="galeria__img" src="../galeria/'.$_REQUEST["coche"].'/'.$_REQUEST["coche"].'_'.$i.'.jpg" alt='.$_REQUEST["coche"].'>
            </a>
        </div>';
            $i+=1;
        }
    }
    
?>