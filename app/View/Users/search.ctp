<style type="text/css">

#propuestos{
    width: 700px;
    overflow: hidden;
}

#view{
    margin-top: 15px; 
    overflow: hidden;
}

#view li{
    margin-right: 15px;
    display: inline;
    float: left;
    color:#d44413;
    margin-left: 0px;
    text-align: left;
}

form.clearfix span{
    font-size: 16px;
    margin-left: 0px;
}

form.clearfix {
    margin-bottom: 10px;
    margin-left: 0px;
}

#search-container {
    width: 700px;
}

#search-container h3{
    text-transform:capitalize;
    font-size: 16px;
    text-align: center;
}

/*Comentarios*/

#comentarios{
        font-size: 14px;
        max-height: 592px;
        float: left;
        margin-left: 50px;
}

    .comment_box{
    background-color:#D3E7F5; border-bottom:#ffffff solid 1px;
    padding-top:3px;
    }

    /**{margin:0;padding:0;}*/
    
    
    ol.timeline{
        overflow-y: scroll;
        max-height: 440px;
        margin-left: 0px;
        list-style:none;
    }

    ol.timeline li{ 
        padding: 5px;
        margin: 0px;
        position:relative;
        border-bottom:1px dashed #000;
        line-height:1.1em; 
        background-color:#D3E7F5; 
        overflow:hidden;
    }

    ol.timeline li div{ 
        width: 350px;
        float: left;
        overflow: hidden;
    }

    ol.timeline li img{ 
        width: 50px;
        height: 50px;
        float: left;
        margin-right: 5px;
    }

    ol.timeline li a{ 

        display: inline;
        text-decoration: none;
        color:#009DE7;
    }

    /*ol.timeline li a:hover{ 
        display: inline-block;
        text-decoration: none;
        color:#009DE7;
    }*/

    ol.timeline li:first-child{
        border-top:1px dashed #000;
    }

    #encabezado {
        /*width: 350px;*/
        margin-top: 30px;
        overflow: hidden;
    }

    #encabezado img{
        width: 48px;
        height: 48px;
        border-radius: 5px;
        border: 4px ridge lightgrey;
        margin-left: 20px;
        margin-right: 10px;
        float: left;
    }
    #encabezado h3{
        display: inline-block;
        float: left;
    }

/*Fin Comentarios*/

#wraperResultados{
        min-height: 600px;
    }


    #filter-container {
        font-size: 14px;
        width: 250px;
        height: 500px;
        float: left;
        overflow: hidden;
    }

    #filter-container h2 {
    font-size: 16px;
    text-align: center;
    font-weight: bold;
    margin-bottom: 0px;
    color: #009DE7;
    margin-top: 50px;
    }

    #filter-container>ul {
        list-style: none;
        padding: 0;
        font-size: 12px;
    }

    #filter-container>ul li {
        margin: 5px auto;
        width: 220px;
    }

    #filter-container>ul li a {
        display: block;
        color: #555555;
        border: 1px solid #E1E1E1;
        padding: 2px;
        text-align: center;
        text-decoration: none;
        font-weight: bold;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        background-color: #F5F5F5;
    }

    #filter-container a.important {
        padding: 5px 5px 5px 25px;
        background: rgb(239,137,4) url(image/icon.png) no-repeat 5px 4px;
    }

    #filter-container>ul a:hover {
        box-shadow: 0 0 3px #999999;
        -webkit-box-shadow: 0 0 3px #999999;
        -moz-box-shadow: 0 0 3px #999999;
    }

    #filter-container>ul a:visited {
        color: #555555;
    }

    #filter-container ul li ul li a#select-element {
        display: block;
        padding-left: 20px;
        border-left: 10px solid #DD4B39;
    }

    #map-container{
        left: 250px;
        float: left;
    }

    #map-container p {
        margin: 0;
    }

    .oculto {
        display: none;
    }

    .muestro {
        display: block;
    }

    #filter-pagination {
      height: 100px;
    }

    #medio{
        overflow: hidden;
        height: auto;
        margin-bottom: 10px;
        width: 100%;
    }

    #marker_izq{
        float: left;
        width: 180px;

    }

    #marker_izq img{
        width: 150px;
        height: 150px;
        display: block;
        margin: 5px; auto;
    }

    #marker_der{
        float: left;
        width: 150px;
        margin-left: 10px;

    }

    #marker_medio{
        overflow: hidden;
        width: auto;
    }

    #marker_total{
        overflow: hidden;
        padding: 10px;
        width: auto;
        margin-left: 13px;
    }

    #boton{
        margin-left: 53px;
    }

    .btn_agregar{
        width: 140px;
        color: #ffffff;
        margin-bottom: 0px;
        margin-top: 20px;
        margin-left: 0px;
    } 

    #votos{
        float: left;
        margin-left: 15px;
    }

    #votos img{
        width: 20px;
        height: 20px;
        float-right;
        margin-left: 15px;
    }

    #ver_comentarios{
        float: left;
        width: 225px;
    }


</style>
    
