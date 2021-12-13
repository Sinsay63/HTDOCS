<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
class BasicController extends AbstractController
{
    private $Soucoupes=
        [
            ["Nom"=>"Laink","Vitesse"=>"4069","Date_Construction"=>"2001-07-28"],
            ["Nom"=>"Terracid","Vitesse"=>"6940","Date_Construction"=>"4069-12-25"]
        ];
    private $Attaques=
        [
            ["Date"=>"2153-12-03","Cible"=>"Aubière"],
            ["Date"=>"2189-05-31","Cible"=>"Clermont-Ferrand"]
        ];
    private $Villes=
        [
            ["Nom"=>"Aubière","Superficie"=>"53,61","Population"=>"108089"],
            ["Nom"=>"Clermont-Ferrand","Superficie"=>"108,97","Population"=>"175057"]
        ];
    /**
     * @Route("/welcome", methods={"GET"})
     */
    public function GetInfos(){
        $request = Request::createFromGlobals();
        $request->getPathInfo();
        if ($request->query->get('Type')=='Soucoupes')
        {
            return New Response (json_encode($this->Soucoupes, JSON_FORCE_OBJECT)) ;
        }
        else if ($request->query->get('Type')=='Attaques')
        {
            return New Response (json_encode($this->Attaques, JSON_FORCE_OBJECT)) ;
        }
        else if ($request->query->get('Type')=='Villes')
        {
            return New Response (json_encode($this->Villes, JSON_FORCE_OBJECT)) ;
        }
        else
        {
            return New Response ("Erreur Type Invalide") ;
        }
    }
}