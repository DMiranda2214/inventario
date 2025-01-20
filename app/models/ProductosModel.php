<?php

namespace App\Models;
use App\Core\Database;

class ProductosModel {
    private $connection;

    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getCantidadProductos() {
        $query = "SELECT COUNT(*) as total FROM products";
        $result = $this->connection->query($query);
        $row = $result->fetch(\PDO::FETCH_ASSOC);
        return $row['total'];
    }
}
?>