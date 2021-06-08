<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Model\Currency;

class WelcomeController extends AbstractController
{
    public function index()
    {
        return $this->render('app/welcome.html.twig');
    }
}
