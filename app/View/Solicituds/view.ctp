<?php 
if(isset($solicitud)){ ?>
  <form class="form-horizontal">
    <fieldset>
    <legend><?php echo "Solicitud #".$solicitud['Solicitud']['id']?></legend>

      <div class="form-group">
        <label for="inputEstado" class="col-lg-2 control-label">Estado: </label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="inputEstado" readonly value="<?php echo $solicitud['Solicitud']['estado'] ?>">
          </div>
      </div>

      <div class="form-group">
        <label for="textArea" class="col-lg-2 control-label">Consulta Sql: </label>
          <div class="col-lg-10">

            <textarea class="form-control" rows="3" id="textArea" readonly style="margin: 0px 5px 0px 0px; width: 430px; height: 159px;">
            <?php echo $solicitud['Solicitud']['sql'] ?>
            </textarea>
          </div>
      </div>

      <div class="form-group">
        <label for="inputAcción" class="col-lg-2 control-label">Acción: </label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="inputAcción" readonly value="<?php echo $solicitud['Solicitud']['accion'] ?>">
          </div>
      </div>

      <div class="form-group">
        <label for="inputTabla" class="col-lg-2 control-label">Tablas Afectadas: </label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="inputTabla" readonly value="<?php echo $solicitud['Solicitud']['tabla'] ?>">
          </div>
      </div>

      <div class="form-group">
        <label for="textArea" class="col-lg-2 control-label">Campos: </label>
          <div class="col-lg-10">

            <textarea class="form-control" id="textArea" readonly style="margin: 0px 0px 0px 0px; width: 430px; height: 159px;">
            <?php echo $solicitud['Solicitud']['campos'] ?>
            </textarea>
          </div>
      </div>

      <div class="form-group">
        <label for="inputFecha" class="col-lg-2 control-label">Fecha de Creación: </label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="inputFecha" readonly value="<?php echo $solicitud['Solicitud']['created'] ?>">
          </div>
      </div>

      <div class="form-group">
        <label for="inputFecha" class="col-lg-2 control-label">Fecha de Modificación: </label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="inputFecha" readonly value="<?php echo $solicitud['Solicitud']['modified'] ?>">
          </div>
      </div>

      <div class="form-group">
        <label for="inputUsuario" class="col-lg-2 control-label">Usuario Solicitante: </label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="inputUsuario" readonly value="<?php echo $solicitud['User']['nombre'] ?>">
          </div>
      </div>

      <div class="form-group">
        <label for="inputAdmin" class="col-lg-2 control-label">Administrador: </label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="inputAdmin" readonly value="<?php echo $solicitud['Solicitud']['admin_id'] ?>">
          </div>
      </div>

    </fieldset>
  </form>
<?php 
} 
else{ ?>
No hay Solicitudes en la Base de Datos
<?php 
} ?>

<form class="form-horizontal">
  <fieldset>
    <legend>Legend</legend>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="inputEmail" placeholder="Email">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Password</label>
      <div class="col-lg-10">
        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
        <div class="checkbox">
          <label>
            <input type="checkbox"> Checkbox
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Textarea</label>
      <div class="col-lg-10">
        <textarea class="form-control" rows="3" id="textArea"></textarea>
        <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Radios</label>
      <div class="col-lg-10">
        <div class="radio">
          <label>
            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
            Option one is this
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
            Option two can be something else
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="select" class="col-lg-2 control-label">Selects</label>
      <div class="col-lg-10">
        <select class="form-control" id="select">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
        <br>
        <select multiple="" class="form-control">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </fieldset>
</form>

<a href="/Hop/Sugerencias" class="Atras btn btn-danger">Atras</a>
      
