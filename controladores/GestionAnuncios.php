<?php
class GestionAnuncios{
    function GestionAnuncios(){

    }

    function getAnunciosPortada($link,$t){
        $anuncios=array();
        $query = "select * from anuncios where tipo='horizontal' order by nclicks desc";
        if($t=='v'){
            $query = "select * from anuncios where tipo='cuadrado' order by nclicks desc";
        }

        $c=mysqli_query($link,$query);
        $n=mysqli_num_rows($c);

        for($i=0;$i<$n;$i++){
            $anuncios[]=mysqli_fetch_assoc($c);
        }
        return $anuncios;

    }

    function getAnuncios($link){
        $anuncios=array();
        $query = "select * from anuncios";
        $c=mysqli_query($link,$query);
        $n=mysqli_num_rows($c);

        for($i=0;$i<$n;$i++){
            $anuncios[]=mysqli_fetch_assoc($c);
        }
        return $anuncios;
    }

    function insertar($link,$tipo,$imagen,$enlace){
        $query="insert into anuncios(anunciante,tipo,imagen,link) values('','".$tipo."','".$imagen."','".$enlace."')";
        mysqli_query($link,$query);
    }

    function update($link,$tipo,$imagen,$enlace){
        $query="update anuncios set tipo='".$tipo."', imagen='".$imagen."' where link='".$enlace."'";
        mysqli_query($link,$query);
    }

    function erase($link,$enlace){
        $query="delete from anuncios where link='".$enlace."'";
        mysqli_query($link,$query);
    }
}
?>