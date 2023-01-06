<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Testimony;

class Testimonies extends Page {

    /**
     * Retorna o conteúdo (view) dos depoimentos
     *
     * @return string
     */
    public static function getTestimonies()
    {

        if(isset($_POST['name'], $_POST['depoiment'])){
            $obTestemony = new Testimony();
            $obTestemony->nome = $_POST['name'];
            $obTestemony->mensagem = $_POST['depoiment'];
            $obTestemony->cadastrar('depoimentos');

            header('Location: /depoimentos');
            exit;
        }

        $res = '';
        $Tests = Testimony::getTestimony(null, 'id DESC', '2');
        foreach($Tests as $Test) {
            $res .= '<div class="card text-dark mb-3">
                        <h5 class="card-header">' . $Test->nome . '<small>05/12/23</small> </h5>
                        <div class="card-body">' . $Test->mensagem . '</div>
                    </div>';
        }



        //VIEW DE DEPOIMENTOS
        $content = View::render('pages/testimonies', [
            'name' => 'Depoimentos',
            'dep' => $res
        ]);

        // RETORNA A VIEW DA PÁGINA
        return parent::getPage('Depoimentos', $content);
        
    }
}