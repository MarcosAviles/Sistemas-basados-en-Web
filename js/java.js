
function adaptar(){
    if($('.cuerpo').length>0){
        for(i=0;i<$('.cuerpo').length;i++){
            var altura = $($('.cuerpo')[i]).height();
            $($('.cuerpo')[i]).height(altura);
        }
    }

    if($('.c2').length>0){
        var altura =$('.c2').find('figure').height();
        $('.c2').find('.noticia').height(altura);
        $('.c2').find('.descripcion').height(altura-15);
        $('.c2').height(altura+40);
        $('.c2').parents('.cuerpo').height(altura+40);
    }

    if($('.categoria  .cabecera  .titulo-categoria').length>0){
        for(i=0;i<$('.categoria  .cabecera  .titulo-categoria').length;i++){
            var wt = $($('.categoria .cabecera')[i]).width();
            var w =$($('.categoria  .cabecera  .titulo-categoria')[i]).width();
            $($('.categoria .cabecera .zona-menu-categoria')[i]).width((wt-w-16));
        }
    }

    if($('#titulo-relacionadas').length>0){
        var wt = $('#cabecera-relacionadas').width();
        var w =$('#titulo-relacionadas').width();
        var h = $('#titulo-relacionadas').height();
        $('#line-relacionadas').width((wt-w-16));
        $('#line-relacionadas').height(h+10);
    }

    if($('#continer-comentarios').length>0){
        var h = $('#cabecera').height();
        $('#continer-comentarios').height(h+30);
    }
    if($('#continer-inicio').length>0){
        var h = $('#cabecera').height();
        $('#continer-inicio').height(h+30);
    }

    if($('#cabecera-comentarios').length>0){
        var wt = $('#cabecera-comentarios').width();
        var w =$('#cabecera-comentarios h3').width();
        var h = $('#cabecera-comentarios h3').height();
        $('#cabecera-comentarios ul').width((wt-w-16));
    }
}

window.onload=function(){
    adaptar();
}

window.onresize=function(){
    adaptar();
}

function noticia(){
    $('#zona-comentarios').unbind();
    $('#cerrar-comentarios').unbind();
    $('#zona-comentarios').click(mostrar_comentarios);
    $('#cerrar-comentarios').click(ocultar_comentarios);
}

function inicio(){
    $('body').click(ocultarAutobox);
    $('#cuenta').unbind();
    $('#cuenta').click(mostrar_registro);

    $('#cerrar-registro').unbind();
    $('#cerrar-registro').click(ocultar_registro);

    $('#lupa').unbind();
    $('#lupa').click(mostrar_buscador);
    $('#buscar').keypress(function(ev){
        if(ev.which == 13) {
            buscar();
        }
    });
    $('#buscar').keyup(buscar);

}

function ocultarAutobox(){
    $('#autobox').css('right','-300px');
}

function buscar(){
    var busqueda = $('#buscar').val();
    var datos={search:busqueda}
    if(busqueda.length>3){
        $.ajax({
            type: "POST",
            url: "index.php?action=search",
            data: datos,
            success: function(data) {
                var ancho=$('#autobox').css('right');
                if(ancho=='-300px'){
                    desplegar_autobox();
                }
                $('#autobox').html(data);
            }
        });
    }
}

function desplegar_autobox(){
    $('#autobox').css('right','0');
}

function mostrar_buscador(){
    var data=parseInt($(this).attr('data'));
    if(data==0){
        $('#cubre-buscador').height(35);
        $('#cubre-buscador').css('padding-top','15px');
        $('#cubre-buscador').css('padding-bottom','15px');
        $(this).attr('data','1');
    }else{
        $('#cubre-buscador').css('padding-top','0px');
        $('#cubre-buscador').css('padding-bottom','0px');
        $('#cubre-buscador').height(0);
        $(this).attr('data','0');
    }
}

function mostrar_registro(){
    $('body').scrollTop(0);
    $('body').css('overflow','hidden');
    $('#continer-inicio').animate({"right":0+"px"},500);
}

