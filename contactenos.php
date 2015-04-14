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
	
      <h2>Cont&aacute;ctenos...</h2>
      <h2>&nbsp;</h2>
      <div align="left">
        <p align="left">Cualquier solicitud o petici&oacute;n que desee hacer, la puede realizar a trav&eacute;s de este medio: </p>
        <p align="left">&nbsp;</p>
		<?php	 
		    if(isset($_POST['pedido'])){
			 	echo 'Su solicitud ha sido enviada satisfactoriamente';
			} else{?> 
        <form id="form1" name="form1" method="post" action="">
          <div align="center">
            <p>
              <textarea name="textarea" rows="5"></textarea>
            </p>
            <p>&nbsp;</p>
            <p>
              <input type="submit" name="Submit" value="Enviar" />
            </p>
          </div>
        </form><?php } ?>
        <p align="center">&nbsp;</p>
      </div>
      <p class="date">&nbsp;</p>
      <br />
      <h2>&nbsp;</h2>
      <p><br />
      </p>
    </div>
    </div>
  <div class="footer"> Copyright &copy; 2006 LightBiz | Design: <a href="http://www.free-css-templates.com">David Herreman</a> | <a href="http://www.free-css.com/">Contact</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a href="http://www.free-css.com/">Home</a> </div>
</div>
</body>
</html>
