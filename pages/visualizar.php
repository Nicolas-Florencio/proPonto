<?php
    include "../backend/funcoes.php";

    $idEvento = $_GET['codigo'];
    $arrayEvento = buscarDadosEvento($idEvento);
    //funcao retorna array associativo

    $tipos = obterTiposEvento();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/visualizacao.css">

    <title>Evento: <?= $arrayEvento['nome'] ?></title>
</head>
<body>
        <main>
            <fieldset>
                <legend>Dados do evento: <?= $arrayEvento['nome'] ?></legend>

                <form action="../backend/editar.php" method="POST" id="formEditarEvento">
                    <label for="tipo">Tipo do evento:</label>
                    <select name="tipo" id="tipoEvento" required>
                        <option value="">-</option>
                    <!-- O usuário deve escolher um dos seguintes tipos: social, cultural, esportivo, corporativo, religioso, entretenimento ou outros. -->
                        <?php foreach($tipos as $opcoes) {
                                if($arrayEvento['tipo'] == $opcoes['tipo']) {
                                    $selected = 'selected';
                                }
                                echo "<option value='". strtolower($opcoes['tipo']) ."' $selected>". ucfirst($opcoes['tipo']) ."</option>";
                                //exemplo do resultado: <option value='social'>Social</option>
                                $selected = "";
                            }
                        ?>
                    </select>

                    <label for="nome">Nome do evento</label>
                    <input id="nomeEvento" name="nome" type="text" maxlength="60" required value="<?= $arrayEvento['nome'] ?>">

                    <label for="descricao">Descrição do evento</label>
                    <input id="descEvento" name="descricao" type="text" maxlength="150" value="<?= $arrayEvento['descricao'] ?>">
                    <!-- poderia ser um textarea-->

                    <label for="endereco">Endereço do evento</label>
                    <input id="enderecoEvento" name="endereco" type="text" maxlength="200" required value="<?= $arrayEvento['endereco'] ?>">

                    <label for="link">Link do Endereço</label>
                    <input id="linkEvento" name="link" type="text" maxlength="50" value="<?= $arrayEvento['link_endereco'] ?>">

                    <label for="data">Data do evento</label>
                    <input id="dataEvento" name="data" type="date" required value="<?= date('Y-m-d', strtotime($arrayEvento['dataHora_inicio'])) ?>">

                    <label for="hora">Hora do evento</label>
                    <input id="horaEvento" name="hora" type="time" required value="<?= date('H:i', strtotime($arrayEvento['dataHora_inicio'])) ?>">

                    <label for="preco">Preço do evento</label>
                    <input id="precoEvento" name="preco" type="number" step="any" value="<?= $arrayEvento['preco'] ?>">

                    <input type="hidden" name="codigo" value="<?= $idEvento ?>">

                    <button class="primario">Salvar</button>
                    <button id="voltar" class="secundario">Voltar</button>
                </form>
            </fieldset>
        </main>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
            document.querySelector('#voltar').addEventListener('click', (e) => {
                e.preventDefault();
                window.location.href = 'index.php';
            });
        });
        </script>
</body>
</html>