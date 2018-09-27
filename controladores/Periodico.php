<?php
include_once('DB.php');
include_once('formato.php');
include_once('GestionPortada.php');
include_once('GestionNoticias.php');
include_once('GestionRSS.php');
include_once('GestionMenu.php');
include_once('GestionHeader.php');
include_once('GestionOrganizacion.php');
include_once('GestionLogin.php');
include_once('GestionRegistro.php');
include_once('GestionAnuncios.php');
include_once('GestionCategorias.php');
include_once('Fecha.php');
include('vistas/Portada.php');
include('vistas/Noticia.php');
include('vistas/Header.php');
include('vistas/Registro.php');
include('vistas/Organizador.php');
include('vistas/Login.php');
include('vistas/publicidad.php');
include('vistas/Categorias.php');
include('vistas/Comentarios.php');
include('vistas/Buscador.php');

class Periodico{
    public $DB;
    public $GP;
    public $GN;
    public $RSS;
    public $GM;
    public $GH;
    public $GL;
    public $GR;
    public $GA;
    public $GC;

    function Periodico(){
        $this->DB = new DB();
        $this->GP = new GestionPortada();
        $this->GN = new GestionNoticias();
        $this->RSS = new GestionRSS();
        $this->GM = new GestionMenu();
        $this->GH = new GestionHeader();
        $this->GO = new GestionOrganizacion();
        $this->GL = new GestionLogin();
        $this->GR = new GestionRegistro();
        $this->GA = new GestionAnuncios();
        $this->GC = new GestionCategorias();
    }

    function getHeader($link){
        $menu=$this->GH->getMenuPrincipal($link);
        return $menu;
    }

    function getHeaderAdmin($link){
        $menu=$this->GH->getMenuPrincipalAdmin($link);
        return $menu;
    }


    function getPortada($tplantilla,$categoria){
        $link=$this->DB->conectar();
        $menu=$this->getHeader($link);
        $header = new Header($menu);
        $header->mostrar($categoria);
        $componentes = $this->GO->getOrganizacion($link,$categoria);
        $noticias=array();
        $galerias=array();
        $opiniones=array();
        for($i=0;$i<count($componentes);$i++){
            $c = $categoria;
            if($categoria=='portada'){
                $c=$componentes[$i]['titulo'];
            }
            $componentes[$i]['submenu'] = $this->GM->getSubcategorias($link,$categoria);
            $noticias[] = $this->GN->getNoticiasPortada($link,$categoria);
            $galerias[]=$this->GN->getGalerias($link,$categoria);
            $opiniones[]=$this->GN->getOpiniones($link,$categoria);
        }
        if(empty($noticias)){
            $noticias[0]= $this->GN->getNoticiasPortada($link,$categoria);
            $galerias[0]=$this->GN->getGalerias($link,$categoria);
            $opiniones[0]=$this->GN->getOpiniones($link,$categoria);
        }
        $noticias['anunciosH']=$this->GA->getAnunciosPortada($link,'h');
        $noticias['anunciosV']=$this->GA->getAnunciosPortada($link,'v');
        $this->DB->desconectar($link);
        $p = new Portada($componentes,$noticias,$galerias,$opiniones);
        echo '<div class="wrapper">';
        $r = new Registro();
        $r->mostrar();
        $p->mostrar($categoria);
        echo '</div>';

    }

    function getPortadaAdmin($cat,$scat){
        $trabajador='';
        if(isset($_SESSION['trabajador'])){
            $trabajador=$_SESSION['trabajador'];
        }
        $link=$this->DB->conectar();
        $menu=$this->getHeaderAdmin($link);
        $header = new Header($menu);
        $header->mostrarAdmin('noticias',$trabajador);
        
        $noticias=array();
        $noticias[] = $this->GN->getNoticiasPortadaAdmin($link,$cat,$scat,$trabajador);
        
        $this->DB->desconectar($link);
        $p = new Portada('',$noticias,'','');
        echo '<div class="wrapper">';
        $p->mostrarAdmin($cat);
        echo '</div>';
    }

