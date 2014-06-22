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

            $json_visitas   = array();
            $json_precios   = array();

            $json_visitas_aux = array();
            $json_precios_aux = array();

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
                $elemento1 = array($oferta['Producto']['nombre'],$oferta['Oferta']['visitas']);
                $elemento2 = array($oferta['Producto']['nombre'],$oferta['Oferta']['precio']);

                array_push($json_visitas_aux,$elemento1); 
                array_push($json_precios_aux,$elemento2); 
            } 

            function sortBy($a, $b) {
                return $b[1] - $a[1];
            }

            usort($json_precios_aux,'sortBy');

            $otros1 = array('Otros',0);

            foreach ($json_visitas_aux as $index => $v) {
              if($index < 10){
                array_push($json_visitas,$v);
              }  
              else{
                $otros1[1] += $v[1];
              }
            }

            if($otros1[1] > 0)
              array_push($json_visitas,$otros1);

            $otros2 = array('Otros',0);

            foreach ($json_precios_aux as $index => $v) {
              if($index < 30){
                array_push($json_precios,$v);
              }  
              else{
                $otros2[1] += $v[1];
              }
            }

            if($otros2[1] > 0)
              array_push($json_precios,$otros2);

            $json_visitas = json_encode($json_visitas);
            $json_precios = json_encode($json_precios);
          } 
          else{ ?>
            <tr>
              <td colspan='8'>No hay Ofertas en la Base de Datos</td>
            </tr>
      <?php } ?>
      </tbody>
  </table>
  <a href="/Hop/Ofertas/locales" class="Agregar btn btn-primary" style="visibility:hidden">Agregar</a>
  </br>
  <div id="container1" class="containerGraph"></div>
  <div id="container2" class="containerGraph"></div>
</div>
<script type="text/javascript">
  jQuery(document).ready(function() { 

    $('#container1').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: 'Grafico ofertas mas visitadas'
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

    $('#container2').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: 'Grafico ofertas mas costosas'
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
            data: <?php echo $json_precios; ?>
        }]
    });
  });
</script>