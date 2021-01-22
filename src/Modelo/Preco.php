<?php 
namespace App\Modelo;

class Preco{

    /**
     * Atributos
     */
    private ?int $idpreco = null;
    private float $preco;

    public function __construct(?int $id, float $preco )
    {
        $this->idpreco = $id;
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

    public function maiorQueCinquenta(){
        if( $this->preco > 50.00 )
            return true;
        else
            return false;    
    }

}
?>