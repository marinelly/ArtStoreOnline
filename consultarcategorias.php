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
      <h2><br />
    </h2>
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
	
      <h2>Gestionar Categor&iacute;as</h2>
      <h2>&nbsp;</h2>
	  <?php
	  if(isset($_POST['cancelar'])){
			echo '<script>document.location = "consultarcategorias.php"</script>';	  
	  }
if( checkForm($_POST) ){
		if(isset($_POST['crear'])){
			$NombreCat = $_POST['nombre'];
			$IdCat = $_POST['idcat'];
			$conexion = mysql_connect($host,$username,$password);
			mysql_select_db($database);
			$query = "select * from categorias where NombreCat='$NombreCat' or IdCat='$IdCat'";
			$result = mysql_query($query,$conexion);
			mysql_close($conexion);
			
			if(mysql_num_rows($result)>0){
				echo "Existe una categoría ya creada con los datos ingresados";
			}else{
				$conexion = mysql_connect($host,$username,$password);
				mysql_select_db($database);
				$query = "insert into categorias (IdCat, NombreCat) values ('$IdCat','$NombreCat')";
				$result = mysql_query($query,$conexion);
				mysql_close($conexion);
				echo '<script>document.location = "consultarcategorias.php"</script>';
			
			}
	}

	
	if(isset($_POST['modificar'])){
			$NombreCat = $_POST['nombre'];
			$IdCat = $_POST['id'];
			$conexion = mysql_connect($host,$username,$password);
			mysql_select_db($database);
			$query = "select * from categorias where NombreCat='$NombreCat'";
			$result = mysql_query($query,$conexion);
			mysql_close($conexion);
			
			if(mysql_num_rows($result)>0){
				echo "Existe una categoría ya creada con los datos ingresados";
			}else{
				$conexion = mysql_connect($host,$username,$password);
				mysql_select_db($database);
				$query = "update categorias set NombreCat='$NombreCat' where IdCat='$IdCat'";
				$result = mysql_query($query,$conexion);
				mysql_close($conexion);
				echo '<script>document.location = "consultarcategorias.php"</script>';
			
			}
	}
	
}else{
echo "Por favor digite todos los campos del formulario";
}
	if(isset($_GET['d'])){
		$IdCat = $_GET['e'];
		$conexion = mysql_connect($host,$username,$password);
		$query = "delete from categorias where IdCat='".$_GET['e']."'";
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
		<form id="form2 name="form2" method="post" action="" target="_self" enctype="application/x-www-form-urlencoded">
        <?php
$conexion = mysql_connect($host,$username,$password);
mysql_select_db($database);
$query = "select * from categorias";
$result = mysql_query($query,$conexion);
$resultStr = $resultStr.'<div id="prodListPanel"><table id="prodListTable" cellspacing="0px">
            	<tr>
                	<th>IdCat</th>
                    <th>Nombre Categoría</th>
					 <th>Eliminar</th>
                 </tr>';
		
if(mysql_num_rows($result)>0){
					while($row = mysql_fetch_array($result)){
						$resultStr = $resultStr . "<tr>";
						$resultStr = $resultStr . '<td><a href="consultarcategorias.php?m=1&e='.$row['IdCat'].'">'.$row['IdCat'].'</td>';
						$resultStr = $resultStr ."<td>" . $row['NombreCat'] . "</td>";
						$resultStr = $resultStr . '<td><a href="consultarcategorias.php?d=1&e='.$row['IdCat'].'">x</td>';
						$resultStr = $resultStr . "</tr>";
					}
					 $resultStr = $resultStr . '</table>';
					 echo $resultStr;
					 ?>
					 <?php
	
						if(isset($_GET['m'])){
							$IdCat = $_GET['e'];
							$conexion = mysql_connect($host, $username, $password);
							mysql_select_db($database);
								
							//Se buscan el estado seleccionado en la base de datos
							$query = "select * from categorias where IdCat='$IdCat'";
							$result = mysql_query($query,$conexion);
							mysql_close($conexion);
							
							$row = mysql_fetch_array($result)
					?></br>
					  <p><strong>Modificar Categoria:</strong></p>
					  <form id="form1" name="form1" method="post" action="" >
						<input name="id" type="hidden" value="<?php echo $row['IdCat']; ?>" />
						<p class="label">Categoria:</p>
						<p class="campo"><input type="text" name="nombre" id="nombre" value="<?php echo $row['NombreCat']; ?>"/></p>
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
					  <p>&nbsp;</p>
					  <form id="form1" name="form1" method="post" action="" target="_self" >
						<p class="label">Categoria:</p>
						<p align="center" class="label">ID Categor&iacute;a: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;   
						  <input type="text" name="idcat" id="idcat" value=""/>
						</p>
						<p align="center" class="campo">Nombre Categor&iacute;a: 
						  <input type="text" name="nombre" id="nombre" value=""/></p>
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
