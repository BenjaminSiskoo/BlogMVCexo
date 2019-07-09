<?php
namespace App\Model\Entity;

use Core\Model\Entity;

use Core\Controller\Helpers\TextController;

class UserEntity extends Entity
{
    private $id;

    private $mail;

    private $password;

    private $token;

    private $createdAt;

    private $verify;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    public function getToken()
    {
        return $this->token;
    }

    /**
     * Get the value of created_at
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return new \DateTime($this->createdAt);
    }

    public function getMail() {
        return $this->mail;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getVerify() {
        return $this->verify;
    }

    public function setVerify() {
        return $this->verify;
    }

    public function setMail(string $mail) {
        return $this->mail = $mail;
    }

    public function setPassword(string $password) {
        $password = password_hash(htmlspecialchars($password), PASSWORD_BCRYPT);
        return $this->password = $password;
    }
}