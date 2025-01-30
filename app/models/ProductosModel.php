<?php

namespace App\Models;

use App\Core\Database;

class ProductosModel
{
    private $connection;
    private $table = "producto";

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getCantidadProductos()
    {
        $query = "SELECT COUNT(*) as total FROM $this->table";
        $result = $this->connection->query($query);
        $row = $result->fetch(\PDO::FETCH_ASSOC);
        return $row['total'];
    }

    public function getAllProducts()
    {
        $query = "SELECT * FROM $this->table";
        $result = $this->connection->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTotalProductosByPage($page, $limit)
    {
        $offset = ($page - 1) * $limit;
        $query = "SELECT * FROM $this->table LIMIT $offset, $limit";
        $result = $this->connection->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getProductsToSell()
    {
        $query = "call getProductsToSell()";
        $result = $this->connection->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insertProduct($data)
    {
        $cantMin = ($data['pro_cantMin'])? intval($data['pro_cantMin']) : 10; 
        $query = "INSERT INTO $this->table(pro_nombre,pro_idCategoria,pro_descripcion,pro_precioVenta,pro_minStock) 
                    VALUES('{$data['pro_nombre']}',{$data['pro_idCategoria']},'{$data['pro_descripcion']}',{$data['pro_precioVenta']},{$cantMin});";
        $result = $this->connection->query($query);
        return;
    }

    public function getProductoById($id)
    {
        $query = "SELECT * FROM $this->table WHERE pro_id = $id";
        $result = $this->connection->query($query);
        return $result->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateProduct($data)
    {
        $query = "UPDATE $this->table SET pro_nombre = '{$data['pro_nombre']}', pro_idCategoria = {$data['pro_idCategoria']}, pro_descripcion = '{$data['pro_descripcion']}', pro_precioVenta = {$data['pro_precioVenta']}, pro_minStock = {$data['pro_cantMin']} WHERE pro_id = {$data['pro_id']}";
        $result = $this->connection->query($query);
        return;
    }

    public function deleteProduct($id)
    {
        $query = "DELETE FROM $this->table WHERE pro_id = $id";
        $result = $this->connection->query($query);
        return;
    }

    public function validateStatusInventory()
    {
        $query = "SELECT
            p.pro_id,
            p.pro_nombre,
            i.inv_Stock,
            p.pro_minStock
        FROM
            Producto p
            INNER JOIN Inventario i ON p.pro_id = i.inv_idProducto
        WHERE 
            i.inv_Stock <= p.pro_minStock;";
        $result = $this->connection->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
}

//