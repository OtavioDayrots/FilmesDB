<?php

// Configura a exibição de erros para facilitar a depuração. 'display_errors' exibe erros na saída padrão.
ini_set('display_errors', 1);

// Configura a exibição de erros de inicialização. 'display_startup_errors' exibe erros ocorridos na inicialização.
ini_set('display_startup_errors', 1);

// Define o nível de relatório de erros para exibir todos os erros.
error_reporting(E_ALL);

// Inclui o arquivo de configuração do banco de dados. Esse arquivo contém as configurações para conexão com o banco.
require __dir__ . "\..\..\Config\Database.php";

// Inclui o modelo 'Usuario', que representa a tabela de usuarios no banco de dados.
require __dir__ . "\..\..\Model\Usuario.php";

// Cria uma instância da classe 'Usuario', passando a conexão do banco de dados como argumento.
$usuarioModel = new Usuario($conn);

// Recupera todos os registros de usuarios usando o método 'findAll' do modelo 'Usuario' e armazena na variável '$usuarios'.
$usuarios = $usuarioModel->findAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Define o charset como UTF-8 para suportar caracteres especiais -->
    <meta charset="UTF-8">
    
    <!-- Configura a visualização para dispositivos móveis, definindo a escala inicial -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Define o título da página -->
    <title></title>

    <!-- Inclui a biblioteca Font Awesome para uso de ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Inclui o arquivo de CSS reset para remover estilos padrões dos navegadores -->
    <link rel="stylesheet" href="Styles/reset.css">
    
    <style>
        /* Estilo da página */
        
        /* Define a cor de fundo e a fonte principal da página */
        body {
            background-color: #181616;
            font-family: 'Arial', Times, serif;
        }

        /* Estilo do título */
        h1 {
            font-size: 28px;
            color: #fdfdfd;
            text-align: center;
            margin: 2rem 0 1rem 0;
        }

        /* Estilo da tabela */
        table {
            margin: 3rem auto;

            /* Define o estilo das células da tabela */
            tr, td, th {
                padding: 1rem;
                color: #fdfdfd;
                font-weight: bold;
            }

            /* Define a cor de fundo do cabeçalho da tabela */
            th {
                background-color: #333;
            }

            /* Define a cor de fundo das linhas ímpares da tabela */
            tr:nth-child(odd) {
                background-color: #1d1d1d;
            }

            /* Define a cor de fundo das linhas pares da tabela */
            tr:nth-child(even) {
                background-color: #333;
            }

            /* Centraliza o conteúdo dentro das células com a classe 'butao' */
            .butao {
                text-align: center;
            }
        }

        /* Estilo da notificação */
        .notificacao {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem;
            border-radius: 15px;
            transition: 1s;
            color: #fff;
        }

        /* Define a cor de fundo da notificação de sucesso */
        .notificacao.sucesso {
            background-color: rgb(71, 190, 12);
        }

        /* Define a cor de fundo da notificação de erro */
        .notificacao.erro {
            background-color: rgb(200, 12, 12);
        }

    </style>

</head>
<body>
    <!-- Título principal da página -->
    <h1>Lista de usuarios</h1>

    <!-- Tabela para exibir a lista de usuarios -->
    <table>
        <thead>
            <tr>
                <th>Id</th> <!-- Coluna para o ID do usuario -->
                <th>Nome</th> <!-- Coluna para o título do usuario -->
                <th>E-mail</th> <!-- Coluna para o ano de lançamento do usuario -->
                <th>Nascimento</th> <!-- Coluna para a descrição do usuario -->
                <th>Detalhes</th> <!-- Coluna para o botão de detalhes do usuario -->
                <th>Excluir</th> <!-- Coluna para o botão de exclusão do usuario -->
            </tr>
        </thead>
        <tbody>
            <!-- Início do loop para percorrer a lista de usuarios -->
            <?php foreach ($usuarios as $usuario) { ?>
                <tr>
                    <!-- Exibe o ID do usuario na coluna correspondente -->
                    <td><?php echo $usuario->id ?></td>
                    
                    <!-- Exibe o nome do usuario na coluna correspondente -->
                    <td><?php echo $usuario->nome ?></td>
                    
                    <!-- Exibe o e-mail de lançamento do usuario na coluna correspondente -->
                    <td><?php echo $usuario->email ?></td>
                    
                    <!-- Exibe a nascimento do usuario na coluna correspondente -->
                    <td><?php echo $usuario->nascimento ?></td>
                    
                    <!-- Botão para visualizar os detalhes do usuario -->
                    <td class="butao">
                        <form action="Visualizar.php" method="GET">
                            <!-- Campo oculto com o ID do usuario para passar como parâmetro -->
                            <input type="hidden" name="id" value="<?php echo $usuario->id ?>">
                            <!-- Botão com ícone de olho para indicar visualização -->
                            <button><i class="fa fa-eye"></i></button>
                        </form>
                    </td>

                    <!-- Botão para excluir o usuario -->
                    <td class="butao">
                        <form action="Excluir.php" method="POST">
                            <!-- Campo oculto com o ID do usuario para passar como parâmetro -->
                            <input type="hidden" name="id" value="<?php echo $usuario->id ?>">
                            <!-- Botão com ícone de lixeira para indicar exclusão -->
                            <button><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            <!-- Fim do loop -->
        </tbody>
    </table>

    <!-- Script para exibir uma notificação de sucesso ou erro após uma ação -->
    <script defer>
        // Cria uma instância de URLSearchParams para acessar os parâmetros da URL
        const parametros = new URLSearchParams(window.location.search);

        // Obtém o valor do parâmetro 'mensagem' da URL
        const tipoMensagem = parametros.get("mensagem");

        // Verifica se o valor de 'mensagem' é "Sucesso" ou "Erro"
        if (tipoMensagem === "Sucesso" || tipoMensagem === "Erro") {
            // Cria um elemento <div> para exibir a notificação
            const notificacao = document.createElement("div");

            // Define a classe de notificação com base no tipo de mensagem
            notificacao.className = "notificacao " + (tipoMensagem === "Sucesso" ? "sucesso" : "erro");

            // Define o texto da notificação
            notificacao.innerHTML = tipoMensagem === "Sucesso" 
                ? "Remoção feita com sucesso" 
                : "Erro. Item não removido";

            // Adiciona a notificação ao corpo da página
            document.body.appendChild(notificacao);

            // Define um tempo para remover a notificação após 2.5 segundos
            setTimeout(() => {
                notificacao.remove();
            }, 2500);
        }
    </script>
</body>
</html>
