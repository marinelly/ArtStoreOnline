<?php

function checkForm($form){	
	foreach( $form as $key => $value ){
		if($value == '') return false;
	}	
	return true;
}

function checkEmail($email){
	return ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]{2,200}\.[a-zA-Z]{2,6}$",$email);
}

// definimos una variable que nos guarde el directorio donde vamos a almacenar los logs
$directoriolog = "logs/";

//la funcion addlog me agrega un registro a al archivo del log del dia actual
function agregarlog($pagina,$evento,$detalles){
	// colocamos a la variable $dirlog como local en esta funcion	
	global $directoriolog;

	// seleccionamos el dia y la hora actual
	$fecha = date('Y-m-d');
	$hora = date('H:i:s');
	
	// armamos el nombre del archivo de log actual
	$nombrearchivo = $directoriolog . 'log'. $fecha . '.txt';	
	
	//verificamos si ese archivo existe
	if( file_exists($nombrearchivo) ){
		// si existe extraemos su contenido
		$contenido = file_get_contents($nombrearchivo);
	}else{
		//si no debe estar vacio
		$contenido = "";
	}
	
	//creamos un apuntador al archivo y lo abrimos de modo escritura
	$archivo = fopen($nombrearchivo, 'w');
	
	//escribimos el registro actual y le anexamos su contenido para que el registro mas reciente quede de primero
	fwrite($archivo, "$fecha, $hora, $pagina, $evento, $detalles" . "\r\n" . $contenido);
	
	//cerramos el apuntador al archivo
	fclose($archivo);
}

function imprimirlog($fecha){	
	//esta funcion nos imprime en una tabla el registro de log de un archivo
	global $directoriolog;

	$nombrearchivo = $directoriolog . 'log'. $fecha . '.txt';
	if(file_exists($nombrearchivo)){
		// si el archivo existe lo creamos de lectura
		$archivo = fopen($nombrearchivo, 'r');
		
		// empezamos a recorrer el archivo
		while( !feof($archivo) ){	
			// extraemos la linea en un vector, sabemos cual es la separacion de las columnas ya que le dimos la coma (,)
			$linea = fgets($archivo,1000);
			echo "<p>$linea</p>";
		}
		
		//cerramos el apuntador al archivo
 		fclose($archivo);
	}
}

function listardirectoriolog(){	
	// esta funcion imprime los nombres de los archivos en la carpeta log y le crea un enlace a cada uno para mostrar 
	// su contenido
	
	global $directoriolog;

	// si el directorio existe
	if ($directorio = opendir($directoriolog)) {
	
		// igual que realizamos cualquier ciclo recorremos el directorio
		while (($archivo = readdir($directorio)) !== false) {
			// preguntamos si ese archivos es un archivo (puede ser directorio)
			if(filetype($directoriolog . $archivo) == 'file'){
					// como todos los archivos de logs se llama log20070905.txt extraemos su nombre
					$nombrelog = substr($archivo,3,10);
					
					// imprimimos el nombre del archivo con un enlace directo para mostrar su contenido
					echo '<p><a href="adminLogs.php?log=' . $nombrelog . '" target="_self">' . $nombrelog . '</a><p>';
			}
		}
		closedir($directorio);
	}
}

?>