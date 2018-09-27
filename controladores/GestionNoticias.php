<?php
class GestionNoticias{
    function GestionNoticias(){

    }

    function insertarComentario($link,$idn,$username,$email,$texto){
        date_default_timezone_set('UTC');
        $fecha = date("Y-m-d H:i:s");
        $id=$idn.'_'.$username.'_'.strtotime($fecha);
        $query="insert into comentarios(idNoticia,idUsuario,fecha,texto,id,email) values('".$idn."','".$username."','".$fecha."','".$texto."','".$id."','".$email."')";
        mysqli_query($link,$query);
    }

    function borrarComentario($link,$id){
        $query="delete from comentarios where id='".$id."'";
        mysqli_query($link,$query);
    }

    function updateComentario($link,$id,$texto){
        $query="update comentarios set texto='".$texto."' where id='".$id."'";
        mysqli_query($link,$query);
    }

    function getImagenes($link,$id){
        $imagenes=array();
        $query = "select * from imagenes where idNoticia='".$id."'";
        $consulta=mysqli_query($link,$query);

        $n=mysqli_num_rows($consulta);
        if($n>0){
            for($i=0;$i<$n;$i++){
                $imagen = mysqli_fetch_assoc($consulta);
                $imagenes[]=$imagen;
            }
        }

        return $imagenes;
    }

    function getVideos($link,$id){
        $videos=array();
        $query = "select * from videos where idNoticia='".$id."'";
        $consulta=mysqli_query($link,$query);

        $n=mysqli_num_rows($consulta);
        if($n>0){
            for($i=0;$i<$n;$i++){
                $video = mysqli_fetch_assoc($consulta);
                $videos[]=$video;
            }
        }

        return $videos;
    }

    function getComentarios($link,$id){
        $comentarios=array();
        $query = "select * from comentarios where idNoticia='".$id."' order by fecha desc";
        $consulta=mysqli_query($link,$query);

        $n=mysqli_num_rows($consulta);
        if($n>0){
            for($i=0;$i<$n;$i++){
                $comentario = mysqli_fetch_assoc($consulta);
                $comentarios[]=$comentario;
            }
        }

        return $comentarios;
    }

    function getNoticia($link,$id){
        $query = "select * from noticias where id='".$id."'";
        $consulta = mysqli_query($link,$query);
        $noticia=mysqli_fetch_assoc($consulta);
        $noticia['imagenes'] = $this->getImagenes($link,$id);
        $noticia['videos'] = $this->getVideos($link,$id);
        $noticia['comentarios'] = $this->getComentarios($link,$id);
        $noticia['relacionadas'] = $this->getRelacionadas($link,$noticia);
        return $noticia;
    }

    function getRelacionadas($link,$noticia){
        $nrel = array();
        
        $ettemp = explode(',',$noticia['etiquetas']);

        $relaciones_parciales=array();
        for($i=0;$i<count($ettemp);$i++){
            $ettemp[$i]=trim($ettemp[$i]);
            $query="select * from noticias where etiquetas like '%".$ettemp[$i]."%' order by fecha desc";
            $c=mysqli_query($link,$query);
            $num=mysqli_num_rows($c);
            for($j=0;$j<$num;$j++){
                $n=mysqli_fetch_assoc($c);
                $relaciones_parciales[]=$n['id'];
            }
        }


        $contadores=array();
        for($i=0;$i<count($relaciones_parciales);$i++){
            if($relaciones_parciales[$i]!='%' && $relaciones_parciales[$i]!=$noticia['id']){
                $contador=array();
                $contador['id']=$relaciones_parciales[$i];
                $contador_c=0;
                for($j=0;$j<count($relaciones_parciales);$j++){
                    if($contador['id']==$relaciones_parciales[$j]){
                        $contador_c=$contador_c+1;
                        $relaciones_parciales[$j]='%';
                    }
                    $contador['cuenta']=$contador_c;
                }
                $contadores[]=$contador;
            }
        }

        for($i=0;$i<count($contadores)-1;$i++){
            for($j=($i+1);$j<count($contadores);$j++){
                if(intval($contadores[$i]['cuenta'])<intval($contadores[$j]['cuenta'])){
                    $aux=$contadores[$i];
                    $contadores[$i]=$contadores[$j];
                    $contadores[$j]=$aux;
                }
            }
        }

        $rela=array();
        for($i=0;$i<count($contadores);$i++){
            $rela[] = mysqli_fetch_assoc(mysqli_query($link,"select * from noticias where id='".$contadores[$i]['id']."'"));
        }
        

        if(count($rela)>0){
            $array_def=array();
            for($i=0;$i<count($rela) && count($array_def)<5;$i++){
                $rela[$i]['imagenes']=$this->getImagenes($link,$rela[$i]['id']);
                if($rela[$i]['imagenes']!=0){
                    $array_def[]=$rela[$i];
                }
            }
            return $array_def;
        }else{
            return 0;
        }
    }