    function getNoticia($id,$cat,$u){
        $link=$this->DB->conectar();
        $menu=$this->getHeader($link);
        $header = new Header($menu);
        $header->mostrar($cat);
        $noticia = $this->GN->getNoticia($link,$id);
        $this->DB->desconectar($link);

        $n=new Noticia($noticia);
        echo '<div class="wrapper">';
        $r = new Registro();
        $r->mostrar();
        $n->mostrar($u);
        echo '</div>';
    }

    function getNoticiaImpresion($id){
        $link=$this->DB->conectar();
        $noticia = $this->GN->getNoticia($link,$id);
        $this->DB->desconectar($link);

        $n=new Noticia($noticia);
        $n->mostrarImpresion();
    }

    function verNoticia($id){
        $link=$this->DB->conectar();
        $this->GN->incrementarVisitas($link,$id);
        $this->DB->desconectar($link);
    }

    function getRSS(){
        $link = $this->DB->conectar();
        $datos = $this->RSS->getRSS();
        $this->GN->insertarNoticiasRSS($link,$datos);
        $this->DB->desconectar($link);
    }

    function borrarNoticia($id){
        $link = $this->DB->conectar();
        $this->GN->borrar($link,$id);
        $this->DB->desconectar($link);
    }

    function getNoticiaAdmin($id,$cat,$u){
        $trabajador='';
        if(isset($_SESSION['trabajador'])){
            $trabajador=$_SESSION['trabajador'];
        }
        $link=$this->DB->conectar();
        $menu=$this->getHeaderAdmin($link);
        $header = new Header($menu);
        $header->mostrarAdmin('noticia',$trabajador);
        $noticia = $this->GN->getNoticia($link,$id);
        $tipos = $this->GN->getTiposNoticia($link);
        $this->DB->desconectar($link);
        $n=new Noticia($noticia);
        echo '<div class="wrapper">';
        $n->mostrarAdmin($u,$tipos);
        echo '</div>';
    }

    function getNoticiaAdminAdd($u,$cat){
        $trabajador='';
        if(isset($_SESSION['trabajador'])){
            $trabajador=$_SESSION['trabajador'];
        }
        $link=$this->DB->conectar();
        $menu=$this->getHeaderAdmin($link);
        $header = new Header($menu);
        $header->mostrarAdmin('noticia',$trabajador);
        $tipos = $this->GN->getTiposNoticia($link);
        $this->DB->desconectar($link);
        $n=new Noticia('');
        echo '<div class="wrapper">';
        $n->mostrarAdminAdd($u,$tipos);
        echo '</div>';
    }

    function updateNoticia($id,$parametros){
        $link=$this->DB->conectar();
        $this->GN->update($link,$id,$parametros);
        $this->DB->desconectar($link);

        echo 'noticia actualizada con exito';
    }

    function insertarNoticia($parametros,$user){
        $link=$this->DB->conectar();
        $id=$this->GN->insertar($link,$parametros,$user);
        $this->DB->desconectar($link);
        echo 'noticia insertada con exito';
        $this->getNoticiaAdmin($id,'portada',$user);
    }

    function getOrganizador($s,$cat){
        $trabajador='';
        if(isset($_SESSION['trabajador'])){
            $trabajador=$_SESSION['trabajador'];
        }
        $link=$this->DB->conectar();
        $menu=$this->getHeaderAdmin($link);
        $header = new Header($menu);
        $header->mostrarAdmin($cat,$trabajador);
        $datos=$this->GO->getOrganizacion($link,$s);
        $this->DB->desconectar($link);
        $organizador = new Organizador($datos);
        echo '<div class="wrapper">';
        $organizador->mostrar($s);
        echo '</div>';
    }

    function nuevaPlantilla($plantilla){
        $link=$this->DB->conectar();
        $this->GO->nueva($link,$plantilla);
        $this->DB->desconectar($link);
    }

    function mostrarLoginAdmin(){
        $l=new Login();
        $l->mostrarAdmin();
    }

    function loginAdmin($nick,$pass){
        $link=$this->DB->conectar();
        $res=$this->GL->login($link,$nick,$pass);
        $this->DB->desconectar($link);

        return $res;
    }