function ocultar_registro(){
    $('body').css('overflow','auto');
    $('#continer-inicio').animate({"right":"-100%"},500);
}
//mostrar oculto;

function mostrar_comentarios(){
    $('.wrapper').scrollTop(0);
    $('.wrapper').css('overflow-y','hidden');
    $('#continer-comentarios').animate({"right":0+"px"},500);
}

function ocultar_comentarios(){
    $('.wrapper').css('overflow-y','auto');
    $('#continer-comentarios').animate({"right":"-100%"},500);   
}

function formulario_noticia(){

    $('#betiquetas').unbind();
    $('.close-etiqueta').unbind();

    $('#boton-imagenes').unbind();
    $('.close-imagen').unbind();

    $('#boton-videos').unbind();
    $('.close-video').unbind();

    $('#betiquetas').click(addEtiquetas);
    $('.close-etiqueta').click(borrarEtiqueta);

    $('#boton-imagenes').click(addImagenes);
    $('.close-imagen').click(borrarImagen);

    $('#boton-videos').click(addVideos);
    $('.close-video').click(borrarVideo);
}

function addEtiquetas(){
    var strEtiquetas = $('#etiquetasf').val();
    if(strEtiquetas!=''){
        var etiquetas = strEtiquetas.split(',');
        for(i=0;i<etiquetas.length;i++){
            etiquetas[i]=etiquetas[i].trim();
            var contenido = '<div class="etiqueta">'+
                                '<p>'+etiquetas[i]+'</p>'+
                                '<figure class="close close-etiqueta anim-g adaptar-img"></figure>'+
                            '</div>';
            $(contenido).insertBefore('#ceti .clear');
           
        }
         $('#etiquetas').val($('#etiquetas').val()+' '+strEtiquetas+',');
    }
    $('#etiquetasf').val('');
    formulario_noticia();
}

function borrarEtiqueta(){
    $(this).parent('.etiqueta').remove();
    contenido='';
    for(i=0;i<$('.etiqueta').length;i++){
        contenido+=$($('.etiqueta')[i]).find('p').html().trim()+', ';
    }
    $('#etiquetas').val(contenido);
}

function addImagenes(){
    var strImagen = $('#imagenf').val();
    if(strImagen!=''){
        var contenido = '<div class="lineanfn bb">'+
                            '<div class="cifn fill-c linea-imagen">'+
                                '<input type="text" disabled placeholder="imagen..." value="'+strImagen+'">'+
                            '</div>'+
                            '<figure class="close close-imagen anim-g adaptar-img"></figure>'+
                        '</div>';
        $(contenido).insertBefore('#sima .lineafn');
        $('#imagenes').val($('#imagenes').val()+' '+strImagen+',');
    }   
    $('#imagenf').val('');
    formulario_noticia();
}

function borrarImagen(){
    $(this).parent('.lineanfn').remove();
    contenido='';
    for(i=0;i<$('.linea-imagen').length;i++){
        contenido+=$($('.linea-imagen')[i]).find('input').val()+', ';
    }
    $('#imagenes').val(contenido);
}

function addVideos(){
    var strVideo = $('#videof').val();
    if(strVideo!=''){
        var contenido = '<div class="lineanfn bb">'+
                            '<div class="cifn fill-c">'+
                                '<input type="text" disabled placeholder="video..." value="'+strVideo+'">'+
                            '</div>'+
                            '<figure class="close close-video anim-g adaptar-img"></figure>'+
                        '</div>';
        $(contenido).insertBefore('#svideo .lineafn');
        $('#videos').val($('#videos').val()+' '+strVideo+',');
    }   
    $('#videof').val('');
    formulario_noticia();
}

function borrarVideo(){
    $(this).parent('.lineanfn').remove();
    contenido='';
    for(i=0;i<$('.linea-video').length;i++){
        contenido+=$($('.linea-video')[i]).find('input').val()+', ';
    }
    $('#videos').val(contenido);
}

/****************functiones organizador */

var portada=[];
var orden=0;
var idactual='';

