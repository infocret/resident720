<?php 
namespace App\Traits;

// Para obtener lista de archvos
trait files
{

function getfilelist($directorio){

  // Array en el que obtendremos los resultados
  $res = array();
$finfo = finfo_open(FILEINFO_MIME_TYPE); // devuelve el tipo mime de su extensión
  // Agregamos la barra invertida al final en caso de que no exista
  if(substr($directorio, -1) != "/") $directorio .= "/";

  // Creamos un puntero al directorio y obtenemos el listado de archivos
  $dir = @dir($directorio) or die("getFileList: Error abriendo el directorio $directorio para leerlo");
  while(($archivo = $dir->read()) !== false) {
      // Obviamos los archivos ocultos
      if($archivo[0] == ".") continue;
      if(is_dir($directorio . $archivo)) {
          $res[] = array(
            "Ruta" => $directorio,
            "Nombre" => $archivo,
            "RutNom" => $directorio . $archivo . "/",
            "Extencion" => pathinfo($directorio . $archivo, PATHINFO_EXTENSION),
            "Tamaño" => 0,
            "Modificado" => filemtime($directorio . $archivo),
            "Mime" => finfo_file($finfo,$directorio . $archivo)
           
          );
      } else if (is_readable($directorio . $archivo)) {
          $res[] = array(
            "Ruta" => $directorio,
            "Nombre" => $archivo,
            "RutNom" => $directorio . $archivo . "/",
            "Extencion" => pathinfo($directorio . $archivo, PATHINFO_EXTENSION),
            "Tamaño" => filesize($directorio . $archivo),
            "Modificado" => filemtime($directorio . $archivo),            
            "Mime" => finfo_file($finfo,$directorio . $archivo)

          );
      }
  }
  $dir->close();
  return $res;
}



}

 ?>