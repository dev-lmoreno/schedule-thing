<?php

namespace ScheduleThing\API\Http;

use ScheduleThing\Constants\Http\MethodsConstants;

class Request {
    private string $httpMethod;
    private string $uri;
    private array  $queryParams = [];
    private array  $postVars = [];
    private array  $headers = [];

    public function __construct()
    {
        $this->setHeaders();
        $this->queryParams  = $_GET ?? [];
        $this->postVars     = $_POST ?? [];
        $this->headers      = getallheaders();
        $this->httpMethod   = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri          = $_SERVER['REQUEST_URI'] ?? '';
    }

    private function setHeaders(): void
    {
        header('Access-Control-Allow-Origin: localhost');
        header('Content-type: application/json');
    }

    public function getHttpMethod(): string
    {
        return $this->httpMethod;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getheaders(): array
    {
        return $this->headers;
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function getPostVars(): array
    {
        return $this->postVars;
    }

    private function getRequestData(): ?array
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    public function sendRequest(object $controller): array
    {
        $response = [];
        $request_data = self::getRequestData();

        switch ($this->getHttpMethod()) {
            case MethodsConstants::GET:
                $response = $controller->findAll();
                break;
            case MethodsConstants::POST:
                $response = $controller->create($request_data);
                break;
            case MethodsConstants::PUT:
                $response = $controller->update();
                break;
            case MethodsConstants::DELETE:
                $response = $controller->delete();
                break;
        }

        return $response;
    }
}