function actualizar_plantilla(){
    var plantilla=[];
    var nombre=$('#tipoplantilla').val();
    var num=$('.cat-plantilla').length;
    for(i=0;i<num;i++){
        var titulo=$($('.cat-plantilla')[i]).attr('nombre');
        var cab=$($('.cat-plantilla')[i]).attr('cabecera');
        var cat={
            orden:i,
            cabecera:cab,
            nombre:nombre,
            titulo:titulo,
            elementos:[]
        }

        var nsp=$($('.cat-plantilla')[i]).find('.sp').length;
        for(j=0;j<nsp;j++){
            var t=$($($('.cat-plantilla')[i]).find('.sp')[j]).attr('tipo');
            var seccion={
                orden:j,
                tipo:t,
                columnas:[]
            }
            
            var cols=$($($('.cat-plantilla')[i]).find('.sp')[j]).find('.bps');
            var nbps=$(cols).length;
            for(k=0;k<nbps;k++){
                var tco=$($(cols)[k]).attr('tipo');
                var nco=$($(cols)[k]).attr('numero');
                var columna={
                    orden:k,
                    tipo:tco,
                    numero:nco,
                    sc:[]
                }
                var divs=$($($($('.cat-plantilla')[i]).find('.sp')[j]).find('.bps')[k]).find('.inte');
                var ninte=$(divs).length;
                for(l=0;l<ninte;l++){
                    var tdiv=$($(divs)[l]).attr('tipo');
                    var division={
                        orden:l,
                        tipo:tdiv
                    }
                    columna.sc.push(division);
                }
                seccion.columnas.push(columna);
            }
            cat.elementos.push(seccion);

        }

        plantilla.push(cat);
    }
    var httpa = new XMLHttpRequest();
    var url = "index.php?action=organizador";
    
    httpa.onreadystatechange = function() {
        if(httpa.readyState == 4 && httpa.status == 200) { 
            //aqui obtienes la respuesta de tu peticion
            console.log(httpa.responseText);
            $('body').html(httpa.responseText);
        }
    }
    httpa.open("POST", url, true);
    httpa.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var b={plantilla:plantilla}
    var a="org="+JSON.stringify(b);
    httpa.send(a);

    
}

function c23(o){
    var contenido='<div orden="'+o+'"  tipo="23"  class="sp anim-g">'+
                '<div class="close adaptar-img mb10"></div><div class="clear"></div>'+
                '<header class="cabecera-plantilla">'+
                    '<figure class="anim-g setting-plantilla"></figure>'+
                '</header>'+
                '<div orden="1" tipo="noticia" numero="1" class="c23 bs bps anim-g">'+
                        '<header class="cabecera-plantilla">'+
                            '<figure class="anim-g setting-plantilla"></figure>'+
                        '</header>'+
                    '</div>'+
                '<div orden="2" tipo="noticia" numero="1" class="c3 bs bps anim-g">'+
                        '<header class="cabecera-plantilla">'+
                            '<figure class="anim-g setting-plantilla"></figure>'+
                        '</header>'+
                    '</div>'+
                '<div class="clear"></div>'+
            '</div>';
    return contenido;
}

function c3(o){
    var contenido='<div orden="'+o+'"  tipo="3"  class="sp  anim-g">'+
                '<div class="close adaptar-img mb10"></div><div class="clear"></div>'+
                '<header class="cabecera-plantilla">'+
                    '<figure class="anim-g setting-plantilla"></figure>'+
                '</header>';
                for(i=0;i<3;i++){
                    contenido +='<div orden="'+(i+1)+'" tipo="noticia" numero="1" class="c3 bs bps anim-g">'+
                        '<header class="cabecera-plantilla">'+
                            '<figure class="anim-g setting-plantilla"></figure>'+
                        '</header>'+
                    '</div>';
                }
                contenido+='<div class="clear"></div>'+
            '</div>';
    return contenido;
}

