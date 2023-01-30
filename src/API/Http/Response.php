<?php

namespace ScheduleThing\API\Http;

use ScheduleThing\Constants\Http\StatusCodeConstants;
use ScheduleThing\Validate\CommomValidate;

class Response {
    private bool   $success = true;
    private int    $statusCode = StatusCodeConstants::OK;
    private string $msg = '';
    private mixed  $data;
    private string $contentType = 'application/json';
    private array  $headers = [];

    public function __construct(
        bool $success,
        int $statusCode,
        string $msg,
        mixed $data,
        string $contentType = 'application/json')
    {
        $this->success = $success;
        $this->statusCode = $statusCode;
        $this->msg = $msg;
        $this->data  = $data;
        $this->setContentType($contentType);
    }

    public function setContentType(string $contentType): void
    {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }

    public function addHeader(string $key, string $value): void
    {
        $this->headers[$key] = $value;
    }

    private function sendHeaders(): void
    {
        http_response_code($this->statusCode);

        foreach ($this->headers as $key => $value) {
            header($key . ': ' . $value);
        }
    }

    public function sendResponse(): string|bool
    {
        $this->sendHeaders();

        $response = CommomValidate::formatResponse(
            $this->success,
            $this->statusCode,
            $this->msg,
            $this->data
        );

        return json_encode($response);
    }
}
