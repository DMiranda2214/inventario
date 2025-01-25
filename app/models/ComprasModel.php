<?php
    namespace App\Models;
    use App\Core\Database;

    class ComprasModel {
        private $connection;
       
        public function __construct() {
            $this->connection = Database::getInstance()->getConnection();
        }

        public function insertCompra($data){
            $query = "call insertCompra({$data['com_idProveedor']},'{$data['com_fecha']}',{$data['com_totalCompra']},{$data['sum_idProducto']},{$data['sum_cantidad']},{$data['sum_precioUnitario']},{$data['sum_subTotal']});";
            $result = $this->connection->query($query);
            return;
        }

        public function getTotalCompras() {
            $query = "call getAllCompras()";
            $result = $this->connection->query($query);
            return $result->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getComprasByPeriodo($fechaInicio, $fechaFin) {
            $query = "CALL getComprasPorPeriodo(:fechaInicio, :fechaFin)";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':fechaInicio', $fechaInicio, \PDO::PARAM_STR);
            $stmt->bindParam(':fechaFin', $fechaFin, \PDO::PARAM_STR);
            $stmt->execute();
            $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultados;
        }

        public function getDetailCompra($id)
        {
            $query = "call getCompraDetalle ($id)";
            $result = $this->connection->query($query);
            return $result->fetch(\PDO::FETCH_ASSOC);
        }
    }

?>