<?php
    if(isset($_REQUEST['tema'])){
        if(file_exists("../xml_dtd/guardarComentarios.xml")){
            $xml = simplexml_load_file("../xml_dtd/guardarComentarios.xml") or die("No se ha podido acceder a la base de datos que almacena los comentarios");
            $respuestas = simplexml_load_file("../xml_dtd/guardarRespuestas.xml") or die("No se ha podido acceder a la base de datos que almacena las respuestas");
            foreach($xml->xpath("//visitor") as $visitor){
                if ($_REQUEST['tema'] == "Select car"){

                        echo'<div class="box"><table border=1>';
                            if(isset($visitor->email))
                            {	
                                $email = $visitor->email;
                                if($email["mostrar"]=="si"){
                                    echo"<th>{$visitor->nombre}</th>";
                                    echo"<th>{$visitor->tema}</th>";
                                    echo"<th>{$visitor->email}</th>";       
                                }else{
                                    echo"<th>{$visitor->nombre}</th>";
                                    echo"<th colspan=\"2\">{$visitor->tema}</th>";
                                }
                            }
                            echo"</tr>";
                            echo"<tr>";
                            echo"<td colspan=\"3\">{$visitor->comentario}</td>";
                            echo"</tr>";
                            $id = $visitor['id'];
                            echo"<tr> <td colspan=\"3\"> Respuestas <form action=\"respuestas.php\" method=\"post\"><input type=\"hidden\" name=\"id_respuesta_comentario\" value=\"$id\"><input type=\"hidden\" name=\"vienedelform\" value=\"si\"/><input type=\"submit\" class=\"boton_respuesta\" value=\"Responder\" ></form></td> </tr>";
                            $i=1;
                            //RECORRER CADA RESPUESTA
                            foreach($respuestas->xpath("//respuesta") as $respuesta) {
                                
                                if(strcmp($respuesta['id_respuesta'],$visitor['id'])===0){
    
                                    echo'<tr style="display: none" class="'.$respuesta['id_respuesta'].'">';
                                    echo"<th>{$respuesta->nombre}</th>";
                                    echo"<th>{$respuesta->comentario}</th>";
                                    echo"<th>{$respuesta->fecha}</th>";
                                    echo"</tr>";
                                     $i = $i + 1;
                                }
                            }
                        echo"<tr> <td colspan=\"3\"> <input type=\"submit\" id=\"boton\" value=\"Mostrar\" onclick=\"mostrar('".$visitor['id']."')\"> <input type=\"submit\" id=\"boton\" value=\"Ocultar\" onclick=\"ocultar('".$visitor['id']."')\"> </td></tr>";
                        echo"</table></div>";
                        echo"<br>";          
                }
                else if($_REQUEST['tema']==$visitor->tema){
                    echo'<div class="box"><table border=1>';
                    if(isset($visitor->email))
                    {	
                        $email = $visitor->email;
                        if($email["mostrar"]=="si"){
                            echo"<th>{$visitor->nombre}</th>";
                            echo"<th>{$visitor->tema}</th>";
                            echo"<th>{$visitor->email}</th>";
                        }else{
                            echo"<th>{$visitor->nombre}</th>";
                            echo"<th>{$visitor->tema}</th>";
                        }  
                    }
                    else
                    {
                        echo"<th>{$visitor->nombre}</th>";
                        echo"<th>{$visitor->tema}</th>";
                    }                         
                    echo"</tr>";
                    echo"<tr>";
                    echo"<td colspan=\"3\">{$visitor->comentario}</td>";
                    echo"</tr>";
                    $id = $visitor['id'];
                    echo"<tr> <td colspan=\"3\"> Respuestas <form action=\"respuestas.php\" method=\"post\"><input type=\"hidden\" name=\"id_respuesta_comentario\" value=\"$id\"><input type=\"hidden\" name=\"vienedelform\" value=\"si\"/><input type=\"submit\" class=\"boton_respuesta\" value=\"Responder\" ></form></td> </tr>";
                    $i=1;
                    foreach($respuestas->xpath("//respuesta") as $respuesta) {

                        if(strcmp($respuesta['id_respuesta'],$visitor['id'])===0){

                            echo'<tr style="display: none" class="'.$respuesta['id_respuesta'].'">';
                            echo"<th>{$respuesta->nombre}</th>";
                            echo"<th>{$respuesta->comentario}</th>";
                            echo"<th>{$respuesta->fecha}</th>";
                            echo"</tr>";
                                $i = $i + 1;
                        }
                    }
                echo"<tr> <td colspan=\"3\"> <input type=\"submit\" id=\"boton\" value=\"Mostrar\" onclick=\"mostrar('".$visitor['id']."')\"> <input type=\"submit\" id=\"boton\" value=\"Ocultar\" onclick=\"ocultar('".$visitor['id']."')\"> </td></tr>";
                echo"</table></div>";
                echo"<br>";
                }
            } 
        }
    }           
?>
