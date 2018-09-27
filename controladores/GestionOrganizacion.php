<?php
class GestionOrganizacion{
    
    function GestionOrganizacion(){

    }

    function getDivisiones($link,$columna){
        $divisiones = array();
        $query = "select * from divisiones where nombreContenedor='".$columna['nombreContenedor']."' and
                 ordenContenedor='".$columna['ordenContenedor']."' and ordenSeccion='".$columna['ordenSeccion']."' and 
                 ordenColumna='".$columna['orden']."' order by orden asc";
        $c = mysqli_query($link,$query);
        $n = mysqli_num_rows($c);

        if($n>0){
            for($i=0;$i<$n;$i++){
                $division=mysqli_fetch_assoc($c);
                $divisiones[]=$division;
            }
        }
        return $divisiones;
    }

    function getColumnas($link,$seccion){
        $columnas=array();
        $query = "select * from columnas where nombreContenedor='".$seccion['nombreContenedor']."'
                 and ordenContenedor='".$seccion['ordenContenedor']."' and ordenSeccion='".$seccion['orden']."' 
                 order by orden asc";
        $c = mysqli_query($link,$query);
        $n = mysqli_num_rows($c);

        if($n>0){
            for($i=0;$i<$n;$i++){
                $columna=mysqli_fetch_assoc($c);
                $columna['divisiones']=$this->getDivisiones($link,$columna);
                $columnas[]=$columna;
            }
        }
        return $columnas;
    }

    function getSecciones($link,$categoria){
        $secciones=array();
        $query = "select * from seccion where nombreContenedor='".$categoria['nombre']."' 
                  and ordenContenedor='".$categoria['orden']."' order by orden asc";
        $c = mysqli_query($link,$query);
        $n = mysqli_num_rows($c);

        if($n>0){
            for($i=0;$i<$n;$i++){
                $seccion=mysqli_fetch_assoc($c);
                $seccion['columnas']=$this->getColumnas($link,$seccion);
                $secciones[]=$seccion;
            }
        }
        return $secciones;
    }

    function getOrganizacion($link,$cat){
        $organizacion=array();
        if($cat=='portada'){
            $query = "select * from contenedor where nombre='".$cat."' order by orden asc";
        }else{
            $query = "select * from contenedor where nombre='seccion' order by orden asc";
        }
        $c=mysqli_query($link,$query);
        $n = mysqli_num_rows($c);

        if($n>0){
            for($i=0;$i<$n;$i++){
                $categoria=mysqli_fetch_assoc($c);
                $categoria['elementos']=$this->getSecciones($link,$categoria);
                $organizacion[]=$categoria;
            }
        }
        return $organizacion;
    }

    function insertarCategoria($link,$c){
        $query = "insert into contenedor(nombre,orden,cabecera,titulo) values('".$c['nombre']."','".$c['orden']."','".$c['cabecera']."','".$c['titulo']."')";
        mysqli_query($link,$query);
    }

    function insertarSeccion($link,$c){
        $query = "insert into seccion(nombreContenedor,ordenContenedor,tipo,orden,ncolumnas) 
                  values('".$c['nombreContenedor']."','".$c['ordenContenedor']."','".$c['tipo']."','".$c['orden']."','".$c['ncolumnas']."')";
        mysqli_query($link,$query);
    }

    function insertarColumna($link,$c){
        $query = "insert into columnas(nombreContenedor,ordenContenedor,ordenSeccion,orden,nDivisiones,tipo) 
                  values('".$c['nombreContenedor']."','".$c['ordenContenedor']."','".$c['ordenSeccion']."','".$c['orden']."',
                  '".$c['nDivisiones']."','".$c['tipo']."')";
        mysqli_query($link,$query);
    }

    function insertarDivision($link,$c){
        $query = "insert into divisiones(nombreContenedor,ordenContenedor,ordenSeccion,ordenColumna,orden,tipo)
                  values('".$c['nombreContenedor']."','".$c['ordenContenedor']."','".$c['ordenSeccion']."',
                  '".$c['ordenColumna']."','".$c['orden']."','".$c['tipo']."')";
        mysqli_query($link,$query);
    }

    function borrarPlantilla($link,$nombre){
        $query0="delete from divisiones where nombreContenedor='".$nombre."'";
        $query1="delete from columnas where nombreContenedor='".$nombre."'";
        $query2="delete from seccion where nombrecontenedor='".$nombre."'";
        $query3="delete from contenedor where nombre='".$nombre."'";

        mysqli_query($link,$query0);
        mysqli_query($link,$query1);
        mysqli_query($link,$query2);
        mysqli_query($link,$query3);
    }

    function nueva($link,$plantilla){
        $this->borrarPlantilla($link,$plantilla[0]['nombre']);
        for($i=0;$i<count($plantilla);$i++){
            $categoria=array('nombre'=>$plantilla[$i]['nombre'],'orden'=>$plantilla[$i]['orden'],'cabecera'=>$plantilla[$i]['cabecera'],'titulo'=>$plantilla[$i]['titulo']);
            $this->insertarCategoria($link,$categoria);
            $elementos=$plantilla[$i]['elementos'];
            for($j=0;$j<count($plantilla[$i]['elementos']);$j++){
                $seccion=array('nombreContenedor'=>$categoria['nombre'],'ordenContenedor'=>$categoria['orden'],
                                'orden'=>$elementos[$j]['orden'],'tipo'=>$elementos[$j]['tipo'],
                                'ncolumnas'=>count($elementos[$j]['columnas']));
                $this->insertarSeccion($link,$seccion);
                $columnas=$elementos[$j]['columnas'];
                for($k=0;$k<count($columnas);$k++){
                    $columna=array('nombreContenedor'=>$categoria['nombre'],'ordenContenedor'=>$categoria['orden'],
                                'ordenSeccion'=>$seccion['orden'],'orden'=>$columnas[$k]['orden'],'nDivisiones'=>$columnas[$k]['numero'],
                                'tipo'=>$columnas[$k]['tipo']);
                    $this->insertarColumna($link,$columna);
                    $sc=$columnas[$k]['sc'];
                    for($l=0;$l<count($sc);$l++){
                        $division=array('nombreContenedor'=>$categoria['nombre'],'ordenContenedor'=>$categoria['orden'],
                                'ordenSeccion'=>$seccion['orden'],'ordenColumna'=>$columnas[$k]['orden'],'orden'=>$sc[$l]['orden'],
                                'tipo'=>$sc[$l]['tipo']);
                        $this->insertarDivision($link,$division);
                    }
                }
            }
        }
    }
}
?>