<h3 class="Titulo">Gestión Solicitudes</h3>
<ul class="nav nav-tabs" style="margin-bottom: 15px;">
  <li class="active"><a href="#Pendientes" data-toggle="tab">Solicitudes Pendientes</a></li>
  <li class=""><a href="#Aprobadas" data-toggle="tab">Solicitudes Aprobadas</a></li>
  <li class=""><a href="#Rechazadas" data-toggle="tab">Solicitudes Rechazadas</a></li>
</ul>

<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="Pendientes">
    <table id ="" class="table table-bordered datatable">
        <thead>
          <tr>
            <th>#</th>
            <th>Estado</th>
            <th>Acción</th>
            <th>Tabla Afectada</th>
            <th>campos</th>
            <th>Fecha de creación</th>
            <th>Fecha de modificación</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
         
          <?php 
            $indice = 1;
            if(isset($solicitudes)){
              if($current_user['rol_id']=="1"){
                foreach ($solicitudes as $index => $solicitud) { 
                  if($solicitud['Solicitud']['estado'] == 'Pendiente'){?>
                    <tr>
                      <td><?php echo $indice; $indice ++; ?></td>
                      <?php if($solicitud['Solicitud']['estado'] == 'Rechazado'){ ?>
                      <td><?php echo "Rechazado" ?></td>
                      <?php }?>
                      <?php if($solicitud['Solicitud']['estado'] == 'Aprobado'){ ?>
                      <td><?php echo "Aprobado" ?></td>
                      <?php }?>
                      <?php if($solicitud['Solicitud']['estado'] == 'Pendiente'){ ?>
                      <td><?php echo "Pendiente" ?></td>
                      <?php }?>
                     
                      <td><?php echo $solicitud['Solicitud']['accion'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['tabla'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['campos'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['created'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['modified'] ?></td>
                      <td>
                        <a href="/Hop/Solicituds/view/<?php echo $solicitud['Solicitud']['id'] ?>">
                          <i class='icon icon-zoom-in'></i>
                        </a>
                        <?php if($solicitud['Solicitud']['estado'] == "Pendiente") { ?>
                                  <a href="/Hop/Solicituds/aprobar/<?php echo $solicitud['Solicitud']['id'] ?>" onclick="return confirm('Esta seguro que desea aprobar la solicitud ?');">
                                    <i class='icon icon-ok'></i>
                                  </a>
                                  <a href="/Hop/Solicituds/rechazar/<?php echo $solicitud['Solicitud']['id'] ?>" onclick="return confirm('Esta seguro que desea rechazar la solicitud ?');">
                                  <i class='icon icon-remove'></i>
                                </a>
                        <?php } ?>
                      </td>
                    </tr>
              <?php } 
              } 
            }

            if($current_user['rol_id']=="3"){
              foreach ($solicitudes as $index => $solicitud) { 
                  if($solicitud['Solicitud']['estado'] == 'Pendiente' && $current_user['local_id'] == $solicitud['Solicitud']['local_id'] ){?>
                    <tr>
                      <td><?php echo $indice; $indice ++; ?></td>
                      <?php if($solicitud['Solicitud']['estado'] == 'Rechazado'){ ?>
                      <td><?php echo "Rechazado" ?></td>
                      <?php }?>
                      <?php if($solicitud['Solicitud']['estado'] == 'Aprobado'){ ?>
                      <td><?php echo "Aprobado" ?></td>
                      <?php }?>
                      <?php if($solicitud['Solicitud']['estado'] == 'Pendiente'){ ?>
                      <td><?php echo "Pendiente" ?></td>
                      <?php }?>
                     
                      <td><?php echo $solicitud['Solicitud']['accion'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['tabla'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['campos'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['created'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['modified'] ?></td>
                      <td>
                        <a href="/Hop/Solicituds/view/<?php echo $solicitud['Solicitud']['id'] ?>">
                          <i class='icon icon-zoom-in'></i>
                        </a>
                        <?php if($solicitud['Solicitud']['estado'] == "Pendiente") { ?>
                                  <a href="/Hop/Solicituds/aprobar/<?php echo $solicitud['Solicitud']['id'] ?>" onclick="return confirm('Esta seguro que desea aprobar la solicitud ?');">
                                    <i class='icon icon-ok'></i>
                                  </a>
                                  <a href="/Hop/Solicituds/rechazar/<?php echo $solicitud['Solicitud']['id'] ?>" onclick="return confirm('Esta seguro que desea rechazar la solicitud ?');">
                                  <i class='icon icon-remove'></i>
                                </a>
                        <?php } ?>
                      </td>
                    </tr>
              <?php } 
              }
            }  
          }  

            else{ ?>
              <tr>
                <td colspan='8'>No hay Sugerencias en la Base de Datos</td>
              </tr>
          <?php } ?>
        </tbody>
    </table>
  </div>

  <div class="tab-pane fade" id="Aprobadas">
    <table id ="" class="table table-bordered datatable">
        <thead>
          <tr>
            <th>#</th>
            <th>Estado</th>
            <th>Acción</th>
            <th>Tabla Afectada</th>
            <th>campos</th>
            <th>Fecha de creación</th>
            <th>Fecha de modificación</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
         
          <?php 
            $indice = 1;
            if(isset($solicitudes)){
              if($current_user['rol_id']=="1"){
                foreach ($solicitudes as $index => $solicitud) { 
                  if($solicitud['Solicitud']['estado'] == 'Aprobado'){?>
                    <tr>
                      <td><?php echo $indice; $indice ++; ?></td>
                      <?php if($solicitud['Solicitud']['estado'] == 'Rechazado'){ ?>
                      <td><?php echo "Rechazado" ?></td>
                      <?php }?>
                      <?php if($solicitud['Solicitud']['estado'] == 'Aprobado'){ ?>
                      <td><?php echo "Aprobado" ?></td>
                      <?php }?>
                      <?php if($solicitud['Solicitud']['estado'] == 'Pendiente'){ ?>
                      <td><?php echo "Pendiente" ?></td>
                      <?php }?>
                     
                      <td><?php echo $solicitud['Solicitud']['accion'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['tabla'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['campos'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['created'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['modified'] ?></td>
                      <td>
                        <a href="/Hop/Solicituds/view/<?php echo $solicitud['Solicitud']['id'] ?>">
                          <i class='icon icon-zoom-in'></i>
                        </a>
                        <?php if($solicitud['Solicitud']['estado'] == "Pendiente") { ?>
                                  <a href="/Hop/Solicituds/aprobar/<?php echo $solicitud['Solicitud']['id'] ?>" onclick="return confirm('Esta seguro que desea aprobar la solicitud ?');">
                                    <i class='icon icon-ok'></i>
                                  </a>
                                  <a href="/Hop/Solicituds/rechazar/<?php echo $solicitud['Solicitud']['id'] ?>" onclick="return confirm('Esta seguro que desea rechazar la solicitud ?');">
                                  <i class='icon icon-remove'></i>
                                </a>
                        <?php } ?>
                      </td>
                    </tr>
              <?php } 
              } 
            }
              
            if($current_user['rol_id']=="3"){
              foreach ($solicitudes as $index => $solicitud) { 
                  if($solicitud['Solicitud']['estado'] == 'Aprobado' && $current_user['local_id'] == $solicitud['Solicitud']['local_id'] ){?>
                    <tr>
                      <td><?php echo $indice; $indice ++; ?></td>
                      <?php if($solicitud['Solicitud']['estado'] == 'Rechazado'){ ?>
                      <td><?php echo "Rechazado" ?></td>
                      <?php }?>
                      <?php if($solicitud['Solicitud']['estado'] == 'Aprobado'){ ?>
                      <td><?php echo "Aprobado" ?></td>
                      <?php }?>
                      <?php if($solicitud['Solicitud']['estado'] == 'Pendiente'){ ?>
                      <td><?php echo "Pendiente" ?></td>
                      <?php }?>
                     
                      <td><?php echo $solicitud['Solicitud']['accion'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['tabla'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['campos'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['created'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['modified'] ?></td>
                      <td>
                        <a href="/Hop/Solicituds/view/<?php echo $solicitud['Solicitud']['id'] ?>">
                          <i class='icon icon-zoom-in'></i>
                        </a>
                        <?php if($solicitud['Solicitud']['estado'] == "Pendiente") { ?>
                                  <a href="/Hop/Solicituds/aprobar/<?php echo $solicitud['Solicitud']['id'] ?>" onclick="return confirm('Esta seguro que desea aprobar la solicitud ?');">
                                    <i class='icon icon-ok'></i>
                                  </a>
                                  <a href="/Hop/Solicituds/rechazar/<?php echo $solicitud['Solicitud']['id'] ?>" onclick="return confirm('Esta seguro que desea rechazar la solicitud ?');">
                                  <i class='icon icon-remove'></i>
                                </a>
                        <?php } ?>
                      </td>
                    </tr>
              <?php } 
              }
            }    
          }  
          else{ ?>
              <tr>
                <td colspan='8'>No hay Sugerencias en la Base de Datos</td>
              </tr>
          <?php } ?>
        </tbody>
    </table>  
  </div>

  <div class="tab-pane fade" id="Rechazadas">
    <table id ="" class="table table-bordered datatable">
        <thead>
          <tr>
            <th>#</th>
            <th>Estado</th>
            <th>Acción</th>
            <th>Tabla Afectada</th>
            <th>campos</th>
            <th>Fecha de creación</th>
            <th>Fecha de modificación</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
         
          <?php 
            $indice = 1;
            if(isset($solicitudes)){
              if($current_user['rol_id']=="1"){
                foreach ($solicitudes as $index => $solicitud) { 
                  if($solicitud['Solicitud']['estado'] == 'Rechazado'){?>
                    <tr>
                      <td><?php echo $indice; $indice ++; ?></td>
                      <?php if($solicitud['Solicitud']['estado'] == 'Rechazado'){ ?>
                      <td><?php echo "Rechazado" ?></td>
                      <?php }?>
                      <?php if($solicitud['Solicitud']['estado'] == 'Aprobado'){ ?>
                      <td><?php echo "Aprobado" ?></td>
                      <?php }?>
                      <?php if($solicitud['Solicitud']['estado'] == 'Pendiente'){ ?>
                      <td><?php echo "Pendiente" ?></td>
                      <?php }?>
                     
                      <td><?php echo $solicitud['Solicitud']['accion'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['tabla'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['campos'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['created'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['modified'] ?></td>
                      <td>
                        <a href="/Hop/Solicituds/view/<?php echo $solicitud['Solicitud']['id'] ?>">
                          <i class='icon icon-zoom-in'></i>
                        </a>
                        <?php if($solicitud['Solicitud']['estado'] == "Pendiente") { ?>
                                  <a href="/Hop/Solicituds/aprobar/<?php echo $solicitud['Solicitud']['id'] ?>" onclick="return confirm('Esta seguro que desea aprobar la solicitud ?');">
                                    <i class='icon icon-ok'></i>
                                  </a>
                                  <a href="/Hop/Solicituds/rechazar/<?php echo $solicitud['Solicitud']['id'] ?>" onclick="return confirm('Esta seguro que desea rechazar la solicitud ?');">
                                  <i class='icon icon-remove'></i>
                                </a>
                        <?php } ?>
                      </td>
                    </tr>
              <?php } 
              } 
            }

            if($current_user['rol_id']=="3"){
              foreach ($solicitudes as $index => $solicitud) { 
                  if($solicitud['Solicitud']['estado'] == 'Rechazado' && $current_user['local_id'] == $solicitud['Solicitud']['local_id'] ){?>
                    <tr>
                      <td><?php echo $indice; $indice ++; ?></td>
                      <?php if($solicitud['Solicitud']['estado'] == 'Rechazado'){ ?>
                      <td><?php echo "Rechazado" ?></td>
                      <?php }?>
                      <?php if($solicitud['Solicitud']['estado'] == 'Aprobado'){ ?>
                      <td><?php echo "Aprobado" ?></td>
                      <?php }?>
                      <?php if($solicitud['Solicitud']['estado'] == 'Pendiente'){ ?>
                      <td><?php echo "Pendiente" ?></td>
                      <?php }?>
                     
                      <td><?php echo $solicitud['Solicitud']['accion'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['tabla'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['campos'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['created'] ?></td>
                      <td><?php echo $solicitud['Solicitud']['modified'] ?></td>
                      <td>
                        <a href="/Hop/Solicituds/view/<?php echo $solicitud['Solicitud']['id'] ?>">
                          <i class='icon icon-zoom-in'></i>
                        </a>
                        <?php if($solicitud['Solicitud']['estado'] == "Pendiente") { ?>
                                  <a href="/Hop/Solicituds/aprobar/<?php echo $solicitud['Solicitud']['id'] ?>" onclick="return confirm('Esta seguro que desea aprobar la solicitud ?');">
                                    <i class='icon icon-ok'></i>
                                  </a>
                                  <a href="/Hop/Solicituds/rechazar/<?php echo $solicitud['Solicitud']['id'] ?>" onclick="return confirm('Esta seguro que desea rechazar la solicitud ?');">
                                  <i class='icon icon-remove'></i>
                                </a>
                        <?php } ?>
                      </td>
                    </tr>
              <?php } 
              }
            }  
          }  
          else{ ?>
              <tr>
                <td colspan='8'>No hay Sugerencias en la Base de Datos</td>
              </tr>
          <?php } ?>
        </tbody>
    </table> 
  </div>
</div>