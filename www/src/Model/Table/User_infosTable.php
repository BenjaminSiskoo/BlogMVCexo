<?php
namespace App\Model\Table;

use Core\Model\Table;

class User_InfosTable extends Table
{
    public function getUserInfosByid($id) {
        return $this->query("SELECT * FROM $this->table
        WHERE id = ?", [$id], true);
    }
}