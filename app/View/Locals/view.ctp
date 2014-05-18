<style type="text/css">
  
  #image{
    width: 100px;
    height: 100px;
    border-radius: 5px;
    border: 5px ridge lightgrey; 
    display: inline;
    margin-bottom: 15px;
  }

  #ver{
    padding: 20px;
    width: 700px;
    margin-left: 50px;
    margin-bottom: 15px;
    text-align: center;
  }

  #ver div{
    border-radius: 50px;
    border: 5px ridge lightgrey; 
    padding: 20px;
    width: 500px;
    margin: auto;
  }

</style>
<div id="ver">
  <div>
    <legend><?php echo "Local ".$local['Local']['nombre']?></legend>
    <?php 
      if(isset($local)){ ?>
        <ul class="view">
          <li>
            <img id="image" src="<?php echo $local['Local']['img'] ?>">
          </li>
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
            <?php } ?>
          </li>
          <li>
            <span>Categoría => </span>
            <?php echo $local['CategoriaLocal']['nombre'] ?>
          </li>
          <li>
            <span>Usuario => </span>
            <?php echo $local['User']['username']?>
          </li>
          <li>
            <span>Dirección => </span>
            <?php echo $local['Local']['calle']." ".$local['Local']['numero'] ?>
          </li>
          <li>
            <span>Comuna => </span>
            <?php echo $local['Comuna']['nombre'] ?>
          </li>
          <li>
            <span>Región => </span>
            <?php echo $local['Region']['nombre'] ?>
          </li>
          <li>
            <span>Teléfono Fijo => </span>
            <?php echo $local['Local']['telefono_fijo'] ?>
          </li>
          <li>
            <span>Teléfono Móvil => </span>
            <?php echo $local['Local']['telefono_movil'] ?>
          </li>
          <li>
            <span>Email => </span>
            <?php echo $local['Local']['email'] ?>
          </li>
          <li>
            <span>Sitio Web => </span>
            <?php echo $local['Local']['sitio_web'] ?>
          </li>
          <li>
            <span>Última Actualización => </span>
            <?php echo $local['Local']['modified'] ?>
          </li>
        </ul>
    <?php 
      } 
      else{ ?>
        <li>No hay Locales en la Base de Datos
    <?php 
      } ?>
        </tbody>
    </table>
    <a style ="margin-left:0px;" onclick="window.history.back()" class="Atras btn btn-danger">Atras</a>
  </div>
</div>