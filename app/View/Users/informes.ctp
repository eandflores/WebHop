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
  <form class="form-horizontal well" enctype="multipart/form-data" method="post" accept-charset="utf-8" action="/Hop/Solicituds/informe">
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

  <form class="form-horizontal well" enctype="multipart/form-data" method="post" accept-charset="utf-8" action="/Hop/Locals/informe">
    <fieldset>
      <legend>Informe de locales agregados por rango de fechas</legend>
      <div class="control-group">
          <label class="control-label" for="inputFechaIni2">Fecha Inicio:</label>
          <div class="controls">
            <input type="date" id="inputFechaIni2" name="fechaIni2" value="<?php echo date("Y-m-d"); ?>" required>
          </div>
          <label class="control-label" for="inputFechaFin2">Fecha Fin:</label>
          <div class="controls">
            <input type="date" id="inputFechaFin2" name="fechaFin2" value="<?php echo date("Y-m-d"); ?>" required>
          </div>
          <div class="controls">
            <select name="tipoLocal">
              <option value="Todos">Todos</option>
              <option value="Administrados">Administrados</option>
              <option value="SinAdministrar">Sin Administrar</option>
            </select>
          </div>
          <div class="controls">
            <input type="submit" class="btn btn-primary" name="btn2" value="Generar" required>
          </div>

      </div>
    </fieldset>
  </form>

  <form class="form-horizontal well" enctype="multipart/form-data" method="post" accept-charset="utf-8" action="/Hop/Users/informe">
    <fieldset>
      <legend>Informe de usuarios agregados por rango de fechas</legend>
      <div class="control-group">
          <label class="control-label" for="inputFechaIni3">Fecha Inicio:</label>
          <div class="controls">
            <input type="date" id="inputFechaIni3" name="fechaIni3" value="<?php echo date("Y-m-d"); ?>" required>
          </div>
          <label class="control-label" for="inputFechaFin3">Fecha Fin:</label>
          <div class="controls">
            <input type="date" id="inputFechaFin3" name="fechaFin3" value="<?php echo date("Y-m-d"); ?>" required>
          </div>
          <div class="controls">
            <select name="rolUsuario">
              <option value="Todos">Todos</option>
              <option value="1">Administrador</option>
              <option value="2">Usuario</option>
              <option value="3">Local</option>
            </select>
          </div>
          <div class="controls">
            <input type="submit" class="btn btn-primary" name="btn3" value="Generar" required>
          </div>

      </div>
    </fieldset>
  </form>
  <form class="form-horizontal well" enctype="multipart/form-data" method="post" accept-charset="utf-8" action="/Hop/Productos/informe">
    <fieldset>
      <legend>Informe de productos agregadas por rango de fechas</legend>
      <div class="control-group">
          <label class="control-label" for="inputFechaIni4">Fecha Inicio:</label>
          <div class="controls">
            <input type="date" id="inputFechaIni4" name="fechaIni4" value="<?php echo date("Y-m-d"); ?>" required>
          </div>
          <label class="control-label" for="inputFechaFin4">Fecha Fin:</label>
          <div class="controls">
            <input type="date" id="inputFechaFin4" name="fechaFin4" value="<?php echo date("Y-m-d"); ?>" required>
          </div>
      </div>
      <div class="control-group">
          <label class="control-label" for="selectCategoria">Categoría:</label>
          <div class="controls">
            <select id="selectCategoria" name="categoria">
              <option value="Todas">Todas</option>
              <?php
              foreach ($categorias as $index => $categoria) { ?>
                  <option value="<?php echo $categoria['CategoriaProducto']['id']; ?>"><?php echo $categoria['CategoriaProducto']['nombre']; ?></option>         
        <?php } ?>
            </select>
          </div>
          <label class="control-label" for="selectSubcategoria">Subcategoría:</label>
          <div class="controls">
            <select id="selectSubcategoria" name="subcategoria">
              <option name="Todas" value="Todas">Todas</option>
              <?php
              foreach ($subcategorias as $index => $subcategoria) { ?>
                  <option name="<?php echo $subcategoria['SubcategoriaProducto']['categoria_producto_id']; ?>" value="<?php echo $subcategoria['SubcategoriaProducto']['id']; ?>"><?php echo $subcategoria['SubcategoriaProducto']['nombre']; ?></option>         
        <?php } ?>
            </select>
          </div>
          <div class="controls">
            <input type="submit" class="btn btn-primary" name="btn4" value="Generar" required>
          </div>
      </div>
    </fieldset>
  </form>
  <form class="form-horizontal well" enctype="multipart/form-data" method="post" accept-charset="utf-8" action="/Hop/Ofertas/informe">
    <fieldset>
      <legend>Informe de ofertas agregadas por rango de fechas</legend>
      <div class="control-group">
          <label class="control-label" for="inputFechaIni7">Fecha Inicio:</label>
          <div class="controls">
            <input type="date" id="inputFechaIni7" name="fechaIni7" value="<?php echo date("Y-m-d"); ?>" required>
          </div>
          <label class="control-label" for="inputFechaFin7">Fecha Fin:</label>
          <div class="controls">
            <input type="date" id="inputFechaFin7" name="fechaFin7" value="<?php echo date("Y-m-d"); ?>" required>
          </div>
      </div>
      <div class="control-group">
          <label class="control-label" for="selectLocal">Local:</label>
          <div class="controls">
            <select id="selectLocal" name="local">
              <option name="Todos" value="Todos">Todos</option>
              <?php
              foreach ($locales as $index => $local) { ?>
                  <option value="<?php echo $local['Local']['id']; ?>"><?php echo $local['Local']['nombre']; ?></option>         
        <?php } ?>
            </select>
          </div>
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
            <input type="submit" class="btn btn-primary" name="btn7" value="Generar" required>
          </div>
      </div>
    </fieldset>
  </form>
  <form class="form-horizontal well" enctype="multipart/form-data" method="post" accept-charset="utf-8" action="/Hop/Locals/informe_anulados">
    <fieldset>
      <legend>Informe de locales anulados por rango de fechas</legend>
      <div class="control-group">
          <label class="control-label" for="inputFechaIni5">Fecha Inicio:</label>
          <div class="controls">
            <input type="date" id="inputFechaIni5" name="fechaIni5" value="<?php echo date("Y-m-d"); ?>" required>
          </div>
          <label class="control-label" for="inputFechaFin5">Fecha Fin:</label>
          <div class="controls">
            <input type="date" id="inputFechaFin5" name="fechaFin5" value="<?php echo date("Y-m-d"); ?>" required>
          </div>
          <div class="controls">
            <select name="tipoLocalAnulado">
              <option value="Todos">Todos</option>
              <option value="Administrados">Administrados</option>
              <option value="SinAdministrar">Sin Administrar</option>
            </select>
          </div>
          <div class="controls">
            <input type="submit" class="btn btn-primary" name="btn5" value="Generar" required>
          </div>

      </div>
    </fieldset>
  </form>
  <form class="form-horizontal well" enctype="multipart/form-data" method="post" accept-charset="utf-8" action="/Hop/Users/informe_anulados">
    <fieldset>
      <legend>Informe de usuarios anulados por rango de fechas</legend>
      <div class="control-group">
          <label class="control-label" for="inputFechaIni6">Fecha Inicio:</label>
          <div class="controls">
            <input type="date" id="inputFechaIni6" name="fechaIni6" value="<?php echo date("Y-m-d"); ?>" required>
          </div>
          <label class="control-label" for="inputFechaFin6">Fecha Fin:</label>
          <div class="controls">
            <input type="date" id="inputFechaFin6" name="fechaFin6" value="<?php echo date("Y-m-d"); ?>" required>
          </div>
          <div class="controls">
            <select name="rolUsuarioAnulado">
              <option value="Todos">Todos</option>
              <option value="1">Administrador</option>
              <option value="2">Usuario</option>
              <option value="3">Local</option>
            </select>
          </div>
          <div class="controls">
            <input type="submit" class="btn btn-primary" name="btn6" value="Generar" required>
          </div>

      </div>
    </fieldset>
  </form>
</div>
<script type="text/javascript">
  jQuery(document).ready(function() {  
    $('#selectCategoria').val('Todas');
    $('#selectSubcategoria').val('Todas');
    $('#selectLocal').val('Todos');
    $('#selectProducto').val('Todos');
    $('#selectMarca').val('Todas');

    $('#selectCategoria').change(function(){
      var valor = $(this).val();
      
      if(valor == "Todas"){
        $('#selectSubcategoria option').attr('disabled',false);
        $('#selectSubcategoria').val('Todas');
      }
      else{
        $('#selectSubcategoria option').attr('disabled',true);
        $('#selectSubcategoria').val('Todas');
      
        $('#selectSubcategoria option').each(function(){
          
          if($(this).attr('name') == valor || $(this).attr('name') == "Todas"){
            $(this).attr('disabled',false);
          }
        });
      }
    });
  });
</script>