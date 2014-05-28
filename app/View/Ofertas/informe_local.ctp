<div class="margenIndex">
  <?php 
      $mensaje = '';

      if($producto == "Todos" && $marca == "Todas"){ 
        $mensaje = "Listado Ofertas Creadas (".$fecha_inicio."/".$fecha_fin.")"; 
      } else if($producto == "Todos"){ 
        $mensaje = "Listado Ofertas Marca ".$marca." Creados (".$fecha_inicio."/".$fecha_fin.")"; 
      } else if($marca == "Todas"){ 
        $mensaje = "Listado Ofertas Producto ".$product['Producto']['nombre']." Creados (".$fecha_inicio."/".$fecha_fin.")"; 
      } else{ 
        $mensaje = "Listado Ofertas Producto ".$product['Producto']['nombre']." Marca ".$marca." Creados (".$fecha_inicio."/".$fecha_fin.")"; 
      } 
  ?>
  <h3 class="Titulo"><?php echo $mensaje; ?></h3>
  <input type="hidden" class="TituloExport" value='<?php echo $mensaje ?>'>

  <table class="table table-bordered datatable">
      <thead>
        <tr>
          <th>#</th>
          <th>Producto</th>
          <th>Local</th>
          <th>Marca</th>
          <th>Precio</th>
          <th>Usuario</th>
          <th>Visitas</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          if(isset($ofertas)){
            foreach ($ofertas as $index => $oferta) { ?>
              <tr>
                <td><?php echo $index+1; ?></td>
                <td><?php echo $oferta['Producto']['nombre']; ?></td>
                <td><?php echo $oferta['Local']['nombre']; ?></td>
                <td><?php echo $oferta['Oferta']['marca']; ?></td>
                <td><?php echo $oferta['Oferta']['precio']; ?></td>
                <td><?php echo $oferta['User']['username']; ?></td>
                <td><?php echo $oferta['Oferta']['visitas']; ?></td>
                <td><?php echo substr($oferta['Oferta']['created'],0,10); ?></td>
              </tr>
            <?php 
            } 
          } 
          else{ ?>
            <tr>
              <td colspan='8'>No hay Ofertas en la Base de Datos</td>
            </tr>
      <?php } ?>
      </tbody>
  </table>
  <a href="/Hop/Ofertas/locales" class="Agregar btn btn-primary" style="visibility:hidden">Agregar</a>
</div>