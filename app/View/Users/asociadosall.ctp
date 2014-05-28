<div class="margenIndex">  
  <h3 class="Titulo">Gestión usuarioes</h3>
  <table class="table table-bordered datatable">
      <thead>
        <tr>
          <th>#</th>
          <th>Rut</th>
          <th>Username</th>
          <th>Estado</th>
          <th>Ver Locales</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          if(isset($usuarios)){
            foreach ($usuarios as $index => $usuario) { 
              if($usuario['User']['rol_id'] == 3)  {?>
                <tr>
                  <td><?php echo $index+1 ?></td>
                  <td><?php echo $usuario['User']['rut'] ?></td>
                  <td><?php echo $usuario['User']['username'] ?></td>
                  <?php if($usuario['User']['estado'] == true){ ?>
                    <td><?php echo "Habilitado" ?></td>
                  <?php } else{ ?>
                    <td><?php echo "Deshabilitado" ?></td>
                  <?php } ?>
                  <td>
                    <a href="/Hop/Users/asociadosview/<?php echo $usuario['User']['id'] ?>">
                      <i class='icon icon-zoom-in'></i>
                    </a>
                  </td>
                </tr>
      <?php   } 
            }
          } else{ ?>
            <tr>
              <td colspan='5'>No hay usuarios en la Base de Datos</td>
            </tr>
        <?php } ?>
      </tbody>
  </table>
</div>