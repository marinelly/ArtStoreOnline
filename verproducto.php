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
#Layer1 {
	position:absolute;
	width:410px;
	height:180px;
	z-index:1;
	left: 282px;
	top: 265px;
}
#Layer2 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:1;
	left: 273px;
	top: 285px;
}
#Layer3 {
	position:absolute;
	width:139px;
	height:115px;
	z-index:1;
}
#Layer4 {
	position:absolute;
	width:334px;
	height:115px;
	z-index:2;
	left: 293px;
	top: 254px;
}
#Layer5 {
	position:absolute;
	width:146px;
	height:183px;
	z-index:1;
	left: 296px;
	top: 475px;
	background-color: #FFFFFF;
}
#Layer6 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:2;
	left: 491px;
	top: 524px;
}
#Layer7 {
	position:absolute;
	width:323px;
	height:115px;
	z-index:3;
	left: 118px;
	top: 300px;
}
.style1 {color: #888}
.style2 {font-family: "Times New Roman", Times, serif}
.style3 {color: #888; font-family: "Times New Roman", Times, serif; }
.style11 {color: #FFFFCC}
</style>
</head>
<body>


<div class="content">
  <div class="rside">
    <div class="topmenu"></div>
    <div class="loginbox">
      <div class="padding">
      <?php
	  	 if(isset($_SESSION['login'])) { 
	  echo "Bienvenido, " . $_SESSION['nombreC']. "<br /><a href= \"index.php\">Logout</a>";}
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
         <ul> <li class="style2"><a href="http://localhost/arteonline/categorias.php?cat=C001">Abstracto</a></li>
		 <li class="style2"><a href="http://localhost/arteonline/categorias.php?cat=C002" >Expresionista</a></li>
		 <li class="style3"><a href="http://localhost/arteonline/categorias.php?cat=C003">Figurativo</a></li>
		 <li class="style3"><a href="http://localhost/arteonline/categorias.php?cat=C004">Hiperrealista</a></li>
		 <li class="style3"><a href="http://localhost/arteonline/categorias.php?cat=C005">Impresionista</a></li>
		 <li class="style3"><a href="http://localhost/arteonline/categorias.php?cat=C006">Pop</a></li>
		 <li class="style3"><a href="http://localhost/arteonline/categorias.php?cat=C007">Realista</a></li>
		 <li class="style2"><a href="http://localhost/arteonline/categorias.php?cat=C008">Surealista</a></li>
		 </ul>
		 </li>
		
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
  <p align="left"><a href="paneldecontrol.php" class="style11">Panel De Control</a></p>
  <p align="left" class="style11"><a href="vercarrito.php" class="style11">Ver carrito</a></p>
</div>
<h1 align="center">&nbsp;</h1>
      </div>
    </div>
    <div class="main">
	<h2 class="Estilo1">Galer&iacute;a</h2>
	<p class="Estilo1">&nbsp;</p>
	<div align="center">
	
	  <p>
	    <?php
$idprod=$_GET['idprod'];
$conexion = mysql_connect($host,$username,$password);
mysql_select_db($database);
$query = "select * from producto where IdProd='". $idprod."'" ;

$result = mysql_query($query,$conexion);
$resultStr = $resultStr.'<div id="prodListPanel"><table id="prodListTable" cellspacing="12px" bordercolor="#000000" >
            	<tr>
                	
                    <th></th>
                    <th></th>
                    
                </tr>';
		
if(mysql_num_rows($result)>0){
					while($row = mysql_fetch_array($result)){
						
						$pepito = $row['Imagen']; 
						$resultStr = $resultStr .     "<tr>" . "<img src=\"$pepito\" height=\"300\" width=\"300\">" . "</tr>";
						$resultStr = $resultStr . 	"<tr width='135' align='left' class='main Estilo10' bordercolor='#000000' >" ."<p align='left' class='Estilo10'>"."</br>" .'Nombre: '. $row['NombreP']."</br>".'Precio: $' . $row['Precio']."</br>" .'Pintor: '. $row['Autor'] ."</br>" .'Pais: '. $row['Pais'] ."</br>" .'Dimensiones: '. $row['Dimensiones']."</br>" .'Técnica: '. $row['Tecnica'] ."</br>" .'Soporte: '. $row['Soporte'] ."</p>"."</tr>";
						
					}
					$resultStr = $resultStr . '</table></div>';
					echo $resultStr;
				}
				
				
	if(isset($_POST['cargar'])){
	$conexion = mysql_connect($host,$username,$password);
				mysql_select_db($database);
				$cliente=$_SESSION['usuario'];
				$fecha=time();
				$query = "insert into carritodecompras (idprod, user,fecha) values ('$idprod','$cliente','$fecha')";
				$result = mysql_query($query,$conexion);
				mysql_close($conexion);
				echo '<script>document.location = "vercarrito.php"</script>';
			
	
	}


?>
	    </p>
	  <p class="campo">
	<?php if(isset($_SESSION['login'])) { ?>   
	  <form id="form1" name="form1" method="post" action="" >
	    <span class="campo"><img src="images/carritodecompra2.jpg" height=38 width=49 /></span>
	    <input type="submit" name="cargar" id="cargar" value="Añadir al carrito" />
	   </form>
	   <?php } ?>
    </div>
     <p class="date">&nbsp;</p>
      <br />
    </div>
    </div>
  <div class="footer"> Copyright &copy; 2006 LightBiz | Design: <a href="http://www.free-css-templates.com">David Herreman</a> | <a href="http://www.free-css.com/">Contact</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a href="http://www.free-css.com/">Home</a> </div>
</div>
</body>
</html>
