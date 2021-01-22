<?php

use App\Acoes\AcoesProduto;

require_once 'src\Acoes\AcoesProduto.php';

$acoes = new AcoesProduto();
?>

<?php include "includes/topo.php" ?>
<!-------------------------------------- SECAO DE FILTRO ---------------------------------------->

<section class="secao-filtro">
    <div class="container">
    
    <?php include "mensagem.php"; ?>

    <a href="form.php" class="botao botao-inserir">INSERIR</a>
    
    <h3>Filtrar por</h3>
        <form action="index.php" id="filtro-form" name="filtro-form" method="POST">
            <div class="filtro-nome">
                <input type="search" name="filtro-nome" placeholder="Nome">
            </div>
            
            <div class="filtro-cor">
                <select name="filtro-cor" id="filtro-cor">
                    <option value="selecione">Selecione</option>
                    <?php                    
                    $cores = $acoes->listarCores();  
                    
                    foreach ($cores as $cor) {  
                        if(isset($cor->cor)) { ?> 
                    
                            <option value="<?= $cor->cor ?>"><?= $cor->cor ?></option>
                    <?php
                        }
                    } 
                ?>    
                </select>
            </div>

            <div class="filtro-preco">
                <div class="preco">
                    <input type="text" name="filtro-preco" placeholder="Preço" class="filtro-preco-input">
                </div>
                <div class="opcoes">
                    <label for="">=</label>
                    <select name="opcoes" id="">
                        <option value="opcao-menorque"> < </option>
                        <option value="opcao-igual"> = </option>
                        <option value="opcao-maiorque"> > </option>
                    </select>
                </div>
            </div>

            <button type="submit" class="botao-filtrar" name="filtrar">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </form>
    </div>
</section>

<!-------------------------------------- SECAO DA TABELA --------------------------------------->
<section class="secao-tabela">
    <div class="container">
    <h3>Resultados</h3>
        <table class="tabela">
            <thead>
                <td>Id</td>
                <td>Nome</td>
                <td>Cor</td>
                <td>Preço</td>
                <td>Ações</td>
            </thead>
            <tbody>
                
                <?php
                
                if(isset($_POST['filtrar']) && $_POST['filtrar'] !== null){
                    $filtroNome       = $_POST['filtro-nome'];
                    $filtroCor        = $_POST['filtro-cor'];
                    $filtroPreco      = $_POST['filtro-preco'];
                    $opcoes           = $_POST['opcoes'];

                    //** Chama a acao de filtrar, filtra de acordo com os campos que foram preenchidos na tela */
                    $produtos = $acoes->filtrar($filtroNome, $filtroCor, $filtroPreco, $opcoes);
                }                

                if( isset($produtos) ){
                    foreach($produtos as $produto){ ?>
                    <tr>
                        <td><?= $produto->idprod ?></td>
                        <td><?= $produto->nome ?></td>
                        <td><?= $produto->cor ?></td>
                        <td><?= "R$ ". number_format( $produto->preco,2,",","."); ?></td>
                        <td class="acoes">
                            
                            <a href="editar.php?id=<?php echo $produto->idprod ?>" class="botao-atualizar" title="Atualizar">
                                <i class="fa fa-pencil icones" aria-hidden="true"></i>
                            </a>
                            <form action="excluir.php" method="POST">
                                <input type="hidden" name="acao" value="excluir">
                                <input type="hidden" name="id" value="<?= $produto->idprod?>">
                                <button type="submit"class="botao-excluir" title="Excluir" name="excluir"> 
                                    <i class="fa fa-trash-o icones" aria-hidden="true"></i>
                                </button>
                            </form>
                            
                        </td>
                    </tr>

                <?php 
                        } 
                    }
                ?>
            </tbody>
        </table>
    </div>
</section>

<?php include("includes/rodape.php"); ?>







