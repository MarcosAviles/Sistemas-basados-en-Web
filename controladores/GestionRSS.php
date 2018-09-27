<?php

class GestionRSS{
    
    function GestionRSS(){

    }

    function quitar_tildes($cadena){
        $no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
        $permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
        $texto = str_replace($no_permitidas, $permitidas ,$cadena);
        return $texto;
    }

    function getRSS(){

        $noticias=array();
        $rss = file_get_contents('http://as.com/rss/diarioas/portada.xml');
        $rss = str_replace('dc:creator','creator',str_replace('content:encoded','content',$rss));
        $rs = new SimpleXMLElement($rss);

        foreach($rs->channel->item as $entrada){
            $etiquetas ='';
            for($i=0;$i<count($entrada->category);$i++){
                $etiquetas.=strtolower($this->quitar_tildes($entrada->category[$i])).', ';
            }
            $imagenes=array();
            for($i=0;$i<count($entrada->enclosure);$i++){
                $imagenes[]=$entrada->enclosure[$i]['url'];
            }
            $noticia = array('titulo'=>$entrada->title,'imagenes'=>$imagenes,'fecha'=>$entrada->pubDate,'entradilla'=>$entrada->description,'cuerpo'=>$entrada->content,'autor'=>$entrada->creator,'etiquetas'=>$etiquetas);
            $noticias[]=$noticia;
        }

        return $noticias;
    }

    
}

?>