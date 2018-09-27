<?php

class Portada{
    public $componentes;
    public $noticias;
    public $galerias;
    public $opiniones;

    function Portada($componentes,$noticias,$galerias,$opiniones){
        $this->componentes=$componentes;
        $this->noticias =$noticias;
        $this->galerias = $galerias;
        $this->opiniones = $opiniones;
    }

    function mostrar_6(){

    }

    function mostrar_5($tipoC,$nc,$columnas,$i,$cat){
        for($k=0;$k<$nc;$k++){

            echo '<div class="c'.$tipoC.' left">';
            if($columnas[$k]['nDivisiones']==1){
                if($columnas[$k]['tipo']=='anuncio'){
                    if(count($this->noticias['anunciosV'])>1){
                        $anuncio = array_shift($this->noticias['anunciosV']);
                        echo '<a href="'.$anuncio['link'].'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g"><img src="'.$anuncio['imagen'].'" /></div></a>';
                    }else{
                        if(count($this->noticias['anunciosV'])>0){
                            $anuncio = $this->noticias['anunciosV'][0];
                            echo '<a href="'.$anuncio['link'].'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g"><img src="'.$anuncio['imagen'].'" /></div></a>';
                        }
                    }
                }
                if($columnas[$k]['tipo']=='galeria'){
                    if(count($this->galerias[$i])>0){
                        $galeria = array_shift($this->galerias[$i]);
                    }
                }
                if($columnas[$k]['tipo']=='opinion'){
                    if(count($this->opiniones[$i])>0){
                        $opiniones = array_shift($this->opiniones[$i]);
                    }
                }
                if($columnas[$k]['tipo']=='noticia'){
                    if(count($this->noticias[$i])>0){
                        $noticia = array_shift($this->noticias[$i]);
                        $f=new Fecha($noticia['fecha']);
                            echo '<a href="index.php?id='.$noticia['id'].'&cat='.$cat.'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g">';
                        if(!empty($noticia['imagenes'])){
                        echo '<figure>';
                            echo '<img src="'.$noticia['imagenes'][0]['url'].'" />';
                        echo '</figure>';
                        }
                        echo '<div class="descripcion">';
                            echo '<h3>'.$noticia['titularSimple'].'</h3>';
                            echo '</div>';
                        echo '<footer class="pie">';
                                echo '<p class="autor">'.substr($noticia['autor'],0,10).'</p>';
                                echo '<p class="fecha">'.$f->getDia().'/'.$f->getMes().'/'.$f->getAnio().' '.$f->getHoras().':'.$f->getMinutos().'</p>';
                        echo '</footer>';
                            echo '</div></a>';
                    }
                }
                
            }else{
                for($l=0;$l<$columnas[$k]['nDivisiones'];$l++){
                    if($columnas[$k]['divisiones'][$l]['tipo']=='anuncio'){
                        if(count($this->noticias['anunciosH'])>1){
                            $anuncio = array_shift($this->noticias['anunciosH']);
                            echo '<a href="'.$anuncio['link'].'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g"><img src="'.$anuncio['imagen'].'" /></div></a>';
                        }else{
                            if(count($this->noticias['anunciosH'])>0){
                                $anuncio = $this->noticias['anunciosH'][0];
                                echo '<a href="'.$anuncio['link'].'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g"><img src="'.$anuncio['imagen'].'" /></div></a>';
                            }
                        }
                    }
                    if($columnas[$k]['divisiones'][$l]['tipo']=='galeria'){
                        if(count($this->galerias[$i])>0){
                            $galeria = array_shift($this->galerias[$i]);
                        }
                    }
                    if($columnas[$k]['divisiones'][$l]['tipo']=='opinion'){
                        if(count($this->opiniones[$i])>0){
                            $opiniones = array_shift($this->opiniones[$i]);
                        }
                    }
                    if($columnas[$k]['divisiones'][$l]['tipo']=='noticia'){
                        if(count($this->noticias[$i])>0){
                            $noticia = array_shift($this->noticias[$i]);
                            $f=new Fecha($noticia['fecha']);
                            if($l==($columnas[$k]['nDivisiones']-1)){
                                echo '<a href="index.php?id='.$noticia['id'].'&cat='.$cat.'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g">';
                            }else{
                                echo '<a href="index.php?id='.$noticia['id'].'&cat='.$cat.'"><div class="n'.$columnas[$k]['nDivisiones'].' mbni noticia anim-g">';
                            }
                            echo '<div class="descripcion">';
                                echo '<h3>'.$noticia['titularSimple'].'</h3>';
                                echo '</div>';
                            echo '<footer class="pie">';
                                    echo '<p class="autor">'.substr($noticia['autor'],0,10).'</p>';
                                    echo '<p class="fecha">'.$f->getDia().'/'.$f->getMes().'/'.$f->getAnio().' '.$f->getHoras().':'.$f->getMinutos().'</p>';
                            echo '</footer>';
                                echo '</div></a>';
                        }
                    }
                }
            }
            echo '</div>';
        }
    }

