<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'moja zajebista apka do szukania pracy',
            'komunikat' => 'witamy w serwisie u wujka Janka'
        ]);
    }
}
