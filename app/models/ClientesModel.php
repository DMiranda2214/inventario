<?php 
namespace App\Models;
use App\Core\Database;

class ClientesModel {
    private $connection;

    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getCantidadClientes() {
        $query = "SELECT COUNT(*) as total FROM customers";
        $result = $this->connection->query($query);
        $row = $result->fetch(\PDO::FETCH_ASSOC);
        return $row['total'];
    }
}

?>