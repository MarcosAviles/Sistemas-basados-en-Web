<?php
class Categorias{
    public $categorias;
    
    function Categorias($datos){
        $this->categorias=$datos;
    }

    function mostrar(){
        $categorias=$this->categorias;
        $strCat='';
        $strScat='';
        for($i=0;$i<count($categorias);$i++){
            $strCat.=$categorias[$i]['nombre'].',';
            for($j=0;$j<count($categorias[$i]['subcategorias']);$j++){
                $strScat.=$categorias[$i]['nombre'].'_'.$categorias[$i]['subcategorias'][$j]['nombre'].',';
            }
        }
        echo '
            <form method="post" action="index.php?action=update_cat">
                <input type="hidden" name="categorias" id="i-categorias" value="'.$strCat.'">
                <input type="hidden" name="subcategorias" id="i-subcategorias" value="'.$strScat.'">
                <input type="submit" id="boton-submit-categorias" class="anim-g" value="actualizar categorias">
            </form>
            <section id="continer-categorias">
        ';
        for($i=0;$i<count($categorias);$i++){
            $categoria=$categorias[$i];
            echo '
                <div class="cubre-categoria">
                    <div class="lineanfn bb linea-categoria anim-g">
                        <div class="cifn-c fill-cc ccat">
                            '.$categoria['nombre'].'
                        </div>
                        <figure class="close close-cat anim-g adaptar-img"></figure>
                    </div>
                    <ul class="continer-subcategorias anim-g">';
                        for($j=0;$j<count($categoria['subcategorias']);$j++){
                            $subcat=$categoria['subcategorias'][$j];
                            echo '
                                <div class="lineanfn bb1 linea-subcategoria anim-g">
                                    <div class="cifn-c fill-cc csub">
                                        '.$subcat['nombre'].'
                                    </div>
                                    <figure class="close close-subcat anim-g adaptar-img"></figure>
                                </div>
                            ';
                        }
                        echo '
                            <div class="lineafn bb">
                                <div class="cifn">
                                    <input type="text" name="subcategoriaf" id="subcategoriaf" placeholder="subcategoria...">
                                </div>
                                <figure class="boton-subcategorias boton-fn add anim-g adaptar-img"></figure>
                            </div>
                        ';
                        
            echo   '</ul>
                </div>
            ';
        }

        echo '
                <div class="lineafn" id="catf">

                    <div class="cifn">
                        <input type="text" name="categoriaf" id="categoriaf" placeholder="categoria...">
                    </div>
                    <figure id="boton-categorias" class="boton-fn add anim-g adaptar-img"></figure>
                </div>
            </section>
        ';
    }
}
?>