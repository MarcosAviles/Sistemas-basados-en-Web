<?php
class Header{
    public $menu;
    function Header($menu){
        $this->menu=$menu;
    }

    function mostrar($c){
        echo '
        <header id="cabecera">
            <a href="index.php"><figure id="logo"></figure></a>
            <p class="lema">las mismas noticias de siempre<br/>pero con clase</p>
            <ul id="menu-g">
                <li class="item-menu anim-g adaptar-img" id="mobile"></li>';
                if(!isset($_SESSION['usuario'])){
                    echo '<li class="item-menu anim-g adaptar-img" id="cuenta"></li>';
                }else{
                    echo '<a href="index.php?action=out"><li class="item-menu anim-g adaptar-img" id="out"></li></a>';
                }
                echo '<li class="item-menu anim-g adaptar-img" id="lupa"></li>
            </ul>
            <div id="cubre-buscador" class="anim-g">
                <input type="search" id="buscar" placeholder="buscar...">
            </div>
            <div id="cubierta-seccion-header">
                <ul id="menu">';
        $menu=$this->menu;
        for($i=0;$i<count($menu);$i++){
            if($menu[$i]['valor']==$c){
                echo '<a href="index.php?cat='.$menu[$i]['valor'].'"><li class="item-menu-activo">'.$menu[$i]['nombre'].'</li></a>';
            }else{
                echo '<a href="index.php?cat='.$menu[$i]['valor'].'"><li class="item-menu">'.$menu[$i]['nombre'].'</li></a>';
            }
        }
        echo '
                </ul>
            </div>
        </header>
        <div id="autobox" class="anim-g"></div>
        ';
    }

    function mostrarAdmin($c,$tr){
        echo '
        <header id="cabecera">
            <a href="index.php"><figure id="logo"></figure></a>
            <p class="lema">las mismas noticias de siempre<br/>pero con clase</p>
            <ul id="menu-g">
                <li class="item-menu anim-g adaptar-img" id="mobile"></li>
                <a href="index.php?action=out"><li class="item-menu anim-g adaptar-img" id="out"></li></a>
                <li class="item-menu anim-g adaptar-img" id="lupa"></li>
            </ul>
            <div id="cubierta-seccion-header">
                <ul id="menu">';
        $menu=$this->menu;
        for($i=0;$i<count($menu);$i++){
            if((($tr['puesto']=='redactor' || $tr['puesto']=='colaborador') &&  $menu[$i]['valor']=='noticias') || $tr['puesto']=='redactorJefe'){
                echo '<div class="cubre-menu">';
                if($menu[$i]['valor']==$c){
                    echo '<a href="index.php?action='.$menu[$i]['valor'].'"><li class="item-menu-activo">'.$menu[$i]['nombre'].'</li></a>';
                }else{
                    echo '<a href="index.php?action='.$menu[$i]['valor'].'"><li class="item-menu">'.$menu[$i]['nombre'].'</li></a>';
                }
                if($menu[$i]['valor']==$c){
                echo '<ul id="hm'.$menu[$i]['valor'].'">
                        ';
                }else{
                    echo '<ul class="hidden-menu" id="hm'.$menu[$i]['valor'].'">
                        ';
                }
                        for($j=0;$j<count($menu[$i]['subcat']);$j++){
                            if($tr['puesto']=='redactor' || $tr['puesto']=='colaborador'){
                                if($menu[$i]['subcat'][$j]['valor']==$tr['seccion']){
                                    echo '<a href="index.php?action='.$menu[$i]['valor'].'&saction='.$menu[$i]['subcat'][$j]['valor'].'"><li class="item-submenu">'.$menu[$i]['subcat'][$j]['nombre'].'</li></a>';
                                }
                            }else{
                                echo '<a href="index.php?action='.$menu[$i]['valor'].'&saction='.$menu[$i]['subcat'][$j]['valor'].'"><li class="item-submenu">'.$menu[$i]['subcat'][$j]['nombre'].'</li></a>';
                            }
                        }

                echo '</ul>';
                echo '</div>';
            }
        }
        echo '
                </ul>
            </div>
        </header>
        ';
    }
}
?>