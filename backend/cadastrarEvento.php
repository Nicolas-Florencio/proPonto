<?php

    function cadastrarEvento($dados) { //chamda da funcao na linha (51)
        include '../connection/conexao.php';
        include '../backend/funcoes.php';

        try {
            $nome = htmlspecialchars($dados['nome']); //funcao quie remove caracteres especiais, previnindo js injection
            verificaEvento($nome);
            //criaco do evento
            $stmt = 'INSERT INTO evento (nome, descricao, endereco, link_endereco, dataHora_inicio, tipo, preco) VALUES (:nome, :descricao, :endereco, :link, :dataHora, :tipo, :preco)';
            $comando = $pdo->prepare($stmt);
            
            /*dados recebidos: tipo, nome, descricao, endereco, link, data, preco*/
            
            $descricao = htmlspecialchars($dados['descricao']);
            $endereco = htmlspecialchars($dados['endereco']);
            $link = htmlspecialchars($dados['link']);
            $data = htmlspecialchars($dados['data']);
            $preco = htmlspecialchars($dados['preco']);
            $tipo = htmlspecialchars($dados['tipo']);

            /*:nome, :descricao, :endereco, :link, :dataHora, :tipo*/
            $comando->bindParam(':nome', $nome);
            $comando->bindParam(':descricao', $descricao);
            $comando->bindParam(':endereco', $endereco);
            $comando->bindParam(':link', $link);
            $comando->bindParam(':dataHora', $data);
            $comando->bindParam(':preco', $preco);
            $comando->bindParam(':tipo', $tipo);

            $comando->execute();

            //vamos verificar se a insercao deu certo
            if($comando->rowCount() > 0) {
                header('Content-Type: application/json');
                $retorno = (["success" => true]);
                return json_encode($retorno);
            }
        }
        catch(Exception $e) {
            // Tratar erro e retornar resposta JSON
            header('Content-Type: application/json');
            $retorno = ["failed" => true, "message" => $e->getMessage()];
            return json_encode($retorno);
        }
    }

    try {
        $recebeJSON = file_get_contents('php://input');
        $dados = json_decode($recebeJSON, true);

        echo cadastrarEvento($dados);
    }
    catch (Exception $e) {
        //erro no recebimento dos dados
        header('Content-Type: application/json');
        echo json_encode(['Erro' => $e->getMessage(), 'Codigo' => $e->getCode()]);
    }
?>