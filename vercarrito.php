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
.Estilo12 {color: #000000}
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
	   echo "Bienvenido, " . $_SESSION['nombreC']. "<br /><a href= \"index.php\">Logout</a>";
	    }
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
         <ul> <?php
		$conexion = mysql_connect($host,$username,$password);
		mysql_select_db($database);
		$query = "select * from categorias" ;
		$result = mysql_query($query,$conexion);
		if(mysql_num_rows($result)>0){
					while($row = mysql_fetch_array($result)){
		
		 echo '<li class=\"style2\"><a href="categorias.php?cat='.$row['IdCat'].'">'.$row['NombreCat']. "</a></li>";
		
					}
		 }
		/* <li class="style2"><a href="categorias.php?cat=C002" >Expresionista</a></li>
		 <li class="style3"><a href="categorias.php?cat=C003">Figurativo</a></li>
		 <li class="style3"><a href="categorias.php?cat=C004">Hiperrealista</a></li>
		 <li class="style3"><a href="categorias.php?cat=C005">Impresionista</a></li>
		 <li class="style3"><a href="categorias.php?cat=C006">Pop</a></li>
		 <li class="style3"><a href="categorias.php?cat=C007">Realista</a></li>
		 <li class="style2"><a href="categorias.php?cat=C008">Surealista</a></li>*/
		
		 ?>
		 </li>
		
          <li><a href="acercade.php">Acerca de </a></li>
          <li><a href="contactenos.php">Cont&aacute;ctenos</a></li>
        </ul>
      </div>
      <br />
    </div>
  </div>
  <div class="lside"><div class="topmenu"><a href="http://www.free-css.com/">About</a> | <a href="http://www.free-css.com/">Contact</a> </div>
    <div class="header">
      <div class="padding">
        <div class="citation">
          <p align="left"><a href="vercarrito.php" class="style11">Carrito de Compras</a></p>
          <p align="left"><a href="paneldecontrol.php" class="style11">Panel De Control</a></p>
        </div>
        <h1 align="center">&nbsp;</h1>
      </div>
    </div>
    <div class="main">
	<h2 class="Estilo1">Productos en el carrito</h2>
	<p class="Estilo1 Estilo12">&nbsp;</p>
	<div align="center">
      <span class="Estilo12">
<?php    
	   if(isset($_POST['compra'])){
 ?>
Su Compra Ha sido Satisfactoria. </br>
La dirección de su domicilio es : 
<?php echo $_SESSION['direccion']?>
 y su teléfono es: 
<?php echo $_SESSION['telefono']?>
.</br>
</br>
</br>
Gracias por su compra,  
<?php echo $_SESSION['nombreC']?>	
 
<?php	
	$conexion = mysql_connect($host,$username,$password);
    mysql_select_db($database);
    $query = "delete from carritodecompras where user='".$_SESSION['usuario']."'";
	$result = mysql_query($query,$conexion);
    mysql_close($conexion);
    
	$conexion = mysql_connect($host,$username,$password);
    mysql_select_db($database);
	$fecha = date('Y-m-d',time());
	$usuario=$_SESSION['usuario'];
	$total=$_SESSION['total'];
	$query = "insert into factura(fecha,user,valortotal) values('$fecha','$usuario',$total)";
	$result = mysql_query($query,$conexion);
    mysql_close($conexion);
    }
  ?>
  	
	  <?php
$cliente=$_SESSION['usuario'];

$conexion = mysql_connect($host,$username,$password);
mysql_select_db($database);
$query = "select * from producto,carritodecompras where user='$cliente' and producto.IdProd= carritodecompras.idprod" ;

$result = mysql_query($query,$conexion);

$resultStr = $resultStr.'<div id="prodListPanel"><table id="prodListTable" cellspacing="12px" bordercolor="#000000" >
            	<tr>
                	
                    <th></th>
                    <th></th>
                    
                </tr>';
		
