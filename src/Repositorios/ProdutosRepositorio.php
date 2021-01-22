<?php 

namespace App\Repositorio;

use App\Conexao\ConexaoPdo;
use App\Modelo\Produto;
use PDO;
use PDOException;

require_once 'src\Conexao\ConexaoPdo.php';

class ProdutoRepositorio{
    
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
    

    public function inserir(Produto $produto){

        try {            
            $sql = "INSERT INTO Produtos (nome, cor, idpreco) VALUES (:nome, :cor, :preco)";

            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare($sql);

            $nome       = $produto->nome;
            $cor        = $produto->cor;
            $preco    = $produto->preco->preco;

            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':cor', $cor, PDO::PARAM_STR);
            $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
            $retorno = $stmt->execute();

            $this->pdo->commit();

            return $retorno;

        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    
    public function editar (Produto $produto){
        try {

                $sql = "UPDATE produtos prod 
                INNER JOIN preco pre
                ON prod.idpreco = pre.idpreco
                SET prod.nome=:nome, pre.preco=:preco
                WHERE prod.idprod =:idprod";
                
                $idprod     =   $produto->idprod;
                $nome       = $produto->nome;
                $preco      = $produto->preco->preco;

                var_dump( $idprod, $nome, $preco );

                $this->pdo->beginTransaction();

                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':idprod', $idprod, PDO::PARAM_INT);
                $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
                $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
                $stmt->execute();
                
                $this->pdo->commit();

            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }
    }

    
    public function excluir($id){
        try {
            //code...
            $sql = "DELETE FROM produtos WHERE idprod = :id";
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare($sql);    
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $retorno = $stmt->execute();  

            $this->pdo->commit();
            return $retorno;

        } catch (PDOException $ex) {
            print_r($ex->getMessage() );
        }

    }


    public function listar(){
        $sql = "SELECT prod.idprod, prod.nome, prod.cor, pre.preco 
        FROM produtos prod 
        INNER JOIN preco pre
        ON prod.idpreco = pre.idpreco;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();  
        $produtos = null;

        while ($resultado = $stmt->fetch(PDO::FETCH_OBJ)){
            $produtos[] = $resultado;
        }
        return $produtos;

    }

    
    public function listarCores(){
        $sql = "SELECT distinct cor 
        FROM produtos";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();  

        $produtos = array();

        while(  $resultado = $stmt->fetch(PDO::FETCH_OBJ) ){
            
            $produtos[] = $resultado;
        }
        return $produtos;
    }


    public function filtrarPorNome( string $nome){
        $sql = "SELECT prod.idprod, prod.nome, prod.cor, pre.preco FROM produtos prod 
                INNER JOIN preco pre
                ON prod.idpreco = pre.idpreco
                WHERE prod.nome = :nome";

                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
                $stmt->execute();  
                $produtos = array();

                while ($resultado = $stmt->fetch(PDO::FETCH_OBJ)){
                    
                    $produtos[] = $resultado;
                }
                return $produtos;
    }


    public function filtrarPorCor( string $cor){
        $sql = "SELECT prod.idprod, prod.nome, prod.cor, pre.preco FROM produtos prod 
                INNER JOIN preco pre
                ON prod.idpreco = pre.idpreco
                WHERE prod.cor = :cor";

                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':cor', $cor, PDO::PARAM_STR);
                $stmt->execute();  
                $produtos = array();

                while ($resultado = $stmt->fetch(PDO::FETCH_OBJ)){
                    $produtos[] = $resultado;
                }
                return $produtos;
    }


    public function filtrarPorPreco( string $preco){
        $sql = "SELECT prod.idprod, prod.nome, prod.cor, pre.preco FROM produtos prod 
                INNER JOIN preco pre
                ON prod.idpreco = pre.idpreco
                WHERE pre.preco = :preco";

                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
                $stmt->execute();  
                $produtos = array();

                while ($resultado = $stmt->fetch(PDO::FETCH_OBJ)){
                    $produtos[] = $resultado;
                }
                return $produtos;
    }


    public function filtraPorPrecoMenorQue( string $preco){
        $sql = "SELECT prod.idprod, prod.nome, prod.cor, pre.preco FROM produtos prod 
                INNER JOIN preco pre
                ON prod.idpreco = pre.idpreco
                WHERE pre.preco < :preco";

                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
                $stmt->execute();  
                $produtos = array();

                while ($resultado = $stmt->fetch(PDO::FETCH_OBJ)){
                    $produtos[] = $resultado;
                }
                return $produtos;
    }


    public function filtraPorPrecoMaiorQue( string $preco){
        $sql = "SELECT prod.idprod, prod.nome, prod.cor, pre.preco FROM produtos prod 
                INNER JOIN preco pre
                ON prod.idpreco = pre.idpreco
                WHERE pre.preco > :preco";

                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
                $stmt->execute();  
                $produtos = array();

                while ($resultado = $stmt->fetch(PDO::FETCH_OBJ)){
                    $produtos[] = $resultado;
                }
                return $produtos;
    }


    public function buscar($id){
        $sql = "SELECT prod.idprod, prod.nome, prod.cor, pre.idpreco, pre.preco
                FROM produtos prod 
                INNER JOIN preco pre
                ON prod.idpreco = pre.idpreco
                WHERE prod.idprod = :id;";

                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();  

                $resultado = $stmt->fetch(PDO::FETCH_OBJ);
                return $resultado;
    }

    public function editarProdutos($id, $nome){
        $sql = "UPDATE produtos SET nome=:nome WHERE idprod = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->execute(); 
    }

    public function editarPreco($idpreco, $preco){
        $sql = "UPDATE preco SET preco=:preco WHERE idpreco = :idpreco";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idpreco', $idpreco, PDO::PARAM_INT);
        $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
        $stmt->execute();
    }


}
?>