    function getGalerias($link,$cat){

        $query = "select * from noticias where etiquetas like '%".$cat."%' and estado='publicado' and tipo='galeria' order by fecha desc";
        if($cat == 'portada'){
            $query = "select * from noticias where tipo='galeria' and estado='publicado' order by fecha desc";
        }
        $consulta = mysqli_query($link,$query);

        $noticias =array();

        $n=mysqli_num_rows($consulta);
        if($n>0){
            for($i=0;$i<$n;$i++){
                $noticia = mysqli_fetch_assoc($consulta);
                $noticia['imagenes'] = $this->getImagenes($link,$noticia['id']);
                $noticia['videos'] = $this->getVideos($link,$noticia['id']);
                $noticia['comentarios'] = $this->getComentarios($link,$noticia['id']);
                $noticias[] = $noticia;
            }
        }

        return $noticias;
    }

    function getOpiniones($link,$cat){

        $query = "select * from noticias where etiquetas like '%".$cat."%' and estado='publicado'  and tipo='opinion' order by fecha desc";
        if($cat == 'portada'){
            $query = "select * from noticias where tipo='opinion' and estado='publicado' order by fecha desc";
        }
        $consulta = mysqli_query($link,$query);

        $noticias =array();

        $n=mysqli_num_rows($consulta);
        if($n>0){
            for($i=0;$i<$n;$i++){
                $noticia = mysqli_fetch_assoc($consulta);
                $noticia['imagenes'] = $this->getImagenes($link,$noticia['id']);
                $noticia['videos'] = $this->getVideos($link,$noticia['id']);
                $noticia['comentarios'] = $this->getComentarios($link,$noticia['id']);
                $noticias[] = $noticia;
            }
        }

        return $noticias;
    }

    function getNoticiasPortada($link,$cat){

        $query = "select * from noticias where etiquetas like '%".$cat."%' and estado='publicado' order by fecha desc";
        if($cat == 'portada'){
            $query = "select * from noticias where estado='publicado' order by fecha desc";
        }
        $consulta = mysqli_query($link,$query);

        $noticias =array();

        $n=mysqli_num_rows($consulta);
        if($n>0){
            for($i=0;$i<$n;$i++){
                $noticia = mysqli_fetch_assoc($consulta);
                $noticia['imagenes'] = $this->getImagenes($link,$noticia['id']);
                $noticia['videos'] = $this->getVideos($link,$noticia['id']);
                $noticia['comentarios'] = $this->getComentarios($link,$noticia['id']);
                $noticias[] = $noticia;
            }
        }

        return $noticias;
    }

    function buscar($link,$query){
        $query=str_replace("'",'',$query);
        $query = "select * from noticias where ( etiquetas like '%".$query."%' || titularCompleto like '%".$query."%' || descripcion like '%".$query."%')  and estado='publicado' order by fecha desc";
       
        $consulta = mysqli_query($link,$query);

        $noticias =array();

        $n=mysqli_num_rows($consulta);
        if($n>0){
            for($i=0;$i<$n;$i++){
                $noticia = mysqli_fetch_assoc($consulta);
                $noticia['imagenes'] = $this->getImagenes($link,$noticia['id']);
                $noticia['videos'] = $this->getVideos($link,$noticia['id']);
                $noticia['comentarios'] = $this->getComentarios($link,$noticia['id']);
                $noticias[] = $noticia;
            }
        }

        return $noticias;
    }

