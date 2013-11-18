<h3><?php echo "Usuario ".$usuario['User']['rut']?></h3>
<?php 
  if(isset($usuario)){ ?>
    <ul class="view">
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
        <span>Aportes Realizados => </span>
        <?php echo $usuario['User']['aportes_totales'] ?>
      </li>
      <li>
        <span>Aportes Aprobados => </span>
        <?php echo $usuario['User']['aportes_aprobados'] ?>
      </li>
      <li>
        <span>Votos Positivos => </span>
        <?php echo $usuario['User']['cant_votos_positivos'] ?>
      </li>
      <li>
        <span>Votos Negativos => </span>
        <?php echo $usuario['User']['cant_votos_negativos'] ?>
      </li>
      <li>
        <span>Comentarios Realizados => </span>
        <?php echo $usuario['User']['cant_comentarios'] ?>
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
    </tbody>
</table>
<a href="/Hop/Users/all" class="Atras btn btn-danger">Atras</a>