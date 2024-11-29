<?php
// Establece encabezados de CORS
header("Access-Control-Allow-Origin: https://pagina-alquiler.vercel.app/"); // Cambia por tu dominio frontend
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS"); // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Encabezados permitidos
header("Content-Type: application/json"); // Tipo de contenido

// Manejo para solicitudes preflight (método OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200); // Responde con éxito para OPTIONS
    exit();
}

// Incluye los archivos necesarios para la conexión a la base de datos y la clase Casa
require_once("../configuracion/conexion.php");
require_once("../modelos/Casa.php");

// Crea una instancia de la clase Casa
$casa = new Casa();

// Obtiene los datos enviados en formato JSON
$body = json_decode(file_get_contents("php://input"), true);

// Obtén el método HTTP utilizado
$method = $_SERVER['REQUEST_METHOD'];

// Define las operaciones basadas en el método HTTP
switch ($method) {
    case "GET":
        $datos = $casa->obtener_casa();
        echo json_encode($datos);
        break;

    case "PATCH":
        $datos = $casa->obtener_casa_por_id($body["id_casa"]);
        echo json_encode($datos);
        break;

    case "POST":
        $datos = $casa->insertar_casa($body["direccion"], $body["ciudad"],  $body["precio_alquiler"],  $body["DNI_propietario"]);
        echo json_encode(["Correcto" => "Inserción Realizada"]);
        break;

    case "PUT":
        $datos = $casa->actualizar_casa($body["id_casa"], $body["direccion"], $body["ciudad"],  $body["precio_alquiler"],  $body["DNI_propietario"]);
        echo json_encode(["Correcto" => "Actualización Realizada"]);
        break;

    case "DELETE":
        $datos = $casa->eliminar_casa($body["id_casa"]);
        echo json_encode(["Correcto" => "Eliminación Realizada"]);
        break;

    default:
        http_response_code(405);
        echo json_encode(["Error" => "Método no permitido"]);
        break;
}
?>
