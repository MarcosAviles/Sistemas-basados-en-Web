<?php
class GestionCategorias{
    function GestionCategorias(){

    }

    function getSubcategorias($link,$valor){
        $subcategorias=array();
        $query = "select * from categorias where administracion='0' and superCategoria='".$valor."'";
        $consulta=mysqli_query($link,$query);
        $n=mysqli_num_rows($consulta);
        for($i=0;$i<$n;$i++){
            $subcategoria=mysqli_fetch_assoc($consulta);
            $subcategorias[]=$subcategoria;
        }
        return $subcategorias;

    }

    function getCategorias($link){
        $categorias=array();
        $query = "select * from categorias where administracion='0' and superCategoria='no'";
        $consulta=mysqli_query($link,$query);
        $n=mysqli_num_rows($consulta);
        for($i=0;$i<$n;$i++){
            $categoria=mysqli_fetch_assoc($consulta);
            $categoria['subcategorias']=$this->getSubcategorias($link,$categoria['valor']);
            $categorias[]=$categoria;
        }
        return $categorias;
    }

    function borrarCategorias($link){
        $query="delete from categorias where administracion='0'";
        mysqli_query($link,$query);
    }

    function insertarCategoria($link,$categoria,$i){
        $valor=strtolower(quitar_tildes($categoria));
        
        $query="insert into categorias(nombre,valor,superCategoria,orden,administracion) 
                values('".$categoria."','".$valor."','no','".$i."','0')";
        mysqli_query($link,$query);
    }

    function insertarSubcategoria($link,$cat,$sub,$i){
        $valor=strtolower(quitar_tildes($sub));
        $super=strtolower(quitar_tildes($cat));
        $query = "insert into categorias(nombre,valor,superCategoria,orden,administracion) 
                  values('".$sub."','".$valor."','".$super."','".$i."','0')";
        mysqli_query($link,$query);
    }

    function actualizar($link,$categorias,$subcategorias){
        $this->borrarCategorias($link);
        $categorias=explode(',',$categorias);
        for($i=0;$i<(count($categorias)-1);$i++){
            $this->insertarCategoria($link,$categorias[$i],$i);
        }

        $subcats=explode(',',$subcategorias);
        for($i=0;$i<(count($subcats)-1);$i++){
            $cat_sub=explode('_',$subcats[$i]);
            $cat=$cat_sub[0];
            $sub=$cat_sub[1];
            $this->insertarSubcategoria($link,$cat,$sub,$i);
        }
    }
}
?>