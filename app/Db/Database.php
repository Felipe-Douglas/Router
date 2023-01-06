<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database {

    /**
     * Nome da tabela a ser manipulada
     *
     * @var string
     */
    private $table;

    /**
     * Instancia da conexão com o banco de dados
     *
     * @var PDO
     */
    private $pdo;
    
    /**
     * Define a tabela, instancia e conexão
     *
     * @param [type] $table
     */
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Cria uma conexão com o banco de dados
     *
     */
    private function setConnection()
    {
        try {
            $this->pdo = new PDO(DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("ERROR: " . $e->getMessage());
        }
    }

    /**
     * Execulta as querys dentro do banco de dados
     *
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query, $params =[])
    {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die("ERROR: " . $e->getMessage());
        }
    }

    /**
     * Inserir dados no banco
     *
     * @param array $values [field => value]
     * @return integer
     */
    public function insertDatabase($values)
    {
        //DADOS DA QUERY
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');

        $query = "INSERT INTO " . $this->table . "(" . implode(',', $fields). ") VALUES (" . implode(',', $binds).")";

        //EXECUTA O INSERT
        $this->execute($query, array_values($values));

        //RETORNA O ID INSERIDO
        return $this->pdo->lastInsertId();
    }

    /**
     * Undocumented function
     *
     * @param string $order
     * @param string $limit
     * @param string $where
     * @return PDOStatement
     */
    public function selectDatabase($where = null, $order = null, $limit = null)
    {
        // DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        //MONTA A QUERY
        $query = 'SELECT * FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

        // EXECULTA A QUERY
        return $this->execute($query);
    }

    

}