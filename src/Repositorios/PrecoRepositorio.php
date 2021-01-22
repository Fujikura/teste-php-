<?php 

namespace App\Repositorio;

use App\Conexao\ConexaoPdo;
use App\Modelo\Preco;
use PDO;
use PDOException;

require_once 'src\Conexao\ConexaoPdo.php';

class PrecoRepositorio{
    
    private $conexao = null;
    private $pdo = null;

    /** 
     * CRIA A CONEXÃO COM O BANCO DE DADOS
     */
    public function __construct(){
        $this->conexao   = new ConexaoPdo();
        $this->pdo       = $this->conexao->conectar();
    }

    /** 
     * DESTROI A CONEXÃO COM O BANCO DE DADOS
     */
    public function __destruct()
    {
        $this->conexao->fecharConexao();
        $this->pdo     = null;
    }
    

    public function inserir(Preco $preco){

        try {            
            $sql = "INSERT INTO Preco (preco) VALUES (:preco)";
            $stmt = $this->pdo->prepare($sql);

            $preco = $preco->preco;

            $stmt->bindParam(':preco',$preco , PDO::PARAM_STR);
            $stmt->execute();

            return $this->pdo->lastInsertId();

        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}
?>