<?php

namespace App\Message;

use App\Entity\User;

class UserFormTypeMessage
{
    public $data;


    public function __construct(User $data)
    {
        $this->data = $data;    }

    public function getData(): ?User
    {
        return $this->data;
    }

}
