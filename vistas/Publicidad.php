<?php
class Publicidad{
    public $anuncios;

    function Publicidad($datos){
        $this->anuncios=$datos;
    }

    function mostrar(){
        $anuncios=$this->anuncios;
        echo '
        <section id="continer-anuncios">
                <div id="scroller-anuncios">
            ';
        echo '<div class="cubre-new">
            <div class="anuncio-form" id="afom">
                            <form method="post" action="index.php?action=add_ad">
                                <div class="zona-label">
                                    <div class="linea-label-org">Imagen</div>
                                    <div class="linea-label-org">Enlace</div>
                                    <div class="linea-label-org">Tipo</div>
                                    <div class="mb10"></div>
                                    <input type="submit" value="añadir" class="bt-g12 anim-g">
                                </div>
                                <div class="zona-input">
                                    <div class="linea-input">
                                        <div class="cubre-input-org">
                                            <input type="text" placeholder="imagen..." id="img" name="img">
                                        </div>
                                    </div>
                                    <div class="linea-input">
                                        <div class="cubre-input-org">
                                            <input type="text" placeholder="enlace..." name="enlace">
                                        </div>
                                    </div>
                                    <div class="linea-input">
                                        <div class="cubre-input-org">
                                            <select name="tipo">
                                        
                                                <option selected value="horizontal" selected>Horizontal</option>
                                                <option selected value="cuadrado">Cuadrado</option>
                                    
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="clear"></div>
                        </div>
                        </div>
                        <ul id="sa">
            ';
        for($i=0;$i<count($anuncios);$i++){
            $anuncio=$anuncios[$i];
            echo '
            
            <li class="anuncio-form">
                            <form method="post" action="index.php?action=update_ad">
                                <div class="zona-label">
                                    <div class="linea-label-org">Imagen</div>
                                    <div class="linea-label-org">Tipo</div>
                                    <div class="mb10"></div>
                                    <input type="submit" value="guardar" class="bt-g12 anim-g">
                                </div>
                                <div class="zona-input">
                                    <div class="linea-input">
                                        <div class="cubre-input-org">
                                            <input type="text" placeholder="imagen..." id="im'.$i.'" name="img" value="'.$anuncio['imagen'].'">
                                        </div>
                                    </div>
                                   
                                            <input type="hidden" placeholder="enlace..." name="enlace" value="'.$anuncio['link'].'">
                                       
                                    <div class="linea-input">
                                        <div class="cubre-input-org">
                                            <select name="tipo">';
                                            if($anuncio['tipo']=='horizontal'){
                                                echo '
                                                <option value="horizontal" selected>Horizontal</option>
                                                <option value="cuadrado">Cuadrado</option>
                                                ';
                                            }else{
                                                echo '
                                                <option value="horizontal">Horizontal</option>
                                                <option selected value="cuadrado">Cuadrado</option>
                                                ';
                                            }
                                                
                                            echo '
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <a href="index.php?action=erase_ad&enlace='.$anuncio['link'].'"><figure class="adaptar-img anim-g anunclose"></figure></a>
                            </form>
                            <div class="clear"></div>
                        </li>
            ';
        }
        echo '</ul>
                    </div>
            </section>
            <section id="continer-plantillas"></section>
        ';
    }
}
?>