    function mostrar_4(){
        for($k=0;$k<$nc && count($this->noticias[$i])>0;$k++){

            echo '<div class="c'.$tipoC.' left">';
            if($columnas[$k]['nDivisiones']==1){
                $noticia = array_shift($this->noticias[$i]);
                $f=new Fecha($noticia['fecha']);
                    echo '<a href="index.php?id='.$noticia['id'].'&cat='.$cat.'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g">';
                if(!empty($noticia['imagenes'])){
                echo '<figure>';
                    echo '<img src="'.$noticia['imagenes'][0]['url'].'" />';
                echo '</figure>';
                }
                echo '<div class="descripcion">';
                    echo '<h3>'.$noticia['titularSimple'].'</h3>';
                    echo '</div>';
                echo '<footer class="pie">';
                        echo '<p class="autor">'.substr($noticia['autor'],0,10).'</p>';
                        echo '<p class="fecha">'.$f->getDia().'/'.$f->getMes().'/'.$f->getAnio().' '.$f->getHoras().':'.$f->getMinutos().'</p>';
                echo '</footer>';
                    echo '</div></a>';
            }else{
                for($l=0;$l<$columnas[$k]['nDivisiones'] && count($this->noticias[$i])>0;$l++){
                    $noticia = array_shift($this->noticias[$i]);
                    $f=new Fecha($noticia['fecha']);
                    if($l==($columnas[$k]['nDivisiones']-1)){
                        echo '<a href="index.php?id='.$noticia['id'].'&cat='.$cat.'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g">';
                    }else{
                        echo '<a href="index.php?id='.$noticia['id'].'&cat='.$cat.'"><div class="n'.$columnas[$k]['nDivisiones'].' mbni noticia anim-g">';
                    }
                    echo '<div class="descripcion">';
                        echo '<h3>'.$noticia['titularSimple'].'</h3>';
                        echo '</div>';
                    echo '<footer class="pie">';
                            echo '<p class="autor">'.substr($noticia['autor'],0,10).'</p>';
                            echo '<p class="fecha">'.$f->getDia().'/'.$f->getMes().'/'.$f->getAnio().' '.$f->getHoras().':'.$f->getMinutos().'</p>';
                    echo '</footer>';
                        echo '</div></a>';
                }
            }
            echo '</div>';
        }
    }

