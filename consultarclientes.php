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
.style11 {color: #888}
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
          <li><a href="http://www.free-css.com/">Cont&aacute;ctenos</a></li>
        </ul>
      </div>
      <h2>&nbsp;</h2>
    </div>
  </div>
  <div class="lside">
    <div class="topmenu"> &nbsp;<a href="http://www.free-css.com/">About</a> | <a href="http://www.free-css.com/">Contact</a> </div>
    <div class="header">
      <div class="padding">
        <div class="citation">
          <p align="left"><a href="vercarrito.php" class="style1"> Carrito de Compras</a></p>
          <p align="left"><a href="paneldecontrol.php" class="style1">Panel De Control</a></p>
        </div>
        <h1>&nbsp;</h1>
		
      </div>
    </div>
	
	
    <div class="main">
	
      <h2>Gestionar Clientes </h2>
      <h2>&nbsp;</h2>
	  <?php
	  if(isset($_POST['cancelar'])){
			echo '<script>document.location = "consultarclientes.php"</script>';	  
	  }
if( checkForm($_POST) ){
		if(isset($_POST['crear'])){
			$conexion = mysql_connect($host, $username, $password);
			mysql_select_db($database);
			
			$user = $_POST['user'];
			$pass = $_POST['pass'];
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$cedula = $_POST['cedula'];
			$telefono = $_POST['telefono'];
			$direccion = $_POST['direccion'];
			$email = $_POST['email'];
				
			$query = "insert into cliente(user,password,nombre,apellido,cedula,telefono,direccion,email) values('$user','$pass','$nombre','$apellido','$cedula','$telefono','$direccion','$email')";
			$result = mysql_query($query,$conexion);
			mysql_close($conexion);
		}
	
if(isset($_POST['modificar'])){

		$conexion = mysql_connect($host,$username,$password);
		mysql_select_db($database);
		$user=$_POST['id'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$cedula = $_POST['cedula'];
		$telefono = $_POST['telefono'];
		$direccion = $_POST['direccion'];
		$email = $_POST['email'];
			
		$query = "select * from cliente where user='$user'";	
		$result = mysql_query($query);		
		mysql_close($conexion);	
		
		if ( mysql_num_rows($result) > 0 ){
				$conexion = mysql_connect($host,$username,$password);
				mysql_select_db($database);
				$estado = 1;		
				$query ="update cliente set nombre='$nombre', apellido='$apellido', cedula=$cedula, telefono=$telefono, direccion='$direccion', email='$email'  where user ='$user'";$result = mysql_query($query,$conexion);
				mysql_close($conexion);
				echo '<script>document.location = "consultarclientes.php"</script>';
	}
}	
}else{
echo "Por favor digite todos los campos del formulario";
}
	if(isset($_GET['d'])){
		$user = $_GET['e'];
		$conexion = mysql_connect($host,$username,$password);
		$query = "delete from cliente where user='".$_GET['e']."'";
		mysql_select_db($database);
		$result = mysql_query($query,$conexion);
		mysql_close($conexion);
	}
	if($est <= 0){
		switch ($est) {
		case -1: //Si no se pudo hacer la conexion con la base de datos
		  echo '<p class="advertencia">Error de autenticacion por verifique los datos</p>';
		break;
		case -2: //Si el formulario no pasó la validación
			echo '<p class="advertencia">Por favor digite todos los campos del formulario</p>';
			break;   
		case -3: //Si hay datos duplicados
			echo '<p class="advertencia">Ya existe un estado con esa etiqueta</p>';
			break;   
		}
	}	
?>        
      
      <div align="center">
		<form id="form2 name="form2" method="post" action="" target="consultarcategorias.php" enctype="application/x-www-form-urlencoded">
        <?php

$conexion = mysql_connect($host,$username,$password);
mysql_select_db($database);
$query = "select * from cliente";
$result = mysql_query($query,$conexion);
$resultStr = '<div id="prodListPanel"><table id="prodListTable" cellspacing="0px">            					               <tr>
                	<th>Username</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
					<th>Cédula</th>
					<th>Teléfono</th>
					<th>Dirección</th>
					<th>E-mail</th>
					<th>Privilegios</th>
					<th>Eliminar</th>
				</tr>';
		
if(mysql_num_rows($result)>0){
					while($row = mysql_fetch_array($result)){
					
					if($row['user']!=$_SESSION['usuario']){
					
						$resultStr = $resultStr .  "<tr>";
						$resultStr = $resultStr .  '<td><a href="consultarclientes.php?m=1&e='.$row['user'].'">'.$row['user']."</td>";
						$resultStr = $resultStr .  "<td>" . $row['nombre'] . "</td>";
						$resultStr = $resultStr .  "<td>" . $row['apellido'] . "</td>";
						$resultStr = $resultStr .  "<td>" . $row['cedula'] . "</td>";
						$resultStr = $resultStr .  "<td>" . $row['telefono'] . "</td>";
						$resultStr = $resultStr .  "<td>" . $row['direccion'] . "</td>";
						$resultStr = $resultStr .  "<td>" . $row['email'] . "</td>";
						if ($row['admin']==1){
							$resultStr = $resultStr .'<td><a href="consultarclientes.php?l=1&e='.$row['user'].'">Administrador</td>';
						}else{
							$resultStr = $resultStr .'<td><a href="consultarclientes.php?o=1&e='.$row['user'].'">Cliente</td>';
						}
						$resultStr = $resultStr . '<td><a href="consultarclientes.php?d=1&e='.$row['user'].'">x</td>';
						$resultStr = $resultStr . "</tr>";
						}
					}
					$resultStr = $resultStr . '</table></div>';
					echo $resultStr;					 ?>
					<?php
	
						if(isset($_GET['l'])){
							$user = $_GET['e'];
							$conexion = mysql_connect($host, $username, $password);
							mysql_select_db($database);
								
							$query ="update cliente set admin='0'  where user ='$user'";
							$result = mysql_query($query,$conexion);
							mysql_close($conexion);
							echo '<script>document.location = "consultarclientes.php"</script>';
							}
					?>
					<?php
	
						if(isset($_GET['o'])){
							$user = $_GET['e'];
							$conexion = mysql_connect($host, $username, $password);
							mysql_select_db($database);
								
							$query ="update cliente set admin='1'  where user ='$user'";
							$result = mysql_query($query,$conexion);
							mysql_close($conexion);
							echo '<script>document.location = "consultarclientes.php"</script>';
							}
					?>
					
					 <?php
	
						if(isset($_GET['m'])){
							$user = $_GET['e'];
							$conexion = mysql_connect($host, $username, $password);
							mysql_select_db($database);
								
							//Se buscan el estado seleccionado en la base de datos
							$query = "select * from cliente where user='$user'";
							$result = mysql_query($query,$conexion);
							mysql_close($conexion);
							
							$row = mysql_fetch_array($result);
					?></br>
					  <p><strong>Modificar Clientes:</strong></p>
					  <form id="form1" name="form1" method="post" action="" >
						<input name="id" type="hidden" value="<?php echo $row['user']; ?>" />
						<p class="label">Clientes:</p>
						<p></p>
                        <p class="label">Nombre:</p>
                        <p>
                          <input name="nombre" type="text" class="campo" id="nombre" value="<?php echo $row['nombre']; ?>"/>
                        </p>
                        <p class="label">Apellido:</p>
                        <p>
                          <input name="apellido" type="text" class="campo" id="apellido" value="<?php echo $row['apellido']; ?>"/>
                        </p>
                        <p class="label">C&eacute;dula:</p>
                        <p>
                          <input name="cedula" type="text" class="campo" id="cedula" value="<?php echo $row['cedula']; ?>"/>
                        </p>
                        <p class="label">Tel&eacute;fono:</p>
                        <p>
                          <input name="telefono" type="text" class="campo" id="telefono" value="<?php echo $row['telefono']; ?>"/>
                        </p>
                        <p class="label">E-mail:</p>
                        <p>
                          <input name="email" type="text" class="campo" id="email" value="<?php echo $row['email']; ?>"/>
                        </p>
                        </p>
                        <span class="style11">Direccion:</span>
                        <p>
                          <input name="direccion" type="text" class="campo" id="direccion" value="<?php echo $row['direccion']; ?>"/>
                        </p>
                        <p class="label">&nbsp;</p>
						
						<p class="campo"><input type="submit" name="modificar" id="modificar" value="Modificar" />
						  <input type="submit" name="cancelar" id="cancelar" value="Cancelar" />
						</p>
						<p class="campo">&nbsp;</p>
					  </form>  
					  
					<?php
						}else{
						if(isset($_POST['agregar'])){
							
					?></br>
					  <p><strong>Modificar Clientes:</strong></p>
					  <form id="form1" name="form1" method="post" action="" >
						<p class="label">Nombre:</p>
						<p>
                          <input name="nombre" type="text" class="campo" id="nombre" />
                        </p>
						<p class="label">Apellido:</p>
						<p>
                          <input name="apellido" type="text" class="campo" id="apellido" />
                        </p>
						<p class="label">C&eacute;dula:</p>
						<p>
                          <input name="cedula" type="text" class="campo" id="cedula" />
                        </p>
						<p class="label">Tel&eacute;fono:</p>
						<p>
                          <input name="telefono" type="text" class="campo" id="telefono" />
                        </p>
						<p class="label">E-mail:</p>
						<p>
                          <input name="email" type="text" class="campo" id="email" />
                        </p>
						</p>
                        <span class="style11">Direccion:</span>
                        <p>
                          <input name="direccion" type="text" class="campo" id="direccion" />
                        </p>
                        <p class="label">Nombre de Usuario:</p>
                        <p>
                          <input name="user" type="text" class="campo" id="user" />
                        </p>
                        <p class="label">Contrase&ntilde;a:</p>
                        <p>
                          <input name="pass" type="password" class="campo" id="pass" />
                        </p>
                        <p align="center" class="label">&nbsp;</p>
						<p class="campo"><input type="submit" name="crear" id="crear" value="Agregar" />
						  <input type="submit" name="cancelar" id="cancelar" value="Cancelar" />
						</p>
						<p class="campo">&nbsp;</p>
					  </form>  
			        <?php
						}else{
			
					?>
					</br>
					<p class="campo"><input type="submit" name="agregar" id="agregar" value="Agregar" /></p>
			
			
					 <?php					
						}
					} 
						
			
					echo '</div>';
				}

?>
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