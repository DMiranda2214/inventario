<?php 
namespace App\Models;
use App\Core\Database;

class CategoriaModel {
    private $connection;

    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getCategoriesName() {
        $query = "SELECT id,name FROM categories";
        $result = $this->connection->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
}
?>