    function mostrar_3($tipoC,$nc,$columnas,$i,$cat){
        for($k=0;$k<$nc;$k++){
            echo '<div class="c'.$tipoC.' left">';
            if($columnas[$k]['nDivisiones']==1){
                if($columnas[$k]['tipo']=='anuncio'){
                    if(count($this->noticias['anunciosV'])>1){
                        $anuncio = array_shift($this->noticias['anunciosV']);
                        echo '<a href="'.$anuncio['link'].'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g"><img src="'.$anuncio['imagen'].'" /></div></a>';
                    }else{
                        if(count($this->noticias['anunciosV'])>0){
                            $anuncio = $this->noticias['anunciosV'][0];
                            echo '<a href="'.$anuncio['link'].'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g"><img src="'.$anuncio['imagen'].'" /></div></a>';
                        }
                    }
                }
                if($columnas[$k]['tipo']=='galeria'){
                    if(count($this->galerias[$i])>0){
                        $galeria = array_shift($this->galerias[$i]);
                    }
                }
                if($columnas[$k]['tipo']=='opinion'){
                    if(count($this->opiniones[$i])>0){
                        $opiniones = array_shift($this->opiniones[$i]);
                    }
                }
                if($columnas[$k]['tipo']=='noticia'){
                    if(count($this->noticias[$i])>0){
                        $noticia = array_shift($this->noticias[$i]);
                        $f=new Fecha($noticia['fecha']);
                            echo '<a href="index.php?id='.$noticia['id'].'&cat='.$cat.'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g">';
                        if(!empty($noticia['imagenes'])){
                        echo '<figure>';
                            echo '<img src="'.$noticia['imagenes'][0]['url'].'" />';
                        echo '</figure>';
                        }
                        echo '<div class="descripcion">';
                            echo '<h3>'.$noticia['titularSimple'].'</h3>';
                            echo '<p>'.$noticia['descripcion'].'</p>';
                        echo '</div>';
                        echo '<footer class="pie">';
                            echo '<div class="spie">';
                                echo '<p class="autor">'.substr($noticia['autor'],0,10).'</p>';
                                echo '<p class="fecha">'.$f->getDia().'/'.$f->getMes().'/'.$f->getAnio().' '.$f->getHoras().':'.$f->getMinutos().'</p>';
                            echo '</div>';
                            echo '<div class="scpie">';
                                echo '<i class="ncomen-logo adaptar-img"></i>';
                                echo '<p class="ncomen">'.count($noticia['comentarios']).'</p>';
                            echo '</div>';
                        echo '</footer>';
                            echo '</div></a>';
                    }
                }
            }else{
                for($l=0;$l<$columnas[$k]['nDivisiones'];$l++){
                    if($columnas[$k]['divisiones'][$l]['tipo']=='anuncio'){
                        if(count($this->noticias['anunciosH'])>1){
                            $anuncio = array_shift($this->noticias['anunciosH']);
                            echo '<a href="'.$anuncio['link'].'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g"><img src="'.$anuncio['imagen'].'" /></div></a>';
                        }else{
                            if(count($this->noticias['anunciosH'])>0){
                                $anuncio = $this->noticias['anunciosH'][0];
                                echo '<a href="'.$anuncio['link'].'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g"><img src="'.$anuncio['imagen'].'" /></div></a>';
                            }
                        }
                    }
                    if($columnas[$k]['divisiones'][$l]['tipo']=='galeria'){
                        if(count($this->galerias[$i])>0){
                            $galeria = array_shift($this->galerias[$i]);
                        }
                    }
                    if($columnas[$k]['divisiones'][$l]['tipo']=='opinion'){
                        if(count($this->opiniones[$i])>0){
                            $opiniones = array_shift($this->opiniones[$i]);
                        }
                    }
                    if($columnas[$k]['divisiones'][$l]['tipo']=='noticia'){
                        if(count($this->noticias[$i])>0){
                            $noticia = array_shift($this->noticias[$i]);
                            $f=new Fecha($noticia['fecha']);
                            if($l==($columnas[$k]['nDivisiones']-1)){
                                echo '<a href="index.php?id='.$noticia['id'].'&cat='.$cat.'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g">';
                            }else{
                                echo '<a href="index.php?id='.$noticia['id'].'&cat='.$cat.'"><div class="n'.$columnas[$k]['nDivisiones'].' mbni noticia anim-g">';
                            }
                            echo '<div class="descripcion">';
                                echo '<h3>'.$noticia['titularSimple'].'</h3>';
                                echo '</div>';
                            echo '<footer class="pie">';
                                echo '<div class="spie">';
                                    echo '<p class="autor">'.substr($noticia['autor'],0,10).'</p>';
                                    echo '<p class="fecha">'.$f->getDia().'/'.$f->getMes().'/'.$f->getAnio().' '.$f->getHoras().':'.$f->getMinutos().'</p>';
                                echo '</div>';
                                echo '<div class="scpie">';
                                    echo '<i class="ncomen-logo  adaptar-img"></i>';
                                    echo '<p class="ncomen">'.count($noticia['comentarios']).'</p>';
                                echo '</div>';
                            echo '</footer>';
                                echo '</div></a>';
                        }
                    }
                }
            }
            echo '</div>';
        }
    }

