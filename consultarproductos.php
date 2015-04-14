<?php
session_start();
if( !isset($_SESSION['login']) ) header("Location: index.php");
include("includes/local.settings.php"); 
include('includes/funciones.php'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Arte Online</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css" media="all">
@import "images/style.css";
.style1 {color: #FFFFCC}
.style2 {color: #888}
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
        <br />
    </div>
      </div>
  </div>
  <div class="lside">
    <div class="topmenu"> &nbsp;<a href="http://www.free-css.com/">About</a> | <a href="http://www.free-css.com/">Contact</a> </div>
    <div class="header">
      <div class="padding">
        <div class="citation">
          <p align="left"><a href="vercarrito.php" class="style1"> Carrito de Compras</a></p>
          <p align="left"><a href="paneldecontrol.php" class="style1">Panel De Control </a></p>
        </div>
        <h1>&nbsp;</h1>
      </div>
    </div>
    <div class="main">
	
      <h2>Consultar Productos</h2>
      <h2>&nbsp;</h2>
      
      <div align="center">
      
        <p>
		
        <?php
	
		if(isset($_POST['agregar'])){
		echo "hacealgo";
		echo '<script>document.location = "insertarproductos2.php"</script>';
	}
			?>		
          <?php

$conexion = mysql_connect($host,$username,$password);
mysql_select_db($database);
$query = "select * from producto";
$result = mysql_query($query,$conexion);
$resultStr = $resultStr.'<div id="prodListPanel"><table id="prodListTable" cellspacing="0px">
            	<tr>
                	<th>IdProd</th>
                    <th>NombreP</th>
                    <th>Categoria</th>
                    <th>Cantidad</th>
					<th>Precio</th>
					<th>Autor</th>
					<th>Pais</th>
					<th>Dimensiones</th>
					<th>Tecnica</th>
					<th>Soporte</th>
					<th>Eliminar</th>
				</tr>';
		
if(mysql_num_rows($result)>0){
					while($row = mysql_fetch_array($result)){
						$resultStr = $resultStr . "<tr>";
						$resultStr = $resultStr . 	"<td>" . $row['IdProd'] . "</td>";
						$resultStr = $resultStr .     "<td>" . $row['NombreP'] . "</td>";
						$resultStr = $resultStr .     "<td>" . $row['Categoria'] . "</td>";
						$resultStr = $resultStr .     "<td>" . $row['Cantidad'] . "</td>";
						$resultStr = $resultStr .     "<td>" . $row['Precio'] . "</td>";
						$resultStr = $resultStr .     "<td>" . $row['Autor'] . "</td>";
						$resultStr = $resultStr .     "<td>" . $row['Pais'] . "</td>";
						$resultStr = $resultStr .     "<td>" . $row['Dimensiones'] . "</td>";
						$resultStr = $resultStr .     "<td>" . $row['Tecnica'] . "</td>";
						$resultStr = $resultStr .     "<td>" . $row['Soporte'] . "</td>";
						$resultStr = $resultStr . '<td><a href="consultarproductos.php?d=1&e='.$row['IdProd'].'">x</td>';
						$resultStr = $resultStr . "</tr>";
					}
					$resultStr = $resultStr . '</table></div>';
					echo $resultStr;
				}
if(isset($_GET['d'])){
		$user = $_GET['e'];
		$conexion = mysql_connect($host,$username,$password);
		$query = "delete from producto where IdProd='".$_GET['e']."'";
		echo $query;
		mysql_select_db($database);
		$result = mysql_query($query,$conexion);
		mysql_close($conexion);
		echo '<script>document.location = "consultarproductos.php"</script>';
	}
?>
        </p>
		<form id="form2 name="form2" method="post" action="" target="" enctype="application/x-www-form-urlencoded">
        <p><span class="campo">
          <input type="submit" name="agregar" id="agregar" value="Agregar" />
        </span> </p>
		</form>
      </div>
      <p><br />
      </p>
    </div>
  </div>
  <div class="footer"> Copyright &copy; 2006 LightBiz | Design: <a href="http://www.free-css-templates.com">David Herreman</a> | <a href="http://www.free-css.com/">Contact</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a href="http://www.free-css.com/">Home</a> </div>
</div>
</body>
</html>
