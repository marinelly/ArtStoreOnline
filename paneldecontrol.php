<?php
session_start();

if(!isset($_SESSION['login'])) { session_destroy(); header("Location: index.php");}

include("includes/local.settings.php");
include('includes/funciones.php'); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Arte Online</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css" media="all">
@import "images/style.css";
.Estilo1 {font-size: 30px}
.style1 {color: #FFFFCC}
</style>
</head>
<body>


<div class="content">
  <div class="rside">
    <div class="topmenu"></div>
    <div class="loginbox">
      <div class="padding">
      <?php
	  echo "Bienvenido, " . $_SESSION['nombreC']. "<br /><a href= \"index.php\">Logout</a>";
         ?> 
      </div>
    </div>
    <div class="topmain">Main Menu</div>
    <div class="menu">
      <h2>Categories</h2>
      <div class="nav">
        <ul>
          <li><a href="index2.php">Home</a></li>
          <li><a href="gallery.php">Galer&iacute;a</a></li>
          <li><a href="acercade.php">Acerca de </a></li>
          <li><a href="contactenos.php">Cont&aacute;ctenos</a></li>
        </ul>
      </div>
      <h2>&nbsp;</h2>
      <br />
    </div>
  </div>
  <div class="lside"><div class="topmenu"><a href="http://www.free-css.com/">About</a> | <a href="http://www.free-css.com/">Contact</a> </div>
    <div class="header">
      <div class="padding">
        <div class="citation">
          <p align="left"><a href="vercarrito.php" class="style1">Carrito de Compras</a></p>
          <p align="left"><a href="paneldecontrol.php" class="style1">Panel De Control</a></p>
        </div>
        <h1>&nbsp;</h1>
      </div>
    </div>
    <div class="main">
	<h2 class="Estilo1">Panel de Control</h2>
      <h2>&nbsp;</h2>
      <div align="left">
        <p><img src="images/arrow.gif" alt="" /> <a href="modificardatos.php">Modificar Datos</a></p>
        
        <?php
		if ($_SESSION['admin']==1){
		?>
        <p><img src="images/arrow.gif" alt="" /><a href="consultarproductos.php"> Gestionar Productos</a></p>
        <p><img src="images/arrow.gif" alt="" /> <a href="consultarclientes.php">Gestionar Clientes</a></a></p>
        <p><img src="images/arrow.gif" alt="" /> <a href="consultarcategorias.php">Gestionar Categor&iacute;as</a><br />
        </p>
        <?php
         }
		 ?>
      </div>
      <p>&nbsp;</p>
      <p class="date">&nbsp;</p>
    </div>
  </div>
  <div class="footer"> Copyright &copy; 2006 LightBiz | Design: <a href="http://www.free-css-templates.com">David Herreman</a> | <a href="http://www.free-css.com/">Contact</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a href="http://www.free-css.com/">Home</a> </div>
</div>
</body>
</html>
