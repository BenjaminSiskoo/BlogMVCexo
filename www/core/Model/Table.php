<?php
namespace Core\Model;

use \Core\Controller\Database\DatabaseController;

class Table
{
    protected $db;

    protected $table;

    public function __construct(DatabaseController $db)
    {
        $this->db = $db;

        if (is_null($this->table)) {
            //App\Model\Table\ClassTable
            $parts = explode('\\', get_class($this));
            $class_name = end($parts);
            $this->table = strtolower(str_replace('Table', '', $class_name));
        }
    }

    public function count()
    {
        return $this->query("SELECT COUNT(id) as nbrow FROM {$this->table}", null, true, null);
    }

    public function last()
    {
        return $this->query("SELECT MAX(id) as lastId FROM {$this->table}", null, true)->lastId;
    }

    public function find($id, $column = "id")
    {
        return $this->query("SELECT * FROM {$this->table} WHERE $column=?", [$id], true);
    }

    public function findAll($id, $column = "id")
    {
        return $this->query("SELECT * FROM {$this->table} WHERE $column=?", [$id], false);
    }

    public function all() {
        return $this->query("SELECT * FROM $this->table");
    }

    public function create($fields){
        $sql_parts = [];// Création d'un tableau vide
        $attributes = [];// Création d'un tableau vide
        //On boucle sur le tableau associatif $fields
        foreach($fields as $k => $v){
            //$sql_parts[] = "firstname = ?"(si $k = "firstname" etc..)
            $sql_parts[] = "$k = ?";
            //echo $k;
            //$attributes[] = "Bob = ?"(si $v = "Bob" etc..)
            $attributes[] = $v;
            //echo $v;
        }
        //On colle les cases du tableau $sql_parts avec un ", "
        $sql_part = implode(', ', $sql_parts);
        
        //Appel de la methode query juste en dessous
        return $this->query("INSERT INTO {$this->table} SET $sql_part", $attributes, true);
    }

    public function update($id, $column, $fields){
        $sql_parts = [];
        $attributes = [];
        foreach($fields as $k => $v){
            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }
        $attributes[] = $id;
        $sql_part = implode(', ', $sql_parts);
        return $this->query("UPDATE {$this->table} SET $sql_part WHERE $column = ?", $attributes, true);
    }

    public function delete($id){
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id], true);
    }

    public function query(string $statement, ?array $attributes = null, bool $one = false, ?string $class_name = null)
    {
        if (is_null($class_name)) {
            $class_name = str_replace('Table', 'Entity', get_class($this));
        }
        //dump($class_name); permet de vérifier que l'entity est correcte
        if ($attributes) {
            return $this->db->prepare(
                $statement,
                $attributes,
                $class_name,
                $one
            );
        } else {
            return $this->db->query(
                $statement,
                $class_name,
                $one
            );
        }
    }
}