    function mostrar_defecto($cat){
        for($k=0;$k<3 && count($this->noticias[0])>0;$k++){
            echo '<div class="c3 left">';
            
                $noticia = array_shift($this->noticias[0]);
                $f=new Fecha($noticia['fecha']);
                    echo '<a href="index.php?id='.$noticia['id'].'&cat='.$cat.'"><div class="n1 noticia anim-g">';
                if(!empty($noticia['imagenes'])){
                echo '<figure>';
                    echo '<img src="'.$noticia['imagenes'][0]['url'].'" />';
                echo '</figure>';
                }
                echo '<div class="descripcion">';
                    echo '<h3>'.$noticia['titularSimple'].'</h3>';
                    echo '<p>'.$noticia['descripcion'].'</p>';
                echo '</div>';
                echo '<footer class="pie">';
                    echo '<div class="spie">';
                        echo '<p class="autor">'.substr($noticia['autor'],0,10).'</p>';
                        echo '<p class="fecha">'.$f->getDia().'/'.$f->getMes().'/'.$f->getAnio().' '.$f->getHoras().':'.$f->getMinutos().'</p>';
                    echo '</div>';
                    echo '<div class="scpie">';
                        echo '<i class="ncomen-logo adaptar-img"></i>';
                        echo '<p class="ncomen">'.count($noticia['comentarios']).'</p>';
                    echo '</div>';
                echo '</footer>';
                    echo '</div></a></div>';
        }
    }

    function mostrar_1($tipoC,$nc,$columnas,$i,$cat){
        echo '<div class="c1">';
        if($columnas[0]['tipo']=='anuncio'){
            if(count($this->noticias['anunciosH'])>1){
                $anuncio = array_shift($this->noticias['anunciosH']);
                echo '<a href="'.$anuncio['link'].'"><div class="n'.$columnas[0]['nDivisiones'].' noticia anim-g"><img src="'.$anuncio['imagen'].'" /></div></a>';
            }else{
                if(count($this->noticias['anunciosH'])>0){
                    $anuncio = $this->noticias['anunciosH'][0];
                    echo '<a href="'.$anuncio['link'].'"><div class="n'.$columnas[0]['nDivisiones'].' noticia anim-g"><img src="'.$anuncio['imagen'].'" /></div></a>';
                }
            }
        }
        if($columnas[0]['tipo']=='galeria'){
            if(count($this->galerias[$i])>0){
                $galeria = array_shift($this->galerias[$i]);
            }
        }
        if($columnas[0]['tipo']=='opinion'){
            if(count($this->opiniones[$i])>0){
                $opiniones = array_shift($this->opiniones[$i]);
            }
        }
        if($columnas[0]['tipo']=='noticia'){
            if(count($this->noticias[$i])>0){
                $noticia = array_shift($this->noticias[$i]);
                $f=new Fecha($noticia['fecha']);
                    echo '<a href="index.php?id='.$noticia['id'].'&cat='.$cat.'"><div class="n'.$columnas[0]['nDivisiones'].' noticia anim-g">';
                if(!empty($noticia['imagenes'])){
                echo '<figure>';
                    echo '<img src="'.$noticia['imagenes'][0]['url'].'" />';
                echo '</figure>';
                }
                echo '<div class="descripcion">';
                    echo '<h3>'.$noticia['titularSimple'].'</h3>';
                    echo '<p>'.substr($noticia['descripcion'],0,100).'</p>';
                echo '</div>';
                echo '<footer class="pie">';
                    echo '<div class="spie">';
                        echo '<p class="autor">'.substr($noticia['autor'],0,10).'</p>';
                        echo '<p class="fecha">'.$f->getDia().'/'.$f->getMes().'/'.$f->getAnio().' '.$f->getHoras().':'.$f->getMinutos().'</p>';
                    echo '</div>';
                    echo '<div class="scpie">';
                        echo '<i class="ncomen-logo adaptar-img"></i>';
                        echo '<p class="ncomen">'.count($noticia['comentarios']).'</p>';
                    echo '</div>';
                echo '</footer>';
                    echo '</div></a>';
            }
        }
        echo '</div>';

    }

