<?php
    if(isset($_REQUEST['tema'])){
        if(file_exists("../xml_dtd/guardarComentarios.xml")){
            $xml = simplexml_load_file("../xml_dtd/guardarComentarios.xml");
            $respuestas = simplexml_load_file("../xml_dtd/guardarRespuestas.xml");
            foreach($xml->xpath("//visita") as $visita){
                if($_REQUEST['tema']==="Select car"){
                    echo'<div class="box"><table border=1>';
                        if(isset($visita->email))
                        {	
                            $email = $visita->email;
                            if($email["mostrar"]=="si"){
                                echo"<th>{$visita->nombre}</th>";
                                echo"<th>{$visita->tema}</th>";
                                echo"<th>{$visita->email}</th>";
                            }else{
                                echo"<th>{$visita->nombre}</th>";
                                echo"<th>{$visita->tema}</th>";
                            }  
                        }
                        else
                        {
                            echo"<th>{$visita->nombre}</th>";
                            echo"<th>{$visita->tema}</th>";
                        }                         
                        echo"</tr>";
                        echo"<tr>";
                        echo"<td colspan=\"3\">{$visita->comentario}</td>";
                        echo"</tr>";
                        echo"<tr> <td colspan=\"3\"> Respuestas </td> </tr>";
                        $i=1;
                        foreach($respuestas->xpath("//respuesta") as $respuesta) {
                            
                            if(strcmp($respuesta['id_respuesta'],$visita['id'])===0){

                                echo'<tr style="display: none" class="'.$respuesta['id_respuesta'].'">';
                                echo"<th>{$respuesta->nombre}</th>";
                                echo"<th>{$respuesta->comentario}</th>";
                                echo"<th>{$respuesta->fecha}</th>";
                                echo"</tr>";
                                 $i = $i + 1;
                            }
                        }
                    echo"<tr> <td colspan=\"3\"> <input type=\"submit\" id=\"boton\" value=\"Mostrar\" onclick=\"mostrar('".$visita['id']."')\"> <input type=\"submit\" id=\"boton\" value=\"Ocultar\" onclick=\"ocultar('".$visita['id']."')\"> </td></tr>";
                    echo"</table></div>";
                    echo"<br>";
                }else{
                    if($_REQUEST['tema']==$visita->tema){
                        echo'<div class="box"><table border=1>';
                        if(isset($visita->email))
                        {	
                            $email = $visita->email;
                            if($email["mostrar"]=="si"){
                                echo"<th>{$visita->nombre}</th>";
                                echo"<th>{$visita->tema}</th>";
                                echo"<th>{$visita->email}</th>";
                            }else{
                                echo"<th>{$visita->nombre}</th>";
                                echo"<th>{$visita->tema}</th>";
                            }  
                        }
                        else
                        {
                            echo"<th>{$visita->nombre}</th>";
                            echo"<th>{$visita->tema}</th>";
                        }                         
                        echo"</tr>";
                        echo"<tr>";
                        echo"<td colspan=\"3\">{$visita->comentario}</td>";
                        echo"</tr>";
                        echo"<tr> <td colspan=\"3\"> Respuestas </td> </tr>";
                        $i=1;
                        foreach($respuestas->xpath("//respuesta") as $respuesta) {
                            
                            if(strcmp($respuesta['id_respuesta'],$visita['id'])===0){

                                echo'<tr style="display: none" class="'.$respuesta['id_respuesta'].'">';
                                echo"<th>{$respuesta->nombre}</th>";
                                echo"<th>{$respuesta->comentario}</th>";
                                echo"<th>{$respuesta->fecha}</th>";
                                echo"</tr>";
                                 $i = $i + 1;
                            }
                        }
                    echo"<tr> <td colspan=\"3\"> <input type=\"submit\" id=\"boton\" value=\"Mostrar\" onclick=\"mostrar('".$visita['id']."')\"> <input type=\"submit\" id=\"boton\" value=\"Ocultar\" onclick=\"ocultar('".$visita['id']."')\"> </td></tr>";
                    echo"</table></div>";
                    echo"<br>";
                    }
                }
                
                
            }
        }           
 }
?>
