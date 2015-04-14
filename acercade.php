<?php
session_start();

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
.style1 {color: #FFFFCC}
</style>
</head>
<body>


<div class="content">
  <div class="rside">
    <div class="topmenu"></div>
    <div class="loginbox">
      <div class="padding">
      <body>
<?php
	$usuario = $_SESSION['usuario'];
	
    $conexion = mysql_connect($host,$username,$password);
    mysql_select_db($database);
        
    $query = "select * from cliente where user='". $usuario ."'";
    $result = mysql_query($query,$conexion);
			        
    mysql_close($conexion);
	$row = mysql_fetch_array($result);
	$_SESSION['nombreC'] = $row['nombre'].' '.$row['apellido'];
?>
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
      <h2><br />
    </h2>
    </div>
  </div>
  <div class="lside">
    <div class="topmenu"> &nbsp;<a href="http://www.free-css.com/">About</a> | <a href="http://www.free-css.com/">Contact</a> </div>
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
	
      <h2>Nosotros</h2>
      <h2>&nbsp;</h2>
      <div align="left">
        <p align="justify"><strong>ArteOnline.com</strong> es una alternativa para descubrir las nuevas tendencias del arte contempor&aacute;neos. Dirigida a coleccionistas,  marchantes, cr&iacute;ticos de arte, galer&iacute;as y al publico en general.</p>
        <p align="justify">La iniciativa naci&oacute; al decubrir la dificultad que tienen los nuevos artistas   para mostrar sus obras a los clientes potenciales. </p>
        <p align="justify">Nuestra  misi&oacute;n es  apoyar a todos aquellos que se sientan motivados en expresar sus emociones a traves de la pintura, brindandoles la posibilidad de dar a conocer sus creaciones, lo que nos ha llevado a ser lideres en la venta de pinturas por interner durante los &uacute;ltimos 5 a&ntilde;os. </p>
        <p align="justify">&nbsp;</p>
        <h2>El equipo </h2>
        <h2>&nbsp;</h2>
        <div align="left">
          <p align="justify"><strong>Director t&eacute;cnico</strong>: Andr&eacute;s Visbal C.<br />
            <strong>Autor del Logo</strong>: Andr&eacute;s Visbal C<br />
  <strong>Directora de contenidos:</strong> Marinelly R&uacute;a D. 
  <br />
  <strong>Responsable de Dise&ntilde;o</strong>: Marinelly R&uacute;a D. <br />
  <strong>Directora comercial </strong>: Osiris R&uacute;a.. </p>
        </div>
        <p align="justify">&nbsp;</p>
      </div>
      <h2>&nbsp;</h2>
      <p><br />
      </p>
    </div>
    </div>
  <div class="footer"> Copyright &copy; 2006 LightBiz | Design: <a href="http://www.free-css-templates.com">David Herreman</a> | <a href="http://www.free-css.com/">Contact</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a href="http://www.free-css.com/">Home</a> </div>
</div>
</body>
</html>
