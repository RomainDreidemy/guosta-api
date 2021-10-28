<?php

namespace App\Controller\Account;

use App\Entity\Account;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateAccountController extends AbstractController
{
    public function __invoke(Account $data): Account
    {
        return $data->addUser($this->getUser());
    }
}
