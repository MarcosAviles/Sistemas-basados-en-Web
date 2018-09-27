<?php
class Comentarios{
    public $comentarios;

    function Comentarios($datos){
        $this->comentarios=$datos;
    }

    function mostrar($id){
        $comentarios=$this->comentarios;
        echo '
        <section data="'.$id.'" id="continer-comentarios-ad">
                <div id="scroller-anuncios">
            ';
        echo '<div class="cubre-new-s">
            <div class="anuncio-form" id="cfom">
                            <form method="post" action="index.php?action=add_com">
                                <div class="zona-label-com">
                                    <div class="linea-label-org">Nick</div>
                                    <div class="linea-label-org">Email</div>
                                    <div class="linea-label-org">Texto</div>
                                    <div class="mb10"></div>
                                    <input type="submit" value="añadir" class="bt-g20 anim-g">
                                </div>
                                <div class="zona-input">
                                    <input type="hidden" name="idn" value="'.$id.'">
                                    <div class="linea-input">
                                        <div class="cubre-input-org">
                                            <input type="text" placeholder="nick..." name="nick">
                                        </div>
                                    </div>
                                    <div class="linea-input">
                                        <div class="cubre-input-org">
                                            <input type="text" placeholder="email..." name="email">
                                        </div>
                                    </div>
                                    <div class="linea-texto-input">
                                        <div class="cubre-texto-org">
                                            <textarea class="text-org" name="texto_com" id="texto_com" placeholder="texto.."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="clear"></div>
                        </div>
                        </div>
                        <ul id="sa1">
            ';
        for($i=0;$i<count($comentarios);$i++){
            $comentario=$comentarios[$i];
            echo '
            
            <li class="anuncio-form">
                             <form method="post" action="index.php?action=update_com">
                                <div class="zona-label-com">
                                    <div class="linea-label-org">Nick</div>
                                    <div class="linea-label-org">Email</div>
                                    <div class="linea-label-org">Texto</div>
                                    <div class="mb10"></div>
                                    <input type="submit" value="modificar" class="bt-g20 anim-g">
                                </div>
                                <div class="zona-input">
                                    <input type="hidden" name="idc" value="'.$comentario['id'].'">
                                    <input type="hidden" name="idn" value="'.$id.'">
                                    <div class="linea-input">
                                        <div class="cubre-input-org">
                                            <input type="text" disabled placeholder="nick..." name="nick" value="'.$comentario['idUsuario'].'">
                                        </div>
                                    </div>
                                    <div class="linea-input">
                                        <div class="cubre-input-org">
                                            <input type="text" disabled placeholder="email..." name="email" value="'.$comentario['email'].'">
                                        </div>
                                    </div>
                                    <div class="linea-texto-input">
                                        <div class="cubre-texto-org">
                                            <textarea class="text-org" name="texto_com" id="texto_com" placeholder="texto..">'.$comentario['texto'].'</textarea>
                                        </div>
                                    </div>
                                </div>
                                <a href="index.php?action=erase_com&idc='.$comentario['id'].'&idn='.$comentario['idNoticia'].'"><figure class="adaptar-img anim-g anunclose"></figure></a>
                            </form>
                            <div class="clear"></div>
                        </li>
            ';
        }
        echo '</ul>
                    </div>
            </section>
        ';
    }
}
?>