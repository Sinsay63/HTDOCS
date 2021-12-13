<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DisplayController extends AbstractController
{
    /**
     * @Route("/welcome", methods={"GET"})
     */
    public function display(){
        return $this->render("test.html.twig",["contenu" => "OHH YEAH!"]);
    }
}