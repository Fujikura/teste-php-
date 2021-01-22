<?php

use App\Acoes\AcoesProduto;

require_once 'src\Acoes\AcoesProduto.php';

$acoes = new AcoesProduto();
?>

<?php include('includes/topo.php'); ?>

<?php 
    if( $_POST['acao'] === "excluir" ) {
        $id = $_POST['id'];

        $excluir = $acoes->excluir($id);
        if( $excluir ){
            header("Location:index.php?acao=excluir&status=ok");
        }
    }
?>

<?php include('includes/rodape.php'); ?>