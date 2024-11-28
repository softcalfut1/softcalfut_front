<?php
// Cargar las variables de entorno desde el archivo .env
require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;

class Database {
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $conn;

    public function __construct() {
        // Cargar las variables de entorno
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        // Usar las variables de entorno para establecer las credenciales
        $this->host = $_ENV['DB_HOST'];
        $this->dbname = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];

        // Conectar a la base de datos PostgreSQL
        $conn_string = "host=$this->host dbname=$this->dbname user=$this->username password=$this->password";
        $this->conn = pg_connect($conn_string);

        // Verificar la conexión
        if (!$this->conn) {
            die("Error de conexión: " . pg_last_error());
        }
    }

    // Método para verificar la conexión
    public function verificarConexion() {
        if (!$this->conn) {
            die("Error de conexión: " . pg_last_error());
        }
    }

    // Método para insertar datos
    public function insertar($tabla, $datos) {
        try {
            // Obtener las columnas (keys) del array $datos
            $columnas = implode(", ", array_keys($datos));
            
            // Crear los marcadores de parámetros dinámicamente: $1, $2, $3, etc.
            $valores = implode(", ", array_map(function($index) {
                return "$" . ($index + 1);  // Crea los marcadores: $1, $2, $3...
            }, range(0, count($datos) - 1)));  // Genera un rango de 0 hasta el número de elementos - 1
    
            // Crear la consulta SQL
            $sql = "INSERT INTO $tabla ($columnas) VALUES ($valores)";
            
            // Obtener los valores del array $datos
            $values = array_values($datos);
    
            // Ejecutar la consulta con los valores preparados
            $result = pg_query_params($this->conn, $sql, $values);
    
            // Comprobar si la consulta fue exitosa
            if ($result) {
                echo "<script>swal('Éxito', 'Registro insertado correctamente', 'success');</script>";
            } else {
                echo "<script>swal('Error', 'Error al insertar el registro: " . pg_last_error($this->conn) . "', 'error');</script>";
            }
        } catch (Exception $e) {
            echo "<script>swal('Error', 'Error al insertar el registro: " . $e->getMessage() . "', 'error');</script>";
        }
    }
    

    // Método para leer datos
    public function leer($tabla, $condiciones = "") {
        try {
            $sql = "SELECT * FROM $tabla $condiciones";
            $result = pg_query($this->conn, $sql);

            if (!$result) {
                echo "<script>swal('Error', 'Error al leer los datos: " . pg_last_error($this->conn) . "', 'error');</script>";
                return false;
            }

            return pg_fetch_all($result);
        } catch (Exception $e) {
            echo "<script>swal('Error', 'Error al leer los datos: " . $e->getMessage() . "', 'error');</script>";
            return false;
        }
    }

    // Método para actualizar datos
    public function actualizar($tabla, $datos, $condicion) {
        try {
            $set = [];
            $values = [];
            $i = 1;
            
            // Generar las partes SET de la consulta SQL y los valores de los parámetros
            foreach ($datos as $key => $value) {
                $set[] = "$key = \$${i}";  // Correctamente usar el placeholder con $i
                $values[] = $value;
                $i++;
            }
            
            // Combinar todas las partes del SET en una cadena
            $set = implode(", ", $set);
            
            // Construir la consulta SQL con la condición
            $sql = "UPDATE $tabla SET $set WHERE $condicion";
            
            // Ejecutar la consulta preparada con los valores
            $result = pg_query_params($this->conn, $sql, $values);
    
            // Comprobar si la ejecución fue exitosa
            if ($result) {
                echo "<script>swal('Éxito', 'Registro actualizado correctamente', 'success');</script>";
            } else {
                echo "<script>swal('Error', 'Error al actualizar el registro: " . pg_last_error($this->conn) . "', 'error');</script>";
            }
        } catch (Exception $e) {
            // Manejo de excepciones y errores
            echo "<script>swal('Error', 'Error al actualizar el registro: " . $e->getMessage() . "', 'error');</script>";
        }
    }
    

    // Método para eliminar datos
    public function eliminar($tabla, $condicion) {
        try {
            $sql = "DELETE FROM $tabla WHERE $condicion";
            $result = pg_query($this->conn, $sql);

            if ($result) {
                echo "<script>swal('Éxito', 'Registro eliminado correctamente', 'success');</script>";
            } else {
                echo "<script>swal('Error', 'Error al eliminar el registro: " . pg_last_error($this->conn) . "', 'error');</script>";
            }
        } catch (Exception $e) {
            echo "<script>swal('Error', 'Error al eliminar el registro: " . $e->getMessage() . "', 'error');</script>";
        }
    }

    // Cerrar la conexión
    public function cerrarConexion() {
        pg_close($this->conn);
    }
}
?>
