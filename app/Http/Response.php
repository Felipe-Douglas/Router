<?php

namespace App\Http;

class Response{

    /**
     * Código do Status HTTP
     *
     * @var integer
     */
    private $httpCode = 200;

    /**
     * Cabeçalho do Response
     *
     * @var array
     */
    private $headers = [];

    /**
     * Tipo de conteúdo
     *
     * @var string
     */
    private $contentType = 'text/html';

    /**
     * Contúdo do response
     *
     * @var mixed
     */
    private $content;

    /**
     * Inicia a classe e definir os valores
     *
     * @param integer $httpCode
     * @param mixed $content
     * @param string $contentType
     */
    public function __construct($httpCode, $content, $contentType = 'text/html')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }

    /**
     * Altera o content type do response
     *
     * @param string $contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }

    /**
     * Adiciona o registro no cabecalho response
     *
     * @param string $key
     * @param string $value
     */
    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    /**
     * Enviar os headers para o navegador
     *
     */
    public function sendHeaders()
    {
        //STATUS
        http_response_code($this->httpCode);

        //ENVIAR HEADERS
        foreach ($this->headers as $key => $value) {
            header($key . ': ' . $value);
        }
    }

    /**
     * Enviar a resposta para o usuário
     *
     */
    public function sendResponse()
    {
        //ENVIA OS HEADERS
        $this->sendHeaders();

        //ENVIA O CONTEÚDO
        switch($this->contentType) {
            case 'text/html':
                echo $this->content;
                exit;
        }
    }

}