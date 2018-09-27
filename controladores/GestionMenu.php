<?php
class GestionMenu{
    function GestionMenu(){

    }

    function getSubcategorias($link,$item){
        $query = "select * from categorias where superCategoria='".$item."' order by nombre desc";
        $consulta = mysqli_query($link,$query);

        $n=mysqli_num_rows($consulta);
        $subcategorias=array();
        if($n>0){
            for($i=0;$i<$n;$i++){
                $subcategorias[]=mysqli_fetch_assoc($consulta);
            }
        }
        return $subcategorias;
    }
}
?>