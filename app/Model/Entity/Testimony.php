<?php

namespace App\Model\Entity;

use \App\Db\Database;
use DateTime;
use \PDO;

class Testimony {

    /**
     * Id do depoimento
     *
     * @var integer
     */
    public $id;

    /**
     * Nome do usuário
     *
     * @var string
     */
    public $nome;

    /**
     * Mensagem do usuário
     *
     * @var string
     */
    public $mensagem;

    /**
     * Data de publicação da mensagem
     *
     * @var string
     */
    public $data;

    /**
     * Cadastrar um depoimento no banco
     *
     * @param string $table
     * @return boolean
     */
    public function cadastrar($table = null)
    {

        //INSERIR A DATA
        $this->data = date('Y-m-d H:i:s');

        $obDatabase = new Database($table);
        $this->id = $obDatabase->insertDatabase([
            'nome' => $this->nome,
            'mensagem' => $this->mensagem,
            'data' => $this->data
        ]);

        return true;
    }

    /**
     * Obter os depoimentos do banco
     *
     * @param string $table
     * @param string $where
     * @param string $order
     * @param string $limit
     */
    public static function getTestimony($where = null, $order = null, $limit = null)
    {
        return (new Database('depoimentos'))->selectDatabase($where,$order,$limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

}
