<?php

use App\Acoes\AcoesProduto;
require_once 'src\Acoes\AcoesProduto.php';

$acoes = new AcoesProduto();
    
    if(isset($_GET['id']) && ($_GET['id'] !== "")){
        $id = $_GET['id'];
        /** busca os dados do produto e preco pelo ID e popula campos */
        $dados = $acoes->buscarPorId($id);

    }
    /** Se clicar no botão editar */
    if( isset($_POST['editar'] ) ){       

        //** PEGA OS VALORES DA REQUISÇÃO */
        $id         = $_POST['idprod'];
        $nome       = $_POST['nome'];
        $preco      = $_POST['preco'];

        /** Chama a acao de editar */
        $acoes->editar($id, $nome, $preco );
        
        /** Redireciona para a index com a acao de editar com status de ok */
        header("Location:index.php?acao=editar&status=ok");
    }
?>
<?php include "includes/topo.php" ?>
<!-------------------------------------- SECAO DO FORMULARIO ---------------------------------------->
<section class="secao-formulario">
    <div class="container">

    <h2>Formulário de Edição</h2>
        <form action="editar.php" method="POST" class="form-cadastro">
            <input type="hidden" name="idprod" value="<?= $dados->idprod ?>">
            <div>
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" placeholder="Nome" required
                value="<?= $dados->nome; ?>">
            </div>
            <div>
                <label for="preco">Preço</label>
                <input type="text" name="preco" id="preco" placeholder="Preço" required
                value="<?= number_format( $dados->preco,2,",","." ); ?>">
            </div>
            <div>
                <label for="cor">Cor</label>
                <input type="text" name="cor" id="cor" placeholder="Cor" required
                value="<?= $dados->cor; ?>" readonly="true">
            </div>
    
            <div>
                <input type="submit" value="EDITAR" class="botao botao-inserir" name="editar" title="Editar"/>
            </div>
        </form>        
    </div>
</section>

<?php include "includes/rodape.php" ?>







