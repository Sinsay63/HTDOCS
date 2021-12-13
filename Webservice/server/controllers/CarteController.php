<?php

include_once('tools/DatabaseLinker.php');
include_once('DAO/CarteDAO.php');

class CarteController {

    private $requestMethod;
    private $carteId = null;

    public function __construct($requestMethod, $id) {
        $this->requestMethod = $requestMethod;
        $this->carteId = $id;
    }

    public function processRequest() {

        $response = $this->notFoundResponse();

        switch ($this->requestMethod) {
            case 'GET':
                if ($this->carteId) {
                    $response = $this->getCarte($this->carteId);
                }
                else {
                    $response = self::getAllCartes();
                }
                break;
            case 'POST':
                $response = $this->createCarte();
                break;
            case 'PUT':
                $response = $this->updateCarte();
                break;
            case 'DELETE':
                if ($this->carteId) {
                    $response = $this->deleteCarte($this->carteId);
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

    public function getAllCartes() {
        $result = CarteDAO::getList();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';

        $response['body'] = json_encode($result);

        return $response;
    }

    private function getCarte($id) {
        $result = CarteDAO::get($id);
        if ($result == null) {
            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function createCarte() {
        $response = $this->unprocessableEntityResponse();
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (!empty($input["nomCarte"]) && !empty($input["prix"]) && !empty($input["idMarque"])) {
            $carte = new CarteDTO($input["nomCarte"], $input['prix'], $input['idMarque']);
            $success = CarteDAO::insert($carte);
            if ($success) {
                $response = null;
                $response['status_code_header'] = 'HTTP/1.1 201 Created';
                $response['body'] = json_encode($carte);
            }
        }
        return $response;
    }

    private function updateCarte() {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        $response = $this->unprocessableEntityResponse();
        if (!empty($input["nomCarte"]) && !empty($input["idCarte"] && !empty($input["prix"]) && !empty($input["idMarque"]))) {
            $carte = new CarteDTO($input['nomCarte'], $input['prix'], $input["idMarque"]);
            $carte->setIdCarte($input['idCarte']);
            $success = CarteDAO::update($carte);
            if ($success) {
                $response['status_code_header'] = 'HTTP/1.1 200 Successful update';
                $response['body'] = json_encode($carte);
            }
        }
        return $response;
    }

    private function deleteCarte($id) {
        $success = CarteDAO::delete($id);
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
