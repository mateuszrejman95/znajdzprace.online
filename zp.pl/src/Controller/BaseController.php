<?php


namespace App\Controller;


use App\Entity\Uzytkownik;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    protected function getUser():Uzytkownik
    {
        return parent::getUser();
    }

}