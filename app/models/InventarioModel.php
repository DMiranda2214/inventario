<?php

namespace App\Models;

use App\Core\Database;

class InventarioModel
{
    private $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function insertInventario($data)
    {
        $query = "call insertInventario({$data['inv_idProducto']},{$data['inv_cantidad']},{$data['inv_precioUnitario']},{$data['inv_subTotal']});";
        $result = $this->connection->query($query);
        return;
    }

    public function getTotalInventario()
    {
        $query = "SELECT i.inv_id,i.inv_Stock,i.inv_precioVenta,p.pro_nombre FROM inventario i INNER JOIN producto p ON i.inv_idProducto = p.pro_id";
        $result = $this->connection->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getInventarioById($id)
    {
        $query = "SELECT i.inv_id,i.inv_Stock,i.inv_precioVenta,p.pro_nombre FROM inventario i INNER JOIN producto p ON i.inv_idProducto = p.pro_id WHERE i.inv_id = $id";
        $result = $this->connection->query($query);
        return $result->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateInventario($data)
    {
        $query = "UPDATE inventario SET inv_precioVenta = {$data['inv_precioVenta']} WHERE inv_id = {$data['inv_id']}";
        $result = $this->connection->query($query);
        return;
    }
}
//
