<?php

use App\Acoes\AcoesProduto;

require_once 'src\Acoes\AcoesProduto.php';

$acoes = new AcoesProduto();
$msg = "";  
//** SE O POST FOR SETADO */
if(isset( $_POST['inserir'] )){

    //** PEGA OS VALORES DA REQUISÇÃO */
    $nome = $_POST['nome'];
    $preco = floatval($_POST['preco']);
    $cor = $_POST['cor'];

    /**
     * CHAMA A ACAO DE INSERIR PRODUTO PASSANDO OS DADOS DA REQUISIÇÃO
     */
    $inseriu = $acoes->inserir($nome, $cor, $preco);  
    
    if( $inseriu )
       header("Location:index.php?acao=inserir&status=ok");

}
?>
<?php include "includes/topo.php" ?>
<!-------------------------------------- SECAO DO FORMULARIO ---------------------------------------->
<section class="secao-formulario">
    <div class="container">

    <h2>Formulário de Cadastro</h2>

    <p class="msg"><?= $msg  ?></p>

    <?php
        
     ?>
        <form action="form.php" method="POST" class="form-cadastro">
            <div>
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" placeholder="Nome" required>
            </div>
            <div>
                <label for="preco">Preço</label>
                <input type="text" name="preco" id="preco" placeholder="Preço" required>
            </div>
            <div>
                <label for="cor">Cor</label>
                <input type="text" name="cor" id="cor" placeholder="Cor" required>
            </div>
    
            <div>
                <input type="submit" value="INSERIR" class="botao botao-inserir" name="inserir" title="Inserir"/>
            </div>
        </form>        
    </div>
</section>

<?php include "includes/rodape.php" ?>







