<?php

class Noticia{
    public $noticia;

    function Noticia($noticia){
        $this->noticia =$noticia;
    }

    function mostrar_comentarios($u){

        
        echo '<div id="continer-comentarios">';

        if(!isset($u['nick'])){
            echo '<section class="lcomen-n" id="lista-comentarios">';
        }else{
            echo '<section class="lcomen" id="lista-comentarios">';
        }
        echo '
                    <header id="cabecera-comentarios">
                        <h3>Comentarios</h3>
                        <ul><div class="adaptar-img anim-g" id="cerrar-comentarios"></div></ul> 
                        <div class="clear"></div>
                    </header>
                    <ul id="comentarios">';
                    for($i=0;$i<count($this->noticia['comentarios']);$i++){
                        $f=new Fecha($this->noticia['comentarios'][$i]['fecha']);
                        echo '<li class="comentario">
                                <header class="cabecera">
                                    <p class="autor">'.$this->noticia['comentarios'][$i]['idUsuario'].'</p>
                                    <p class="fecha">'.$f->getDia().'/'.$f->getMes().'/'.$f->getAnio().' '.$f->getHoras().':'.$f->getMinutos().'</p>
                                    <div class="clear"></div>
                                </header>
                                <div class="cuerpo">
                                    <p>'.$this->noticia['comentarios'][$i]['texto'].'</p>
                                </div>
                             </li>';
                    }
                echo '</ul>
                </section>';
            if(isset($u['nick'])){
             echo '<section id="zona-formulario-comentarios">
                    <form method="post" action="index.php?action=add_com" id="form-com">
                        <input type="hidden" id="idn" name="idn" value="'.$this->noticia['id'].'">
                        <input type="hidden" id="uname" name="uname" value="'.$u['nick'].'">
                        <div class="linea">
                            <div class="cubre-input">
                                <input required type="text" placeholder="email" id="email_c" name="email_c">
                            </div>
                        </div>
                        <textarea required id="texto_c" name="texto_c" placeholder="deja tu comentario"></textarea>
                        <input type="submit" class="anim-g" value="enviar" class="boton-formulario">
                    </form>
                </section>';
            }
           echo ' </div>';
    }

    function mostrar_relacionadas(){
        echo '<div id="relacionadas-continer">
                <div id="cabecera-relacionadas">
                        <h2 id="titulo-relacionadas">Te puede interesar</h2>
                        <div id="line-relacionadas"></div>
                        <div class="clear"></div>
                </div>
                <div class="cubre-secciones">
                    <div class="cuerpo">';
        $relacionadas = $this->noticia['relacionadas'];
        for($i=0;$i<count($relacionadas);$i++){
            $f=new Fecha($relacionadas[$i]['fecha']);
            echo '<a href="index.php?id='.$relacionadas[$i]['id'].'"><div class="c5 left">
                        <div class="n1 noticia anim-g">';
                        if(!empty($relacionadas[$i]['imagenes'])){
                            echo '<figure>
                                <img src="'.$relacionadas[$i]['imagenes'][0]['url'].'">
                            </figure>';
                        }
                        echo '
                            <div class="descripcion">
                                <h3>'.$relacionadas[$i]['titularSimple'].'</h3>
                            </div>
                            <footer class="pie">
                                <p class="autor">'.substr($relacionadas[$i]['autor'],0,10).'</p>
                                <p class="fecha">'.$f->getDia().'/'.$f->getMes().'/'.$f->getAnio().' '.$f->getHoras().':'.$f->getMinutos().'</p>
                            </footer>
                        </div>
                    </div></a>';
        }
        echo '          <div class="clear"></div>
                    </div>
                </div>
              </div>';
    }