function c2(o){
    var contenido='<div orden="'+o+'"  tipo="2"  class="sp anim-g">'+
                '<div class="close adaptar-img mb10"></div><div class="clear"></div>'+
                '<header class="cabecera-plantilla">'+
                    '<figure class="anim-g setting-plantilla"></figure>'+
                '</header>';
                for(i=0;i<2;i++){
                    contenido +='<div orden="'+(i+1)+'"  tipo="noticia" numero="1" class="c2 bs bps anim-g">'+
                        '<header class="cabecera-plantilla">'+
                            '<figure class="anim-g setting-plantilla"></figure>'+
                        '</header>'+
                    '</div>';
                }
                contenido+='<div class="clear"></div>'+
            '</div>';
    return contenido;
}

function c5(o){
    var contenido='<div orden="'+o+'"  tipo="5"  class="sp anim-g">'+
                '<div class="close adaptar-img mb10"></div><div class="clear"></div>'+
                '<header class="cabecera-plantilla">'+
                    '<figure class="anim-g setting-plantilla"></figure>'+
                '</header>';
                for(i=0;i<5;i++){
                    contenido +='<div orden="'+(i+1)+'" tipo="noticia" numero="1" class="c5 bs bps anim-g">'+
                        '<header class="cabecera-plantilla">'+
                            '<figure class="anim-g setting-plantilla"></figure>'+
                        '</header>'+
                    '</div>';
                }
                contenido+='<div class="clear"></div>'+
            '</div>';
    return contenido;
}

function c4(o){
    var contenido='<div orden="'+o+'"  tipo="4"  class="sp anim-g">'+
                '<div class="close adaptar-img mb10"></div><div class="clear"></div>'+
                '<header class="cabecera-plantilla">'+
                    '<figure class="anim-g setting-plantilla"></figure>'+
                '</header>';
                for(i=0;i<4;i++){
                    contenido +='<div orden="'+(i+1)+'" tipo="noticia" numero="1" class="c4 bs bps anim-g">'+
                        '<header class="cabecera-plantilla">'+
                            '<figure class="anim-g setting-plantilla"></figure>'+
                        '</header>'+
                    '</div>';
                }
                contenido+='<div class="clear"></div>'+
            '</div>';
    return contenido;
}

function c6(o){
    var contenido='<div orden="'+o+'"  tipo="6"  class="sp anim-g">'+
                '<div class="close adaptar-img mb10"></div><div class="clear"></div>'+
                '<header class="cabecera-plantilla">'+
                    '<figure class="anim-g setting-plantilla"></figure>'+
                '</header>';
                for(i=0;i<6;i++){
                    contenido +='<div orden="'+(i+1)+'" tipo="noticia" numero="1" class="c6 bs bps anim-g">'+
                        '<header class="cabecera-plantilla">'+
                            '<figure class="anim-g setting-plantilla"></figure>'+
                        '</header>'+
                    '</div>';
                }
                contenido+='<div class="clear"></div>'+
            '</div>';
    return contenido;
}

function c1(o){
    var contenido='<div orden="'+o+'" tipo="1" class="sp anim-g">'+
                '<div class="close adaptar-img  mb10"></div><div class="clear"></div>'+
                '<header class="cabecera-plantilla">'+
                    '<figure class="anim-g setting-plantilla"></figure>'+
                '</header>'+
                '<div tipo="noticia" numero="1" class="c1 bs bps anim-g">'+
                        '<header class="cabecera-plantilla">'+
                            '<figure class="anim-g setting-plantilla"></figure>'+
                        '</header>'+
                    '</div>'+
                '<div class="clear"></div>'+
            '</div>';
    return contenido;
}

function borrar_resaltados(){
    for(i=0;i<$('.resaltado').length;i++){
        $($('.resaltado')[i]).css('border','solid 1px rgba(200,200,200,1)');
        $($('.resaltado')[i]).removeClass('resaltado');
        
    }
}

function eliminarElemento(item){
    $(item).parent().remove();
}

