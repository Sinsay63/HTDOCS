<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\HourService;

class testController extends AbstractController {
    private $service;

    public function __construct(HourService $service) {
    $this->service = $service;
}
    /**
     * @Route("/welcome", methods={"GET"})
     */
    public function hello() {
        return new Response('<html><body>'. $this->service->getHour() .'</body></html>');
    }




}