function validar() {
  var nombre, email, tema, mensaje;
  nombre = document.getElementById("Nombre").value;
  email = document.getElementById("email").value;
  tema = document.getElementById("tema").value;
  mensaje = document.getElementById("mensaje").value;
  expresion = /\w+@\w+\.+[a-z]/;
  if (nombre == "" || email == "" || tema == "" || mensaje == "") {
    alert("Todos los campos son obligatorios");
    return false;
  } else if (nombre.length > 20) {
    alert("El nombre introducido es demasiado largo");
    return false;
  } else if (mensaje.length > 20) {
    alert("El mensaje introducido es demasiado largo");
    return false;
  } else if (!expresion.test(email)) {
    alert("El emsil introducido no es valido");
    return false;
  } else if (email.length > 50) {
    alert("El email introducido es demasiado largo");
    return false;
  } else if (tema == 0) {
    alert("Selecciona un tema valido.");
    return false;
  }

}

function cambiarTema(){
  $.ajax({
    type: "GET",
    url: "../php/filtroComentarios.php?tema="+$('#tema').val(),
    async: false,
    cache: false,
    success: function (response) {
      $('#comentarios').html(response);
    }
  });
}

function cambiarFotos(coche){

  $.ajax({
    type: "GET",
    url: "../php/filtroGaleria.php?coche="+ coche,
    async: false,
    cache: false,
    success: function (response) {
      $('#fotos').empty();
      $('#fotos').html(response);
    }
  });
}

function volverGaleria(){
  $('#fotos').empty();
  $('#fotos').html('<div class="fotos" id="escogido" onclick="cambiarFotos(\'impreza\')"><a class="lightbox">Subaru impreza sti<img class="galeria__img" src="../galeria/impreza/impreza_1.jpg"></a></div><div class="fotos" id="escogido" onclick="cambiarFotos(\'evo\')"><a class="lightbox">Lanzer EVO<img class="galeria__img" src="../galeria/evo/evo_2.jpg" value="1" ></a></div><div class="fotos" id="escogido" onclick="cambiarFotos(\'supra\')"><a class="lightbox">Toyota Supra<img class="galeria__img" src="../galeria/supra/supra_2.jpg" value="2"></a></div><div class="fotos" id="escogido" onclick="cambiarFotos(\'silvia\')"><a class="lightbox">Sivia s15<img class="galeria__img" src="../galeria/silvia/silvia_2.jpg" value="3" ></a></div><div class="fotos" id="escogido" onclick="cambiarFotos(\'honda\')"><a class="lightbox">Honda S2000<img class="galeria__img" src="../galeria/honda/honda_2.jpg" value="4" alt="Rails"></a></div><div class="fotos" id="escogido" onclick="cambiarFotos(\'datsun\')"><a class="lightbox">Datsun 240z<img class="galeria__img" src="../galeria/datsun/datsun_2.jpg" value="5"></a></div><input type="button" name="boton" class="galeria" value="VOLER AL INICIO" onclick="location.href=\'../index.php\';">');
}

function mostrar(id){
  $("." + id).show(); /* funcion simple para mostrar dandole al boton mostrar las respuestas de un cierto comentario*/
}

function ocultar(id){
  $("." + id).hide();/* funcion simple para ocultar dandole al boton ocultar las respuestas de un cierto comentario*/
}
