<?php
namespace App\Model\Entity;

use Core\Model\Entity;

use Core\Controller\Helpers\TextController;

class StatusEntity extends Entity
{
    private $id;

    private $status;

    public function getId()
    {
        return $this->id;
    }

    public function getStatus()
    {
        return $this->status;
    }
}