function cargar_settings_categoria(item){

    var name=$(item).attr('nombre');
    var cabecera=$(item).attr('cabecera');
    var contenido='<div class="c-label-settings">'+
                    '<div class="linea-label-org">Titulo</div>';
                    
                    contenido+='<div class="linea-label-org">Nombre</div>';
                    
                contenido+='</div>'+
                '<div class="c-input-settings">'+
                    '<div class="linea-input">'+
                        '<div class="cubre-input-org">'+
                            '<select id="cab" name="cab">';
                            if(cabecera=='si'){
                                contenido+='<option value="si" selected>Si</option>'+
                                '<option value="no">No</option>';
                            }else{
                                contenido+='<option value="no" selected>No</option>'+
                                '<option value="si">Si</option>';
                            }
                            contenido+='</select>'+
                        '</div>'+
                    '</div>';
                    
                    contenido+='<div class="linea-input">'+
                        '<div class="cubre-input-org">'+
                            '<input type="text" id="namecat" name="namecat" placeholder="nombre" value="'+name+'">'+
                        '</div>'+
                    '</div>';
                    
                contenido+='</div>'+
                '<div class="clear"></div>';
    $('#csettings').html(contenido);
    $('#csettings').height(85);
    mostrar_settings_org();
    opciones_categoria();
}

function opciones_categoria(){
    $('#cab').change(actualizarCategoria);
    $('#namecat').keypress(function(ev){
        if(ev.which == 13){
            actualizarCategoria();
        }
    });
}

function actualizarCategoria(){
    var cab= $('#cab').val();
    var name=$('#namecat').val();

    $($('.resaltado')[0]).attr('nombre',name);
    $($('.resaltado')[0]).attr('cabecera',cab);
}

function cargarTipoCol(se){
    var items=["noticia","galeria","opinion","anuncio"];
    var valores=["Noticia","Galeria","Opinion","Anuncio"];

    contenido='';
    for(i=0;i<items.length;i++){
        if(items[i]==se){
            contenido+='<option selected value="'+items[i]+'">'+valores[i]+'</option>';
        }else{
            contenido+='<option value="'+items[i]+'">'+valores[i]+'</option>';
        }
    }

    return contenido;
}

function cargarDivisionCol(se){
    var items=["1","2","3"];

    contenido='';
    for(i=0;i<items.length;i++){
        if(items[i]==se){
            contenido+='<option selected value="'+items[i]+'">'+items[i]+'</option>';
        }else{
            contenido+='<option value="'+items[i]+'">'+items[i]+'</option>';
        }
    }

    return contenido;
}

function cargar_settings_columna(item){
    var contenido='<div class="c-label-settings">'+
                    '<div class="linea-label-org">Tipo</div>';
                    if($(item).hasClass('c3')){
                        contenido+='<div class="linea-label-org">division</div>';
                    };
                contenido+='</div>'+
                '<div class="c-input-settings">'+
                    '<div class="linea-input">'+
                        '<div class="cubre-input-org">'+
                            '<select id="tipoCol" name="tipoCol">';
                                contenido+=cargarTipoCol($(item).attr('tipo'));
                            contenido+= '</select>'+
                        '</div>'+
                    '</div>';
                    if($(item).hasClass('c3')){
                        contenido+='<div class="linea-input">'+
                        '<div class="cubre-input-org">'+
                            '<select id="nCol" name="nCol">';
                                contenido+=cargarDivisionCol($(item).attr('numero'));
                            contenido+= '</select>'+
                        '</div>'+
                    '</div>';
                    };
                contenido+='</div>'+
                '<div class="clear"></div>';
    $('#csettings').html(contenido);
    if(!$(item).hasClass('c3')){
        $('#csettings').height(45);
    }else{
        $('#csettings').height(85);
    }
    mostrar_settings_org();
    opciones_columna();

}

function opciones_columna(){
    $('#tipoCol').change(actualizarColumna);
    $('#nCol').change(actualizarColumna);
}

