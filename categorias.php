<?php
session_start();

//if(!isset($_SESSION['login'])) { session_destroy(); header("Location: index.php");}

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
	  $cat = $_GET['cat'];
	  if($_SESSION['login']==true) {	  
	    echo "Bienvenido, " . $_SESSION['nombreC']. "<br /><a href= \"index.php\">Logout</a>";
		}else{ ?>
		 <form id="form2" name="form2" method="post" target="_self" enctype="application/x-www-form-urlencoded" action="">
          Login <br />
          <input type="text" value="" class="text" name="username" id="username" />
          <br />
          Password <br />
          <input type="password" value="" class="text" name="password" id="password" />
          <br />
	    <br />
          <input type="submit" name="login" id="login" value="Login" class="searchbutton" />
          <br />
	    <a href="registrar.php">Reg�strate</a>
	    <br />
        </form>
		<?php } ?>
	  </div>
       <?php
	  
	$estado = 0;
	if(isset($_POST['login'])){
		if( checkForm($_POST) ){
		
			// el formulario es correcto procedemos a comprobar el nombre de usuario y contrase�a
			
			$conexion = mysql_connect($host, $username, $password);
			mysql_select_db($database);
					
			$query = "select * from cliente where user='" . $_POST['username'] . "' and password='" . $_POST['password'] . "'" ;
		
			$result = mysql_query($query);		
					
			
			if ( mysql_num_rows($result) > 0 ){
					//si fue exitoso y estoy seguro que solo se trajo un registro
					$row = mysql_fetch_array($result);
					
					// creo las variables de sesion que estaran disponibles en todas las pagina donde se inicialice la sesion
					
					$_SESSION['login'] = true;
					$_SESSION['admin'] = $row['admin'];
					$_SESSION['usuario'] = $row['user'];
					$_SESSION['cedula'] = $row['cedula'];
					$_SESSION['telefono'] = $row['telefono'];
					$_SESSION['direccion'] = $row['direccion'];
					$_SESSION['email'] = $row['email'];
					
				$estado = 1;	
				echo '<script>document.location = "categorias.php?cat="'.cat.'</script>';
			
			}else{
				$estado = -1;
			}
	
			mysql_close($conexion);
		}else{
			$estado = -2;
		}			
		}	
	if($estado <= 0){
		switch ($estado) {
		case -1:
		?>
		<div class="citation">Error de autenticacion por verifique los datos</div>
		<?php
		break;
		case -2:?>
		<div class="citation">Por favor digite todos los campos del formulario</div>
			<?php
			break;    
		}
		}
	?> 
	</div>
    <div class="topmain">Main Menu</div>
    <div class="menu">
      <h2>Categories</h2>
      <div class="nav">
        <ul>
          <li><a href="index2.php">Home</a></li>
          <li><a href="gallery.php">Galer&iacute;a</a></li>
        <ul> 
		<?php
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
		 </ul>
		 </li>
		
		
          <li><a href="acercade.php">Acerca de </a></li>
          <li><a href="http://www.free-css.com/">Cont&aacute;ctenos</a></li>
        </ul>
      </div>
      <h2>&nbsp;</h2>
    </div>
  </div>
  <div class="lside"><div class="topmenu"><a href="http://www.free-css.com/">About</a> | <a href="http://www.free-css.com/">Contact</a> </div>
    <div class="header">
      <div class="padding">
        <div class="citation">
          <?php   if($_SESSION['login']==true) {	  ?>
	 
		  <p><a href="paneldecontrol.php" class="style11">Panel De Control </a></p>
          <p><a href="vercarrito.php" class="style11">Carrito de Compras  </a></p>
		   <?php  }  ?>
		  
        </div>
        <h1 align="center">&nbsp;</h1>
      </div>
    </div>
    <div class="main">
	<h2 class="Estilo1">
	  <?php

$conexion = mysql_connect($host,$username,$password);
mysql_select_db($database);
$query = "select * from categorias where IdCat='" . $cat. "'" ;
$result = mysql_query($query,$conexion);
$row = mysql_fetch_array($result);
echo $row['NombreCat'];				
?>
	
	</h2>
	<p class="Estilo1">&nbsp;</p>
	<div align="center">
	
	  <?php

$conexion = mysql_connect($host,$username,$password);
mysql_select_db($database);
$query = "select * from producto, categorias where Categoria='". $cat. "' and IdCat='" . $cat. "'" ;
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
						$resultStr = $resultStr . 	"<td width='135' align='left' class='main Estilo10' bordercolor='#000000' >" ."<p align='left' class='Estilo10'>".'Nombre: '. $row['NombreP']."</br>".'Precio: $' . $row['Precio']."</br>" .'Pintor: '. $row['Autor'] ."</p>"."</td>";
						$resultStr = $resultStr . "</tr>";
						}
						}
					$resultStr = $resultStr . '</table></div>';
					
					echo $resultStr;
					
				}else{
				echo "No hay elementos en esta categor�a";
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
