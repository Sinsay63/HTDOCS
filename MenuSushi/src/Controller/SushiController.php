<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\SushiService;

class SushiController extends AbstractController
{
    private $service;

    public function __construct(SushiService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/carte", methods={"GET"})
     */
    public function displayCarte()
    {
        $obj = $this->service->getData();
        $listeName = [];
        for ($i = 0; $i < COUNT(array_keys($obj)); $i++) {
            $listeName[] = array_keys($obj)[$i];
        }
        return $this->render('carte.html.twig', ["navNames" => $listeName, "titrePage" => "Carte", "listeProduits" => json_decode($this->service->getProduits(),true)]);
    }
}