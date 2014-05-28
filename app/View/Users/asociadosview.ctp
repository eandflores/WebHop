<div class="margenIndex">
  <h3 class="Titulo">Locales Asociados - <?php echo $usuario['User']['username'] ?> </h3>
  <form style="margin-left:0px;" method="post" id="formAsociados" action="/Hop/Users/asociadosadd/">
    <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Estado</th>
            <th>Rubro</th>
            <th>Desasociar</th>
          </tr>
        </thead>
        <tbody>
          <?php 

            $indice = 1;
            if(isset($locales)){ 
              foreach ($locales as $index => $local) { ?>
                  <tr>
                    <td><?php echo $indice; $indice ++; ?></td>
                    <td><?php echo $local['Local']['nombre'] ?></td>
                    <td><?php echo $local['Local']['calle']." #".$local['Local']['numero'].", ".$local['Comuna']['nombre'] ?></td>
                    <?php if($local['Local']['estado'] == true){ ?>
                      <td><?php echo "Habilitado" ?></td>
                    <?php } else{ ?>
                      <td><?php echo "Deshabilitado" ?></td>
                    <?php } ?>
                    <td><?php echo $local['CategoriaLocal']['nombre'] ?></td>
                    <td><a href="/Hop/Users/asociadosdelete/<?php echo $local['Local']['id'] ?>" onclick="return confirm('Está seguro que desea desasociar el local <?php echo $local['Local']['nombre'] ?> ?');">
                      <i class='icon icon-remove' ></i>
                    </a></td>
                  </tr>
          <?php 
              } 
            }
           else{ ?>
              <tr>
                <td colspan='5'>No hay Locales en la Base de Datos</td>
              </tr>
          <?php } ?>
        </tbody>
    </table>

    <legend>Asociar Nuevos Locales - <?php echo $usuario['User']['username'] ?> </legend>

    <table class="table table-bordered datatable">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Estado</th>
            <th>Rubro</th>
            <th>Selección</th>
          </tr>
        </thead>
        <tbody>
          <?php 

            $indice = 1;
            if(isset($locales_all)){ 
              foreach ($locales_all as $index => $local) { ?>
                  <tr>
                    <td><?php echo $indice; $indice ++; ?></td>
                    <td><?php echo $local['Local']['nombre'] ?></td>
                    <td><?php echo $local['Local']['calle']." #".$local['Local']['numero'].", ".$local['Comuna']['nombre'] ?></td>
                    <?php if($local['Local']['estado'] == true){ ?>
                      <td><?php echo "Habilitado" ?></td>
                    <?php } else{ ?>
                      <td><?php echo "Deshabilitado" ?></td>
                    <?php } ?>
                    <td><?php echo $local['CategoriaLocal']['nombre'] ?></td>
                    <td><input type="checkbox" id="nombre<?php echo $index; ?>" name="locales[<?php echo $index; ?>];" value="<?php echo $local['Local']['id']; ?>" class="checkbox"></td>
                  </tr>
          <?php 
              } 
            }
           else{ ?>
              <tr>
                <td colspan='5'>No hay Locales en la Base de Datos</td>
              </tr>
          <?php } ?>
        </tbody>
    </table>
    <input type="submit" value="Asociar Locales" class="Agregar btn btn-primary">
    <input type="hidden" name="usuario" value="<?php if(isset($usuario)){ echo $usuario['User']['id']; } ?>">
    <a href="/Hop/Locals/add" id="boton" style="width:auto" class="Agregar btn btn-primary">Agregar nuevo local</a>
  </form>  
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {  
      $('#formAsociados').submit(function(){
        var cont = 0;
   
        $('.checkbox').each(function(){
          if($(this).is(':checked')){
            cont = cont + 1;
          }
        });

        if(cont == 0){
          alertify.error('Debe seleccionar al menos un local.');
          return false;
        }
        else{
          return true;
        }
      });
    });
  </script>