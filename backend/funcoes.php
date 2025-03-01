<?php
    function verificaEvento($nome) {
        include '../connection/conexao.php';
         //verifica se o evento existe
         $stmt = "SELECT nome FROM evento WHERE nome = :nome";
         $comando = $pdo->prepare($stmt);
 
         $comando->bindParam(":nome", $nome);
         $comando->execute();
 
         if ($comando->rowCount() > 0) {
            return throw new Exception("Evento já cadastrado", 401); //cadastro nao autorizado
            die();
         }
    }

    function buscarDadosEvento($idEvento) {
        include '../connection/conexao.php';

        $stmt = "SELECT * FROM evento WHERE codigo = :codigo";
        $comando = $pdo->prepare($stmt);

        $comando->bindParam(":codigo", $idEvento);
        $comando->execute();

        return $comando->fetch(PDO::FETCH_ASSOC);
    }

    function obterTiposEvento() {
        include '../connection/conexao.php';

        $stmt = "SELECT tipo from tiposEvento";
        $comando = $pdo->prepare($stmt);
        $comando->execute();

        return $comando->fetchAll(PDO::FETCH_ASSOC);
    }
?>