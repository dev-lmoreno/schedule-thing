<?php

namespace ScheduleThing\API\Http;

use ScheduleThing\API\Routes\Endpoints;
use ScheduleThing\Constants\Http\StatusCodeConstants;
use ScheduleThing\Controller\DefaultController;
use ScheduleThing\Model\DefaultModel;

class Router {
    private string  $url = '';
    private string  $prefix = '';
    private string  $resource = '';
    private int     $urlIdParam = 0;
    private array   $urlPaths = [];
    private Request $request;

    public function __construct(string $url)
    {
        $this->request = new Request();
        $this->url = $url;
        $this->urlPaths = self::parseUrl();
        $this->setPrefix();
        $this->setResource();
        $this->setIdUrlParam();
    }

    private function parseUrl(): array
    {
        $parts = parse_url($this->request->getUri());
        $paths = explode('/', $parts['path']);

        return $paths;
    }

    private function setPrefix(): void
    {
        $this->prefix = $this->urlPaths[2];
    }

    private function setResource(): void
    {
        $this->resource = $this->urlPaths[3] ?? '';
    }

    private function setIdUrlParam(): void
    {
        $this->urlIdParam = $this->urlPaths[4] ?? 0;
    }

    public function isApiRequest(): bool
    {
        return $this->urlPaths[1] === 'api' ? true : false;
    }

    public function run(): bool
    {
        $endpointExist = (new Endpoints())->validateExistEndpoint($this->prefix, $this->resource);

        if ($endpointExist) {
            $controller = (new DefaultController())->redirect($this->prefix);

            $returnRequest = $this->request->sendRequest(
                $controller,
                $this->prefix,
                $this->resource,
                $this->urlIdParam
            );

            $response = (new Response(
                $returnRequest['success'],
                $returnRequest['statusCode'],
                $returnRequest['msg'],
                $returnRequest['data']
            ))->sendResponse();

            echo $response;

            return true;
        }

        $response = (new Response(
            false,
            StatusCodeConstants::NOT_FOUND,
            "Endpoint /{$this->resource} not found",
            "HTTP/1.1 404 Not Found"
        ))->sendResponse();

        echo $response;

        return false;
    }
}
