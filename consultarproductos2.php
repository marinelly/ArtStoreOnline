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
          <li><a href="contactenos.php">Cont&aacute;ctenos</a></li>
        </ul>
      </div>
      <h2>Search</h2>

      <br />
      <h2>Your Ads</h2>
      <div class="ads"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer euismod ante non diam. Sed eleifend odio sed quam.Integer euismod ante non diam. Sed eleifend odio sed quam. </div>
      <br />
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
			echo '<script>document.location = "consultarproductos2.php"</script>';	  
	  }

	if(isset($_POST['crear'])){
		echo '<script>document.location = "insertarproductos2.php"</script>';
	}

	
	if(isset($_POST['modificar'])){

		$conexion = mysql_connect($host, $username, $password);
		mysql_select_db($database);
		
		$idprod = $_POST['id'];
		$nombrep = $_POST['nombrep'];
		$categoria = $_POST['categoria'];
		$cantidad = $_POST['cantidad'];
		$precio = $_POST['precio'];
		$autor = $_POST['autor'];
		$pais = $_POST['pais'];
		$dimensiones = $_POST['dimensiones'];
		$tecnica = $_POST['tecnica'];
		$soporte=$_POST['soporte'];
			
		$query = "select * from producto where IdProd='$idprod'";	
		$result = mysql_query($query);		
		mysql_close($conexion);	
		
		if ( mysql_num_rows($result) > 0 ){
				$conexion = mysql_connect($host,$username,$password);
				mysql_select_db($database);
				$estado = 1;		
				if($_FILES["file"]["name"] != ''){
					if ($_FILES["file"]["error"] <= 0){
						if( move_uploaded_file($_FILES["file"]["tmp_name"], "images/" . $_FILES["file"]["name"]) ){		
		
							$tmp_name = $_FILES["file"]["tmp_name"]; 
							$size = $_FILES["file"]["size"];
							$type    = $_FILES["file"]["type"];
							$name  = $_FILES["file"]["name"];
							$contenido= "images/" . $_FILES["file"]["name"] ;
							
							$query ="update producto set NombreP='$nombrep', Categoria='$categoria', Cantidad=$cantidad, Precio=$precio, Autor='$autor', Pais='$pais', Dimensiones='$dimensiones',Imagen='$contenido', Tecnica='$tecnica', Soporte='$soporte'  where IdProd='$idprod' ";
						}else{
							echo "No se pudo cargar la imagen";
						}
					}else{
						echo "No se pudo cargar la imagen";
					}
				}else{
					$query ="update producto set NombreP='$nombrep', Categoria='$categoria', Cantidad=$cantidad, Precio=$precio, Autor='$autor', Pais='$pais', Dimensiones='$dimensiones', Tecnica='$tecnica', Soporte='$soporte'  where IdProd='$idprod' ";
				}
						$result = mysql_query($query,$conexion);
						mysql_close($conexion);
						echo '<script>document.location = "consultarproductos2.php"</script>';	
			}
	}	

	if(isset($_GET['d'])){
		$user = $_GET['e'];
		$conexion = mysql_connect($host,$username,$password);
		$query = "delete from producto where IdProd='".$_GET['e']."'";
		echo $query;
		mysql_select_db($database);
		$result = mysql_query($query,$conexion);
		mysql_close($conexion);
		echo '<script>document.location = "consultarproductos2.php"</script>';
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
$query = "select * from producto";
$result = mysql_query($query,$conexion);
$resultStr = $resultStr.'<div id="prodListPanel"><table id="prodListTable" cellspacing="0px">
            	<tr>
                	<th>IdProd</th>
                    <th>NombreP</th>
                    <th>Categoria</th>
                    <th>Cantidad</th>
					<th>Precio</th>
					<th>Autor</th>
					<th>Pais</th>
					<th>Dimensiones</th>
					<th>Tecnica</th>
					<th>Soporte</th>
					<th>Eliminar</th>
					<th></th>
				</tr>';
		
if(mysql_num_rows($result)>0){
					while($row = mysql_fetch_array($result)){
						$resultStr = $resultStr . "<tr>";
						$resultStr = $resultStr . 	'<td><a href="consultarproductos2.php?m=1&e='.$row['IdProd'].'">'.$row['IdProd'].'</td>';								
						$resultStr = $resultStr .     "<td>" . $row['NombreP'] . "</td>";
						$resultStr = $resultStr .     "<td>" . $row['Categoria'] . "</td>";
						$resultStr = $resultStr .     "<td>" . $row['Cantidad'] . "</td>";
						$resultStr = $resultStr .     "<td>" . $row['Precio'] . "</td>";
						$resultStr = $resultStr .     "<td>" . $row['Autor'] . "</td>";
						$resultStr = $resultStr .     "<td>" . $row['Pais'] . "</td>";
						$resultStr = $resultStr .     "<td>" . $row['Dimensiones'] . "</td>";
						$resultStr = $resultStr .     "<td>" . $row['Tecnica'] . "</td>";
						$resultStr = $resultStr .     "<td>" . $row['Soporte'] . "</td>";
						$resultStr = $resultStr . '<td><a href="consultarproductos2.php?d=1&e='.$row['IdProd'].'">x</td>';

						$resultStr = $resultStr . "</tr>";
					}
					$resultStr = $resultStr . '</table></div>';
					echo $resultStr;?>
					 <?php
	
						if(isset($_GET['m'])){
							$IdProd = $_GET['e'];
							$conexion = mysql_connect($host, $username, $password);
							mysql_select_db($database);
								
							//Se buscan el estado seleccionado en la base de datos
							$query = "select * from producto where IdProd='$IdProd'";
							$result = mysql_query($query,$conexion);
							mysql_close($conexion);
							
							$row = mysql_fetch_array($result);
					?></br>
					  <p><strong>Modificar Productos:</strong></p>
					 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
						<input name="id" type="hidden" value="<?php echo $row['IdProd']; ?>" />
						<p class="label">Productos</p>
						<p> </p>
                        <p class="label">Nombre Producto:</p>
                        <p>
                          <input name="nombrep" type="text" class="campo" id="nombrep" value="<?php echo $row['NombreP']; ?>"/>
                        </p>
                        <p class="label">Categor&iacute;a:</p>
                        <p>
                          <select name = "categoria">
						  
                            <?php
                           $conexion1 = mysql_connect($host, $username, $password);
							mysql_select_db($database);
							$query1="select * from categorias";
                            $result1=mysql_query($query1,$conexion1);
                            
							while( $row1 = mysql_fetch_array($result1) ){
								if($row1['IdCat']==$row['Categoria']){
								echo '<option value="' . $row1['IdCat'] . ' selected="selected" ">' . htmlentities($row1['NombreCat']) . '</option>';
								}else{
								echo '<option value="' . $row1['IdCat'] . '">' . htmlentities($row1['NombreCat']) . '</option>';
								}
							}
							   	mysql_close($conexion1);
                            
                            ?>
                          </select>
                        </p>
                        <p class="label">Cantidad:</p>
                        <p>
                          <input name="cantidad" type="text" class="campo" id="cantidad" value="<?php echo $row['Cantidad']; ?>"/>
                        </p>
                        <p class="label">Precio:</p>
                        <p>
                          <input name="precio" type="text" class="campo" id="precio" value="<?php echo $row['Precio']; ?>"/>
                        </p>
                        <p class="label">Autor:</p>
                        <p>
                          <input name="autor" type="text" class="campo" id="autor" value="<?php echo $row['Autor']; ?>"/>
                        </p>
                        <p class="label">Pa&iacute;s:</p>
                        <p>
                          <input name="pais" type="text" class="campo" id="pais" value="<?php echo $row['Pais']; ?>"/>
                        </p>
                        <p class="label">Dimensiones:</p>
                        <p>
                          <input name="dimensiones" type="text" class="campo" id="dimensiones" value="<?php echo $row['Dimensiones']; ?>"/>
                        </p>
                        <p class="label">Im&aacute;gen:</p>
						<p>
						   <img src="<?php echo $row['Imagen']; ?>" width="64" height="64" border="0" />
                        </p>
                        <p>
                          <input type="file" name="file" id="file" />
                        </p>
						<p class="label">T&eacute;cnica:</p>
                        <p>
						
                          <input name="tecnica" type="text" class="campo" id="tecnica"  value="<?php echo $row['Tecnica']; ?>"/>
                        </p>
                        <p class="label">Soporte:</p>
                        <p>
                          <input name="soporte" type="text" class="campo" id="soporte" value="<?php echo $row['Soporte']; ?>"/>
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
					  <p><strong>Agregar Producto:</strong></p>
					  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        <p class="label">Identificador Producto:</p>
					    <p>
                          <input name="idprod2" type="text" class="campo" id="idprod2" />
                        </p>
					    <p class="label">Nombre Producto:</p>
					    <p>
                          <input name="nombrep2" type="text" class="campo" id="nombrep2" />
                        </p>
					    <p class="label">Categor&iacute;a:</p>
					    <p>
                          <select name = "categoria">
                            <?php
                           $conexion = mysql_connect($host, $username, $password);
							mysql_select_db($database);
							$query="select * from categorias";
                            $result=mysql_query($query,$conexion);
                            while($row = mysql_fetch_array($result)) {
                            printf( "<option value = %s>%s - %s", $row["IdCat"], $row["IdCat"], $row["NombreCat"]);
                                }
                               	mysql_close($conexion);
                            
                            ?>
                          </select>
                        </p>
					    <p class="label">Cantidad:</p>
					    <p>
                          <input name="cantidad2" type="text" class="campo" id="cantidad2" />
                        </p>
					    <p class="label">Precio:</p>
					    <p>
                          <input name="precio2" type="text" class="campo" id="precio2" />
                        </p>
					    <p class="label">Autor:</p>
					    <p>
                          <input name="autor2" type="text" class="campo" id="autor2" />
                        </p>
					    <p class="label">Pa&iacute;s:</p>
					    <p>
                          <input name="pais2" type="text" class="campo" id="pais2" />
                        </p>
					    <p class="label">Dimensiones:</p>
					    <p>
                          <input name="dimensiones2" type="text" class="campo" id="dimensiones2" />
                        </p>
					    <p class="label">Im&aacute;gen:</p>
					    <p>
                          <input type="file" name="file" id="file" />
                        </p>
					    <p class="label">T&eacute;cnica:</p>
					    <p>
                          <input name="tecnica2" type="text" class="campo" id="tecnica2" />
                        </p>
					    <p class="label">Soporte:</p>
					    <p>
                          <input name="soporte2" type="text" class="campo" id="soporte2" />
				        </p>
					    <p>&nbsp;</p>
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
			
			
					 <p>
  <?php					
						}
					} 
						
			
					echo '</div>';
				}

?>
  </form>
	    </p>
					 <p>&nbsp;</p>
					 <p>&nbsp;</p>
					 <p>&nbsp;</p>
					 <p>&nbsp;</p>
					 <p>&nbsp;</p>
					 <p>&nbsp;</p>
					 <p>&nbsp;</p>
					 <p>&nbsp;</p>
					 <p>&nbsp;               </p>
      </div>
      <p><br /></p>
    </div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
  <div class="footer"> Copyright &copy; 2006 LightBiz | Design: <a href="http://www.free-css-templates.com">David Herreman</a> | <a href="http://www.free-css.com/">Contact</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> and <a href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a href="http://www.free-css.com/">Home</a> </div>
</div>
</body>
</html>