    function mostrar_2($tipoC,$nc,$columnas,$i,$cat){

        for($k=0;$k<$nc;$k++){
            
            echo '<div class="c'.$tipoC.' left">';
            if($columnas[$k]['nDivisiones']==1){
                if($columnas[$k]['tipo']=='anuncio'){
                    if(count($this->noticias['anunciosV'])>1){
                        $anuncio = array_shift($this->noticias['anunciosH']);
                        echo '<a href="'.$anuncio['link'].'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g"><img src="'.$anuncio['imagen'].'" /></div></a>';
                    }else{
                        if(count($this->noticias['anunciosH'])>0){
                            $anuncio = $this->noticias['anunciosH'][0];
                            echo '<a href="'.$anuncio['link'].'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g"><img src="'.$anuncio['imagen'].'" /></div></a>';
                        }
                    }
                }
                if($columnas[$k]['tipo']=='galeria'){
                    if(count($this->galerias[$i])>0){
                        $galeria = array_shift($this->galerias[$i]);
                    }
                }
                if($columnas[$k]['tipo']=='opinion'){
                    if(count($this->opiniones[$i])>0){
                        $opiniones = array_shift($this->opiniones[$i]);
                    }
                }
                if($columnas[$k]['tipo']=='noticia'){
                    if(count($this->noticias[$i])>0){
                        $noticia = array_shift($this->noticias[$i]);
                        $f=new Fecha($noticia['fecha']);
                            echo '<a href="index.php?id='.$noticia['id'].'&cat='.$cat.'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g">';
                        if(!empty($noticia['imagenes'])){
                        echo '<figure>';
                            echo '<img src="'.$noticia['imagenes'][0]['url'].'" />';
                        echo '</figure>';
                        }
                        echo '<div class="descripcion">';
                            echo '<h3>'.$noticia['titularSimple'].'</h3>';
                            echo '<p>'.substr($noticia['descripcion'],0,100).'</p>';
                        echo '</div>';
                        echo '<footer class="pie">';
                            echo '<div class="spie">';
                                echo '<p class="autor">'.substr($noticia['autor'],0,10).'</p>';
                                echo '<p class="fecha">'.$f->getDia().'/'.$f->getMes().'/'.$f->getAnio().' '.$f->getHoras().':'.$f->getMinutos().'</p>';
                            echo '</div>';
                            echo '<div class="scpie">';
                                echo '<i class="ncomen-logo adaptar-img"></i>';
                                echo '<p class="ncomen">'.count($noticia['comentarios']).'</p>';
                            echo '</div>';
                        echo '</footer>';
                            echo '</div></a>';
                    }
                }
            }else{
                for($l=0;$l<$columnas[$k]['nDivisiones'] && count($this->noticias[$i])>0;$l++){
                    $noticia = array_shift($this->noticias[$i]);
                    $f=new Fecha($noticia['fecha']);
                    if($l==($columnas[$k]['nDivisiones']-1)){
                        echo '<a href="index.php?id='.$noticia['id'].'&cat='.$cat.'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g">';
                    }else{
                        echo '<a href="index.php?id='.$noticia['id'].'&cat='.$cat.'"><div class="n'.$columnas[$k]['nDivisiones'].' mbni noticia anim-g">';
                    }
                    echo '<div class="descripcion">';
                        echo '<h3>'.$noticia['titularSimple'].'</h3>';
                        echo '</div>';
                    echo '<footer class="pie">';
                        echo '<div class="spie">';
                            echo '<p class="autor">'.substr($noticia['autor'],0,10).'</p>';
                            echo '<p class="fecha">'.$f->getDia().'/'.$f->getMes().'/'.$f->getAnio().' '.$f->getHoras().':'.$f->getMinutos().'</p>';
                        echo '</div>';
                        echo '<div class="scpie">';
                            echo '<i class="ncomen-logo adaptar-img"></i>';
                            echo '<p class="ncomen">'.count($noticia['comentarios']).'</p>';
                        echo '</div>';
                    echo '</footer>';
                        echo '</div></a>';
                }
            }
            echo '</div>';
        }
    }

