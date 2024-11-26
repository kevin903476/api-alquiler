<?php
// Clase Categoria hereda de la clase Conectar
class Casa extends Conectar {

    // Obtiene todas las categorías activas
    public function obtener_casa() {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Consulta SQL para obtener todas las categorías activas
        $consulta_sql = "SELECT * FROM casa";   

        // Prepara la consulta SQL
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->execute();

        // Retorna el resultado de la consulta como un array asociativo
        return $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);   
    }

    // Obtiene una categoría específica por su ID
    public function obtener_casa_por_id($id) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Consulta SQL para obtener una propietario     específica por su ID
        $consulta_sql = "SELECT * FROM casa WHERE id_casa = ?";

        // Prepara la consulta SQL
        $consulta = $conexion->prepare($consulta_sql);
        $consulta->bindValue(1, $id);  // Asocia el valor del ID de categoría

        // Ejecuta la consulta
        $consulta->execute();

        // Retorna el resultado como un array asociativo
        return $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserta una nuevo propietario
    public function insertar_casa($direccion, $ciudad, $precio_alquiler, $DNI_propietario) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Sentencia SQL para insertar una nueva categoría
        $sentencia_sql = "INSERT INTO `casa`(`id_casa`, `direccion`, `ciudad`, `precio_alquiler`, `DNI_propietario`) VALUES (NULL,?,?,?,?)";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $direccion);  
        $sentencia->bindValue(2, $ciudad);  
        $sentencia->bindValue(3, $precio_alquiler); 
        $sentencia->bindValue(4, $DNI_propietario); 

        // Ejecuta la sentencia
        $sentencia->execute();

        // Retorna el resultado (aunque no es necesario para un insert, se puede omitir)
        return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    // Actualiza una categoría existente
    public function actualizar_casa($id_casa, $direccion, $ciudad, $precio_alquiler, $DNI_propietario) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Sentencia SQL para actualizar una categoría existente
        $sentencia_sql = "UPDATE `casa` SET `direccion`= ? ,`ciudad`= ? ,`precio_alquiler`=?,`DNI_propietario`=? WHERE id_casa = ? ";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
         
        $sentencia->bindValue(1, $direccion);  
        $sentencia->bindValue(2, $ciudad);  
        $sentencia->bindValue(3, $precio_alquiler); 
        $sentencia->bindValue(4, $DNI_propietario); 
        $sentencia->bindValue(5, $id_casa); 

        // Ejecuta la sentencia
        $sentencia->execute();

        // Retorna el resultado (aunque no es necesario para un update, se puede omitir)
        return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    // Desactiva (elimina lógicamente) una categoría
    public function eliminar_casa($id_casa) {
        // Establece la conexión a la base de datos
        $conexion = parent::conectar_bd();
        parent::establecer_codificacion();
        
        // Sentencia SQL para "eliminar" (desactivar) una categoría
        $sentencia_sql = "DELETE FROM `casa` WHERE id_casa = ?";

        // Prepara la sentencia SQL
        $sentencia = $conexion->prepare($sentencia_sql);
        $sentencia->bindValue(1, $id_casa);  // Asocia el ID de la categoría

        // Ejecuta la sentencia
        $sentencia->execute();

        // Retorna el resultado (aunque no es necesario para un delete lógico, se puede omitir)
        return $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
