<?php

namespace App\MessageHandler;

use App\Entity\User;
use App\Message\UserFormTypeMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(fromTransport: 'async', priority: 10)]
class FormMessageHandler
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em; 
    }

    public function __invoke(UserFormTypeMessage $message)
    {
        $formData = $message->getData();
        $file = $formData->getPicture();

        $user = (new User())
            ->setFirstName($formData->getFirstName())
            ->setLastName($formData->getLastName())
            ->setPicture($file);    

            $this->em->persist($user);
            $this->em->flush();
    }
}

