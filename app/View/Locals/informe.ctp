<div class="margenIndex">
    <?php 
      $mensaje = '';

      if($tipoLocal == "Todos"){ 
        $mensaje = "Listado Locales Creados (".$fecha_inicio."/".$fecha_fin.")"; 
      } else if($tipoLocal == "Administrados"){ 
        $mensaje = "Listado Locales Administrados Creados (".$fecha_inicio."/".$fecha_fin.")"; 
      } else{ 
        $mensaje = "Listado Locales Sin Administrar Creados (".$fecha_inicio."/".$fecha_fin.")"; 
      } 
    ?>
  <h3 class="Titulo"><?php echo $mensaje?></h3>
  <input type="hidden" class="TituloExport" value='<?php echo $mensaje ?>'>
  
  <table class="table table-bordered datatable">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre</th>
          <th>Estado</th>
          <th>Categoría</th>
          <th>Usuario</th>
          <?php if($tipoLocal != "SinAdministrar") { ?>
            <th>Administrador</th>
          <?php } ?>
          <th>Vistas</th>
          <th>Votos Positivos</th>
          <th>Votos Negativos</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          if(isset($locales)){

            $json_positivos = array(); 
            $json_negativos = array(); 
            $json_visitas   = array();

            $json_positivos_aux = array(); 
            $json_negativos_aux = array(); 
            $json_visitas_aux = array(); 

            foreach ($locales as $index => $local) { ?>
              <tr>
                <td><?php echo $index+1; ?></td>
                <td><?php echo $local['Local']['nombre']; ?></td>
                <?php if($local['Local']['estado'] == true){ ?>
                        <td><?php echo "Habilitado" ?></td>
                      <?php } else{ ?>
                        <td><?php echo "Deshabilitado" ?></td>
                      <?php } ?>
                <td><?php echo $local['CategoriaLocal']['nombre']; ?></td>
                <td><?php echo $local['User']['username']; ?></td>
                <?php if($tipoLocal != "SinAdministrar") { ?>
                  <td>
                    <?php 
                      foreach ($usuarios as $index => $usuario) { 
                          if($usuario['User']['id'] == $local['Local']['admin_id']){
                            echo $usuario['User']['username']; 
                            break;
                          }
                      }
                    ?>
                  </td>
                <?php } ?>
                <td><?php echo $local['Local']['visitas']; ?></td>
                <?php 
                  $votos_positivos = 0;
                  $votos_negativos = 0;

                  foreach ($votos as $index => $voto) { 
                    if($voto['VotosLocal']['local_id'] == $local['Local']['id']){
                      if($voto['VotosLocal']['tipo'] == "positivo")
                        $votos_positivos += 1;
                      else
                        $votos_negativos += 1;
                    }
                  }
                ?>
                <td><?php echo $votos_positivos ?></td>
                <td><?php echo $votos_negativos ?></td>
                <td>
                  <?php echo substr($local['Local']['created'],0,10); ?>
                </td>
              </tr>
              <?php 
                $elemento1 = array($local['Local']['nombre'],$votos_positivos);
                $elemento2 = array($local['Local']['nombre'],$votos_negativos);
                $elemento3 = array($local['Local']['nombre'],$local['Local']['visitas']);

                array_push($json_positivos_aux,$elemento1); 
                array_push($json_negativos_aux,$elemento2);
                array_push($json_visitas_aux,$elemento3);  
            } 

            function sortBy($a, $b) {
                return $b[1] - $a[1];
            }

            usort($json_positivos_aux,'sortBy');
            usort($json_negativos_aux,'sortBy');

            $otros1 = array('Otros',0);
            $otros2 = array('Otros',0);
            $otros3 = array('Otros',0);

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

            foreach ($json_positivos_aux as $index => $v) {
              if($index < 10){
                array_push($json_positivos,$v);
              }  
              else{
                $otros2[1] += $v[1];
              }
            }

            if($otros2[1] > 0)
              array_push($json_positivos,$otros2);

            foreach ($json_negativos_aux as $index => $v) {
              if($index < 10){
                array_push($json_negativos,$v);
              }  
              else{
                $otros3[1] += $v[1];
              }
            }

            if($otros3[1] > 0)
              array_push($json_negativos,$otros3);

            $json_positivos = json_encode($json_positivos);
            $json_negativos = json_encode($json_negativos);
            $json_visitas = json_encode($json_visitas);
          } 
          else{ ?>
            <tr>
              <td colspan='8'>No hay locales en la Base de Datos.</td>
            </tr>
    <?php } ?>
      </tbody>
  </table>
  <a href="javascript:void(0)" class="Agregar btn btn-primary" style="visibility:hidden">Agregar</a>
  </br>
  <div id="container1" class="containerGraph"></div>
  <div id="container2" class="containerGraph"></div>
  <div id="container3" class="containerGraph" style="margin-left:25%"></div>
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
            text: 'Grafico locales mas votados positivo'
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
            data: <?php echo $json_positivos; ?>
        }]
    });

    $('#container2').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: 'Grafico locales mas votados negativo'
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
            data: <?php echo $json_negativos; ?>
        }]
    });

    $('#container3').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: 'Grafico locales mas visitados'
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