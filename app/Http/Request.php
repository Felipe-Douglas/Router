<?php

namespace App\Http;

class Request {
    
    /**
     * Método HTTP da requisição
     *
     * @var string
     */
    private $httpMethod;

    /**
     * URI da página
     *
     * @var string
     */
    private $uri;

    /**
     * Parâmetros da URL ($_GET)
     *
     * @var array
     */
    private $queryParams = [];

    /**
     * Variáveis recebidas no POST da página ($_POST)
     *
     * @var array
     */
    private $postVars = [];

    /**
     * Cabecalho da requisição
     *
     * @var array
     */
    private $headers = [];

    public function __construct()
    {
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
    }

    /**
     * Retorna o método HTTP da requisição
     *
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * Retorna a URI da requisição
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Retorna os Headers HTTP da requisição
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Retorna os parâmetros da URL da requisição
     *
     * @return array
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }

    /**
     * Retorna as variáveis POST da requisição
     *
     * @return array
     */
    public function getPostVars()
    {
        return $this->postVars;
    }
    

}