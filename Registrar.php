<?php
	// inicializamos la sesion
	session_start();
	
	//como es el ingreso de la sesion si existe la destruimos con todas sus variables
if(isset($_SESSION['login'])) session_destroy();

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
.style1 {color: #888}
</style>
</head>
<body>


<div class="content">
  <div class="rside">
    <div class="topmenu"></div>
    <div class="loginbox">
      <div class="padding">
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
  <div class="lside">
    <div class="topmenu"> &nbsp;<a href="http://www.free-css.com/">About</a> | <a href="http://www.free-css.com/">Contact</a> </div>
    <div class="header">
      <div class="padding">
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
	?>   
        <h1>&nbsp;</h1>
      </div>
    </div>
    <div class="main">
	
      <h2><a href="http://www.free-css.com/">Registrar</a></h2>
      <h2>&nbsp;</h2>
      <div align="left">
           <?php
if(isset($_POST['registrar'])){
	if( checkForm($_POST) ){
	
		$conexion = mysql_connect($host, $username, $password);
		mysql_select_db($database);
		
		$username = $_POST['user'];
		$password = $_POST['pass'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$cedula = $_POST['cedula'];
		$telefono = $_POST['telefono'];
		$direccion = $_POST['direccion'];
		$email = $_POST['email'];
			
		$query = "insert into cliente(user,password,nombre,apellido,cedula,telefono,direccion,email) values('$username','$password','$nombre','$apellido','$cedula','$telefono','$direccion','$email')";
		$result = mysql_query($query,$conexion);
		mysql_close($conexion);
		echo "Cliente Agregado Correctamente";
}else{	echo "Error Al ingresar Cliente";
}
}		
?> <br />
    <br />
         <form id="form1" name="form1" method="post" action="" target="_self" enctype="application/x-www-form-urlencoded">
          <p class="label">Nombre:</p>
          <p>
            <input name="nombre" type="text" class="campo" id="nombre" />
          </p>
          <p class="label">Apellido:</p>
          <p>
            <input name="apellido" type="text" class="campo" id="apellido" />
          </p>
           <p class="label">Cédula:</p>
          <p>
            <input name="cedula" type="text" class="campo" id="cedula" />
          </p>
          <p class="label">Teléfono:</p>
          <p>
            <input name="telefono" type="text" class="campo" id="telefono" />
          </p>
          <p class="label">E-mail:</p>
          <p>
            <input name="email" type="text" class="campo" id="email" />
          </p>
          </p>
          <span class="style1">Direccion:</span>
          <p>
            <input name="direccion" type="text" class="campo" id="direccion" />
          </p>
          <p class="label">Nombre de Usuario:</p>
          <p>
            <input name="user" type="text" class="campo" id="user" />
          </p>
          <p class="label">Contraseña:</p>
          <p>
            <input name="pass" type="password" class="campo" id="pass" />    
          </p>
          <p class="label">
            <input type="submit" name="registrar" id="registrar" value="Registrar" />
          </p>
	  </form>
     </p>
      </div>
      </div>
    </div>
  <div class="footer"> Copyright &copy; 2006 LightBiz | Design: <a href="http://www.free-css-templates.com">David Herreman</a> | <a href="http://www.free-css.com/">Contact</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a href="http://www.free-css.com/">Home</a> </div>
</div>
<?php
}
?>
</body>
</html>
