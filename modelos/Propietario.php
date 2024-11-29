<?php
// Clase Categoria hereda de la clase Conectar
class Propietario extends Conectar {

    // Obtiene todas las categorías activas
    public function obtener_propietario() {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Consulta SQL para obtener todas las categorías activas
        $consulta_sql = "SELECT * FROM propietario";   

        // Prepara la consulta SQL
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->execute();

        // Retorna el resultado de la consulta como un array asociativo
        return $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);   
    }

    // Obtiene una categoría específica por su ID
    public function obtener_propietario_por_DNI($DNI) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Consulta SQL para obtener una propietario     específica por su ID
        $consulta_sql = "SELECT * FROM propietario WHERE DNI = ?";

        // Prepara la consulta SQL
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->bindValue(1, $DNI);  // Asocia el valor del ID de categoría

        // Ejecuta la consulta
        $consulta->execute();

        // Retorna el resultado como un array asociativo
        return $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserta una nuevo propietario
    public function insertar_propietario($DNI, $nombre, $telefono, $email) {
    
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
    
        // Sentencia SQL para insertar un nuevo propietario
        $sentencia_sql = "INSERT INTO `propietario`(`DNI`, `nombre`, `telefono`, `email`) VALUES (?, ?, ?, ?)";
    
        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $DNI);
        $sentencia->bindValue(2, $nombre);
        $sentencia->bindValue(3, $telefono);
        $sentencia->bindValue(4, $email);
    
        // Ejecuta la sentencia
        $sentencia->execute();
    
        // Retorna el número de filas afectadas (opcional)
        return $sentencia->rowCount(); // Retorna el número de filas insertadas
    }

    // Actualiza una categoría existente
    public function actualizar_propietario($DNI, $nombre, $telefono, $email) {

        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
    
        // Sentencia SQL para actualizar un propietario
        $sentencia_sql = "UPDATE `propietario` SET `nombre`=?, `telefono`=?, `email`=? WHERE `DNI`=?";
    
        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
    
        // Vincula los valores a la sentencia
        $sentencia->bindValue(1, $nombre);
        $sentencia->bindValue(2, $telefono);
        $sentencia->bindValue(3, $email);
        $sentencia->bindValue(4, $DNI);
    
        // Ejecuta la sentencia
        $sentencia->execute();
    
        // Retorna el número de filas afectadas (indica si la actualización fue exitosa)
        return ["filas_afectadas" => $sentencia->rowCount()];
    }

    // Desactiva (elimina lógicamente) una categoría
    public function eliminar_propietario($DNI) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Sentencia SQL para "eliminar" (desactivar) una categoría
        $sentencia_sql = "DELETE FROM `propietario` WHERE DNI = ?";

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
