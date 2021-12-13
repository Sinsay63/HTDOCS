<?php

namespace App\Service;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\HttpClient;

class InvasionService
{
    private $client;
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }


    public function getSoucoupes(){
        $response=$this->client->request(
            'GET',
            'http://127.0.0.1:3000/welcome?Type=Soucoupes'
        );
        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'];
        $content = $response->getContent();
        $content=$response->toArray();

        return json_encode($content);

    }
    public function getAttaques(){
        $response=$this->client->request(
            'GET',
            'http://127.0.0.1:3000/welcome?Type=Attaques'
        );
        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'];
        $content = $response->getContent();
        $content=$response->toArray();

        return json_encode($content);

    }
    public function getVilles(){
        $response=$this->client->request(
            'GET',
            'http://127.0.0.1:3000/welcome?Type=Villes'
        );
        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'];
        $content = $response->getContent();
        $content=$response->toArray();

        return json_encode($content);

    }
}