function actualizarColumna(){
    var n=1;
    var tipo=$('#tipoCol').val();
    if(tipo=='noticia' || tipo=='opinion'){
        n=$('#nCol').val();
    }
    if((tipo=='anuncio' || tipo=='galeria') && ($($('.resaltado')[0]).hasClass('c3'))){
        n=1;
        $('#csettings').height(45);
    }else{
            $('#csettings').height(85);
    }

    if(n>1){
        var con='';
        for(i=0;i<n;i++){
            if(i==n-1){
                con+='<div tipo="noticia" class="n'+n+' bin inte"></div>';
            }else{
                con+='<div tipo="noticia" class="n'+n+' bin mb10 inte"></div>';
            }
        }
        $($('.resaltado')[0]).html(con);
    }else{
        $($('.resaltado')[0]).html('');
    }

    $($('.resaltado')[0]).attr('tipo',tipo);
    $($('.resaltado')[0]).attr('numero',n);

    var res=$('.resaltado')[0];
    var ocol=parseInt($(res).attr('orden'));
    var osec=parseInt($(res).parent('.sp').attr('orden'));
    var ocat=parseInt($(res).parents('.cat-plantilla').attr('orden'));

    portada[ocat-1]['elementos'][osec-1]['columnas'][ocol-1]['tipo']=tipo;
    portada[ocat-1]['elementos'][osec-1]['columnas'][ocol-1]['numero']=n;

}

function mostrar_settings_org(){
    $('#set').parent('.seccion-controles-plantilla').fadeIn(500);
}

function ocultar_settings_org(){
    $('#set').parent('.seccion-controles-plantilla').fadeOut(500);
}
function organizador(){
    $('#boton-submit-plantilla').click(actualizar_plantilla);
    $('#continer-plantilla').on('dragover',function(ev){
        ev.preventDefault();
        
        var contenido='';
        //if($(ev.target).hasClass('cat-plantilla') || $(ev.target).attr('id')=='continer-plantilla'){
            if(idactual=='categoria-boton'){
                if($(ev.target).attr('id')=='continer-plantilla'){
                    $(ev.target).css('background-color','rgba(220,226,255,1)');
                    $(ev.target).css('border','solid 1px rgba(0,90,184,1)');
                }else{
                    if(!$(ev.target).hasClass('sp') && !$(ev.target).hasClass('close')){
                        $(ev.target).css('background-color','rgba(255,178,158,1)');
                        $(ev.target).css('border','solid 1px rgba(170,0,0,1)');
                    }
                }
            }

            if(idactual=='c23' || idactual=='c2' || idactual=='c3' || idactual=='c4' || idactual=='c5' || idactual=='c6' || idactual=='c1'){
                if($(ev.target).hasClass('cat-plantilla')){
                    $(ev.target).css('background-color','rgba(220,226,255,1)');
                    $(ev.target).css('border','solid 1px rgba(0,90,184,1)');
                }else{
                    if(!$(ev.target).hasClass('sp') && !$(ev.target).hasClass('close')){
                        $(ev.target).css('background-color','rgba(255,178,158,1)');
                        $(ev.target).css('border','solid 1px rgba(170,0,0,1)');
                    }
                }

            }
        //}

    });

    $('#continer-plantilla').on('drop',function(ev){
        ev.preventDefault();
        var data = ev.originalEvent.dataTransfer.getData("text");

        var contenido='';
        if(data=='categoria-boton'){
            contenido='<div orden="'+(orden+1)+'" cabecera="no" nombre="portada" class="cat-plantilla">'+
            '<div class="close adaptar-img mb10"></div><div class="clear"></div>'+
                '<header class="cabecera-plantilla">'+
                    '<figure class="anim-g setting-plantilla"></figure>'+
                '</header>'+
            '</div>';
            if($(ev.target).attr('id')=='continer-plantilla'){
                $(ev.target).append(contenido);
            }
        }

        if(data=='c23'){ 
            if($(ev.target).hasClass('cat-plantilla')){

                var o=$($(ev.target).find('.sp')).length
                contenido=c23((o+1));
                $(ev.target).append(contenido);
            } 
        }
        if(data=='c2'){ 
            if($(ev.target).hasClass('cat-plantilla')){
                var o=$($(ev.target).find('.sp')).length
                contenido=c2((o+1));
                $(ev.target).append(contenido);
            }  
        }

        if(data=='c1'){ 
            
            if($(ev.target).hasClass('cat-plantilla')){
                var o=$($(ev.target).find('.sp')).length
                contenido=c1((o+1));
                $(ev.target).append(contenido);
            }  
        }

        if(data=='c3'){ 
            if($(ev.target).hasClass('cat-plantilla')){
                var o=$($(ev.target).find('.sp')).length
                contenido=c3((o+1));
                $(ev.target).append(contenido);
            }  
        }
        if(data=='c4'){ 
            
            if($(ev.target).hasClass('cat-plantilla')){
                var o=$($(ev.target).find('.sp')).length
                contenido=c4((o+1));
                $(ev.target).append(contenido);
            }  
        }
        if(data=='c5'){ 

            if($(ev.target).hasClass('cat-plantilla')){
                var o=$($(ev.target).find('.sp')).length
                contenido=c5((o+1));
                $(ev.target).append(contenido);
            } 
        }
        if(data=='c6'){ 

            if($(ev.target).hasClass('cat-plantilla')){
                var o=$($(ev.target).find('.sp')).length
                contenido=c6((o+1));
                $(ev.target).append(contenido);
            }  
        }

        if($(ev.target).hasClass('cat-plantilla') || $(ev.target).attr('id')=='continer-plantilla'){
            $(ev.target).css('background-color','rgba(255,255,255,1)');
            $(ev.target).css('border','solid 1px rgba(200,200,200,1)');
        }

    });
    $('#continer-plantilla').on('dragleave',function(ev){
            
        if(!$(ev.target).hasClass('sp') && !$(ev.target).hasClass('close')){
            $(ev.target).css('background-color','rgba(255,255,255,1)');
            $(ev.target).css('border','solid 1px rgba(200,200,200,1)');
        }
    });

    $('#continer-plantilla').click(function(ev){

        if($(ev.target).hasClass('close')){
            eliminarElemento(ev.target);
        }
        if($(ev.target).hasClass('cat-plantilla') || $(ev.target).hasClass('bps') || $(ev.target).hasClass('inte')){
            borrar_resaltados();
            $(ev.target).css('border','solid 1px rgba(100,50,200,1)');
            $(ev.target).addClass('resaltado');
            if($(ev.target).hasClass('cat-plantilla')){
                cargar_settings_categoria(ev.target);
            }
            if($(ev.target).hasClass('bps') || $(ev.target).hasClass('inte')){
                cargar_settings_columna(ev.target);
            }
        }else{
            borrar_resaltados();
            ocultar_settings_org();
        
        }
    });
    $('.contenedor').on('dragstart',function(ev){
        idactual=$(this).attr('id');
        ev.originalEvent.dataTransfer.setData('text',$(this).attr('id'));
    });

    $('.item-columnas').on('dragstart',function(ev){
        idactual=$(this).attr('id');
        ev.originalEvent.dataTransfer.setData('text',$(this).attr('id'));
    });

    $('#tipoplantilla').change(seccionPlantilla);
}

