<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\InvasionService;

class InvasionController extends AbstractController {
    private $service;

    public function __construct(InvasionService $service) {
        $this->service = $service;
    }
    /**
     * @Route("/welcome", methods={"GET"})
     */
    public function hello() {
        return new Response('<html><body>'. $this->service->getSoucoupes() .'</body></html>');
    }




}