    function login($nick,$pass){
        $link=$this->DB->conectar();
        $res=$this->GL->loginUser($link,$nick,$pass);
        $this->DB->desconectar($link);

        return $res;
    }

    function registrar($datos){
        $link=$this->DB->conectar();
        $res=$this->GR->registrar($link,$datos);
        if($res==1){
            $res=$this->GL->loginUser($link,$datos['nick'],$datos['rpassc']);
        }
        $this->DB->desconectar($link);

        return $res;
    }

    function getPublicidadAdmin($cat){
        $trabajador='';
        if(isset($_SESSION['trabajador'])){
            $trabajador=$_SESSION['trabajador'];
        }
        $link=$this->DB->conectar();
        $menu=$this->getHeaderAdmin($link);
        $header = new Header($menu);
        $header->mostrarAdmin($cat,$trabajador);
        $anuncios = $this->GA->getAnuncios($link);
        $this->DB->desconectar($link);

        $publicidad= new Publicidad($anuncios);
        echo '<div class="wrapper">';
        $publicidad->mostrar();
        echo '</div>';
    }

    function insertarAnuncio($tipo,$img,$enlace){
        $link=$this->DB->conectar();
        $this->GA->insertar($link,$tipo,$img,$enlace);
        $this->DB->desconectar($link);
    }

    function updateAnuncio($tipo,$img,$enlace){
        $link=$this->DB->conectar();
        $this->GA->update($link,$tipo,$img,$enlace);
        $this->DB->desconectar($link);
    }

    function eraseAnuncio($enlace){
        $link=$this->DB->conectar();
        $this->GA->erase($link,$enlace);
        $this->DB->desconectar($link);
    }

    function getCategorias($cat){
        $trabajador='';
        if(isset($_SESSION['trabajador'])){
            $trabajador=$_SESSION['trabajador'];
        }
        $link=$this->DB->conectar();
        $menu=$this->getHeaderAdmin($link);
        $header = new Header($menu);
        $header->mostrarAdmin($cat,$trabajador);
        $datos = $this->GC->getCategorias($link);
        $this->DB->desconectar($link);

        $categorias= new Categorias($datos);
        echo '<div class="wrapper">';
        $categorias->mostrar($datos);
        echo '</div>';
    }

    function updateCategorias($categorias,$subcategorias){
        $link=$this->DB->conectar();
        $this->GC->actualizar($link,$categorias,$subcategorias);
        $this->DB->desconectar($link);
    }

    function insertarComentario($idn,$username,$email,$texto){
        $link=$this->DB->conectar();
        $this->GN->insertarComentario($link,$idn,$username,$email,$texto);
        $this->DB->desconectar($link);
    }

    function publicar($id){
        $link=$this->DB->conectar();
        $this->GN->publicar($link,$idn);
        $this->DB->desconectar($link);
    }

    function getComentarios($id){
        $trabajador='';
        if(isset($_SESSION['trabajador'])){
            $trabajador=$_SESSION['trabajador'];
        }
        $link=$this->DB->conectar();
        $menu=$this->getHeaderAdmin($link);
        $header = new Header($menu);
        $header->mostrarAdmin('noticias',$trabajador);
        $datos = $this->GN->getComentarios($link,$id);
        $this->DB->desconectar($link);

        $comentarios= new Comentarios($datos);
        echo '<div class="wrapper">';
        $comentarios->mostrar($id);
        echo '</div>';
    }

    function updateComentario($idn,$texto){
        $link=$this->DB->conectar();
        $this->GN->updateComentario($link,$idn,$texto);
        $this->DB->desconectar($link);
    }

    function borrarComentario($idc){
        $link=$this->DB->conectar();
        $this->GN->borrarComentario($link,$idc);
        $this->DB->desconectar($link);
    }

    function buscar($query){
        $link=$this->DB->conectar();
        $noticias=$this->GN->buscar($link,$query);
        $this->DB->desconectar($link);
        $autobox=new Buscador($noticias);
        $autobox->mostrar($query);
    }
}
?>