function seccionPlantilla(){
    var sec=$('#tipoplantilla').val();
    window.location='index.php?action=organizador&sec='+sec;
}

function categorias(){
    $('.linea-categoria').unbind();
    $('#boton-categorias').unbind();
    $('.boton-subcategorias').unbind();
    $('.close-cat').unbind();
    $('.close-subcat').unbind();

    $('.linea-categoria').click(desplegar_sub);
    $('#boton-categorias').click(addCategoria);
    $('.boton-subcategorias').click(addSubcategoria);
    $('.close-cat').click(borrarCat);
    $('.close-subcat').click(borrarSubCat);
}

function borrarCat(){
    $(this).parents('.cubre-categoria').remove();
}

function borrarSubCat(){
    var altoa=$(this).parents('.continer-subcategorias').height();
    $(this).parents('.continer-subcategorias').height((altoa-36));
    $(this).parents('.linea-subcategoria').remove();
}

function existeSubcategoria(cat,e){
    cat = cat.toUpperCase();
    var cats=$(e).parents('.continer-subcategorias').find('.csub');
    var n = cats.length;
    var existe=false;
    for(i=0;i<n && !existe;i++){
        var ccat=$(cats[i]).html().trim().toUpperCase();
        if(ccat==cat){
            existe=true;
        }
    }
    return existe;
}

