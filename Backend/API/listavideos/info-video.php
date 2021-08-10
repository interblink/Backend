<?PHP

//La idea de info-videos es conectarse a la base de datos y obtener un registro especifico del video que necesite


//CORS Es un formato que me permite compartir desde diferentes medios los archivos que se encuentran dentro de este servidor  
header("Access-Control-Allow-Origin: *"); //envia los datos al inicio
//el * permite que cualquier servidor obtenga la informacion.

// pero si quiero que sea un servidor especial en lugar de colocar * pongo servidor.com
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");//Permite que se acceda desde cualquier servidor a la informacion de abajo cuando viene por POST, GET, OPTIONS

header("Content-Type: application/json"); //define el formato para que se vea en json

include_once('../comun/db_sitio_videos.php'); //conexion a la base de datos

function obtener_info($id){ //obtener los resultados que se encuentran en la base de datos

    global $enlace;

    $resultado = mysqli_query( $enlace, "SELECT * FROM videos WHERE id= '".$id."' "); //'".$id."' es un valor de trabajo dinamico porque cambia segun el get que llega de la URL

    // Si me genera error al mostrar en el navegador la consulta es porque debo pasarle a traves del get el numero quedando asi http://localhost/API/info-video.php?id=123  //donde 123 es el valor del id de la tabla videos
   // Si aparece el error en navegador SyntaxError: JSON.parse: unexpected character at line 1 column 1 of the JSON data, es porque no exite el registro en el campo id de la tabla videos
    while ($fila = mysqli_fetch_array($resultado)){
        $todosLosVideos[] = $fila;
    }
    return $todosLosVideos;
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){

  $resultado = obtener_info( $_GET['id'] ); //$_GET['id'] es el argumento que viene desde la URL que se esta buscando

}else{

    header('HTTP/1.1 405 Method Not Allowed');
    exit;

}

echo json_encode($resultado); //"json_encode (obtiene un Array no asociativo retornado como objeto)



?>