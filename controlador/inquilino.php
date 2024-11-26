<?php

// Establece el tipo de contenido a JSON
header("Content-Type: application/json");

// Incluye los archivos necesarios para la conexión a la base de datos y la clase Categoria
require_once("../configuracion/conexion.php");
require_once("../modelos/Inquilino.php");

// Crea una instancia de la clase Categoria
$inquilino = new Inquilino();

// Obtiene los datos enviados en formato JSON
$body = json_decode(file_get_contents("php://input"), true);

// Obtén el método HTTP utilizado
$method = $_SERVER['REQUEST_METHOD'];

// Define las operaciones basadas en el método HTTP
switch ($method) {

    // Manejo para obtener todas las categorías (GET)
    case "GET":
        // Llama al método para obtener todas las categorías

            $datos = $inquilino->obtener_inquilino();
            // Devuelve los datos en formato JSON
            echo json_encode($datos);
            break;
    case "PATCH":
            // Llama al método para insertar una nueva categoría
            $datos = $inquilino->obtener_inquilino_por_DNI($body["DNI"]);
            // Devuelve una respuesta indicando que la inserción fue correcta
            echo json_encode($datos);
            break;    
        

    // Manejo para insertar una nueva categoría (POST)
    case "POST":
        // Llama al método para insertar una nueva categoría
        $datos = $inquilino->insertar_inquilino($body["DNI"], $body["nombre"],  $body["telefono"],  $body["email"], $body["fecha_inicio_alquiler"], $body["id_casa"]);
        // Devuelve una respuesta indicando que la inserción fue correcta
        echo json_encode(["Correcto" => "Inserción Realizada"]);
        break;

    // Manejo para actualizar una categoría (PUT)
    case "PUT":
        // Llama al método para actualizar una categoría existente
        $datos = $inquilino->actualizar_inquilino($body["DNI"], $body["nombre"],  $body["telefono"],  $body["email"], $body["fecha_inicio_alquiler"], $body["id_casa"]);
        // Devuelve una respuesta indicando que la actualización fue correcta
        echo json_encode(["Correcto" => "Actualización Realizada"]);
        break;

    // Manejo para eliminar una categoría (DELETE)
    case "DELETE":
        // Llama al método para eliminar una categoría
        $datos = $inquilino->eliminar_inquilino($body["DNI"]);
        // Devuelve una respuesta indicando que la eliminación fue correcta
        echo json_encode(["Correcto" => "Eliminación Realizada"]);
        break;

    // Manejo para métodos no soportados
    default:
        http_response_code(405);
        echo json_encode(["Error" => "Método no permitido"]);
        break;
}
?>