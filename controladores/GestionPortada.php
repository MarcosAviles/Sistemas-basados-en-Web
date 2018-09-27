<?php
class GestionPortada{
    function GestionPortada(){

    }

    function getComposicion($link,$s){
        if($s=='portada'){
            $consulta=mysqli_query($link,"select * from contenedor where  nombre='".$s."' order by orden asc");
        }else{
            $consulta=mysqli_query($link,"select * from contenedor where  nombre='seccion' order by orden asc");
        }

        $num=mysqli_num_rows($consulta);
        $portada=array();
        if($num>0){
            for($i=0;$i<$num;$i++){
                $seccion=mysqli_fetch_assoc($consulta);
                $portada[]=$seccion;

                $idSeccion=$seccion['titulo'].'_'.$seccion['lugar'].'_'.$seccion['orden'];
                $query ="select * from subsecciones where idSeccion='".$idSeccion."' and idSubseccion='no' order by orden asc";
                $subsec=mysqli_query($link,$query);
                $ns=mysqli_num_rows($subsec);

                if($ns>0){
                    $subsecciones=array();
                    for($j=0;$j<$ns;$j++){
                        
                        $columnas=array();
                        $ss=mysqli_fetch_assoc($subsec);
                        $subsecciones[]=$ss;
                        $idco=$ss['idSeccion'].'_'.$ss['orden'];
                        $n=$ss['ncolumnas'];
                        for($k=0;$k<$n;$k++){
                            $columna = mysqli_fetch_assoc(mysqli_query($link,"select * from columnas where idSubseccion='".$idco."' and orden='".($k+1)."'"));
                            $columnas[]=$columna;
                        }

                        $subsecciones[$j]['columnas']=$columnas;

                    }
                    $portada[$i]['subsecciones']=$subsecciones;
                }
            }
        }

        return $portada;
    }
}
?>