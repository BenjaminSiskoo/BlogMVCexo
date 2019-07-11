<?php
namespace App\Model\Table;

use Core\Model\Table;
use App\Model\Entity\OrdersEntity;

class OrdersTable extends Table
{
    /**
     * 
     * @return OrdersEntity|null
     */
    public function findWithToken(string $token): ?OrdersEntity
    {
        $orderslines = (new Orders_lineTable($this->db))->findAllWithToken($token, 'token');
        $order = $this->find($token, 'token');
        $order->setLines($orderslines);
        return $order;
    }
}