<?php
namespace App\Model\Table;

use Core\Model\Table;

class Orders_lineTable extends Table
{
    // On récupère les lignes de commande par token
    public function findAllWithToken($id)
    {
        $fields = [
            "o.*", "b.title", "b.img"
        ];
        return $this->findjoin([$id], $fields, " WHERE o.token=?");
        /*
        
                return $this->findAll($id, 'token');
    */
    }
    // On récupère les lignes de commande par BeerId.
    public function findAllLineWithBeerId($id)
    {
        $fields = [
            "o.*", "b.title", "b.img"
        ];
        return $this->findjoin([$id], $fields, " WHERE b.id=?");
        /*
        
                return $this->findAll($id, 'token');
    */
    }
            


    private function findjoin(array $id = [], array $fields = ["o.*", "b.*"],string $where = "")
    {

        return $this->query("SELECT ".join(", ", $fields)."
                FROM {$this->table} o 
                LEFT JOIN beer b on o.beer_id = b.id
                $where", $id);
        /*
        
                return $this->findAll($id, 'token');
    */
            }
}