    function mostrar_23($tipoC,$nc,$columnas,$i,$cat){

        if(count($this->noticias[$i])>0){
            echo '<div class="c'.$tipoC.' left">';
            for($k=0;$k<$columnas[0]['nDivisiones'];$k++){
                $noticia = array_shift($this->noticias[$i]);
                $f=new Fecha($noticia['fecha']);
                echo '<a href="index.php?id='.$noticia['id'].'&cat='.$cat.'"><div class="n'.$columnas[0]['nDivisiones'].' noticia anim-g">';
                echo '<figure>';
                        echo '<img src="'.$noticia['imagenes'][0]['url'].'" />';
                echo '</figure>';
                echo '<div class="descripcion">';
                    echo '<h3>'.$noticia['titularSimple'].'</h3>';
                    echo '<p>'.$noticia['descripcion'].'</p>';
                echo '</div>';
                echo '<footer class="pie">';
                    echo '<div class="spie">';
                            echo '<p class="autor">'.substr($noticia['autor'],0,10).'</p>';
                            echo '<p class="fecha">'.$f->getDia().'/'.$f->getMes().'/'.$f->getAnio().' '.$f->getHoras().':'.$f->getMinutos().'</p>';
                        echo '</div>';
                        echo '<div class="scpie">';
                            echo '<i class="ncomen-logo adaptar-img"></i>';
                            echo '<p class="ncomen">'.count($noticia['comentarios']).'</p>';
                        echo '</div>';
                echo '</footer>';
                echo '</div></a>';
            }
            echo '</div>';
        }

        
        
            echo '<div class="c3 left">';
            if($columnas[1]['nDivisiones']==1){
                if($columnas[1]['tipo']=='anuncio'){
                    if(count($this->noticias['anunciosV'])>1){
                        $anuncio = array_shift($this->noticias['anunciosV']);
                        echo '<a href="'.$anuncio['link'].'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g"><img src="'.$anuncio['imagen'].'" /></div></a>';
                    }else{
                        if(count($this->noticias['anunciosV'])>0){
                            $anuncio = $this->noticias['anunciosV'][0];
                            echo '<a href="'.$anuncio['link'].'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g"><img src="'.$anuncio['imagen'].'" /></div></a>';
                        }
                    }
                }
                if($columnas[1]['tipo']=='galeria'){
                    if(count($this->galerias[$i])>0){
                        $galeria = array_shift($this->galerias[$i]);
                    }
                }
                if($columnas[1]['tipo']=='opinion'){
                    if(count($this->opiniones[$i])>0){
                        $opiniones = array_shift($this->opiniones[$i]);
                    }
                }
                if($columnas[1]['tipo']=='noticia'){
                    if(count($this->noticias[$i])>0){
                        $noticia = array_shift($this->noticias[$i]);
                        $f=new Fecha($noticia['fecha']);
                        if(isset($noticia['id'])){
                            echo '<a href="index.php?id='.$noticia['id'].'&cat='.$cat.'"><div class="n'.$columnas[1]['nDivisiones'].' noticia anim-g">';
            
                            echo '<div class="descripcion">';
                                echo '<h3>'.$noticia['titularSimple'].'</h3>';
                                echo '<p>'.$noticia['descripcion'].'</p>';
                            echo '</div>';
                            echo '<footer class="pie">';
                                echo '<div class="spie">';
                                    echo '<p class="autor">'.substr($noticia['autor'],0,10).'</p>';
                                    echo '<p class="fecha">'.$f->getDia().'/'.$f->getMes().'/'.$f->getAnio().' '.$f->getHoras().':'.$f->getMinutos().'</p>';
                                echo '</div>';
                                echo '<div class="scpie">';
                                    echo '<i class="ncomen-logo adaptar-img"></i>';
                                    echo '<p class="ncomen">'.count($noticia['comentarios']).'</p>';
                                echo '</div>';
                            echo '</footer>';
                            echo '</div></a>';
                        }
                    }
                }
            }else{
                for($k=0;$k<$columnas[1]['nDivisiones'];$k++){

                    if($columnas[1]['divisiones'][$k]['tipo']=='anuncio'){
                        if(count($this->noticias['anunciosH'])>1){
                            $anuncio = array_shift($this->noticias['anunciosH']);
                            echo '<a href="'.$anuncio['link'].'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g"><img src="'.$anuncio['imagen'].'" /></div></a>';
                        }else{
                            if(count($this->noticias['anunciosH'])>0){
                                $anuncio = $this->noticias['anunciosH'][0];
                                echo '<a href="'.$anuncio['link'].'"><div class="n'.$columnas[$k]['nDivisiones'].' noticia anim-g"><img src="'.$anuncio['imagen'].'" /></div></a>';
                            }
                        }
                    }
                    if($columnas[1]['divisiones'][$k]['tipo']=='galeria'){
                        if(count($this->galerias[$i])>0){
                            $galeria = array_shift($this->galerias[$i]);
                        }
                    }
                    if($columnas[1]['divisiones'][$k]['tipo']=='opinion'){
                        if(count($this->opiniones[$i])>0){
                            $opiniones = array_shift($this->opiniones[$i]);
                        }
                    }
                    if($columnas[1]['divisiones'][$k]['tipo']=='noticia'){
                        if(count($this->noticias[$i])>0){
                            $noticia = array_shift($this->noticias[$i]);
                            $f=new Fecha($noticia['fecha']);
                            if(isset($noticia['id'])){
                                if($k==($columnas[1]['nDivisiones']-1)){
                                        echo '<a href="index.php?id='.$noticia['id'].'&cat='.$cat.'"><div class="n'.$columnas[1]['nDivisiones'].' noticia anim-g">';
                                    }else{
                                        echo '<a href="index.php?id='.$noticia['id'].'&cat='.$cat.'"><div class="n'.$columnas[1]['nDivisiones'].' mbni noticia anim-g">';
                                    }
                                echo '<div class="descripcion">';
                                    echo '<h3>'.$noticia['titularSimple'].'</h3>';
                                    echo '<p>'.$noticia['descripcion'].'</p>';
                                echo '</div>';
                                echo '<footer class="pie">';
                                    echo '<div class="spie">';
                                        echo '<p class="autor">'.substr($noticia['autor'],0,10).'</p>';
                                        echo '<p class="fecha">'.$f->getDia().'/'.$f->getMes().'/'.$f->getAnio().' '.$f->getHoras().':'.$f->getMinutos().'</p>';
                                    echo '</div>';
                                    echo '<div class="scpie">';
                                        echo '<i class="ncomen-logo adaptar-img"></i>';
                                        echo '<p class="ncomen">'.count($noticia['comentarios']).'</p>';
                                    echo '</div>';
                                echo '</footer>';
                                echo '</div></a>';
                            }
                        }
                    }
                }
            }
        
        echo '</div>';
        
    }


