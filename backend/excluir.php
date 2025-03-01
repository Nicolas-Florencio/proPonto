<?php
    include '../connection/conexao.php';

    try {
        $stmt = "DELETE FROM evento WHERE codigo = :codigo";

        $comando = $pdo->prepare($stmt);

        $codigo = htmlspecialchars($_GET['codigo']);

        $comando->bindParam(':codigo', $codigo);
        $comando->execute();
        //vamos verificar se deu certo
        if($comando->rowCount() > 0) {
            echo '<script>
                alert("Evento excluido com sucesso!");
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