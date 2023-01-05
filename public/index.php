<?php

require __DIR__ . "/../vendor/autoload.php";

use \App\Http\Router;
use \App\Utils\View;

//DEFINE O VALOR PADRÃO DA VARIÁVEL
View::init([
    'URL' => URL
]);

//INICIA O ROUTER
$obRouter = new Router(URL);

//INCLUI AS ROTAS DE PÁGINA
include __DIR__ . '/../config/routes.php';

//IMPRIME O RESPONSE DA ROTA
$obRouter->run()->sendResponse();