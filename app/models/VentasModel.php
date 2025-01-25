<?php
    namespace App\Models;
    use App\Core\Database;

    class VentasModel {
        private $connection;
       
        public function __construct() {
            $this->connection = Database::getInstance()->getConnection();
        }

        public function insertVenta($data){
            
            $query = "call insertVenta({$data['ven_idCliente']},'{$data['ven_fecha']}',{$data['ven_totalPedido']},{$data['ven_estado']},{$data['sum_idProducto']},{$data['sum_cantidad']},{$data['sum_precioUnitario']},{$data['sum_subTotal']})";
            $result = $this->connection->query($query);
            return;
        }

        public function getCantidadVentas() {
            $query = "SELECT COUNT(*) as total FROM pedido";
            $result = $this->connection->query($query);
            $row = $result->fetch(\PDO::FETCH_ASSOC);
            return $row['total'];
        }

        public function getTotalPedidos() {
            $query = "call getAllPedidos()";
            $result = $this->connection->query($query);
            return $result->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getPedidoById($id){
            $query = "call getPedidoInfo($id)";
            $result = $this->connection->query($query);
            return $result->fetch(\PDO::FETCH_ASSOC);
        }
    }
?>