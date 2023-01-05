<?php

namespace App\Utils;

class View {

    /**
     * Variáveis padrões da View
     *
     * @param array $vars
     */
    private static $vars = [];

    /**
     * Define os dados iniciais da classe
     *
     * @param array $vars
     */
    public static function init($vars = [])
    {
        self::$vars = $vars;
    }

    /**
     * Retorna o conteúdo da view
     *
     * @param string $view
     * @return string
     */
    public static function getContentView($view)
    {
        $file = __DIR__ . "/../../resources/view/" . $view . ".html";
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * Retorna o conteúdo renderizado da view
     *
     * @param string $view
     * @param array $vars (string/numeric)
     * @return string
     */
    public static function render($view, $vars = [])
    {
        //CONTEUDO DA VIEW
        $contentView = self::getContentView($view); 

        //MERGE DE VARIÁVEIS DA VIEW
        $vars = array_merge(self::$vars, $vars);

        //CHAVES DO ARRAY DAS VARIÁVEIS
        $keys = array_keys($vars);
        $keys = array_map(function($item) {
            return '{{' . $item . '}}';
        }, $keys);

        //RETORNA O CONTEÚDO RENDERIZADO
        return str_replace($keys, array_values($vars), $contentView);
    }
}