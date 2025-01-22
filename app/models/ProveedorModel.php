<?php 
    namespace App\Models;
    use App\Core\Database;

    class ProveedorModel{
        private $connection;
        private $table = 'proveedor';

        public function __construct() {
            $this->connection = Database::getInstance()->getConnection();
        }

        public function getCantidadProveedores() {
            $query = "SELECT COUNT(*) as total FROM $this->table";
            $result = $this->connection->query($query);
            $row = $result->fetch(\PDO::FETCH_ASSOC);
            return $row['total'];
        }

        public function getAllProviders() {
            $query = "call getAllProveedores()";
            $result = $this->connection->query($query);
            $proveedores = $result->fetchAll(\PDO::FETCH_ASSOC);
            return $proveedores;
        }

        public function getProviderById($id) {
            $query = "call getProveedorInfo($id)";
            $result = $this->connection->query($query);
            $proveedor = $result->fetch(\PDO::FETCH_ASSOC);
            return $proveedor;
        }

        public function insertProvider($data) {
            $query = "call insertProveedor('{$data['prov_empresa']}','{$data['prov_vendedor']}','{$data['prov_email']}','{$data['prov_direccion']}','{$data['prov_telefono']}')";
            $result = $this->connection->query($query);
            return;
        }

        public function updateProvider($data) {
            $query = "call updateProveedor({$data['prov_id']},'{$data['prov_vendedor']}','{$data['prov_email']}','{$data['prov_direccion']}','{$data['prov_telefono']}')";
            $result = $this->connection->query($query);
            return;
        }
    }

?>