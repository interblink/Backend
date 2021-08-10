<?php
//este archivo entra a la base de datos y me trae todos los registros que esten


//CORS Es un formato que me permite compartir desde diferentes medios los archivos que se encuentran dentro de este servidor  
header("Access-Control-Allow-Origin: *"); //envia los datos al inicio
//el * permite que cualquier servidor obtenga la informacion.

// pero si quiero que sea un servidor especial en lugar de colocar * pongo servidor.com
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");//Permite que se acceda desde cualquier servidor a la informacion de abajo cuando viene por POST, GET, OPTIONS

header("Content-Type: application/json"); //define el formato para que se vea en json

include_once('../comun/db_sitio_videos.php'); //conexion a la base de datos

function lista_de_video(){
//lo que hace es llamar a la base de datos y traerse todo lo que tenga segun lo que yo necesite

    global $enlace;

    $resultado = mysqli_query($enlace,"SELECT * FROM videos");

    while($fila = mysqli_fetch_array($resultado)){
        $todoslosvideos[] = $fila;


    }
  return $todoslosvideos;
}


if($_SERVER['REQUEST_METHOD'] == 'GET'){

$resultado = lista_de_video();

}else{

header('HTTP/1.1 405 Method Not Allowed');
exit;

}

echo json_encode( $resultado);//"json_encode (obtiene un Array no asociativo retornado como objeto)


?>