    function mostrar($cat){
        for($i=0;$i<count($this->componentes);$i++){
            echo '<div class="categoria">';

            if($this->componentes[$i]['cabecera']=='si'){
                echo '<div class="cabecera">
                        <h2 class="titulo-categoria">'.strtoupper(substr($this->componentes[$i]['titulo'],0,1)).substr($this->componentes[$i]['titulo'],1).'</h2>
                        <nav class="zona-menu-categoria">';
                        if(count($this->componentes[$i]['submenu'])>0){
                            echo '<ul>';
                            for($j=0;$j<count($this->componentes[$i]['submenu']);$j++){
                                echo '<a href="index.php?cat='.$this->componentes[$i]['submenu'][$j]['valor'].'"><li class="item-submenu-cat anim-g">'.$this->componentes[$i]['submenu'][$j]['nombre'].'</li></a>';
                            }
                            echo '</ul>';
                        }
                  echo '</nav>
                     </div>';
            }

            echo '<div class="cubre-secciones">';
            for($j=0;$j<count($this->componentes[$i]['elementos']);$j++){
                echo '<div class="seccion">
                                <div class="cuerpo">';
                
                $tipoC = $this->componentes[$i]['elementos'][$j]['tipo'];
                $nc = $this->componentes[$i]['elementos'][$j]['ncolumnas'];
                $columnas = $this->componentes[$i]['elementos'][$j]['columnas'];
                
                if(count($this->noticias[$i]>0)){
                if($tipoC=='23'){ $this->mostrar_23($tipoC,$nc,$columnas,$i,$cat); }
                if($tipoC=='2'){ $this->mostrar_2($tipoC,$nc,$columnas,$i,$cat); }
                if($tipoC=='3'){ $this->mostrar_3($tipoC,$nc,$columnas,$i,$cat); }
                if($tipoC=='4'){ $this->mostrar_5($tipoC,$nc,$columnas,$i,$cat); }
                if($tipoC=='5'){ $this->mostrar_5($tipoC,$nc,$columnas,$i,$cat); }
                if($tipoC=='6'){ $this->mostrar_5($tipoC,$nc,$columnas,$i,$cat); }
                if($tipoC=='1'){ $this->mostrar_1($tipoC,$nc,$columnas,$i,$cat); }
                }
                echo '<div class="clear"></div>';
                echo '</div>
                </div>';
            }

            //var_dump($this->noticias);

            echo '</div>';
            echo '</div>';
        }
        echo '<div class="categoria"><div class="cubre-secciones">';
        if($cat!='portada'){
                while(count($this->noticias[0])>0){
                    echo '<div class="seccion">
                                <div class="cuerpo">';
                    $this->mostrar_defecto($cat);
                    echo '<div class="clear"></div>';
                    echo '</div>
                    </div>';

                }
            }
        echo '</div></div>';
        
    }

    function mostrarAdmin($cat){
        echo '
        <a href="index.php?action=add"><div class="bt-g1 anim-g " id="addn">añadir noticia</div></a>
        <div class="categoria-admin">
                <ul id="lista-admin">';
        $noticias = $this->noticias;
        
        for($i=0;$i<count($noticias[0]);$i++){
            echo '
            <div class="cna">
            <a href="index.php?id='.$noticias[0][$i]['id'].'&cat='.$cat.'">
            <li class="noticia">';
            if(!empty($noticias[0][$i]['imagenes'])){
               echo ' <figure>
                    <img src="'.$noticias[0][$i]['imagenes'][0]['url'].'" />
                </figure>
                <div class="descripcion left">';
            }else{
                echo '<div class="descripcion">';
            }
            echo '       <h3 class="titulo">'.$noticias[0][$i]['titularCompleto'].'</h3>
                    <p>'.$noticias[0][$i]['descripcion'].'</p>
                </div>
                
            </li>
            </a>
            <a href="index.php?erase=0&cat=portada&id='.$noticias[0][$i]['id'].'">
                    <div class="eliminar anim-g"></div>
                </a>
            </div>
            ';
        }
        echo '</ul>
        </div>';
    }


}

?>