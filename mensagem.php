<?php 
    if(isset($_GET['status']) && $_GET['status'] === "ok" && $_GET['acao'] === "editar"){?>
        <p class="msg msg-sucesso">Registro editado com sucesso!!</p>
    <?php
    }elseif(isset($_GET['status']) && $_GET['status'] === "ok" && $_GET['acao'] === "excluir"){?>
        <p class="msg msg-sucesso">Registro excluido com sucesso!!</p>
    <?php
    }elseif(isset($_GET['status']) && $_GET['status'] === "ok" && $_GET['acao'] === "inserir"){?>
        <p class="msg msg-sucesso">Registro inserido com sucesso!!</p>
        <?php
    }
?>