    function getNoticiasPortadaAdmin($link,$cat,$scat,$tr){

        if($tr['puesto']=='redactorJefe'){
            $query = "select * from noticias where etiquetas like '%".$cat."%' order by fecha desc";
            if($scat!=''){
                $query = "select * from noticias where etiquetas like '%".$scat."%' order by fecha desc";
            }
            if($cat == 'portada'){
                $query = "select * from noticias order by fecha desc";
            }
        }else{
            $query = "select * from noticias where etiquetas like '%".$tr['seccion']."%' and autor='".$tr['nombre'].' '.$tr['apellidos']."' order by fecha desc";
        }
        $consulta = mysqli_query($link,$query);

        $noticias =array();

        $n=mysqli_num_rows($consulta);
        if($n>0){
            for($i=0;$i<$n;$i++){
                $noticia = mysqli_fetch_assoc($consulta);
                $noticia['imagenes'] = $this->getImagenes($link,$noticia['id']);
                $noticia['videos'] = $this->getVideos($link,$noticia['id']);
                $noticia['comentarios'] = $this->getComentarios($link,$noticia['id']);
                $noticias[] = $noticia;
            }
        }

        return $noticias;
    }

    function getTiposNoticia($link){
         $query = "select * from tiposnoticia";
         $consulta=mysqli_query($link,$query);
         $n=mysqli_num_rows($consulta);
         $tipos=array();
         for($i=0;$i<$n;$i++){
            $tipos[]=mysqli_fetch_assoc($consulta);
         }
         return $tipos;
    }

    function insertar($link,$par,$user){
        date_default_timezone_set('UTC');
        $fecha = date("Y-m-d H:i:s");
        $id = $user['nombre'].' '.$user['apellidos'].'_'.strtotime($fecha);
        $estado='pendiente';
        if($user['puesto']=='radactorJefe'){
            $estado='publicado';
        }
        $query = "insert into noticias(id,titularCompleto,titularSimple,descripcion,cuerpo,autor,fecha,tipo,etiquetas,estado)
                 values('".$id."','".$par['tcompleto']."','".$par['tsimple']."','".$par['entradilla']."',
                 '".$par['textoc']."','".$user['nombre']." ".$user['apellidos']."','".$fecha."','".$par['tipno']."','".$par['etiquetas']."','".$estado."')";
        mysqli_query($link,$query);
        $this->insertarImagenes($link,$id,$par['tcompleto'],$par['imagenes']);
        $this->insertarVideos($link,$id,$par['tcompleto'],$par['videos']);
        return $id;
    }

    function insertarImagenes($link,$id,$titulo,$imagenes){
        $imagenes=explode(',',$imagenes);
        for($i=0;$i<count($imagenes)-1;$i++){
            $imagenes[$i]=trim($imagenes[$i]);
            $query="insert into imagenes(idNoticia,url,tipo,pie) values('".$id."','".$imagenes[$i]."','0','".$titulo."')";
            mysqli_query($link,$query);
        }
    }

    function insertarVideos($link,$id,$titulo,$videos){
        $videos=explode(',',$videos);
        for($i=0;$i<count($videos)-1;$i++){
            $videos[$i]=trim($videos[$i]);
            $query="insert into videos(idNoticia,url,pie,imagen) values('".$id."','".$videos[$i]."','".$titulo."','')";
            mysqli_query($link,$query);
        }
    }

    function insertarNoticiasRSS($link,$datos){
        for($j=0;$j<count($datos);$j++){
            $this->insertarNoticiaRSS($link,$datos[$j]);
        }
    }

