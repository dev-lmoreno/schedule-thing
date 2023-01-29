<?php

namespace ScheduleThing\API\Http;

use ScheduleThing\API\Routes\Endpoints;
use ScheduleThing\Controller\Client\ClientController;

class Router {
    private string $url = '';
    private string $prefix = '';
    private string $resource = '';
    private array $urlPaths = [];
    private Request $request;

    public function __construct(string $url)
    {
        $this->request = new Request();
        $this->url = $url;
        $this->urlPaths = self::parseUrl();
        $this->setPrefix();
        $this->setResource();
    }

    private function parseUrl(): array
    {
        $parts = parse_url($this->request->getUri());
        $paths = explode('/', $parts['path']);

        return $paths;
    }

    public function isApiRequest(): bool
    {
        return $this->urlPaths[1] === 'api' ? true : false;
    }

    private function setPrefix(): void
    {
        $this->prefix = $this->urlPaths[2];
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    private function setResource(): void
    {
        $this->resource = $this->urlPaths[3];
    }

    public function getResource(): string
    {
        return $this->resource;
    }

    public function run()
    {
        $instanceEndpoint = new Endpoints();
        $isValidEndpoint = $instanceEndpoint->validateExistEndpoint($this->prefix, $this->resource);
        if (!$isValidEndpoint) {
            return false;
        }

        if ($this->prefix === 'clients') {
            $clientController = new ClientController();
            $request_data = $this->request->getRequestData();

            switch ($this->request->getHttpMethod()) {
                case 'GET':
                    $clientController->findOne();
                    break;
                case 'POST':
                    $clientController->create($request_data);
                    break;
                case 'PUT':
                    $clientController->update();
                    break;
                case 'DELETE':
                    $clientController->delete();
                    break;
            }
        }
    }
}
