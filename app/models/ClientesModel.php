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

    public function getAllClients() {
        $query = "call getAllClientes()";
        $result = $this->connection->query($query);
        $clientes = $result->fetchAll(\PDO::FETCH_ASSOC);
        return $clientes;
    }

    public function getClienteById($id) {
        $query = "call getClienteInfo($id)";
        $result = $this->connection->query($query);
        $cliente = $result->fetch(\PDO::FETCH_ASSOC);
        return $cliente;
    }

    public function insertClient($data) {
        $query = "call insertCliente('{$data['cli_nombre']}','{$data['cli_apellido']}','{$data['cli_email']}','{$data['cli_direccion']}','{$data['cli_telefono']}')";
        $result = $this->connection->query($query);
        return;
    }

    public function updateClient($data) {
        $query = "call updateCliente({$data['cli_id']},'{$data['cli_email']}','{$data['cli_direccion']}','{$data['cli_telefono']}')";
        $result = $this->connection->query($query);
        return;
    }
}
?>