    function insertarNoticiaRSS($link,$noticia){

        if(!$this->existeNoticia($link,$noticia)){
            date_default_timezone_set('UTC');
            $fecha = date("Y-m-d H:i:s");
            $id = $noticia['autor'].'_'.strtotime($fecha);
            
            $query = "insert into noticias(id,titularCompleto,titularSimple,descripcion,cuerpo,autor,fecha,tipo,etiquetas) 
                    values('".$id."','".$noticia['titulo']."','".$noticia['titulo']."','".$noticia['entradilla']."','".$noticia['cuerpo']."','".$noticia['autor']."','".$fecha."','normal','".$noticia['etiquetas']."')";
            mysqli_query($link,$query);

            

            for($i=0;$i<count($noticia['imagenes']);$i++){
                $this->insertarImagenRSS($link,$noticia['imagenes'][$i],$id,$noticia['titulo']);
            }
        }
        
    }

    function existeNoticia($link,$noticia){
        
        $query = "select * from noticias where titularCompleto='".$noticia['titulo']."'";
        $c=mysqli_query($link,$query);
        $num=mysqli_num_rows($c);
        
        if($num>0){
            return true;
        }
        return false;
        
    }

    function insertarImagenRSS($link,$imagen,$id,$titulo){
        
        $query = "insert into imagenes(idNoticia,url,tipo,pie) values('".$id."','".$imagen."','0','".$titulo."')";
        mysqli_query($link,$query);
        
    }

    function incrementarVisitas($link,$id){
        $query = "update noticias set nvisitas = nvisitas + 1 where id='".$id."'";
        mysqli_query($link,$query);
    }

    function borrar($link,$id){
        $this->borrarImagenes($link,$id);
        $this->borrarVideos($link,$id);
        $query = "delete from noticias where id='".$id."'";
        mysqli_query($link,$query);
    }

    function borrarImagenes($link,$idn){
        $query = "delete from imagenes where idNotcia='".$idn."'";
        mysqli_query($link,$query);
    }

    function borrarVideos($link,$idn){
        $query = "delete from videos where idNotcia='".$idn."'";
        mysqli_query($link,$query);
    }

    function update($link,$id,$parametros){
        date_default_timezone_set('UTC');
        $fecha = date("Y-m-d H:i:s");
        $query="update noticias set titularCompleto = '".$parametros['tcompleto']."', 
                titularSimple='".$parametros['tsimple']."', descripcion = '".$parametros['entradilla']."', 
                cuerpo = '".$parametros['textoc']."', tipo='".$parametros['tipno']."', 
                etiquetas = '".$parametros['etiquetas']."', fechaModificacion = '".$fecha."' where id='".$id."'";
        mysqli_query($link,$query);
        $this->updateImagenes($link,$id,$parametros['tcompleto'],$parametros['imagenes']);
        $this->updateVideos($link,$id,$parametros['tcompleto'],$parametros['videos']);
    }

    function updateImagenes($link,$id,$titulo,$imagenes){
        $query ="delete from imagenes where idNoticia='".$id."'";
        mysqli_query($link,$query);
        $imagenes=explode(',',$imagenes);
        for($i=0;$i<count($imagenes)-1;$i++){
            $imagenes[$i]=trim($imagenes[$i]);
            $query="insert into imagenes(idNoticia,url,tipo,pie) values('".$id."','".$imagenes[$i]."','0','".$titulo."')";
            mysqli_query($link,$query);
        }
    }

    function updateVideos($link,$id,$titulo,$videos){
        $query ="delete from videos where idNoticia='".$id."'";
        mysqli_query($link,$query);
        $videos=explode(',',$videos);
        for($i=0;$i<count($videos)-1;$i++){
            $videos[$i]=trim($videos[$i]);
            $query="insert into videos(idNoticia,url,pie,imagen) values('".$id."','".$videos[$i]."','".$titulo."','')";
            mysqli_query($link,$query);
        }
    }

    function publicar($link,$id){
        $query="update noticias set estado='publicado' where id='".$id."'";
        mysqli_query($link,$query);
    }

}
?>