<?php 
namespace App\Conexao;

use PDO;
use PDOException;

class ConexaoPdo{
    private $pdo = null;

    /**
     * Cria a conexão com banco de dados
    */
    function conectar(){
        try {
            if($this->pdo === null){
                $this->pdo = new PDO('mysql:host=localhost:3306;dbname=testetitan','root', 'root');
                $this->pdo->exec("set names utf8");
            }
            return $this->pdo;
        } catch (PDOException $ex) {
            echo "Erro ao conectar no banco de dados " . PHP_EOL;
            echo "Mensagem do erro: " . $ex->getMessage() . PHP_EOL;
        }
    }

    /**
     * Fecha a conexão com banco de dados
     */
    public function fecharConexao(){
        try {
            if($this->pdo != null){
                $this->pdo = null;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}

?>