<?php 
namespace App\Models;
use App\Core\Database;

class CategoriaModel {
    private $connection;
    private $table = 'categoria';

    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getAllCategories() {
        $query= "SELECT cat_id,cat_nombre,cat_descripcion FROM $this->table";
        $result = $this->connection->query($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCategoryById($id) {
        $query = "SELECT cat_id,cat_nombre,cat_descripcion FROM $this->table WHERE cat_id = $id";
        $result = $this->connection->query($query);
        return $result->fetch(\PDO::FETCH_ASSOC);
    }

    public function insertCategory($data){
        $query = "INSERT INTO $this->table(cat_nombre,cat_descripcion)
                VALUES('{$data['cat_nombre']}','{$data['cat_descripcion']}')";
        $result = $this->connection->query($query);
        return;
    }

    public function updateCategory($data) {
        $query = "UPDATE $this->table SET cat_nombre = '{$data['cat_nombre']}', cat_descripcion = '{$data['cat_descripcion']}' WHERE cat_id = {$data['cat_id']}";
        $result = $this->connection->query($query);
        return;
    }

    public function deleteCategory($id) {
        $query = "DELETE FROM $this->table WHERE cat_id = $id";
        $result = $this->connection->query($query);
        return;
    }
}
?>

//