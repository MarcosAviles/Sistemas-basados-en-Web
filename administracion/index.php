<?php 
session_start();
include_once('Administracion.php'); 
$periodico= new Administracion();

$cat = 'portada';
$u='';
extract($_GET);

if(isset($_SESSION['trabajador'])){
    $u=$_SESSION['trabajador'];
}

if(isset($_POST['uname'])){
    $res=$periodico->loginAdmin($_POST['uname'],$_POST['pass']);
    if($res!='1'){
        $_SESSION['trabajador']=$res;
        $u=$res;
    }
}

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>DailySport</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css?v175s">
        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/java.js?v136"></script>
    </head>
    <body>
        <?php
        if(!isset($_SESSION['trabajador'])){
            $periodico->mostrarLoginAdmin();
        }else{
            $u=$_SESSION['trabajador'];
            if(isset($_POST['org'])){
                $e = json_decode($_POST['org'],true);

                $plantilla=$e['plantilla'];
                $periodico->nuevaPlantilla($plantilla);
                $periodico->getOrganizador('portada',$action);
            }else{
                if(isset($action)){

                    if($action=='out'){
                        unset($_SESSION['trabajador']);
                        session_destroy();
                        header('Location: index.php');
                    }
                    if($action=='mnoticia'){
                        $periodico->updateNoticia($id,$_POST);
                    }

                    if($action=='inoticia'){
                        $periodico->insertarNoticia($_POST,$u);
                    }

                    if($action=='add'){
                        $periodico->getNoticiaAdminAdd($u,$cat);
                    }

                    if($action=='add_ad'){
                        extract($_POST);
                        $periodico->insertarAnuncio($tipo,$img,$enlace);
                        $periodico->getPublicidadAdmin('publicidad');

                    }

                    if($action=='update_com'){
                        extract($_POST);
                        $periodico->updateComentario($idc,$texto_com);
                        $periodico->getComentarios($idn);
                    }
                    
                    if($action=='erase_com'){
                        $periodico->borrarComentario($idc);
                        $periodico->getComentarios($idn);
                    }

                    if($action=='add_com'){
                        extract($_POST);
                        $periodico->insertarComentario($idn,$nick,$email,$texto_com);
                        $periodico->getComentarios($idn);
                    }

                    if($action=='update_cat'){
                        extract($_POST);
                        $periodico->updateCategorias($categorias,$subcategorias);
                        $periodico->getCategorias('categorias');
                    }

                    if($action=='update_ad'){
                        extract($_POST);
                        $periodico->updateAnuncio($tipo,$img,$enlace);
                        $periodico->getPublicidadAdmin('publicidad');
                    }

                    if($action=='erase_ad'){
                        extract($_GET);
                        $periodico->eraseAnuncio($enlace);
                        $periodico->getPublicidadAdmin('publicidad');
                    }

                    if($action=='organizador'){
                        $so='portada';
                        if(isset($sec)){
                            $so=$sec;
                        }
                        $periodico->getOrganizador($so,$action);
                        
                    }

                    if($action=='comentarios'){
                        $periodico->getComentarios($idn);
                    }

                    if($action=='pub'){
                        $periodico->publicar($idn);
                        $periodico->getNoticiaAdmin($idn,'portada',$u);
                    }

                    if($action=='noticias'){
                        if(isset($saction)){
                            $periodico->getPortadaAdmin($action,$saction);
                        }else{
                            $periodico->getPortadaAdmin($cat,'');
                        }
                    }

                    if($action=='categorias'){
                        $periodico->getCategorias($action);
                    }

                    if($action=='publicidad'){
                        $periodico->getPublicidadAdmin($action);
                    }

                    
                }else{
                    if(isset($erase)){
                        if($erase==0){
                            $periodico->borrarNoticia($id);
                            $periodico->getPortadaAdmin($cat,'');
                        }

                    }else{
                        if(isset($id)){
                            $periodico->getNoticiaAdmin($id,$cat,$u);
                        }else{
                            $periodico->getPortadaAdmin($cat,'');
                        }
                    }
                }
            }
        }
            
        ?>
        <script type="text/javascript">
        $(document).ready(function(){
            inicio();
            admin();
            if($('#cubre-noticia-a').length>0){
                formulario_noticia();
            }
            if($('#continer-plantilla').length>0){
                organizador();
            }
            if($('#continer-categorias').length>0){
                categorias();
            }
            adaptar();
        });
        adaptar();
        </script>
    </body>
</html>
<?php
    
?>