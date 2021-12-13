<?php

include_once('tools/DatabaseLinker.php');
include_once('DAO/MarqueDAO.php');

class MarqueController {

    private $requestMethod;
    private $marqueId = null;

    public function __construct($requestMethod, $id) {
        $this->requestMethod = $requestMethod;
        $this->marqueId = $id;
    }

    public function processRequest() {

        $response = $this->notFoundResponse();

        switch ($this->requestMethod) {
            case 'GET':
                if ($this->marqueId) {
                    $response = $this->getMarque($this->marqueId);
                }
                else {
                    $response = self::getAllMarques();
                };
                break;
            case 'POST':
                $response = $this->createMarque();
                break;
            case 'PUT':
                $response = $this->updateMarque();
                break;
            case 'DELETE':
                if ($this->marqueId) {
                    $response = $this->deleteMarque($this->marqueId);
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

    public function getAllMarques() {
        $result = MarqueDAO::getList();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';

        $response['body'] = json_encode($result);

        return $response;
    }

    private function getMarque($id) {
        $result = MarqueDAO::get($id);
        if ($result == null) {
            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function createMarque() {
        $response = $this->unprocessableEntityResponse();
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (!empty($input["nomMarque"])) {
            $marque = new MarqueDTO($input["nomMarque"]);
            $success = MarqueDAO::insert($marque);
            if ($success) {
                $response = null;
                $response['status_code_header'] = 'HTTP/1.1 201 Created';
                $response['body'] = json_encode($marque);
            }
        }
        return $response;
    }

    private function updateMarque() {
        $response = $this->unprocessableEntityResponse();
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (!empty($input["nomMarque"]) && !empty($input["idMarque"])) {
            $marque = new MarqueDTO($input['nomMarque']);
            $marque->setIdMarque($input['idMarque']);
            $success = MarqueDAO::update($marque);
            if ($success) {
                $response['status_code_header'] = 'HTTP/1.1 200 Successful update';
                $response['body'] = json_encode($marque);
            }
        }
        return $response;
    }

    private function deleteMarque($id) {
        MarqueDAO::delete($id);
        $response['status_code_header'] = 'HTTP/1.1 200 Successful deletion';
        $response['body'] = null;
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
