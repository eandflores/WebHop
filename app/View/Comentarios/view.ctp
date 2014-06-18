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
    <legend><?php echo "Comentario #".$comentario['Comentario']['id']?></legend>
    <?php 

    if(isset($comentario)){ ?>
      <ul class="view">
        <li>
          <span>Usuario => </span>
          <?php echo $comentario['User']['username'] ?>
        </li>
        <li>
          <span>Texto => </span>
          <?php echo $comentario['Comentario']['texto'] ?>
        </li>
        <li>
          <span>Local => </span>
          <?php echo $comentario['Local']['nombre'] ?>
        </li>
        <li>
          <span>Fecha => </span>
          <?php echo $comentario['Comentario']['created'] ?>
        </li>
      </ul>
      
    <?php 
    } 
    else{ ?>
    No hay Comentarios en la Base de Datos
    <?php 
    } ?>
    <a style ="margin-left:0px;" onclick="window.history.back()" class="Atras btn btn-danger">Atras</a>
  </div>
</div>          
