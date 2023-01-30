<?php

namespace ScheduleThing\API\Http;

use ScheduleThing\API\Routes\Endpoints;
use ScheduleThing\Controller\Client\ClientController;
use ScheduleThing\Controller\DefaultController;

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
        $endpointExist = (new Endpoints())->validateExistEndpoint($this->prefix, $this->resource);
        if (!$endpointExist) {
            return false;
        }

        $controller = (new DefaultController())->redirect($this->prefix);

        $request_data = $this->request->getRequestData();

        $this->request->sendRequest($controller, $request_data);
    }
}
