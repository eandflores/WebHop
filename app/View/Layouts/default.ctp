<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="/Hop/img/LogoHop.jpg">
<title>Bienvenido a HOP</title>

<?php
  echo $this->Html->css("reset.css");
  echo $this->Html->css("bootstrap.css");
  echo $this->Html->css("jquery.dataTables.css");
  echo $this->Html->css("main.css");
  echo $this->Html->css("alertify.core.css");
  echo $this->Html->css("alertify.default.css");
  echo $this->Html->css("TableTools.css");
  echo $this->Html->css("dataTables.colVis.css");

?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="/Hop/js/jquery-1.7.2.js">
</script>
<style type="text/css"></style>

</head> 
<body>
  <div id="wrapper">
      <div id="menu-container" class="navbar">
          <a id="logoHome" class="brand" href="/Hop">
              <?php echo $this->Html->image('mc_hop.png') ?>
          </a>
          <ul id="NavBarHome" class="nav pull-right">

              <!-- ADMINISTRADOR -->
              <?php if(!empty($logged_in) and $current_user['rol_id']=="1"): ?>
                <li>
                  <a href="/Hop/Users/all">USUARIOS</a>
                </li>
                <li class="dropdown">
                <a class="dropdown-toggle item-menu" data-toggle="dropdown" href="#">LOCÁLES<b class="caret"></b></a>
                <ul class="dropdown-menu" id="swatch-menu">
                  <li><a href="/Hop/Locals">Locales </a></li>
                  <li class="divider"></li>
                  <li><a href="/Hop/CategoriaLocals">Categoría Locales</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle item-menu" data-toggle="dropdown" href="#">PRODUCTOS<b class="caret"></b></a>
                <ul class="dropdown-menu" id="swatch-menu">
                  <li><a href="/Hop/Productos">Productos </a></li>
                  <li class="divider"></li>
                  <li><a href="/Hop/CategoriaProductos">Categoría Productos</a></li>
                  <li class="divider"></li>
                  <li><a href="/Hop/Ofertas">Productos Asociados a Locales</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle item-menu" data-toggle="dropdown" href="#">SOLICITUDES <b class="caret"></b></a>
                <ul class="dropdown-menu" id="swatch-menu">                
                  <li><a href="/Hop/Comentarios">Comentarios</a></li>
                  <li class="divider"></li>
                  <li><a href="/Hop/Sugerencias">Sugerencias</a></li>
                  <li class="divider"></li>
                  <li><a href="/Hop/Solicituds">Solicitudes</a></li>
                </ul>
              </li>
              <?php endif; ?>

              <!-- LOCALES -->
              <?php if(!empty($logged_in) and $current_user['rol_id']=="3"): ?> 
              <li class="dropdown">
                <a href="/Hop/Locals">LOCAL</a>
              </li>
              <li class="dropdown">
                <a href="/Hop/Ofertas">PRODUCTOS</a>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle item-menu" data-toggle="dropdown" href="#">SOLICITUDES <b class="caret"></b></a>
                <ul class="dropdown-menu" id="swatch-menu">
                  <li><a href="/Hop/Comentarios">Comentarios</a></li>
                  <li class="divider"></li>
                  <li><a href="/Hop/Solicituds">Solicitudes</a></li>
                </ul>
              </li>
              <?php endif; ?>

              <li>
                <a href="#contacto" class="item-menu" data-toggle='modal'>CONTÁCTANOS</a>
              </li>
              <?php if(!empty($logged_in)): ?>
                <li class="dropdown">
                  <a class="dropdown-toggle item-menu" data-toggle="dropdown" href="#"><i class="icon-user icon-white"></i><?php echo " ".$current_user['username']." "; ?><b class="caret"></b></a>
                  <ul class="dropdown-menu" id="swatch-menu">
                    <li><a href="/Hop/Users/edit/<?php echo $current_user['id']; ?>">Configurar Cuenta</a></li>
                    <li><a href="/Hop/Users/contrasena">Cambiar Contraseña</a></li>
                    <li><a href="/Hop/Users/logout">Cerrar Sesión</a></li>
                  </ul>
                </li>
              <?php else: ?>
                <li><a href="/Hop/users/add">REGISTRARSE <i class="icon-white icon-share-alt"></i></a></li>
                <li><a href="/Hop/users/login">INICIAR SESIÓN <i class="icon-white icon-share-alt"></i></a></li>
              <?php endif; ?>
          </ul>
      </div>
      <div class="MainContent well">
          <?php echo $this->Session->flash(); ?>
          <?php echo $this->fetch('content'); ?>
          <?php echo $this->element('contacto_partial'); ?>
      </div>
      <div id="footer">
          <a href="http://www.clouder.cl">www.clouder.cl</a>
      </div>
  </div>
</body>
<?php
  echo $this->Html->script("jquery-1.7.2.js");
  echo $this->Html->script("bootstrap.js");
  echo $this->Html->script("jquery.dataTables.js");
  echo $this->Html->script("dataTables.colVis.js");
  echo $this->Html->script("TableTools.min.js");
  echo $this->Html->script("main.js");
  echo $this->Html->script("bootstrap-tooltip.js");
  echo $this->Html->script("alertify.js");
  echo $this->Html->script("jquery.elastic.source.js");
?>


