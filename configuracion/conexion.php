<?php
// Clase Conectar para manejar la conexión a la base de datos
class Conectar {
    // Variable protegida para almacenar la instancia de la conexión
    protected $conexion_bd;

    // Método protegido para establecer la conexión con la base de datos
    protected function conectar_bd() {
        try {
            // Datos de conexión a la base de datos
            $host = "smysql.railway.internal"; // Asegúrate de que este sea correcto
            $user = "root";           // Usuario de la base de datos
            $pass = "JGMckceHxTYheiHBCakwuvlmiepLyAow";        // Contraseña de la base de datos
            $db = "railway";   // Nombre de la base de datos
            $port = "3306";

            // Establece la conexión utilizando mysqli_connect
            $this->conexion_bd = mysqli_connect($host, $user, $pass, $db);

            // Verifica si la conexión fue exitosa
            if (!$this->conexion_bd) {
                die("Error en la conexión a la base de datos: " . mysqli_connect_error());
            }

            // Configura la codificación UTF-8
            mysqli_set_charset($this->conexion_bd, "utf8");

            return $this->conexion_bd;
        } catch (Exception $e) {
            // Si ocurre un error, muestra el mensaje de error y detiene la ejecución
            die("Error en la base de datos: " . $e->getMessage());
        }
    }

    // Método público para establecer la codificación de caracteres a UTF-8
    public function establecer_codificacion() {
        // Verifica si la conexión está inicializada
        if ($this->conexion_bd) {
            return $this->conexion_bd->query("SET NAMES 'utf8'");
        } else {
            die("No se pudo establecer la codificación: Conexión no inicializada.");
        }
    }
}
?>
