<?php
    include "../connection/conexao.php";

    include '../backend/funcoes.php';
    $tipos = obterTiposEvento();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/index.css">
    <title>Cadastrar Evento</title>
</head>
<body>
    <main>
        <div class="container">
            <h1>Bem-vindo, cadastre um evento!</h1>

            <div class="filtragem">
                <h2>Filtre os resultados</h2>
                <form action="index.php" method="GET" id="formFiltro">
                    <!--tipo, nome, endereço, data (de/até) e preço (de/até) -->

                    <div class="inputs">
                        <label for="tipo">Tipo do evento:</label>
                        <select name="tipo">
                            <option value="">-</option>
                        <!-- O usuário deve escolher um dos seguintes tipos: social, cultural, esportivo, corporativo, religioso, entretenimento ou outros. -->
                            <?php foreach($tipos as $opcoes) {
                                    if(@$_GET['tipo'] == $opcoes['tipo']) {
                                        $selected = 'selected';
                                    }
                                    
                                    echo "<option value='". strtolower($opcoes['tipo']) ."' $selected>". ucfirst($opcoes['tipo']) ."</option>";
                                    //exemplo do resultado: <option value='social'>Social</option>
                                    $selected = "";
                                }
                            ?>
                        </select>
                    </div>
                    
                    <input type="text" name="nome" placeholder="Nome" value="<?=@$_GET['nome'] ?>">

                    <input type="text" name="endereco" placeholder="Endereço" value="<?=@$_GET['endereco'] ?>">


                    <div class="inputs">
                        <label for="dataInicio">Data Inicio:</label>
                        <input type="date" name="dataInicio" value="<?=@$_GET['dataInicio'] ?>">
                    </div>

                    <div class="inputs">
                        <label for="dataFim">Data Fim:</label>
                        <input type="date" name="dataFim" value="<?=@$_GET['dataFim'] ?>">
                    </div>

                    <input type="number" name="precoMin" placeholder="Preco minimo" value="<?= @$_GET['precoMin'] ?>">
                    <input type="number" name="precoMax" placeholder="Preco maximo" value="<?= @$_GET['precoMax'] ?>">

                    <div class="botoes">
                        <button class="primario">Filtrar</button>
                        <button class="secundario" id="limpar">Limpar</button>
                    </div>
                </form>
            </div>
        
            <fieldset>
                <legend>Cadastro de evento</legend>

                <form action="#" method="POST" id="formCriarEvento">
                    <div class="camposCadastro">
                        <label for="opcoes">Tipo do evento:</label>
                        <select name="opcoes" id="tipoEvento" required>
                            <option value="">-</option>
                        <!-- O usuário deve escolher um dos seguintes tipos: social, cultural, esportivo, corporativo, religioso, entretenimento ou outros. -->
                            <?php foreach($tipos as $opcoes) {
                                    echo "<option value='". strtolower($opcoes['tipo']) ."'>". ucfirst($opcoes['tipo']) ."</option>";
                                    //exemplo do resultado: <option value='social'>Social</option>
                                }
                            ?>
                        </select>
                    </div>

                    <div class="camposCadastro">
                        <label for="nome">Nome do evento:</label>
                        <input placeholder="Nome" id="nomeEvento" name="nome" type="text" maxlength="60" required>
                    </div>

                    <div class="camposCadastro">
                            <label for="descricao">Descrição do evento:</label>
                            <input placeholder="Descricao" id="descEvento" name="descricao" type="text" maxlength="150">
                    </div>
                    <!-- poderia ser um textarea-->

                    <div class="camposCadastro">
                        <label for="endereco">Endereço do evento:</label>
                        <input placeholder="Endereco" id="enderecoEvento" name="endereco" type="text" maxlength="200" required>
                    </div>

                    <div class="camposCadastro">
                        <label for="link">Link do Endereço:</label>
                        <input placeholder="Link do Endereco" id="linkEvento" name="link" type="text" maxlength="50">
                    </div>

                    <div class="camposCadastro">
                        <label for="data">Data do evento:</label>
                        <input placeholder="Dia do evento" id="dataEvento" name="data" type="date" required>
                    </div>

                    <div class="camposCadastro">
                        <label for="hora">Hora do evento:</label>
                        <input placeholder="Hora do evento" id="horaEvento" name="hora" type="time" required>
                    </div>

                    <div class="camposCadastro">
                        <label for="preco">Preço do evento:</label>
                        <input placeholder="Preco do evento" id="precoEvento" name="preco" type="number" step="any">
                    </div>

                    <button class="primario">Cadastrar</button>
                </form>
            </fieldset>
            
            <section class="resultados">
                <span>Eventos cadastrados:</span>
                <div class="listagem">
                <?php
                    $stmt = 'SELECT * FROM evento WHERE 1=1'; //selecionando all mesmo, ja que precisamos de tudo
                    //macete para contornar o where e ir para as clausulas variaveis
                    /*--tipo, nome, endereço, data (de/até) e preço (de/até)*/
                    if (!empty($_GET['tipo'])) {
                        $tipo = $_GET['tipo'];
                        $stmt .= ' AND tipo LIKE :tipo';
                    }

                    if (!empty($_GET['nome'])) {
                        $nome = '%' . $_GET['nome'] . '%';
                        $stmt .= ' AND nome LIKE :nome';
                    }

                    if (!empty($_GET['endereco'])) {
                        $endereco = '%' . $_GET['endereco'] . '%';
                        $stmt .= ' AND endereco LIKE :endereco';
                    }

                    if (!empty($_GET['dataInicio']) && !empty($_GET['dataFim'])) {
                        $dataInicio = $_GET['dataInicio'];
                        $dataFim = $_GET['dataFim'];
                        $stmt .= ' AND dataHora_inicio BETWEEN :dataInicio AND :dataFim';
                    }

                    if (!empty($_GET['precoMin']) && !empty($_GET['precoMax'])) {
                        $precoMin = $_GET['precoMin'];
                        $precoMax = $_GET['precoMax'];
                        $stmt .= ' AND preco BETWEEN :precoMin AND :precoMax';
                    }
                    
                    $stmt .= " ORDER BY dataHora_inicio DESC";
                    //prepara a query
                    $comando = $pdo->prepare($stmt);

                    empty($_GET['tipo']) ? '' : $comando->bindParam('tipo', $tipo);
                    empty($_GET['nome']) ? '' : $comando->bindParam('nome', $nome);
                    empty($_GET['endereco']) ? '' : $comando->bindParam('endereco', $endereco);
                    empty($_GET['dataInicio']) ? '' : $comando->bindParam('dataInicio', $dataInicio);
                    empty($_GET['dataFim']) ? '' : $comando->bindParam('dataFim', $dataFim);
                    empty($_GET['precoMin']) ? '' : $comando->bindParam('precoMin', $precoMin);
                    empty($_GET['precoMax']) ? '' : $comando->bindParam('precoMax', $precoMax);
                    
                    $comando->execute();
                    $dadosRetornar = $comando->fetchAll(PDO::FETCH_ASSOC);

                    if($dadosRetornar) {
                        foreach($dadosRetornar as $evento) {
                            echo '<div class="evento">
                                <span>Evento: '. ucfirst($evento['nome']) .'</span>'.
                                '<span>Tipo de evento: '. ucfirst($evento['tipo']) .'</span>'.
                                '<span>Local: '. ucfirst($evento['endereco']) .'</span>'.
                                '<span>Preço: '. ucfirst($evento['preco']) .'</span>'.
                                '<span>Data e hora: '. date('d/m/Y', strtotime($evento['dataHora_inicio'])) . ' às ' . date('H:i', strtotime($evento['dataHora_inicio'])) .'</span>'.

                                '<div class="botoes">'.
                                    '<a class="primario" href="visualizar.php?codigo='. $evento['codigo'] .'">Editar</a>'.
                                    '<a class="secundario" href="../backend/excluir.php?codigo='. $evento['codigo'] .'">Excluir</a>'
                                .'</div>'
                            .'</div>';
                        }
                    }
                    else {
                        echo '<p>Nenhum agendamento encontrado.</p>';
                    }
                ?>
                </div>
            </section>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelector('#limpar').addEventListener('click', (e) => {
                e.preventDefault();
                window.location.href = 'index.php';
            });

            document.querySelectorAll('.secundario').forEach(link => {
                link.addEventListener('click', (e) => {
                e.preventDefault();
                let respostaAlert = confirm("Deseja realmente excluir este evento?");

                if (!respostaAlert) {
                    alert('Operação cancelada!');
                }
                else {
                    console.log('Url para exclusao: ' + e.target.href); // captura o href correto
                    window.location.href = e.target.href; //redireciona para a exclusão se confirmado
                }
                })
            });

            document.querySelector('#formCriarEvento').addEventListener('submit', async (e) => {
                e.preventDefault();

                let respostaAlert = confirm("Deseja cadastrar este evento?");

                if(!respostaAlert) {
                    alert('Operação cancelada!');
                }
                else {
                    const data = document.querySelector('#dataEvento').value;
                    const hora = document.querySelector('#horaEvento').value;

                    let dataHora = data+ " " +hora;

                    const dadosForm = {
                        tipo: document.querySelector('#tipoEvento').value,
                        nome: document.querySelector('#nomeEvento').value,
                        descricao: document.querySelector('#descEvento').value,
                        endereco: document.querySelector('#enderecoEvento').value,
                        link: document.querySelector('#linkEvento').value,
                        data: dataHora,
                        preco: document.querySelector('#precoEvento').value
                    }
                    //console.log(JSON.stringify(dadosForm));
                    //console.log(dadosForm);
                    const retornoBack = await fetch('../backend/cadastrarEvento.php', {
                        method: "POST", //metodo de envio
                        headers: {
                            'Content-Type': 'application/json' //cabecalho para dados em json
                        },
                        body: JSON.stringify(dadosForm) //variavel dadosForm formatada como objeto JSON
                    })
                    .then(response => { //retorno do back
                        console.log(response);
                        if(response.ok === false) {
                            throw new Error("Erro ao cadastrar evento");
                        }
                        else {
                            return response.json(); //se ok, transforma a resposta em JSON
                        }
                    })
                    .catch((erro) => {
                        console.log("Erro: ", erro.message);
                    });
                    console.log(retornoBack);
                    if(!document.querySelector('h4') && retornoBack.failed) {
                        const h4 = document.createElement("h4");
                        h4.textContent = retornoBack.message;
                        h4.style.color = "red";
                        document.querySelector("#formCriarEvento").appendChild(h4);
                    }
                    else {
                        alert("Evento criado com sucesso!");
                        location.reload();
                    }
                }
            });
        });
    </script>
</body>
</html>