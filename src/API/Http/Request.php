<?php

namespace ScheduleThing\API\Http;

class Request {
    private string $httpMethod;
    private string $uri;
    private array  $queryParams = [];
    private array  $postVars = [];
    private array  $request_data;
    private array  $headers = [];

    public function __construct()
    {
        $this->setHeaders();
        $this->queryParams = $_GET ?? [];
        $this->postVars    = $_POST ?? [];
        $this->request_data = json_decode(file_get_contents('php://input'), true);
        $this->headers     = getallheaders();
        $this->httpMethod  = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri         = $_SERVER['REQUEST_URI'] ?? '';
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

    public function getRequestData(): array
    {
        return $this->request_data;
    }
}