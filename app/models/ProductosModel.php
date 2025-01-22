<?php

namespace App\Models;
use App\Core\Database;

class ProductosModel {
    private $connection;
    private $table = "producto";

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
        $query = "SELECT * FROM $this->table LIMIT $offset, $limit";
        $result = $this->connection->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insertProduct($data){
        $query = "INSERT INTO $this->table(pro_nombre,pro_idCategoria,pro_descripcion,pro_precioVenta,pro_cantMin) 
                    VALUES('{$data['pro_nombre']}',{$data['pro_idCategoria']},'{$data['pro_descripcion']}',{$data['pro_precioVenta']},{$data['pro_cantMin']});";
        $result = $this->connection->query($query);
        return;
    }

    public function getProductoById($id) {
        $query = "SELECT * FROM $this->table WHERE pro_id = $id";
        $result = $this->connection->query($query);
        return $result->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateProduct($data) {
        $query = "UPDATE $this->table SET pro_nombre = '{$data['pro_nombre']}', pro_idCategoria = {$data['pro_idCategoria']}, pro_descripcion = '{$data['pro_descripcion']}', pro_precioVenta = {$data['pro_precioVenta']}, pro_cantMin = {$data['pro_cantMin']} WHERE pro_id = {$data['pro_id']}";
        $result = $this->connection->query($query);
        return;
    }

    public function deleteProduct($id) {
        $query = "DELETE FROM $this->table WHERE pro_id = $id";
        $result = $this->connection->query($query);
        return;
    }
}
?>