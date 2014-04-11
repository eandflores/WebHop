<?php header('content-type: application/json; charset=utf-8'); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="/Hop/img/LogoHop.jpg">
<title>Hop</title>

<?php
  echo $this->Html->css("reset.css");
  echo $this->Html->css("bootstrap.css");
  echo $this->Html->css("jquery.dataTables.css");
  echo $this->Html->css("main.css");
?>

<script type="text/javascript" src="/Hop/js/jquery-1.7.2.js"></script>
<style type="text/css"></style>
</head>
<body>
  <div id="wrapper">
      <div class="navbar navbar-fixed-top">
       <div class="navbar-inner">
         <div class="container">
           <div class="nav-collapse collapse" id="main-menu">
            <ul class="nav" id="main-menu-left">
              <a id="logo" class="brand" href="/Hop"><img src="/Hop/img/mc_hop.png"></a>
            </ul>
            <ul class="nav pull-right" id="main-menu-right">
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">USUARIOS<b class="caret"></b></a>
                <ul class="dropdown-menu" id="swatch-menu">
                  <li><a href="/Hop/Users">Usuarios </a></li>
                  <li class="divider"></li>
                  <li><a href="/Hop/Rols">Roles</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">LOCÁLES<b class="caret"></b></a>
                <ul class="dropdown-menu" id="swatch-menu">
                  <li><a href="/Hop/Locals">Locales </a></li>
                  <li class="divider"></li>
                  <li><a href="/Hop/CategoriaLocals">Categoria Locales</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">PRODUCTOS<b class="caret"></b></a>
                <ul class="dropdown-menu" id="swatch-menu">
                  <li><a href="/Hop/Productos">Productos </a></li>
                  <li class="divider"></li>
                  <li><a href="/Hop/CategoriaProductos">Categoria Productos</a></li>
                  <li><a href="/Hop/Ofertas">Asociar Productos a Locales</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">SUGERENCIAS <b class="caret"></b></a>
                <ul class="dropdown-menu" id="swatch-menu">
                  <li><a href="/Hop/Comentarios">Comentarios</a></li>
                  <li class="divider"></li>
                  <li><a href="/Hop/Sugerencias">Sugerencias</a></li>
                </ul>
              </li>
              <?php if (isset($logged_in)): ?>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $current_user['username']." "; ?><b class="caret"></b></a>
                  <ul class="dropdown-menu" id="swatch-menu">
                    <li><a href="/Hop/Users/edit">Configurar Cuenta</a></li>
                    <li><a href="/Hop/Users/logout">Cerrar Sesión</a></li>
                  </ul>
                </li>
              <?php else: ?>
                <li><a href="/Hop/users/add">Registrarse <i class="icon-share-alt"></i></a></li>
                <li><a href="/Hop/users/login">Iniciar Sesión <i class="icon-share-alt"></i></a></li>
              <?php endif; ?>
            </ul>
           </div>
         </div>
       </div>
      </div>
      <div class="MainContent well">
          <?php echo $this->Session->flash(); ?>
          <?php echo $this->fetch('content'); ?>
      </div>
      <div id="footer">
          <a href="http://www.clouder.cl">www.clouder.cl</a>
      </div>
    </div>
  </div>
</body>
<?php
  echo $this->Html->script("jquery-1.7.2.js");
  echo $this->Html->script("bootstrap.js");
  echo $this->Html->script("jquery.dataTables.js");
  echo $this->Html->script("main.js");
?>
