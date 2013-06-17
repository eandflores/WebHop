<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="/Hop/img/logo.jpg">
<title>Hop</title>

<?php
  echo $this->Html->css("reset.css");
  echo $this->Html->css("bootstrap.css");
  echo $this->Html->css("main.css");
?>

<script type="text/javascript" src="/Hop/js/jquery-1.7.2.js"></script>
<style type="text/css">
</style>
</head>
<body>
  <div id="wrapper">
      <div class="navbar navbar-fixed-top">
       <div class="navbar-inner">
         <div class="container" style="padding-top: 20px;padding-bottom: 20px">
           <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
           </a>
           <a class="brand" href="../">Hop!</a>
           <div class="nav-collapse collapse" id="main-menu">
            <ul class="nav" id="main-menu-left">
              <li><a href="#">Inicio</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Gestión Administradores<b class="caret"></b></a>
                <ul class="dropdown-menu" id="swatch-menu">
                  <li><a href="../default/">Mostrar</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Agregar</a></li>
                  <li><a href="#">Modificar</a></li>
                  <li><a href="#">Eliminar</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav pull-right" id="main-menu-right">
              <li><a href="#">Registrarse <i class="icon-share-alt"></i></a></li>
              <li><a href="/Hop/Users/login">Iniciar Sesión <i class="icon-share-alt"></i></a></li>
              <li><a href="/Hop/Users/logout">Cerrar Sesión <i class="icon-share-alt"></i></a></li>
            </ul>
           </div>
         </div>
       </div>
      </div>
      <div class="MainContent well">
        <?php echo $this->fetch('content'); ?>
      </div>
  </div>
</body>
<?php
  echo $this->Html->script("jquery.js");
  echo $this->Html->script("bootstrap.js");
?>

