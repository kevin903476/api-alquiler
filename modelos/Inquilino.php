<?php
// Clase Categoria hereda de la clase Conectar
class Inquilino extends Conectar {

    // Obtiene todas las categorías activas
    public function obtener_inquilino() {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Consulta SQL para obtener todas las categorías activas
        $consulta_sql = "SELECT * FROM inquilino";   

        // Prepara la consulta SQL
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->execute();

        // Retorna el resultado de la consulta como un array asociativo
        return $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);   
    }

    // Obtiene una categoría específica por su ID
    public function obtener_inquilino_por_DNI($DNI) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Consulta SQL para obtener una propietario     específica por su ID
        $consulta_sql = "SELECT * FROM inquilino WHERE DNI = ?";

        // Prepara la consulta SQL
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->bindValue(1, $DNI);  // Asocia el valor del ID de categoría

        // Ejecuta la consulta
        $consulta->execute();

        // Retorna el resultado como un array asociativo
        return $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserta una nuevo propietario
    public function insertar_inquilino($DNI, $nombre, $telefono,$email,  $fecha_inicio_alquiler, $id_casa) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Sentencia SQL para insertar una nueva categoría
        $sentencia_sql = "INSERT INTO `inquilino`(`DNI`, `nombre`, `telefono`, `email`, `fecha_inicio_alquiler`, `id_casa`) VALUES (?,?,?,?,?,?)";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $DNI);  
        $sentencia->bindValue(2, $nombre);  
        $sentencia->bindValue(3, $telefono); 
        $sentencia->bindValue(4, $email); 
        $sentencia->bindValue(5, $fecha_inicio_alquiler); 
        $sentencia->bindValue(6, $id_casa); 

        // Ejecuta la sentencia
        $sentencia->execute();

        // Retorna el resultado (aunque no es necesario para un insert, se puede omitir)
        return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    // Actualiza una categoría existente
    public function actualizar_inquilino($DNI, $nombre, $telefono,$email, $fecha_inicio_alquiler, $id_casa) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Sentencia SQL para actualizar una categoría existente
        $sentencia_sql = "UPDATE `inquilino` SET `nombre`= ? ,`telefono`= ? ,`email`= ? ,`fecha_inicio_alquiler`= ? ,`id_casa`= ? WHERE `DNI`= ? ";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
         
        $sentencia->bindValue(1, $nombre);  
        $sentencia->bindValue(2, $telefono); 
        $sentencia->bindValue(3, $email); 
        $sentencia->bindValue(4, $fecha_inicio_alquiler); 
        $sentencia->bindValue(5, $id_casa); 
        $sentencia->bindValue(6, $DNI); 

        // Ejecuta la sentencia
        $sentencia->execute();

        // Retorna el resultado (aunque no es necesario para un update, se puede omitir)
        return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    // Desactiva (elimina lógicamente) una categoría
    public function eliminar_inquilino($DNI) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Sentencia SQL para "eliminar" (desactivar) una categoría
        $sentencia_sql = "DELETE FROM `inquilino` WHERE DNI = ?";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $DNI);  // Asocia el ID de la categoría

        // Ejecuta la sentencia
        $sentencia->execute();

        // Retorna el resultado (aunque no es necesario para un delete lógico, se puede omitir)
        return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
