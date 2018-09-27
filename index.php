<?php
session_start();
include_once('controladores/Periodico.php'); 
$periodico= new Periodico();

$tplantilla='portada';
$cat = 'portada';
$u='';
if(isset($_SESSION['usuario'])){
    $u=$_SESSION['usuario'];
}

extract($_GET);

if(isset($_POST['nick'])){
    $res=$periodico->registrar($_POST);
    if($res!='1'){
        $_SESSION['usuario']=$res;
        $u=$_SESSION['usuario'];
    }
}

if(isset($_POST['pass'])){
    $res=$periodico->login($_POST['uname'],$_POST['pass']);
    if($res!='1'){
        $_SESSION['usuario']=$res;
        $u=$_SESSION['usuario'];
    }
}


if(isset($action)){
    if($action=='out'){
        unset($_SESSION['usuario']);
        session_destroy();
        header('Location: index.php');
    }
}

if(isset($action) && $action=='search'){
        $busqueda=$_POST['search'];
        $periodico->buscar($busqueda);
}else{

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>DailySport</title>
        <link rel="stylesheet" type="text/css" href="css/style.css?v172s">
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/java.js?v170"></script>
    </head>
    <body>
        <?php
        if(isset($action)){
            if($action=='add_com'){
                extract($_POST);
                $periodico->insertarComentario($idn,$uname,$email_c,$texto_c);
                $periodico->getNoticia($idn,'portada',$u);
            }
        }else{
            if(isset($vi)){
                $periodico->getNoticiaImpresion($id);
            }else{
                if(isset($id)){
                    $periodico->verNoticia($id);
                    $periodico->getNoticia($id,$cat,$u);
                }else{
                    $periodico->getPortada($tplantilla,$cat);
                }
            }
        }
        ?>
        <script type="text/javascript">
        $(document).ready(function(){
            inicio();
            if($('#cubre-noticia').length>0){
                noticia();
            }
            adaptar();
        });
        adaptar();
        </script>
    </body>
</html>
<?php
}
?>