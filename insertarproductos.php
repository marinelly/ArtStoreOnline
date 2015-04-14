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
	
      <h2>Modificar Producto</h2>
      <h2>&nbsp;</h2>
      <div align="left">
      
      <?php
$estado = 0;

if(isset($_POST['cargar'])){

	if( checkForm($_POST) ){

		if($_FILES["file"]["name"] != ''){

			if ($_FILES["file"]["error"] <= 0){

				$conexion = mysql_connect($host, $username, $password);
				mysql_select_db($database);
				
				$idprod = $_POST['idprod'];
				$nombrep = $_POST['nombrep'];
				$categoria = $_POST['categoria'];
				$cantidad = $_POST['cantidad'];
				$precio = $_POST['precio'];
				$autor = $_POST['autor'];
				$pais = $_POST['pais'];
				$dimensiones = $_POST['dimensiones'];
				$tecnica = $_POST['tecnica'];
				$soporte=$_POST['soporte'];
		
		
				$tmp_name = $_FILES["file"]["tmp_name"]; 
				$size = $_FILES["file"]["size"];
				$type    = $_FILES["file"]["type"];
				$name  = $_FILES["file"]["name"];
			
				$fp = fopen($tmp_name, "rb");
				$contenido = fread($fp, $size);
				$contenido = addslashes($contenido);
				fclose($fp); 
			
				$query = "insert into producto(IdProd,NombreP,Categoria,Cantidad,Precio,Autor,Pais,Dimensiones,Imagen, Tecnica,Soporte) values('$idprod','$nombrep','$categoria',$cantidad,$precio,'$autor','$pais','$dimensiones','$contenido','$tecnica','$soporte')";
				
		
				$result = mysql_query($query,$conexion);
				mysql_close($conexion);
				echo "Producto Agregado Correctamente";
				$estado = 1;
						}else{
							$estado = -3;
						}
					}
				}else{
					$estado = -1;
				}
			}

		if($estado <= 0){
		switch ($estado) {
		case -1:
			echo '<p class="advertencia">Por favor seleccione la imagen que desea cargar.</p>';
		break;
		case -2:
			echo '<p class="error">Upps ha ocurrido un error en el sistema, por favor intentelo mas tarde.</p>';
		break;
		case -3:
			echo '<p class="error">Upps ha ocurrido un error en el sistema, el archivo se cargo pero no se puede mover.</p>';
		break;

	}
	}
?>

      
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
         <p class="label">Identificador Producto:</p>
          <p>
            <input name="idprod" type="text" class="campo" id="idprod" />
          </p>
           <p class="label">Nombre Producto:</p>
           <p>
             <input name="nombrep" type="text" class="campo" id="nombrep" />
</p>
           <p class="label">Categor&iacute;a:</p>
           <p>
             <input name="categoria" type="text" class="campo" id="categoria" />
           </p>
           <p class="label">Cantidad:</p>
           <p>
             <input name="cantidad" type="text" class="campo" id="cantidad" />
           </p>
           <p class="label">Precio:</p>
           <p>
             <input name="precio" type="text" class="campo" id="precio" />
           </p>
           <p class="label">Autor:</p>
           <p>
             <input name="autor" type="text" class="campo" id="autor" />
           </p>
           <p class="label">Pa&iacute;s:</p>
           <p>
             <input name="pais" type="text" class="campo" id="pais" />
           </p>
           <p class="label">Dimensiones:</p>
           <p>
             <input name="dimensiones" type="text" class="campo" id="dimensiones" />
           </p>
           <p class="label">Im&aacute;gen:</p>
           <p>
             <input type="file" name="file" id="file" />
           </p>
           <p class="label">T&eacute;cnica:</p>
           <p>
             <input name="tecnica" type="text" class="campo" id="tecnica" />
           </p>
           <p class="label">Soporte:</p>
           <p>
             <input name="soporte" type="text" class="campo" id="soporte" />
           </p>
           <p>&nbsp;</p>
		
		<input type="submit" name="cargar" value="Cargar" id="cargar" />
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
