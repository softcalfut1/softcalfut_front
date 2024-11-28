<?php
// Cargar las variables de entorno desde el archivo .env
require_once __DIR__ . '/../vendor/autoload.php'; // Asegúrate de que esta ruta sea correcta

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
            $columnas = implode(", ", array_keys($datos));
            $valores = implode(", ", array_fill(0, count($datos), "$1"));

            $sql = "INSERT INTO $tabla ($columnas) VALUES ($valores)";
            
            // Convertir los valores en un array indexado
            $values = array_values($datos);

            // Ejecutar la consulta preparada
            $result = pg_query_params($this->conn, $sql, $values);

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
            foreach ($datos as $key => $value) {
                $set[] = "$key = $$i";
                $values[] = $value;
                $i++;
            }
            $set = implode(", ", $set);
            $sql = "UPDATE $tabla SET $set WHERE $condicion";
            
            // Ejecutar la consulta preparada
            $result = pg_query_params($this->conn, $sql, $values);

            if ($result) {
                echo "<script>swal('Éxito', 'Registro actualizado correctamente', 'success');</script>";
            } else {
                echo "<script>swal('Error', 'Error al actualizar el registro: " . pg_last_error($this->conn) . "', 'error');</script>";
            }
        } catch (Exception $e) {
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
