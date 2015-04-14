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
.Estilo10 {font-size: small}
.style1 {color: #888}
.style2 {font-family: "Times New Roman", Times, serif}
.style3 {color: #888; font-family: "Times New Roman", Times, serif; }
.Estilo12 {font-size: small; color: #999999; }
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
	    <a href="registrar.php">Regístrate</a>
	    <br />
        </form>
		<?php } ?> 
      </div>
	
    </div>
    <div class="topmain">Main Menu</div>
    <div class="menu">
      <h2>Categories</h2>
      <div class="nav">
        <ul>
          <li><a href="index2.php">Home</a></li>
          <li><a href="gallery.php">Galer&iacute;a</a></li>
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
		    <?php
	  
	$estado = 0;
	if(isset($_POST['login'])){
		if( checkForm($_POST) ){
		
			// el formulario es correcto procedemos a comprobar el nombre de usuario y contraseña
			
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
				echo '<script>document.location = "index2.php"</script>';
			
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
		
		<?php if($_SESSION['login']==true) {	?>  
	  
          <p align="left"><a href="vercarrito.php" class="style11">Carrito de Compras</a></p>
          <p align="left"><a href="paneldecontrol.php" class="style11">Panel De Control</a></p>
       <?php } ?>
   	    </div>
        <h1 align="center">&nbsp;</h1>
      </div>
    </div>
    <div class="main">
	<h2 class="Estilo1">Galer&iacute;a</h2>
	<p class="Estilo1">&nbsp;</p>
	<div align="center">
        <table width="397" cellspacing="12" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
          <tr bordercolor="#FFFFFF">
            <td width="145"><p><a href="verproducto.php?idprod=P0014"><img src="images/DE LA LINEA AL CABALLO.jpg" width="135" height="108" /></a></p></td>
            <td width="206" bordercolor="#FFFFFF" class="main Estilo10"><p align="left" class="Estilo10">De la linea al caballo.</p>
                <p align="left" class="Estilo10"> $750.000 .</p>
            <p align="left" class="Estilo10">Mario Alberto Gonzalez. Colombia</p></td>
          </tr>
          <tr>
            <td width="145"><p><a href="verproducto.php?idprod=P0002"><img src="images/blanco y negro.jpg" width="140" height="108" /></a></p></td>
            <td width="206" class="main Estilo10"><p align="left" class="Estilo10">Blanco y negro.</p>
                <p align="left" class="Estilo10"> $400.000 .</p>
            <p align="left" class="Estilo12">Jeremie Iordanoff. </p>
            <p align="left" class="Estilo10">Francia</p></td>
          </tr>
          <tr>
            <td width="145"><p><a href="verproducto.php?idprod=P0011"><img src="images/maternal.jpg" width="134" height="115" /></a></p></td>
            <td width="206" class="main Estilo10"><p align="left" class="Estilo10">Maternal.</p>
                <p align="left" class="Estilo10"> $650.000 .</p>
            <p align="left" class="Estilo10">Pere Ventura Julia. Espa&ntilde;a</p></td>
          </tr>
        </table>
      </div>
     <p class="date">&nbsp;</p>
      <p><br />
      </p>
    </div>
  </div>
  <div class="footer"> Copyright &copy; 2006 LightBiz | Design: <a href="http://www.free-css-templates.com">David Herreman</a> | <a href="http://www.free-css.com/">Contact</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a href="http://www.free-css.com/">Home</a> </div>
</div>
</body>
</html>
