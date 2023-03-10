<?php

use \App\Http\Response;
use \App\Controller\Pages;

//ROTA HOME
$obRouter->get('/', [
    function() {
        return new Response(200, Pages\Home::getHome());
    }
]);

//ROTA SOBRE
$obRouter->get('/sobre', [
    function() {
        return new Response(200, Pages\About::getAbout());
    }
]);

//ROTA DE DEPOIMENTOS
$obRouter->get('/depoimentos', [
    function() {
        return new Response(200, Pages\Testimonies::getTestimonies());
    }
]);

//ROTA DE DEPOIMENTOS
$obRouter->post('/depoimentos', [
    function($request) {
        return new Response(200, Pages\Testimonies::getTestimonies());
    }
]);
