<style type="text/css">

.comment_box
{
background-color:#D3E7F5; border-bottom:#ffffff solid 1px; padding-top:3px
}
a
    {
    text-decoration:none;
    color:#d02b55;
    }
    a:hover{
        text-decoration:underline;
        color:#d02b55;
    }
    *{margin:0;padding:0;}
    
    
    ol.timeline{
        list-style:none;font-size:1.2em;
    }

    ol.timeline li{ 
        /*display:none;*/
        position:relative;
        padding:.7em 0 .6em 0;
        border-bottom:1px dashed #000;
        line-height:1.1em; 
        background-color:#D3E7F5; height:45px
    }

    ol.timeline li:first-child{
        border-top:1px dashed #000;
    }

</style>


    <div align="center">
        <table cellpadding="0" cellspacing="0" width="500px">
            <tr>
                <td>

                <div align="left">
                    <form  method="post" name="form" action="">
                        <table cellpadding="0" cellspacing="0" width="500px">
                            <tr>
                                <td align="left"><div align="left"><h3>Comenta...</h3></div></td></tr>
                            <tr>
                                <td style="padding:4px; padding-left:10px;" class="comment_box">
                                    <textarea cols="30" rows="2" style="width:480px;font-size:14px; font-weight:bold" name="texto" id="texto" maxlength="145" ></textarea><br />
                                    <input type="submit"  value="Comentar"  id="v" name="submit" class="btn btn-success"/>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>

                <div style="height:7px"></div>
                <div id="flash" align="left"  ></div>

                <ol  id="update" class="timeline">
                    <?php
                    foreach ($comentarios as $index => $comentario) { ?>
                        <li class="bar<?php echo $comentario['Comentario']['id']; ?>">
                            <div align="left">
                            <span style=" padding:10px"><?php echo $comentario['Comentario']['texto']; ?> </span>
                            <span style="float:right; margin-right:10px; width:20px; height:20px"><a href="#" class="delete_update" id="<?php echo $comentario['Comentario']['id']; ?>"><b>X</b></a></span>
                        </li> 
                    <?php } ?>
                </ol>
                </td>
            </tr>
        </table>

        

<!--<form class="form-horizontal"  method="post">
    <fieldset>
        <legend>Escribir Comentario</legend>
        <div class="control-group">
            <label class="control-label" for="inputTexto">Comentario:</label>
            <div class="controls">
                <input type="text" id="inputTexto" name="texto" placeholder="Comentario" value="<?php if(!empty($texto)){ echo $texto; } ?>" maxlength="500" required>
                <textarea id="inputTexto" name="texto" rows="5" cols="50"></textarea>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Agregar</button>
            <button type="reset" class="btn btn-danger" onclick="window.location='/Hop/Comentarios'">Atras</button>
        </div>
    </fieldset>
</form> -->





