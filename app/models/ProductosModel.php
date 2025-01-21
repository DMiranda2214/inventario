<?php

namespace App\Models;
use App\Core\Database;

class ProductosModel {
    private $connection;
    private $table = "products";

    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getCantidadProductos() {
        $query = "SELECT COUNT(*) as total FROM $this->table";
        $result = $this->connection->query($query);
        $row = $result->fetch(\PDO::FETCH_ASSOC);
        return $row['total'];
    }

    public function getTotalProductos() {
        $query = "SELECT * FROM $this->table";
        $result = $this->connection->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTotalProductosByPage($page, $limit) {
        $offset = ($page - 1) * $limit;
        $query = "SELECT * FROM products LIMIT $offset, $limit";
        $result = $this->connection->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insertProduct($data){
        $query = "INSERT INTO $this->table(name,description,price,category_id,stock) 
                    VALUES('{$data['nombre']}','{$data['description']}',{$data['priceSell']},{$data['categoria']},{$data['inventoryInit']});";
        print_r($query);
        $result = $this->connection->query($query);
        echo $result->rowCount();
        return;
    }
}
?>