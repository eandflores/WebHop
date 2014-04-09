<?php 
if(isset($sugerencia)){ ?>
  <form class="form-horizontal">
    <fieldset>
    <legend><?php echo "Sugerencia #".$sugerencia['Sugerencia']['id']?></legend>

      <div class="form-group">
        <label for="inputUsuario" class="col-lg-2 control-label">Usuario</label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="inputEmail" readonly value="<?php echo $sugerencia['User']['nombre'] ?>">
          </div>
      </div>

      <div class="form-group">
        <label for="textArea" class="col-lg-2 control-label">Texto</label>
          <div class="col-lg-10">

            <textarea class="form-control" rows="3" id="textArea" readonly style="margin: 0px 5px 0px 0px; width: 430px; height: 159px;">
            <?php echo $sugerencia['Sugerencia']['texto'] ?>"
            </textarea>
          </div>
      </div>

      <div class="form-group">
        <label for="inputFecha" class="col-lg-2 control-label">Fecha</label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="inputFecha" readonly value="<?php echo $sugerencia['Sugerencia']['created'] ?>">
          </div>
      </div>

  </form>
<?php 
} 
else{ ?>
No hay Sugerencias en la Base de Datos
<?php 
} ?>
<a href="/Hop/Sugerencias" class="Atras btn btn-danger">Atras</a>
      
