<?php
class Organizador{
    public $organizacion;
    function Organizador($org){
        $this->organizacion=$org;
    }

    function c23($elemento){
        echo '<div orden="'.$elemento['orden'].'"  tipo="'.$elemento['tipo'].'"  class="sp anim-g">
                <div class="close adaptar-img mb10"></div><div class="clear"></div>
                <header class="cabecera-plantilla">
                    <figure class="anim-g setting-plantilla"></figure>
                </header>';
                $columna=$elemento['columnas'][0];
                $columna1=$elemento['columnas'][1];
                echo '
                <div orden="'.$columna['orden'].'" tipo="'.$columna['tipo'].'" numero="'.$columna['nDivisiones'].'" class="c'.$elemento['tipo'].' bs bps anim-g">
                    <header class="cabecera-plantilla">
                        <figure class="anim-g setting-plantilla"></figure>
                    </header>
                </div>
                <div orden="'.$columna1['orden'].'" tipo="'.$columna1['tipo'].'" numero="'.$columna1['nDivisiones'].'" class="c3 bs bps anim-g">
                    <header class="cabecera-plantilla">
                        <figure class="anim-g setting-plantilla"></figure>
                    </header>';
                    if($columna1['nDivisiones']>1){
                        for($i=0;$i<count($columna1['divisiones']);$i++){
                            $division=$columna1['divisiones'][$i];
                            if($i==($columna1['nDivisiones']-1)){
                                echo '<div tipo="'.$division['tipo'].'" class="n'.$columna1['nDivisiones'].' bin inte"></div>';
                            }else{
                                echo '<div tipo="'.$division['tipo'].'" class="n'.$columna1['nDivisiones'].' bin mb10 inte"></div>';
                            }
                        }
                    }
          echo '</div>';
          echo '<div class="clear"></div>
            </div>';
    }



    function cGeneral($elemento){
        echo '<div orden="'.$elemento['orden'].'"  tipo="'.$elemento['tipo'].'"  class="sp anim-g">
                <div class="close adaptar-img mb10"></div><div class="clear"></div>
                <header class="cabecera-plantilla">
                    <figure class="anim-g setting-plantilla"></figure>
                </header>';
                for($i=0;$i<$elemento['ncolumnas'];$i++){
                    $columna=$elemento['columnas'][$i];
                    echo '<div orden="'.$columna['orden'].'"  tipo="'.$columna['tipo'].'" numero="'.$columna['nDivisiones'].'" class="c'.$elemento['tipo'].' bs bps anim-g">
                        <header class="cabecera-plantilla">
                            <figure class="anim-g setting-plantilla"></figure>
                        </header>';
                        if($columna['nDivisiones']>1){
                            for($j=0;$j<count($columna['divisiones']);$j++){
                                $division=$columna['divisiones'][$j];
                                if($j==($columna['nDivisiones']-1)){
                                    echo '<div tipo="'.$division['tipo'].'" class="n'.$columna['nDivisiones'].' bin inte"></div>';
                                }else{
                                    echo '<div tipo="'.$division['tipo'].'" class="n'.$columna['nDivisiones'].' bin mb10 inte"></div>';
                                }
                            }
                        }
                    echo '</div>';
                }
                echo '<div class="clear"></div>
            </div>';
    }

    function c1($elemento){
        $columna=$elemento['columnas'][0];
        echo '<div orden="'.$elemento['orden'].'" tipo="'.$elemento['tipo'].'" class="sp anim-g">
                <div class="close adaptar-img  mb10"></div><div class="clear"></div>
                <header class="cabecera-plantilla">
                    <figure class="anim-g setting-plantilla"></figure>
                </header>
                <div tipo="'.$columna['tipo'].'" numero="'.$columna['nDivisiones'].'" class="c1 bs bps anim-g">
                        <header class="cabecera-plantilla">
                            <figure class="anim-g setting-plantilla"></figure>
                        </header>
                    </div>
                <div class="clear"></div>
            </div>';
    }

    function mostrarSeccion($elemento){
        $tipo=$elemento['tipo'];
        if($tipo==23){
            $this->c23($elemento);
        }
        if($tipo==1){
            $this->c1($elemento);
        }
        if($tipo>1 && $tipo!=23){
            $this->cGeneral($elemento);
        }
    }

    function mostrar($c){
        $org=$this->organizacion;
        echo '<div id="plantilla">
                <div id="cubre-tipo-plantilla">
                    <select name="tipoplantilla" id="tipoplantilla">';
                    if($c=='portada'){
                        echo '<option value="portada" selected>Portada</option>';
                        echo '<option value="seccion">Seccion</option>';
                    }else{
                        echo '<option value="portada">Portada</option>';
                        echo '<option value="seccion" selected>Seccion</option>';
                    }
                    echo '</select>
                </div>
                <div id="continer-plantilla" class="anim-g">';
                for($i=0;$i<count($org);$i++){
                    echo '<div orden="'.$i.'" cabecera="'.$org[$i]['cabecera'].'" nombre="'.$org[$i]['nombre'].'" class="cat-plantilla">
                            <div class="close adaptar-img mb10"></div><div class="clear"></div>
                            <header class="cabecera-plantilla">
                                <figure class="anim-g setting-plantilla"></figure>
                            </header>';
                            for($j=0;$j<count($org[$i]['elementos']);$j++){
                                $elemento=$org[$i]['elementos'][$j];
                                $this->mostrarSeccion($elemento);

                            }
                    echo '</div>';
                }
          echo '</div>
            </div>
            <div id="controles-plantilla">
                <section class="seccion-controles-plantilla">
                    <header id="colu" class="cabecera-controles-plantilla">Columnas</header>
                    <ul>
                        <li class="item-columnas mrc" draggable="true" id="c23">
                            <figure class="icontenedor-d"></figure>
                            <figure class="icontenedor-i"></figure>
                            
                        </li>
                        <li class="item-columnas" draggable="true" id="c2">
                            <figure class="icontenedor-i"></figure>
                            <figure class="icontenedor-i"></figure>
                        </li>
                        <li class="item-columnas mrc" draggable="true" id="c3">
                            <figure class="icontenedor-i"></figure>
                            <p class="tcon ml">x3</p>
                        </li>
                        <li class="item-columnas" draggable="true" id="c4">
                            <figure class="icontenedor-i"></figure>
                            <p class="tcon ml">x4</p>
                        </li>
                        <li class="item-columnas mrc" draggable="true" id="c5">
                            <figure class="icontenedor-i"></figure>
                            <p class="tcon ml">x5</p>
                        </li>
                        <li class="item-columnas" draggable="true" id="c6">
                            <figure class="icontenedor-i"></figure>
                            <p class="tcon ml">x6</p>
                        </li>
                        <li class="item-columnas mrc" draggable="true" id="c1">
                            <figure class="icontenedor-c"></figure>
                        </li>
                        <li class="clear"></li>
                    </li>
                </section>
                <section class="seccion-controles-plantilla">
                    <header id="con" class="cabecera-controles-plantilla">Contenedores</header>
                    <ul>
                        <li class="contenedor" draggable="true" id="categoria-boton">
                            <figure class="icontenedor"></figure>
                            <p class="tcon">categoria</p>
                        </li>
                    </ul>
                </section>
                <section class="seccion-controles-plantilla hide">
                    <header id="set" class="cabecera-controles-plantilla">Settings</header>

                    <div class="continer-settings" id="csettings">
                        
                    </div>
                </section>

                <div id="boton-submit-plantilla" class="anim-g">
                    actualizar
                </div>
            </div>  ';
    }
}
?>