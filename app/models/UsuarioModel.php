<?php 
    namespace App\Models;
    use App\Core\Database;

    class UsuarioModel {
        private $connection;
        private $table = 'usuario';

        public function __construct() {
            $this->connection = Database::getInstance()->getConnection();
        }

        public function getAllUsers() {
            $query = "SELECT * FROM $this->table";
            $result = $this->connection->query($query);
            $usuarios = $result->fetchAll(\PDO::FETCH_ASSOC);
            return $usuarios;
        }

        public function getUserById($id) {
            $query = "SELECT * FROM $this->table WHERE usu_id = $id";
            $result = $this->connection->query($query);
            $usuario = $result->fetch(\PDO::FETCH_ASSOC);
            return $usuario;
        }

        public function insertUser($data) {
            $query = "INSERT INTO $this->table(usu_nombre,usu_cuenta,usu_email,usu_password,usu_idEstado)
                        VALUES('{$data['usu_nombre']}','{$data['usu_cuenta']}','{$data['usu_email']}','{$data['usu_password']}','{$data['usu_estado']}')";
            $result = $this->connection->query($query);
            return;
        }

        public function updateUser($data) {
            $query = "UPDATE $this->table SET usu_cuenta = '{$data['usu_cuenta']}', usu_password = '{$data['usu_password']}', usu_idEstado = '{$data['usu_estado']}' WHERE usu_id = {$data['usu_id']}";
            $result = $this->connection->query($query);
            return;
        }

        public function deleteUser($id) {
            $query = "DELETE FROM $this->table WHERE usu_id = $id";
            $result = $this->connection->query($query);
            return;
        }
    }

?>

//