function actualizarCategorias(cat){
    var str=$('#i-categorias').val()+cat+',';
    $('#i-categorias').val(str);
}

function actualizarSubcategorias(sub,e){
    var categoria = $($($(e).parents('.continer-subcategorias').siblings('.linea-categoria')[0]).find('.ccat')[0]).html().trim();
    var str=categoria+'_'+sub;
    var str_comp=$('#i-subcategorias').val()+str+',';
    $('#i-subcategorias').val(str_comp);
}

function addSubcategoria(){
    var cat =$($($(this).siblings('.cifn')[0]).find('input')[0]).val();
    $($($(this).siblings('.cifn')[0]).find('input')[0]).val('');
    if(cat!='' && !existeSubcategoria(cat,this)){
        actualizarSubcategorias(cat,this);
        var contenido = '<div class="lineanfn bb1 linea-subcategoria anim-g">'+
                                '<div class="cifn-c fill-cc csub">'+
                                    cat+
                                '</div>'+
                                '<figure class="close close-subcat anim-g adaptar-img"></figure>'+
                            '</div>';
        var altoa=$(this).parents('.continer-subcategorias').height();
        $(this).parents('.continer-subcategorias').height((altoa+36));
        $(contenido).insertBefore($(this).parents('.lineafn'));
        categorias();
    }
}

function existeCategoria(cat){
    cat = cat.toUpperCase();
    var cats=$('.ccat');
    var n = $('.ccat').length;
    var existe=false;
    for(i=0;i<n && !existe;i++){
        var ccat=$(cats[i]).html().trim().toUpperCase();
        if(ccat==cat){
            existe=true;
        }
    }
    return existe;
}

function addCategoria(){
    var cat = $('#categoriaf').val();
    $('#categoriaf').val('');
    if(cat!='' && !existeCategoria(cat)){
        actualizarCategorias(cat);
        var contenido = '<div class="cubre-categoria">'+
                            '<div class="lineanfn bb linea-categoria anim-g">'+
                                '<div class="cifn-c fill-cc ccat">'+
                                    cat+
                                '</div>'+
                                '<figure class="close close-cat anim-g adaptar-img"></figure>'+
                            '</div>'+
                            '<ul class="continer-subcategorias anim-g">'+
                                '<div class="lineafn bb">'+

                                    '<div class="cifn">'+
                                        '<input type="text" name="subcategoriaf" id="subcategoriaf" placeholder="subcategoria...">'+
                                    '</div>'+
                                    '<figure class="boton-subcategorias boton-fn add anim-g adaptar-img"></figure>'+
                                '</div>'+
                            '</ul>'+
                        '</div>';
        $(contenido).insertBefore('#catf');
        categorias();
    }
}

function desplegar_sub(){
    if($($(this).parent('.cubre-categoria')).find('.continer-subcategorias').height()>0){
        $($(this).parent('.cubre-categoria')).find('.continer-subcategorias').height(0);
    }else{
        replegarTodos();
        var subs=$($(this).parent('.cubre-categoria')).find('.linea-subcategoria');
        var n=$(subs).length;
        var alto=(n*36)+55;
        $($(this).parent('.cubre-categoria')).find('.continer-subcategorias').height(alto);
    }
}

function replegarTodos(){
    $('.continer-subcategorias').height(0);
}

function admin(){
    $('#menu .item-menu').click(desplegarSubmenu);
}

function replegarTodosS(){
    $('.hidden-menu').height(0);
}

function desplegarSubmenu(){
    if($($(this).parent('.cubre-menu')).find('.hidden-menu').height()>0){
        $($(this).parent('.cubre-menu')).find('.hidden-menu').height(0);
    }else{
        replegarTodosS();
        var subs=$($(this).parent('.cubre-menu')).find('.item-submenu');
        var n=$(subs).length;
        var alto=(n*26);
        $($(this).parent('.cubre-menu')).find('.hidden-menu').height(alto);
    }
}