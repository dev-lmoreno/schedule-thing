<?php

namespace ScheduleThing\API\Http;

class Response {

    private int $httpCode = 200;
    private array $headers = [];
    private string $contentType = 'application/json';
    private mixed $content;

    public function __construct(int $httpCode, mixed $content, string $contentType = 'application/json')
    {
        $this->httpCode = $httpCode;
        $this->content  = $content;
        $this->setContentType($contentType);
    }

    /**
     * Método responsável por alterar o content type do response
     * @param string $contentType
     */
    public function setContentType(string $contentType): void
    {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }

    /**
     * Método responsável por adicionar um registro no cabeçalho de response
     * @param string $key
     * @param string $value
     */
    public function addHeader($key, $value): void
    {
        $this->headers[$key] = $value;
    }

    /**
     * Método responsável por enviar os headers para o navegador
     */
    private function sendHeaders(): void
    {
        // DEFINIR OS STATUS
        http_response_code($this->httpCode);

        // ENVIAR HEADERS
        foreach ($this->headers as $key => $value) {
            header($key . ': ' . $value);
        }
    }

    /**
     * Método responsável por enviar a resposta para o usuário
     */
    public function sendResponse(): void
    {
        // ENVIA OS HEADERS
        $this->sendHeaders();

        // DEFINE O CONTEÚDO
        switch ($this->contentType) {
            case 'application/json':
                exit;
        }
    }
}
