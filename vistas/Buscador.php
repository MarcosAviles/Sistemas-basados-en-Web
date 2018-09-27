<?php
class Buscador{
    public $noticias;
    
    function Buscador($datos){
        $this->noticias=$datos;
    }

    function resaltar($query,$texto){
        $query = strtolower(trim($query));
        $palabras_consulta=explode(' ',$query);
        for($i=0;$i<count($palabras_consulta);$i++){
            $palabras_consulta[$i]=trim($palabras_consulta[$i]);
        }

        $titular=$texto;
        $palabras_t=explode(' ',$titular);

        $npal=count($palabras_consulta);
        $npalt=count($palabras_t);
        for($i=0;$i<count($palabras_t);$i++){
            $encontrado=true;
            for($j=0;$j<$npal && $encontrado;$j++){
                if($i+$j>($npalt-1)){
                    $encontrado=false;
                }else{
                    if(strtolower(str_replace(',','',str_replace(':','',str_replace('"','',quitar_tildes($palabras_t[$i+$j])))))!=$palabras_consulta[$j]){ $encontrado=false;}
                }
            }

            if($encontrado){
                $palabras_t[$i]='<span class="redt">'.$palabras_t[$i];
                $palabras_t[($i+$npal-1)]=$palabras_t[($i+$npal-1)].'</span>';
            }
        }

        $titular_final = '';
        for($i=0;$i<$npalt;$i++){
            if($i==($npalt-1)){
                $titular_final.=$palabras_t[$i];
            }else{
                $titular_final.=$palabras_t[$i].' ';
            }
        }
        return $titular_final;
    }

    function mostrar_noticia($query,$n){

        if(count($n['titularCompleto'])<=count($query)){
            $titular_final = $this->resaltar($query,$n['titularCompleto']);
        }
        if(count($n['descripcion'])<=count($query)){
            $descripcion = $this->resaltar($query,$n['descripcion']);
        }
        

        echo '<a href="index.php?id='.$n['id'].'"><li class="noticia-autobox">
            <h3 class="titulo-autobox">'.$titular_final.'</h3>
            <p class="descripcion-autobox">'.$descripcion.'</p>
        </li></a>
        ';
    }

    function mostrar($query){
        $not=$this->noticias;
        $n=count($not);
        echo '<h2 class="tbusqueda">'.$n.' Resultados para "'.$query.'"</h2><ul>';
        if(count($not)>0){
            for($i=0;$i<count($not);$i++){
                $this->mostrar_noticia($query,$not[$i]);
            }
        }else{
            echo 'no hay noticias';
        }
        echo '</ul>';
    }
}
?>