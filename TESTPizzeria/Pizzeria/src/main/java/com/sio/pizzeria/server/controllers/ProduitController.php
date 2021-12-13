<?php

include_once('tools/DatabaseLinker.php');
include_once('DAO/ProduitDAO.php');

class ProduitController {

    private $requestMethod;
    private $produitId = null;

    public function __construct($requestMethod, $id) {
        $this->requestMethod = $requestMethod;
        $this->produitId = $id;
    }

    public function processRequest() {

        $response = $this->notFoundResponse();

        switch ($this->requestMethod) {
            case 'GET':
                if ($this->produitId) {
                    $response = $this->getProduit($this->produitId);
                }
                else {
                    $response = self::getAllProduits();
                }
                break;
            case 'POST':
                $response = $this->createProduit();
                break;
            case 'PUT':
                $response = $this->updateProduit();
                break;
            case 'DELETE':
                if ($this->produitId) {
                    $response = $this->deleteProduit($this->produitId);
                }
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }

        header($response['status_code_header']);
        if ($response['body'] != null && $response['status_code_header'] === "HTTP/1.1 200 OK") {
            echo $response['body'];
        }
        else {
            echo $response['status_code_header'];
            echo $response['body'];
        }
    }

    public function getAllProduits() {
        $result = ProduitDAO::getList();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';

        $response['body'] = json_encode($result);

        return $response;
    }

    private function getProduit($id) {
        $result = ProduitDAO::get($id);
        if ($result == null) {
            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function createProduit() {
        $response = $this->unprocessableEntityResponse();
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (!empty($input["nomProduit"]) && !empty($input["prix"]) && !empty($input["idTypeProduit"])) {
            $produit = new ProduitDTO($input["nomProduit"], $input['prix'], $input['idMarque']);
            $success = ProduitDAO::insert($produit);
            if ($success) {
                $response = null;
                $response['status_code_header'] = 'HTTP/1.1 201 Created';
                $response['body'] = json_encode($produit);
            }
        }
        return $response;
    }

    private function updateProduit($produit) {
        $response = $this->unprocessableEntityResponse();
        if ($produit !=null) {
            $success = ProduitDAO::update($produit);
            if ($success) {
                $response['status_code_header'] = 'HTTP/1.1 200 Successful update';
                $response['body'] = json_encode($produit);
            }
        }
        return $response;
    }

    private function deleteProduit($id) {
        $success = ProduitDAO::delete($id);
        $response = $this->unprocessableEntityResponse();
        if ($success) {
            $response['status_code_header'] = 'HTTP/1.1 200 Successful deletion';
            $response['body'] = null;
        }
        return $response;
    }

    private function unprocessableEntityResponse() {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    private function notFoundResponse() {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }

}
