<?php

// Configura a exibição de erros para facilitar a depuração. 'display_errors' exibe erros na saída padrão.
ini_set('display_errors', 1);

// Configura a exibição de erros de inicialização. 'display_startup_errors' exibe erros ocorridos na inicialização.
ini_set('display_startup_errors', 1);

// Define o nível de relatório de erros para exibir todos os erros.
error_reporting(E_ALL);

// Inclui o arquivo de configuração do banco de dados. Esse arquivo contém as configurações para conexão com o banco.
require __dir__ . "\..\..\Config\Database.php";

// Inclui o modelo 'Filme', que representa a tabela de filmes no banco de dados.
require __dir__ . "\..\..\Model\Filme.php";

// Cria uma instância da classe 'Filme', passando a conexão do banco de dados como argumento.
$filmeModel = new Filme($conn);

// Recupera todos os registros de filmes usando o método 'findAll' do modelo 'Filme' e armazena na variável '$filmes'.
$filmes = $filmeModel->findAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="Styles/reset.css">
    <link rel="stylesheet" href="Styles/listar.css">
</head>
<body>
    
    <h1>Lista de Filmes</h1>

    <div class="container-cadastro">
        <a href="Cadastrar.php" class="cadastro">Cadastrar</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Ano</th>
                <th>Descrição</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($filmes as $filme) { ?>
                <tr>
                    <td><?php echo $filme->id ?></td>
                    <td><?php echo $filme->titulo ?></td>
                    <td><?php echo $filme->ano ?></td>
                    <td class="descricao"><?php echo $filme->descricao ?></td>
                    <td class="butoes">
                        <form action="Visualizar.php" method="GET">
                            <input type="hidden" name="id" value="<?php echo $filme->id ?>">
                            <button class="botao"><i class="fa fa-eye"></i></button>
                        </form>
                        <form action="Editar.php" method="GET">
                            <input type="hidden" name="id" value="<?php echo $filme->id ?>">
                            <button class="botao"><i class="fa fa-pencil-alt"></i></button>
                        </form>
                        <form action="Excluir.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $filme->id ?>">
                            <button class="botao"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <script defer>
        const parametros = new URLSearchParams(window.location.search);
        const tipoStatus = parametros.get("status");
        const tipoMensagem = parametros.get("mensagem");

        if (tipoMensagem === "Sucesso" || tipoMensagem === "Erro") {
            const notificacao = document.createElement("div");
            notificacao.className = "notificacao " + (tipoMensagem === "Sucesso" ? "sucesso" : "erro");

            if (tipoStatus === "Excluir") {
                notificacao.innerHTML = tipoMensagem === "Sucesso" 
                    ? "Remoção feita com sucesso" 
                    : "Erro. Item não removido";
            } 
            else if (tipoStatus === "Cadastro") {
                notificacao.innerHTML = tipoMensagem === "Sucesso" 
                    ? "Cadastro feito com sucesso" 
                    : "Erro. Item não cadastrado";
            }
            else if (tipoStatus === "Atualizado") {
                notificacao.innerHTML = tipoMensagem === "Sucesso" 
                    ? "Atualizado com sucesso" 
                    : "Erro. Item não atualizado";
            }

            document.body.appendChild(notificacao);

            setTimeout(() => {
                notificacao.remove();
                parametros.delete("mensagem");
                const novaUrl = window.location.pathname;
                window.history.replaceState(null, "", novaUrl);
            }, 2500);
        }
    </script>
</body>
</html>
