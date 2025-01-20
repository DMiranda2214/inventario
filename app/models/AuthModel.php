<?php

class AuthModel {
    private $connection;

    public function __construct() {
        $this->connection = Connection::getInstance()->getConnection();
    }

    public function findUserByEmail($username) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->fetch();
    }


}
?>