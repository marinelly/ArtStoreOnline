<?php
session_start();
if( !isset($_SESSION['login']) ) header("Location: index.php");
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
      </div>
      <br />
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
	
      <h2>Modificar Datos</h2>
      <h2>&nbsp;</h2>
      <div align="left">
      
      <?php
$estado = 0;

if(isset($_POST['modificar'])){

		$conexion = mysql_connect($host,$username,$password);
		mysql_select_db($database);
		$user=$_SESSION['usuario'];
		$pass = $_POST['pass'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$cedula = $_POST['cedula'];
		$telefono = $_POST['telefono'];
		$direccion = $_POST['direccion'];
		$email = $_POST['email'];
			
		$query = "select * from cliente where user='$username'";	
		$result = mysql_query($query);		
		
				$estado = 1;		
				$query ="update cliente set nombre='$nombre', apellido='$apellido', cedula='$cedula', telefono='$telefono', direccion='$direccion', email='$email', password='$pass' where user ='$user'";
echo '<p class=advertencia"> Modificado correctamente</p>';
		$result = mysql_query($query,$conexion);
					$_SESSION['cedula'] = $cedula;
					$_SESSION['telefono'] = $telefono;
					$_SESSION['direccion'] = $direccion;
					$_SESSION['email'] = $email;				
			
		mysql_close($conexion);	
			

}
if($estado <= 0){
	switch ($estado) {
	   case -1:
  	  echo '<p class="advertencia">Error de autenticacion por verifique los datos</p>';
    break;
    case -2:
	    echo '<p class="advertencia">Por favor digite todos los campos del formulario</p>';
		break;    
	}
}
				
    					  $conexion = mysql_connect($host, $username, $password);
							mysql_select_db($database);
								
						
							$query = "select * from cliente where user='".$_SESSION['usuario']."'";
							$result = mysql_query($query,$conexion);
							mysql_close($conexion);
							
							$row = mysql_fetch_array($result) ?>
	  
	  
            <form id="form1" name="form1" method="post" action="" target="_self" enctype="application/x-www-form-urlencoded">
          <p class="label">Nombre:</p>
          <p>
            <input name="nombre" type="text" class="campo" id="nombre" value="<?php echo $row['nombre']?> "/>
          </p>
          <p class="label">Apellido:</p>
          <p>
            <input name="apellido" type="text" class="campo" id="apellido" value="<?php echo $row['apellido']?> "/>
          </p>
           <p class="label">Cédula:</p>
          <p>
            <input name="cedula" type="text" class="campo" id="cedula"value="<?php echo $row['cedula']?> " />
          </p>
          <p class="label">Teléfono:</p>
          <p>
            <input name="telefono" type="text" class="campo" id="telefono" value="<?php echo $row['telefono']?> "/>
          </p>
          <p class="label">E-mail:</p>
          <p>
            <input name="email" type="text" class="campo" id="email" value="<?php echo $row['email']?> "/>
          </p>
          </p>
          <span class="style2">Direccion:</span>
          <p>
            <input name="direccion" type="text" class="campo" id="direccion"value="<?php echo $row['direccion']?> " />
          </p>
          <p class="label">Contraseña:</p>
          <p>
            <input name="pass" type="password" class="campo" id="pass" />    
          </p>
          <p class="label">
            <input type="submit" name="modificar" id="modificar" value="Modificar" />
          </p>
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
