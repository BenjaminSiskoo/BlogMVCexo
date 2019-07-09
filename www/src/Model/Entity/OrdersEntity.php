<?php
namespace App\Model\Entity;

use Core\Model\Entity;

use Core\Controller\Helpers\TextController;

class OrdersEntity extends Entity
{
    private $id;

    private $userInfos_id;

    private $priceHT;

    private $port;

    private $ordersTva;

    private $created_at;

    private $status_id;

    private $token;

    public function getId()
    {
        return $this->id;
    }

    public function getUserInfosId()
    {
        return $this->userInfos_id;
    }

    public function getPriceHT()
    {
        return $this->priceHT;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function getOrdersTva()
    {
        return $this->ordersTva;
    }

    public function getCreatedAt()
    {
        return new \DateTime($this->createdAt);
    }

    public function getStatusId()
    {
        return $this->status_id;
    }

    public function getToken()
    {
        return $this->token;
    }
}