<?php
    include '../connection/conexao.php';

    try {
        $stmt = 'UPDATE evento 
            SET nome = :nome, descricao = :descricao, endereco = :endereco, link_endereco = :link, dataHora_inicio = :dataHora, tipo = :tipo, preco = :preco 
            WHERE codigo = :codigo';
            $comando = $pdo->prepare($stmt);

            $codigo = htmlspecialchars($_POST['codigo']);
            $nome = htmlspecialchars($_POST['nome']);
            $descricao = htmlspecialchars($_POST['descricao']);
            $endereco = htmlspecialchars($_POST['endereco']);
            $link = htmlspecialchars($_POST['link']);

            $dataEvento = htmlspecialchars($_POST['data']);
            $horaEvento = htmlspecialchars($_POST['hora']);
            $data = $dataEvento. " " .$horaEvento; //concatenando data e hora
            
            $preco = htmlspecialchars($_POST['preco']);
            $tipo = htmlspecialchars($_POST['tipo']);

            /*:nome, :descricao, :endereco, :link, :dataHora, :tipo*/
            $comando->bindParam(':codigo', $codigo);
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
                echo '<script>
                    alert("Evento atualizado com sucesso!");
                    window.location.href = "../pages/index.php";
                </script>';
            }
    }
    catch(Exception $e) {
        // Tratar erro e retornar resposta JSON
        header('Content-Type: application/json');
        $retorno = ["failed" => true, "message" => $e->getMessage()];
        echo json_encode($retorno);
    }
?>