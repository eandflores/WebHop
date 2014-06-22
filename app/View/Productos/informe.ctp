<div class="margenIndex">
  <?php 
      $mensaje = '';

      if($categoria == "Todas" && $subcategoria == "Todas"){ 
        $mensaje = "Listado Productos Creados (".$fecha_inicio."/".$fecha_fin.")"; 
      } else if($subcategoria != "Todas"){ 
        $mensaje = "Listado Productos Subcategoria ".$subcat['SubcategoriaProducto']['nombre']." Creados (".$fecha_inicio."/".$fecha_fin.")"; 
      } else{ 
        $mensaje = "Listado Productos Categoria ".$cat['CategoriaProducto']['nombre']." Creados (".$fecha_inicio."/".$fecha_fin.")"; 
      } 
  ?>
  <h3 class="Titulo"><?php echo $mensaje; ?></h3>
  <input type="hidden" class="TituloExport" value='<?php echo $mensaje ?>'>

  <table class="table table-bordered datatable">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Subcategoría</th>
          <th>Categoría</th>
          <th>Usuario</th>
          <th>Visitas</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          if(isset($productos)){

            $json_visitas = array();
            $json_visitas_aux = array();

            foreach ($productos as $index => $producto) { ?>
              <tr>
                <td><?php echo $index+1 ?></td>
                <td><?php echo $producto['Producto']['nombre'] ?></td>
                <td><?php echo $producto['SubcategoriaProducto']['nombre'] ?></td>
                <td>
                  <?php 
                    foreach ($categorias as $index => $categ) { 
                      if($categ['CategoriaProducto']['id'] == $producto['SubcategoriaProducto']['categoria_producto_id']){
                        echo $categ['CategoriaProducto']['nombre'];
                      }
                    }
                  ?>
                </td>
                <td><?php echo $producto['User']['username']?></td>
                <td><?php echo $producto['Producto']['visitas'] ?></td>
                <td>
                  <?php echo substr($producto['Producto']['created'],0,10); ?>
                </td>
              </tr>
              <?php 
                $elemento = array($producto['Producto']['nombre'],$producto['Producto']['visitas']);

                array_push($json_visitas_aux,$elemento); 

            } 

            $otros = array('Otros',0);

            foreach ($json_visitas_aux as $index => $v) {
              if($index < 10){
                array_push($json_visitas,$v);
              }  
              else{
                $otros[1] += $v[1];
              }
            }

            if($otros[1] > 0)
              array_push($json_visitas,$otros);

            $json_visitas = json_encode($json_visitas);

          } else{ ?>
            <tr>
              <td colspan='7'>No hay Productos en la Base de Datos</td>
            </tr>
        <?php } ?>
      </tbody>
  </table>
  <a href="/Hop/Productos/add" class="Agregar btn btn-primary" style="visibility:hidden">Agregar</a>
  <div id="container" class="containerGraph" style="margin-left:25%"></div>
</div>
<script type="text/javascript">
  jQuery(document).ready(function() { 

    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: 'Grafico productos mas visitados'
        },
        tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: <?php echo $json_visitas; ?>
        }]
    });
  });
</script>