<?php 
namespace App\Models;
use App\Core\Database;

class ClientesModel {
    private $connection;
    private $table = 'cliente';

    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getCantidadClientes() {
        $query = "SELECT COUNT(*) as total FROM $this->table";
        $result = $this->connection->query($query);
        $row = $result->fetch(\PDO::FETCH_ASSOC);
        return $row['total'];
    }
}

?>