    function mostrar($u){
        $this->mostrar_comentarios($u);
        $noticia=$this->noticia;
        $f=new Fecha($noticia['fecha']);
        echo '<div id="cubre-noticia">
            <article id="noticia-continer">';
            if(!empty($noticia['imagenes'])){
                echo '
                <figure class="imagen">
                    <img src="'.$noticia['imagenes'][0]['url'].'" />
                    <figcaption>'.$noticia['imagenes'][0]['pie'].'</figcaption>
                </figure>
                ';
            }
            echo '
                <h2>'.$noticia['titularCompleto'].'</h2>
                <p class="entradilla">'.$noticia['descripcion'].'</p>
                '.$noticia['cuerpo'].'
            </article>
            <footer class="pie">
                <ul id="menu-noticia">
                    <li class="item-menu anim-g adaptar-img" id="facebook"></li>
                    <li class="item-menu anim-g adaptar-img" id="twitter"></li>
                    <li class="item-menu anim-g adaptar-img" id="google"></li>
                    <a href="index.php?id='.$noticia['id'].'&vi=1"><li class="item-menu anim-g adaptar-img" id="print"></li></a>
                </ul>
                <div id="zona-comentarios">
                    <div class="logo-comentarios anim-g adaptar-img"></div>
                    <p class="ncomentarios">'.count($noticia['comentarios']).'</p>
                </div>
                <div id="autor-fecha">
                    <p class="autor">'.$noticia['autor'].'</p>
                    <p class="fecha">'.$f->getDia().'/'.$f->getMes().'/'.$f->getAnio().' '.$f->getHoras().':'.$f->getMinutos().'</p>
                </div>
                <div class="clear"></div>
            </footer>
            </div>';
        $this->mostrar_relacionadas();
    }

    function mostrarAdminAdd($u,$tipos){
        echo '<div id="cubre-noticia-a">
            <article id="noticia-continer-a">';
        echo '<form id="fn" method="post" action="index.php?action=inoticia">
                <div class="zona-label">
                    <div class="linea-label">
                        <h4>Titular Simple</h4>
                    </div>
                    <div class="linea-label">
                        <h4>Titular Completo</h4>
                    </div>
                    <div class="linea-label">
                        <h4>Entradilla</h4>
                    </div>
                    <div class="linea-label-ta">
                        <h4>Cuerpo</h4>
                    </div>
                    <div class="linea-label">
                        <h4>Tipo de Noticia</h4>
                    </div>
                </div>
                <div class="zona-inputs">
                    <div class="linea">
                        <div class="cinput-m">
                            <input type="text" name="tsimple" id="tsimple" placeholder="titular simple...">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="linea">
                        <div class="cinput-l">
                            <input type="text" name="tcompleto" id="tcompleto" placeholder="titular completo...">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="linea">
                        <div class="cinput-l">
                            <input type="text" name="entradilla" id="entradilla" placeholder="entradilla...">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="linea">
                        
                            <textarea name="textoc" id="textoc" placeholder="cuerpo..."></textarea>
                        
                        <div class="clear"></div>
                    </div>

                    <div class="linea">
                        <div class="cinput-m">
                            <select name="tipno" id="tipno">';
                            for($i=0;$i<count($tipos);$i++){
                                if($i==0){
                                    echo '<option selected value="'.$tipos[$i]['valor'].'">'.$tipos[$i]['nombre'].'</option>';
                                }else{
                                    echo '<option value="'.$tipos[$i]['valor'].'">'.$tipos[$i]['nombre'].'</option>';
                                }
                            }
                            echo '</select>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="sfn">
                    <header class="hfn">Etiquetas</header>
                    <input type="hidden" value="" id="etiquetas" name="etiquetas">
                    <div class="lineafn bb">
                        <div class="cifn">
                            <input type="text" name="etiquetasf" id="etiquetasf" placeholder="etiquetas...">
                        </div>
                        <figure class="boton-fn add anim-g adaptar-img" id="betiquetas"></figure>
                    </div>
                    <div class="cubre-etiquetas" id="ceti">
                    ';
                    echo '<div class="clear"></div>
                    </div>
                </div>
                <div class="sfn" id="sima">
                    <header class="hfn">Imagenes</header>
                    ';
                    
                    echo '<input type="hidden" id="imagenes" name="imagenes" value="">
                    <div class="lineafn">

                        <div class="cifn">
                            <input type="text" name="imagenf" id="imagenf" placeholder="imagen...">
                        </div>
                        <figure id="boton-imagenes" class="boton-fn add anim-g adaptar-img"></figure>
                    </div>
                </div>
                <div class="sfn" id="svideo">
                    <header class="hfn">Videos</header>
                    ';
                    
                    echo '<input type="hidden" id="videos" name="videos" value="">
                    <div class="lineafn">
                        <div class="cifn">
                            <input type="text" name="videof" id="videof" placeholder="video...">
                        </div>
                        <figure id="boton-videos" class="boton-fn add anim-g adaptar-img"></figure>
                    </div>
                </div>
                <input class="anim-g" type="submit" value="insertar">
                <div class="clear"></div>
        </form>';
        echo '</article>
            </div>';
        
    }

