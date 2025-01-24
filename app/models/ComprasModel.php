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


    }

?>