if(mysql_num_rows($result)>0){
					while($row = mysql_fetch_array($result)){
						
						if($row['Cantidad']>0){
						$resultStr = $resultStr . "<tr>";
						$pepito = $row['Imagen']; 
						$resultStr = $resultStr .     "<td>" . "<a href='verproducto.php?idprod=".$row['IdProd']."'>"."<img src=\"$pepito\" height=\"108\" width=\"135\">" . "</td>";
						$resultStr = $resultStr . 	"<td width='135' align='left' class='main Estilo10' bordercolor='#000000' >" ."<p align='left' class='Estilo10'>".'Nombre: '. $row['NombreP']."</br>".'Precio: $' . $row['Precio']."</br>" .'Pintor: '. $row['Autor'] ."</p>".'</br><a href="vercarrito.php?o=1&e='.$row['idprod'].'">Eliminar del carrito'."</td>";
						$resultStr = $resultStr . "</tr>";
					}
					}
					$resultStr = $resultStr . '</table></div>';
					echo $resultStr;
					?>
					</br> 
	    </span>
      <form id="form1" name="form1" method="post" action="" >
	    <input type="submit" name="pedido" id="pedido" value="Realizar Pedido" />
	   </form>
				<?php 	
				}else {
				 if(!isset($_POST['compra'])){
				echo "</br></br></br></br></br>No hay elementos en su carrito de compras";
				}
				}
?>
       
  <?php 

if(isset($_POST['pedido'])){
$cliente=$_SESSION['usuario'];
$conexion = mysql_connect($host,$username,$password);
mysql_select_db($database);
$query = "select * from producto,carritodecompras where user='$cliente' and producto.IdProd= carritodecompras.idprod" ;
$result = mysql_query($query,$conexion);
mysql_close($conexion);
$subtotal =0;
  ?>
  </br>
  <div id="prodListPanel">
  <table width="200" border="1">
    <tr>
      <td>ArteOnline</td>
      <td>&nbsp;</td>
      
      <td>Código</td>
      <td>Fecha:<?php echo date('Y-m-d',time()); ?></td>
    </tr>
    <tr>
      <td>Nombre:<?php echo $_SESSION['nombreC'];?></td>
      <td>Cedula:<?php echo $_SESSION['cedula']; ?></td>
      <td>Telefono:<?php echo $_SESSION['telefono']; ?></td>
      <td>Direccion:<?php echo $_SESSION['direccion']; ?></td>
    </tr>
    <tr>
      <td>email:<?php echo $_SESSION['email']; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Productos</td>
      <td>Cantidad</td>
      <td>ValorUnitario</td>
      <td>Valor </td>
    </tr>
    <?php while($row = mysql_fetch_array($result)){?>
    <tr>
      <td>  <?php echo $row['NombreP']?></td>
      <td>	<?php echo '1' ?></td>
      <td>	<?php echo $row['Precio']?></td>
      <td>	<?php $subtotal+='1'*$row['Precio']; echo '1'*$row['Precio']?></td>
    </tr>
    <?php }?>
      <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Subtotal:<?php echo $subtotal?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Total:<?php echo $total=$subtotal*'0.16'+$subtotal;
	  $_SESSION['total']= $total;
	  
	  ?></td>
	  </tr>
  </table>
  </div>
 	<form id="form2" name="form2" method="post" action="" >
	    <input type="submit" name="compra" id="compra" value="Realizar Compra" />
	   </form>
  <?php
  }
  ?>
  
  <?php
	
						if(isset($_GET['o'])){
							$idprod = $_GET['e'];
							$conexion = mysql_connect($host, $username, $password);
							mysql_select_db($database);
								
							$query = "delete from carritodecompras where idprod='".$idprod."'";
							$result = mysql_query($query,$conexion);
 							mysql_close($conexion);
							echo '<script>document.location = "vercarrito.php"</script>';
							}
							
					?>
	</div>
     <p class="date">&nbsp;</p>
      <br />
      <h2><br />
      </h2>
    </div>
  </div>
  <div class="footer"> Copyright &copy; 2006 LightBiz | Design: <a href="http://www.free-css-templates.com">David Herreman</a> | <a href="http://www.free-css.com/">Contact</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a href="http://www.free-css.com/">Home</a> </div>
</div>
</body>
</html>
