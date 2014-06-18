<style type="text/css">
  
  #ver{
    padding: 20px;
    max-width: 90%;
    margin-left: 50px;
    margin-bottom: 15px;
    text-align: center;
  }

  #ver div{
    border-radius: 50px;
    border: 5px ridge lightgrey; 
    padding: 20px;
    margin: 0 auto;
  }

  ul.view{

  }

</style>

<div id="ver">
  <div>
    <legend><?php echo "Solicitud #".$solicitud['Solicitud']['id']?></legend>

    <?php 
    if(isset($solicitud)){ ?>
      <ul class="view">
        <li>
          <span>Estado => </span>
          <?php echo $solicitud['Solicitud']['estado'] ?>
        </li>
        <li>
          <span>Consulta Sql => </span>
          <?php echo $solicitud['Solicitud']['sql'] ?>
        </li>
        <li>
          <span>Acción => </span>
          <?php echo $solicitud['Solicitud']['accion'] ?>
        </li>
        <li>
          <span>Tabla Afectada => </span>
          <?php echo $solicitud['Solicitud']['tabla'] ?>
        </li>
        <li>
          <span>Campos => </span>
          <?php echo $solicitud['Solicitud']['campos'] ?>
        </li>
        <li>
          <span>Fecha de Creación => </span>
          <?php echo $solicitud['Solicitud']['created'] ?>
        </li>
        <li>
          <span>Fecha de Modificación => </span>
          <?php echo $solicitud['Solicitud']['modified'] ?>
        </li>
        <li>
          <span>Usuario Solicitante => </span>
          <?php echo $solicitud['User']['username'] ?>
        </li>
        <li>
          <span>Administrador => </span>
          <?php echo $admin_username ?>
        </li>
      </ul>
    <?php 
    } 
    else{ ?>
    No hay Solicitudes en la Base de Datos
    <?php 
    } ?>
    <a style ="margin-left:0px;" onclick="window.history.back()" class="Atras btn btn-danger">Atras</a>
  </div>
</div>
          