<div id = "medio">
    <input id="localId" type="hidden" name="local_id" value="<?php echo $loc_id; ?>">
    <div >
        <div id="filter-container">
            <?php 
            if(!empty($buscado_local)){
                echo "<h2>Locales</h2>\n";
                echo "<ul id='resultados'>\n";
                
                foreach($buscado_local as $index => $local){
                ?>
                    <li class="muestro">
                        <a id="<?php echo $local['Local']['id'] ?>" href="javascript:void(<?php echo $index;?>);" name="<?php echo $index;?>" class="localesListado" onclick="show(<?php echo $index;?>)" ><?php echo $local['Local']['nombre']; ?></a>
                    </li>
                <?php
                    
                }
                echo "</ul>\n";
            }
                 
            if(!empty($buscado_local)){  
                ?>
                <div class='pagination pagination-centered' id='filter-pagination'>
                </div>  

                <div>
                    <a href="/Hop/Locals/add" id="boton" class=" btn_agregar Agregar btn btn-primary">Agregar nuevo local</a>
                </div>
        <?php } ?> 
        </div>
    </div>

    <div id="map-container">

        <div id="propuestos">
            <?php 
            if(!empty($buscadoN)){ ?>
                <h3>Quizas quisiste decir :</h3>
                <ul id="view">
                    <?php
                    foreach($buscadoN as $index => $pruepuesto){
                    ?>
                        <li>
                            <form action="/Hop/Users/search" method="post" name="formulario" class="clearfix">
                                <span ><?php echo $pruepuesto['Producto']['nombre']; ?> </span>
                                <input type="hidden" name="nombre" value="<?php echo $pruepuesto['Producto']['nombre']; ?>">
                                <button type='submit'><i class='icon-search'></i></button> 
                            </form> 
                        </li>
                    <?php } ?>
                </ul> 
                
            <?php } ?>
        </div>

        <div id="search-container" class="clearfix">
            <form action="/Hop/Users/search" method="post" name="formulario" class="clearfix">
                <input name="nombre" type="text" value=""/>
                <button type='submit'><i class='icon-search'></i></button>  
            </form> 

            <?php
                if(!empty($nombre)){
                    echo "<h3>$nombre</h3>\n";
                }
            ?>
        </div>
    
       <?= $this->Html->script('http://maps.google.com/maps/api/js?sensor=false', false); ?>

            <?php
                  $map_options = array(
                    'id'         => 'map',
                    'width'      => '700px',
                    'height'     => '500px',
                    'localize'   => false,
                    'style' => '',
                    'zoom'       => 15,
                    "type"       => "MAPS",
                    'marker'     => false, 
                    'markerTitle' => 'Centro de Concepcion',
                    'infoWindow' => false,
                  );

                ?>

                <?= $this->GoogleMap->map($map_options); ?>

                <?php 

                    if(!empty($buscado_local)){ 

                        foreach($buscado_local as $index => $local){     
                            $nombreLoc = $local['Local']['nombre'];
                            $local_id = $local['Local']['id'];
                            $img = $local['Local']['img'];
                            $direccion = $local['Local']['calle']." ".$local['Local']['numero'].", Concepcion";
                            if ($local['Local']['telefono_fijo'] != null)
                                $fijo = $local['Local']['telefono_fijo']."/";
                            else 
                                $fijo = $local['Local']['telefono_fijo'];
                            $movil = $local['Local']['telefono_movil'];
                            $web = $local['Local']['sitio_web'];
                            $email = $local['Local']['email'];
                            $like = "/Hop/img/like.png";
                            $dislike = "/Hop/img/dislike.png";
                            $votos_negativos = $VotosLocal->find('count', array('conditions' => array('VotosLocal.tipo' => 'negativo' , 'VotosLocal.local_id' => $local_id)));
                            $votos_positivos = $VotosLocal->find('count', array('conditions' => array('VotosLocal.tipo' => 'positivo' , 'VotosLocal.local_id' => $local_id)));

                            $windowText =  "<div id=\"marker_total\"><div id=\"marker_medio\"><div id=\"marker_izq\"><p><b>$nombreLoc</b></p><img src= \" $img\">$direccion<br>$fijo$movil<br>$web<br>$email</div><div id=\"marker_der\"><a href=\"/Hop/Ofertas/view/$local_id\" class=\"btn_agregar Agregar btn btn-primary\">Ver productos</a><br><a href=\"/Hop/Locals/edit/$local_id\" class=\"btn_agregar Agregar btn btn-primary\">Editar información</a></div></div><br><div id=\"ver_comentarios\"><a href=\"/Hop/Users/search?loc=$local_id&nomb=$nombre\" id=\"mostrar\">VER VOMENTARIOS...</a></div><div id=\"votos\"><a href=\"/Hop/VotosLocals/add?loc=$local_id&nomb=$nombre&tipo=positivo\"><img src= \" $like\"></a>$votos_positivos<a href=\"/Hop/VotosLocals/add?loc=$local_id&nomb=$nombre&tipo=negativo\"><img src= \" $dislike\"></a>$votos_negativos</div></div>";

                            $marker_options = array(
                                "showWindow"   => true,
                                "windowText"   => $windowText,
                                "markerTitle"  => $local['Local']['nombre']
                             );

                            echo $this->GoogleMap->addMarker("map", $index+1, "$direccion", $marker_options);
                        }
                    }
                ?>     
    </div>

    <?php if($loc_id!=null) { ?> 
        <div id="comentarios" >
        
            <div align="left">
                <div id="encabezado" align="left">
                    <?php 
                        foreach($buscado_local as $index => $local){
                            if($local['Local']['id'] == $loc_id){
                    ?>
                                <a id="<?php echo $local['Local']['id'] ?>" href="javascript:void(<?php echo $index;?>);" name="<?php echo $index;?>" class="localesListado" onclick="show(<?php echo $index;?>)" ><h3>Comentarios <?php echo $local['Local']['nombre'] ?></h3></a>
                                <a id="<?php echo $local['Local']['id'] ?>" href="javascript:void(<?php echo $index;?>);" name="<?php echo $index;?>" class="localesListado" onclick="show(<?php echo $index;?>)" ><img src="<?php echo $local['Local']['img'] ?>"></a>
                    <?php 
                            }                          
                        }
                    ?> 
                    
                </div>

                <?php if(isset($current_user["id"])) {?>
                    <form style="margin-left:0px;" method="post" name="form" action="/Hop/Comentarios/add/">
                        <table cellpadding="0" cellspacing="0" width="400px">
                            <tr>
                                <td style="padding:10px;" class="comment_box">
                                    <textarea cols="30" rows="2" style="width:400px; margin:auto; font-size:14px; font-weight:bold" name="texto" id="texto" maxlength="250" required></textarea><br />
                                    <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
                                    <input type="hidden" name="local_id" value="<?php echo $loc_id; ?>">
                                    <input type="hidden" name="user_id" value="<?php echo $current_user['id']; ?>">
                                    <input type="submit"  value="Comentar"  id="v" name="submit" class="btn btn-success"/>
                                </td>
                            </tr>
                        </table>
                    </form>
                <?php } ?>
            </div>

            <ol class="timeline">
                <?php
                if(isset($comentarios)){
                    $cont = 0;
                    foreach ($comentarios as $index => $comentario) { 
                        if($comentario['Local']['id'] == $loc_id) { $cont = 1; ?>
                            <li class=>                                
                                <a href="/Hop/Users/view/<?php echo $comentario['User']['id']; ?>"><img src="<?php echo $comentario['User']['img'] ?>"></a>
                                <div>
                                    <a href="/Hop/Users/view/<?php echo $comentario['User']['id']; ?>">
                                        <span style=" ">
                                            <!-- <b><?php echo $comentario['User']['nombre']." ".$comentario['User']['apellido_paterno']." ".$comentario['User']['apellido_materno'].":"; ?>
                                            </b> -->
                                            <b><?php echo $comentario['User']['username'].":"; ?>
                                            </b>
                                        </span>
                                    </a>
                                    <?php if($comentario['Comentario']['user_id'] == $current_user['id']){ ?>
                                        <span style="float:right; width:20px; height:20px"><a style = "color:#d02b55;" href="/Hop/Comentarios/delete?<?php echo "loc=".$loc_id."&"."nomb=".$nombre."&"."id=".$comentario['Comentario']['id']; ?>" id="<?php echo $comentario['Comentario']['id']; ?>"><b>X</b></a></span>  
                                    <?php } ?>
                                    <br>
                                    <span style="display:inline-block; width:340px; "><?php echo $comentario['Comentario']['texto']; ?> </span>  
                                    <br>                    
                                    <span style="float:right; margin-top:5px;"><?php echo $comentario['Comentario']['created']; ?></span>
                                </div>
                            </li> 
                        
                <?php } } if ($cont == 0) echo "No existen comentarios"; }?>
            </ol>            <?php } ?>
        
    </div>

<script type="text/javascript">
      $(document).ready(function(){

          var elements = $("#resultados").children("li");
          var a = elements.length;
          var cnt = parseInt(((a/10)+1));
          var html = '<ul>';

          for (var i = 0; i < cnt; i++) {
            html += "<li><a href='#' data-page='"+i+"' >"+(i+1)+"</a></li>";
          };

          html += "</ul>";

          $("#filter-pagination").html(html);

          $("#resultados").children("li").each(function(i){
            if(i > 9)
              $(this).addClass("oculto");
            else
              $(this).addClass("muestro");

          })

          $(".pagination ul li a").click(function(e){
              e.preventDefault();
              var page = $(this).data("page");
             $(".muestro").removeClass("muestro").addClass("oculto");
              $("#resultados").children("li").each(function(index){
                  if(index >= (page*10) && index <= ((page*10)+9)){
                    $(this).removeClass("oculto").addClass("muestro");
                  }
              })
          });
      });

      // window.onload = function(){
      //   $.each($('.localesListado'), function() {
      //       if($(this).attr('id') == $('#localId').val()){

      //           console.log($(this).attr('name'));
      //           show($(this).attr('name'));
                
      //       }
      //   });
      // };
</script>





