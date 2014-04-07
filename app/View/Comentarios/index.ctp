<h3 class="Titulo">Gestión Comentarios</h3>
<table class="table table-bordered datatable">
    <thead>
      <tr>
        <th>#</th>
        <th>Usuario</th>
        <th>Texto</th>
        <th>Local</th>
        <th>Fecha de creación</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
     
      <?php 
        if(isset($comentarios)){
          foreach ($comentarios as $index => $comentario) { ?>
            <tr>
              <td><?php echo $index+1 ?></td>
              <td><?php echo $comentario['User']['nombre'] ?></td>

             <!-- Inicio Obtener Texto de Comentario --> 
              <?php if(strlen($comentario['Comentario']['texto']) > 80) { 
              ?>
                <td><?php echo substr($comentario['Comentario']['texto'],0,80) ?>...</td>
              <?php 
              } 
              else{ 
              ?>
                <td><?php echo $comentario['Comentario']['texto'] ?></td>
              <?php 
              }
              ?>
             <!-- Fin Obtener Texto de Comentario --> 

              <td><?php echo $comentario['Local']['nombre'] ?></td>

              <td><?php echo $comentario['Comentario']['created'] ?></td>

              <td>
                <a href="/Hop/Comentarios/view/<?php echo $comentario['Comentario']['id'] ?>">
                  <i class='icon icon-zoom-in'></i>
                </a>
                <a href="/Hop/Comentarios/edit/<?php echo $comentario['Comentario']['id'] ?>">
                  <i class='icon icon-edit'></i>
                </a>
                <a href="/Hop/Comentarios/delete/<?php echo $comentario['Comentario']['id'] ?>" onclick="return confirm('Está seguro que desea eliminar la comentario ?');">
                  <i class='icon icon-remove'></i>
                </a>
              </td>
            </tr>
    <?php } 
        } else{ ?>
          <tr>
            <td colspan='3'>No hay Comentarios en la Base de Datos</td>
          </tr>
      <?php } ?>
    </tbody>
</table>
