<?php
class OrderProcessor {
    private $dbConnection;

    function __construct($dbHost, $dbUser, $dbPassword, $dbName) {
        $this->dbConnection = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
      //Sentencia en caso de que no se pueda conectar a la base de datos
        if ($this->dbConnection->connect_error) {
            throw new Exception("Error de conexión a la base de datos: " . $this->dbConnection->connect_error);
        }
    }

    function processOrder($orderId) {
        try {
            $stmt = $this->dbConnection->prepare("SELECT * FROM orders WHERE id = ?");
            $stmt->bind_param("i", $orderId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "Procesando orden: " . $row["id"];
                }
            } else {
                echo "No se encontró la orden.";
            }

            // Cerrar la sentencia preparada
            $stmt->close();
        } catch (Exception $e) {
            // Ver errores de la base de datos
            echo "Error de base de datos: " . $e->getMessage();
        }
    }

    function closeConnection() {
        // Cerrar la conexión al terminar
        $this->dbConnection->close();
    }
}

try {
    // Crear una instancia de OrderProcessor
    $orderProcessor = new OrderProcessor("localhost", "user", "password", "ecommerce_db");

    // Procesar la orden
    $orderProcessor->processOrder($_GET['orderId']);

    // Cerrar la conexión
    $orderProcessor->closeConnection();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
