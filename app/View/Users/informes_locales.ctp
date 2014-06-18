<style type="text/css">
  .form-horizontal .controls{
    float:left;
    margin-left:25px;
  }
  .invisible{
    display:none;
  }
</style>
<div style="margin-right:50px">
  <h3 style="margin-left:50px">Reportes de Gestión</h3>
  <form class="form-horizontal well" enctype="multipart/form-data" method="post" accept-charset="utf-8" action="/Hop/Solicituds/informe_local">
    <fieldset>
      <legend>Informe de solicitudes por rango de fechas</legend>
      <div class="control-group">
          <label class="control-label" for="inputFechaIni1">Fecha Inicio:</label>
          <div class="controls">
            <input type="date" id="inputFechaIni1" name="fechaIni1" value="<?php echo date("Y-m-d"); ?>" required>
          </div>
          <label class="control-label" for="inputFechaFin1">Fecha Fin:</label>
          <div class="controls">
            <input type="date" id="inputFechaFin1" name="fechaFin1" value="<?php echo date("Y-m-d"); ?>" required>
          </div>
      </div>
      <div class="control-group">
          <label class="control-label">Tipo:</label>
          <div class="controls">
            <select name="estado">
              <option value="Creadas">Creadas</option>
              <option value="Todos">Aprobadas/Rechazadas</option>
              <option value="Aprobado">Aceptadas</option>
              <option value="Rechazado">Rechazadas</option>
            </select>
          </div>
          <div class="controls">
            <input type="submit" class="btn btn-primary" name="btn1" value="Generar" required>
          </div>
      </div>
    </fieldset>
  </form>
  <form class="form-horizontal well" enctype="multipart/form-data" method="post" accept-charset="utf-8" action="/Hop/Ofertas/informe_local">
    <fieldset>
      <legend>Informe de ofertas agregadas por rango de fechas</legend>
      <div class="control-group">
          <label class="control-label" for="inputFechaIni2">Fecha Inicio:</label>
          <div class="controls">
            <input type="date" id="inputFechaIni2" name="fechaIni2" value="<?php echo date("Y-m-d"); ?>" required>
          </div>
          <label class="control-label" for="inputFechaFin2">Fecha Fin:</label>
          <div class="controls">
            <input type="date" id="inputFechaFin2" name="fechaFin2" value="<?php echo date("Y-m-d"); ?>" required>
          </div>
      </div>
      <div class="control-group">
          <label class="control-label" for="selectProducto">Producto:</label>
          <div class="controls">
            <select id="selectProducto" name="producto">
              <option name="Todos" value="Todos">Todos</option>
              <?php
              foreach ($productos as $index => $producto) { ?>
                  <option value="<?php echo $producto['Producto']['id']; ?>"><?php echo $producto['Producto']['nombre']; ?></option>         
        <?php } ?>
            </select>
          </div>
          <label class="control-label" for="selectMarca">Marca:</label>
          <div class="controls">
            <select id="selectMarca" name="marca">
              <option name="Todas" value="Todas">Todas</option>
              <?php
              foreach ($marcas as $index => $marca) { ?>
                  <option value="<?php echo $marca['Oferta']['marca'] ?>"><?php echo $marca['Oferta']['marca']; ?></option>         
        <?php } ?>
            </select>
          </div>
          <div class="controls">
            <input type="submit" class="btn btn-primary" name="btn2" value="Generar" required>
          </div>
      </div>
    </fieldset>
  </form>
</div>
<script type="text/javascript">
  jQuery(document).ready(function() {  
    $('#selectProducto').val('Todos');
    $('#selectMarca').val('Todas');
  });
</script>