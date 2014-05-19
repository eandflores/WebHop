<style type="text/css">
  
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
    <legend><?php echo "Sugerencia #".$sugerencia['Sugerencia']['id']?></legend>

    <?php 
    if(isset($sugerencia)){ ?>
      <ul class="view">
        <li>
          <span>Usuario => </span>
          <?php echo $sugerencia['User']['username'] ?>
        </li>
        <li>
          <span>Texto => </span>
          <?php echo $sugerencia['Sugerencia']['texto'] ?>
        </li>
        <li>
          <span>Fecha => </span>
          <?php echo $sugerencia['Sugerencia']['created'] ?>
        </li>
      </ul>
    <?php 
    } 
    else{ ?>
    No hay Sugerencias en la Base de Datos
    <?php 
    } ?>
    <a style ="margin-left:0px;" onclick="window.history.back()" class="Atras btn btn-danger">Atras</a>
  </div>
</div>
      
