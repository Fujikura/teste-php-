<?php 
namespace App\Modelo;

class Produto{
    /**
     * Atributos
     */
    private ?int $idprod;
    private string $nome;
    private string $cor;
    private Preco $preco;

    /**
     * Construtor
     */
    public function __construct(?int $idprod, string $nome, ?string $cor, Preco $preco){ 
        $this->idprod = $idprod;
        $this->nome = $nome;
        $this->cor = $cor;
        $this->preco = $preco;
    }

    /**
     * Metodos
     */
    public function __set($atrib, $value){
        $this->$atrib = $value;
        return $this->$atrib;
    }

    public function __get($atrib){
        return $this->$atrib;
    }

    private function corVermelho(){
        if( strtoupper( $this->cor ) === "VERMELHO")
            return true;
    }

    private function corAzul(){
        if( strtoupper( $this->cor ) === "AZUL")
            return true;
    }

    private function corAmarelo(){
        if( strtoupper( $this->cor ) === "AMARELO")
            return true;
    }

    public function desconto(){
        $desconto = 0;
        if( $this->corVermelho() && $this->preco->maiorQueCinquenta() ){
            $desconto = 5;
        }elseif( $this->corAmarelo()){
            $desconto = 10;
        }elseif( $this->corVermelho() || $this->corAzul() ){
            $desconto = 20;
        }else{
            $desconto = 0;
        }
        return $desconto;
        
    }
}
?>