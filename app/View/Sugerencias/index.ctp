<h3 class="Titulo">Gestión Sugerencias</h3>
<table class="table table-bordered datatable">
    <thead>
      <tr>
        <th>#</th>
        <th>Usuario</th>
        <th>Texto</th>
        <th>Fecha de creación</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
     
      <?php 
        if(isset($sugerencias)){
          foreach ($sugerencias as $index => $sugerencia) { ?>
            <tr>
              <td><?php echo $index+1 ?></td>
              <td><?php echo $sugerencia['User']['username'] ?></td>
             <!-- Obtener Texto de Sugerencia --> 
              <?php if(strlen($sugerencia['Sugerencia']['texto']) > 80) { 
              ?>
                <td><?php echo substr($sugerencia['Sugerencia']['texto'],0,80) ?>...</td>
              <?php 
              } 
              else{ 
              ?>
                <td><?php echo $sugerencia['Sugerencia']['texto'] ?></td>
              <?php 
              }
              ?>
             <!-- Obtener Texto de Sugerencia --> 
              <td><?php echo $sugerencia['Sugerencia']['created'] ?></td>
              <td>
                <a href="/Hop/Sugerencias/view/<?php echo $sugerencia['Sugerencia']['id'] ?>">
                  <i class='icon icon-zoom-in'></i>
                </a>
                <a href="/Hop/Sugerencias/edit/<?php echo $sugerencia['Sugerencia']['id'] ?>">
                  <i class='icon icon-edit'></i>
                </a>
                <a href="/Hop/Sugerencias/delete/<?php echo $sugerencia['Sugerencia']['id'] ?>" onclick="return confirm('Está seguro que desea eliminar la sugerencia ?');">
                  <i class='icon icon-remove'></i>
                </a>
              </td>
            </tr>
    <?php } 
        } else{ ?>
          <tr>
            <td colspan='3'>No hay Sugerencias en la Base de Datos</td>
          </tr>
      <?php } ?>
    </tbody>
</table>
