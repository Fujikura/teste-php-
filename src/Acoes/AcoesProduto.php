<?php 
namespace App\Acoes;

use App\Modelo\Preco;
use App\Modelo\Produto;
use App\Repositorio\PrecoRepositorio;
use App\Repositorio\ProdutoRepositorio;

require_once 'src\Modelo\Produto.php';
require_once 'src\Modelo\Preco.php';
require_once 'src\Repositorios\ProdutosRepositorio.php';
require_once 'src\Repositorios\PrecoRepositorio.php';

//** CLASSE RESPONSAVEL PELAS ACOES DOS PRODUTOS */
class AcoesProduto{

    /**
     * ATRIBUTOS 
     */
    private  PrecoRepositorio $precoRepositorio;     
    private ProdutoRepositorio $produtoRepositorio;
    
    /**
     * CRIA OS REPOSITORIOS AO CRIAR A CLASSE ACAO PRODUTO
     */
    public function __construct(){
         $this->precoRepositorio    = new PrecoRepositorio();
         $this->produtoRepositorio  = new ProdutoRepositorio();
    }


    /**
     * ACAO RESPONSAVEL POR INSERIR REGISTRO DO PRODUTO
     */
    public function inserir($nome, $cor, $preco){
        //** CRIA OS OBJETO PRECO COM OS VALORES DA REQUISICAO */
        $objPreco   = new Preco(null, $preco);
        //** INSERE PRECO E SETA O ID INSERIDO NO OBJETO PRECO*/
        $objPreco->id = $this->precoRepositorio->inserir($objPreco);

        //** CRIA OBJETO PRODUTO COM OS VALORES DA REQUISICAO E O ID DO PRECO */
        $objProduto = new Produto(null, $nome, $cor, $objPreco);
        $objProduto->nome       = $nome;
        $objProduto->cor        = $cor;
        $objProduto->idpreco    = $objPreco->id;

        $desconto = $objProduto->desconto();

        //** SE ID FOR MAIOR QUE 0 INSERE PRODUTO PASSANDO O ID DO PRECO */
        if( $objPreco->id > 0 ){
            return $this->produtoRepositorio->inserir($objProduto);
        }
    }

    public function excluir($id){
        return $this->produtoRepositorio->excluir($id);
    }

    public function editar($id, $nome, $preco){
        /**$this->produtoRepositorio->editarProdutos($id, $nome);
        $this->produtoRepositorio->editarPreco($id, $preco);*/
        
        $objPreco = new Preco(null, $preco);        
        $objProduto = new Produto($id, $nome, "", $objPreco);

        $this->produtoRepositorio->editar($objProduto);
    }

    public function buscarPorId($id){
        return $this->produtoRepositorio->buscar($id);
    }


    public function filtrarPorNome(string $nome){
        return $this->produtoRepositorio->filtrarPorNome($nome);
    }

    public function filtrarPorCor(string $cor){
        return $this->produtoRepositorio->filtrarPorCor($cor);
    }

    public function filtrarPorPreco(string $preco){
        return $this->produtoRepositorio->filtrarPorPreco($preco);
    }

    public function filtrarPorPrecoMenorQue(string $preco){
        return $this->produtoRepositorio->filtraPorPrecoMenorQue($preco);
    }

    public function filtrarPorPrecoMaiorQue(string $preco){
        return $this->produtoRepositorio->filtraPorPrecoMaiorQue($preco);
    }

    public function filtrarTodos(){
        return $this->produtoRepositorio->listar();
    }

    public function listarCores(){
        return $this->produtoRepositorio->listarCores();
    }

    public function filtrar($nome, $cor, $preco, $opcoes){

        var_dump($opcoes);

        if( $nome !== "" ){
            return $this->filtrarPorNome($nome);
        }
        elseif( $cor !== "selecione"){
            return $this->filtrarPorCor($cor);
        }
        elseif( $preco !== "" && $opcoes === "opcao-igual" ){
            return $this->filtrarPorPreco($preco);
        }elseif ( $preco !== "" && $opcoes === "opcao-menorque" ){
            return $this->filtrarPorPrecoMenorQue($preco);
        }elseif( $preco !== "" && $opcoes === "opcao-maiorque"){
            return $this->filtrarPorPrecoMaiorQue($preco);
        }
        else{ 
            return $this->filtrarTodos();
        }
    }
}
?>