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

    <legend><?php echo "Usuario ".$usuario['User']['username']?></legend>
    <?php 
      if(isset($usuario)){ ?>
        <ul class="view">
          <li>
            <img id="image" src="<?php echo $usuario['User']['img'] ?>">
          </li>
          <li>
            <span>Username => </span>
            <?php echo $usuario['User']['username'] ?>
          </li>
          <li>
            <span>Nombre => </span>
            <?php echo $usuario['User']['nombre']." ".$usuario['User']['apellido_paterno']." ".$usuario['User']['apellido_materno'] ?>
          </li>
          <li>
            <span>Estado => </span>
            <?php if($usuario['User']['estado'] == true){ ?>
                    <?php echo "Habilitado" ?>
            <?php } 
                  else{ ?>
                    <?php echo "Deshabilitado" ?>
            <?php } ?>
          </li>
          <li>
            <span>Rol => </span>
            <?php echo $usuario['Rol']['nombre'] ?>
          </li>
          <li>
            <span>Fecha de Nacimiento => </span>
            <?php echo $usuario['User']['fecha_nacimiento']?>
          </li>
          <li>
            <span>Email => </span>
            <?php echo $usuario['User']['email'] ?>
          </li>
          <li>
            <span>Dirección => </span>
            <?php echo $usuario['User']['calle']." ".$usuario['User']['numero'] ?>
          </li>
          <li>
            <span>Comuna => </span>
            <?php echo $usuario['Comuna']['nombre'] ?>
          </li>
          <li>
            <span>Región => </span>
            <?php echo $usuario['Region']['nombre'] ?>
          </li>
          <li>
            <span>Teléfono Fijo => </span>
            <?php echo $usuario['User']['telefono_fijo'] ?>
          </li>
          <li>
            <span>Teléfono Móvil => </span>
            <?php echo $usuario['User']['telefono_movil'] ?>
          </li>
          <li>
            <span>Última Actualización => </span>
            <?php echo $usuario['User']['modified'] ?>
          </li>
        </ul>
    <?php 
      } 
      else{ ?>
        <li>No hay Usuarios en la Base de Datos
    <?php 
      } ?>

    <a style ="margin-left:0px;" onclick="window.history.back()" class="Atras btn btn-danger">Atras</a>
  </div>
</div>

