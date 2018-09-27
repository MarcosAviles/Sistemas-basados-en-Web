<?php
class GestionHeader{
    function GestionHeader(){

    }

    function getMenuPrincipal($link){
        $menu=array();
        $query = "select * from categorias where superCategoria='no' and administracion='0' order by orden asc";
        $consulta=mysqli_query($link,$query);
        $n=mysqli_num_rows($consulta);
        for($i=0;$i<$n;$i++){
            $item=mysqli_fetch_assoc($consulta);
            $menu[]=$item;
        }

        return $menu;
    }

    function getSubseccionesAdmin($link,$valor){
        $sub=array();
        $query = "select * from categorias where superCategoria='".$valor."' and administracion='1' order by orden asc";
        $consulta=mysqli_query($link,$query);
        $n=mysqli_num_rows($consulta);
        for($i=0;$i<$n;$i++){
            $item=mysqli_fetch_assoc($consulta);
            $sub[]=$item;
        }
        return $sub;
    }

    function getMenuPrincipalAdmin($link){
        $menu=array();
        $query = "select * from categorias where superCategoria='no' and administracion='1' order by orden asc";
        $consulta=mysqli_query($link,$query);
        $n=mysqli_num_rows($consulta);
        for($i=0;$i<$n;$i++){
            $item=mysqli_fetch_assoc($consulta);
            $item['subcat']=$this->getSubseccionesAdmin($link,$item['valor']);
            $menu[]=$item;
        }

        return $menu;
    }

}

?>