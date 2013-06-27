<h3><?php echo $local['Local']['nombre']?></h3>
<?php 
  if(isset($local)){ ?>
    <ul class="view">
      <li>
        <span>Nombre => </span>
        <?php echo $local['Local']['nombre'] ?>
      </li>
      <li>
        <span>Estado => </span>
        <?php if($local['Local']['estado'] == true){ ?>
                <?php echo "Habilitado" ?>
        <?php } 
              else{ ?>
                <?php echo "Deshabilitado" ?>
        <?php } ?></li>
      <li>
        <span>Categoría => </span>
        <?php echo $local['CategoriaLocal']['nombre'] ?></li>
      <li>
        <span>Usuario => </span>
        <?php echo $local['User']['username']?></li>
      <li>
        <span>Dirección => </span>
        <?php echo $local['Local']['calle']." ".$local['Local']['numero'] ?></li>
      <li>
        <span>Comuna => </span>
        <?php echo $local['Comuna']['nombre'] ?></li>
      <li>
        <span>Región => </span>
        <?php echo $local['Region']['nombre'] ?></li>
      <li>
        <span>Teléfono Fijo => </span>
        <?php echo $local['Local']['telefono_fijo'] ?></li>
      <li>
        <span>Teléfono Móvil => </span>
        <?php echo $local['Local']['telefono_movil'] ?></li>
      <li>
        <span>Email => </span>
        <?php echo $local['Local']['email'] ?></li>
      <li>
        <span>Sitio Web => </span>
        <?php echo $local['Local']['sitio_web'] ?></li>
      <li>
        <span>Votos Positivos => </span>
        <?php echo $local['Local']['votos_positivos'] ?></li>
      <li>
        <span>Votos Negativos => </span>
        <?php echo $local['Local']['votos_negativos'] ?></li>
      <li>
        <span>Última Actualización => </span>
        <?php echo $local['Local']['modified'] ?></li>
    </ul>
<?php 
  } 
  else{ ?>
    <li>No hay Locales en la Base de Datos
<?php 
  } ?>
    </tbody>
</table>