    function mostrarAdmin($u,$tipos){
        
        $noticia=$this->noticia;
        echo '<div id="cubre-noticia-a">
            <article id="noticia-continer-a">';
        echo '<form id="fn" method="post" action="index.php?action=mnoticia&id='.$noticia['id'].'">
                <div class="zona-label">
                    <div class="linea-label">
                        <h4>Estado</h4>
                    </div>
                    <div class="linea-label">
                        <h4>Titular Simple</h4>
                    </div>
                    <div class="linea-label">
                        <h4>Titular Completo</h4>
                    </div>
                    <div class="linea-label">
                        <h4>Entradilla</h4>
                    </div>
                    <div class="linea-label-ta">
                        <h4>Cuerpo</h4>
                    </div>
                    <div class="linea-label">
                        <h4>Tipo de Noticia</h4>
                    </div>
                </div>
                <div class="zona-inputs">
                    <div class="linea">
                        <div class="cinput-m">
                            <input type="text" disabled name="estado" id="estado" placeholder="titular simple" value="'.str_replace('"','&#39;',$noticia['estado']).'">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="linea">
                        <div class="cinput-m">
                            <input type="text" name="tsimple" id="tsimple" placeholder="titular simple" value="'.str_replace('"','&#39;',$noticia['titularSimple']).'">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="linea">
                        <div class="cinput-l">
                            <input type="text" name="tcompleto" id="tcompleto" placeholder="titular completo" value="'.str_replace('"','&#39;',$noticia['titularCompleto']).'">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="linea">
                        <div class="cinput-l">
                            <input type="text" name="entradilla" id="entradilla" placeholder="entradilla..." value="'.$noticia['descripcion'].'">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="linea">
                        
                            <textarea name="textoc" id="textoc" placeholder="cuerpo...">'.$noticia['cuerpo'].'</textarea>
                        
                        <div class="clear"></div>
                    </div>

                    <div class="linea">
                        <div class="cinput-m">
                            <select name="tipno" id="tipno">';
                            for($i=0;$i<count($tipos);$i++){
                                if($noticia['tipo']==$tipos[$i]['valor']){
                                    echo '<option selected value="'.$tipos[$i]['valor'].'">'.$tipos[$i]['nombre'].'</option>';
                                }else{
                                    echo '<option value="'.$tipos[$i]['valor'].'">'.$tipos[$i]['nombre'].'</option>';
                                }
                            }
                            echo '</select>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="sfn">
                    <header class="hfn">Etiquetas</header>
                    <input type="hidden" value="'.$noticia['etiquetas'].'" id="etiquetas" name="etiquetas">
                    <div class="lineafn bb">
                        <div class="cifn">
                            <input type="text" name="etiquetasf" id="etiquetasf" placeholder="etiquetas...">
                        </div>
                        <figure class="boton-fn add anim-g adaptar-img" id="betiquetas"></figure>
                    </div>
                    <div class="cubre-etiquetas" id="ceti">
                    ';
                    $etiquetas=explode(',',$noticia['etiquetas']);
                    for($i=0;$i<count($etiquetas)-1;$i++){
                        $etiquetas[$i]=trim($etiquetas[$i]);
                        echo '<div class="etiqueta">
                                <p>'.$etiquetas[$i].'</p>
                                <figure class="close close-etiqueta anim-g adaptar-img"></figure>
                              </div>';
                    }
                    echo '<div class="clear"></div>
                    </div>
                </div>
                <div class="sfn" id="sima">
                    <header class="hfn">Imagenes</header>
                    ';
                    for($i=0;$i<count($noticia['imagenes']);$i++){
                        echo '<div class="lineanfn bb">
                            <div class="cifn fill-c linea-imagen">
                                <input type="text" disabled name="imagenf'.$i.'" id="imagenf'.$i.'" placeholder="imagen..." value="'.$noticia['imagenes'][$i]['url'].'">
                            </div>
                            <figure class="close close-imagen anim-g adaptar-img"></figure>
                        </div>';
                    }
                    echo '<input type="hidden" id="imagenes" name="imagenes" value="';for($i=0;$i<count($noticia['imagenes']);$i++){echo $noticia['imagenes'][$i]['url'].',';} echo '">
                    <div class="lineafn">

                        <div class="cifn">
                            <input type="text" name="imagenf" id="imagenf" placeholder="imagen...">
                        </div>
                        <figure id="boton-imagenes" class="boton-fn add anim-g adaptar-img"></figure>
                    </div>
                </div>
                <div class="sfn" id="svideo">
                    <header class="hfn">Videos</header>
                    ';
                    for($i=0;$i<count($noticia['videos']);$i++){
                        echo '<div class="lineanfn bb">
                            <div class="cifn fill-c linea-video">
                                <input type="text" disabled name="videof'.$i.'" id="video'.$i.'" placeholder="video..." value="'.$noticia['videos'][$i]['url'].'">
                            </div>
                            <figure class="close close-video anim-g adaptar-img"></figure>
                        </div>';
                    }
                    echo '<input type="hidden" id="videos" name="videos" value="';for($i=0;$i<count($noticia['videos']);$i++){echo $noticia['videos'][$i]['url'].',';} echo '">
                    <div class="lineafn">
                        <div class="cifn">
                            <input type="text" name="videof" id="videof" placeholder="video...">
                        </div>
                        <figure id="boton-videos" class="boton-fn add anim-g adaptar-img"></figure>
                    </div>
                </div>
                <input class="anim-g" type="submit" value="modificar">
                <a href="index.php?action=comentarios&idn='.$noticia['id'].'"><div class="cboton-not">
                    <div class="bt-g2 anim-g">comentarios</div>
                </div></a>';
                if($noticia['estado']!='publicado' && $u['puesto']=='redactorJefe'){
                    echo '
                        <a href="index.php?action=pub&idn='.$noticia['id'].'"<div class="cboton-not">
                            <div class="bt-g2 anim-g">publicar</div>
                        </div></a>
                    ';

                }
        echo '<div class="clear"></div></form>';
        echo '</article>
            </div>';
        
    }

    function mostrarImpresion(){
        $noticia=$this->noticia;
        $f=new Fecha($noticia['fecha']);
        echo '
        <div id="wimp">
            <h1 id="logo"></h1>';
            if(!empty($noticia['imagenes'])){
                echo '
            <figure>
                <img src="'.$noticia['imagenes'][0]['url'].'" />
                <figcaption>'.$noticia['imagenes'][0]['pie'].'</figcaption>
            </figure>
            ';
            }
        echo '
            <h2 id="titulo">'.$noticia['titularCompleto'].'</h2>
            <div class="cubre-noticia">
            <p class="entradilla">'.$noticia['descripcion'].'</p>
            '.$noticia['cuerpo'].'
            </div>
            <div id="pie-impresion">
                <p class="autor">'.$noticia['autor'].'</p>
                <p class="fecha">'.$f->getDia().'/'.$f->getMes().'/'.$f->getAnio().' '.$f->getHoras().':'.$f->getMinutos().'</p>
            </div>
        </div>
        ';
    }

    
}

?>