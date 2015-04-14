<?php
session_start();
include("includes/local.settings.php");
include('includes/funciones.php'); 
	
if(isset($_SESSION['login'])){

  $conexion = mysql_connect($host,$username,$password);
    mysql_select_db($database);
    $query = "delete from carritodecompras where user='".$_SESSION['usuario']."'";
	$result = mysql_query($query,$conexion);
    mysql_close($conexion);
    session_destroy();
 }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Arte Online</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css" media="all">
@import "images/style.css";
</style>
</head>
<body>


<div class="content">
  <div class="rside">
    <div class="topmenu"></div>
    <div class="loginbox">
      <div class="padding">
       <form id="form1" name="form1" method="post" target="_self" enctype="application/x-www-form-urlencoded" action="">
          Login <br />
          <input type="text" value="" class="text" name="username" id="username" />
          <br />
          Password <br />
          <input type="password" value="" class="text" name="password" id="password" />
          <br />
	    <br />
          <input type="submit" name="login" id="login" value="Login" class="searchbutton" />
          <br />
	    <a href="Registrar.php">Regístrate</a>
	    <br />
        </form>
        
      </div>
    </div>
    <div class="topmain">Main Menu</div>
    <div class="menu">
      <h2>Categories</h2>
      <div class="nav">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="gallery.php">Galer&iacute;a</a></li>
          <li><a href="acercade.php">Acerca de </a></li>
          <li><a href="contactenos.php">Cont&aacute;ctenos</a></li>
        </ul>
      </div>
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
	
      <h2>Picasso y el Cubismo</h2>
      <h2>&nbsp;</h2>
      <div align="left">
        <p align="center"><img src="images/demoisel.jpeg" alt="Las se&ntilde;oritas de Avignon" width="269" height="235" /></p>
        <p>&nbsp;</p>
        <p>Por 1906, Picasso ha conseguido una posici&oacute;n destacada  con su arte. Era el mejor pintor de su c&iacute;rculo de amigos y su reputaci&oacute;n  segu&iacute;a creciendo. Durante el a&ntilde;o 1906, empez&oacute; trabajar  en una pintura muy diferente de sus otras pinturas. La pintura se llama <em>Las se&ntilde;oritas de Avignon</em> y constituye una ruptura en la historia  del arte.</p>
        <p>Para <em>Las se&ntilde;oritas de Avignon</em> Picasso hizo  m&aacute;s de treinta esbozos. Fue la pintura m&aacute;s grande que hizo.  Guando termin&oacute; esta pintura, la reacci&oacute;n fue de incredulidad.  Nadie loa la pintura. Mucho tiempo pas&oacute; antes de fuera apreciada.  En esta pintura, Picasso distorsion&oacute; las figuras de las mujeres.  Cambi&oacute; los rasgos de la cara y muestra el frente y el rev&eacute;s  al mismo tiempo.</p>
      </div>
      <p class="date">&nbsp;</p>
      <p>&nbsp;</p>
      <p><br />
        </p>
    </div>
    </div>
  <div class="footer"> Copyright &copy; 2006 LightBiz | Design: <a href="http://www.free-css-templates.com">David Herreman</a> | <a href="http://www.free-css.com/">Contact</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a href="http://www.free-css.com/">Home</a> </div>
</div>
<?php
}
?>
</body>
</html>
