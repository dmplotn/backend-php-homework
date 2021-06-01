<?php

namespace App\Controllers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WelcomeController extends AbstractController
{
    public function index()
    {
        return $this->render('welcome.html.twig');
    }
}
