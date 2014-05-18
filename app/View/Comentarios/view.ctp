<legend><?php echo "Comentario #".$comentario['Comentario']['id']?></legend>
<?php 

if(isset($comentario)){ ?>
  <ul class="view">
    <li>
      <span>Usuario => </span>
      <?php echo $comentario['User']['nombre'] ?>
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
<a href="/Hop/Comentarios" class="Atras btn btn-danger">Atras</a>
      
