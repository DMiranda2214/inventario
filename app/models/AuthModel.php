<?php

namespace App\Models;
use App\Core\Database;

class AuthModel {
    private $connection;
    private $table= "usuario";

    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function findUserByEmail($username) {
        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE usu_cuenta = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->fetch();
    }
}
?>